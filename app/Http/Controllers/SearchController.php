<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDueDiligenceJob;
use App\Models\Company;
use App\Models\Faq;
use App\Models\SearchHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    /**
     * Tampilkan halaman utama portal pencarian.
     */
    public function index()
    {
        $data = [
            'title' => 'TrustCheck AI — Cari Reputasi Perusahaan',
            'popularSearches' => SearchHistory::orderByDesc('search_count')->take(6)->get(),
            'faqs' => Faq::where('is_active', true)->orderBy('order')->get(),
        ];

        return view('frontend.search.index', $data);
    }

    /**
     * Proses input pencarian dari pengguna.
     */
    public function process(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2|max:100',
        ], [
            'query.required' => 'Nama perusahaan wajib diisi.',
            'query.min' => 'Nama perusahaan minimal terdiri dari 2 karakter.',
            'query.max' => 'Nama perusahaan maksimal 100 karakter.',
        ]);

        $queryClean = trim(strip_tags($request->input('query')));
        $slug = Str::slug($queryClean);

        // Update atau catat riwayat pencarian populer
        $history = SearchHistory::firstOrCreate(
            ['query' => $queryClean],
            ['search_count' => 0]
        );
        $history->increment('search_count');

        // Cek apakah perusahaan sudah pernah diproses sebelumnya
        $company = Company::where('slug', $slug)->first();
        $ttlDays = config('ai.cache_ttl_days', 7);

        if ($company) {
            if ($company->status === 'completed' && now()->diffInDays($company->updated_at) < $ttlDays) {
                return redirect()->route('search.result', $company->id);
            }
            if ($company->status === 'processing') {
                return redirect()->route('search.loading', $company->id);
            }
            
            // Perbarui status menjadi processing kembali jika data sudah kedaluwarsa (> 7 hari) atau sebelumnya failed
            $company->update(['status' => 'processing']);
            ProcessDueDiligenceJob::dispatchSync($company->id, $queryClean);
            return redirect()->route('search.result', $company->id);
        }

        // Buat entitas perusahaan baru berstatus processing
        $company = Company::create([
            'name' => $queryClean,
            'slug' => $slug,
            'status' => 'processing',
            'trust_score' => 0,
            'risk_level' => 'UNKNOWN',
        ]);

        // Eksekusi job untuk pengumpulan data & analisis AI
        // Menggunakan dispatchSync agar proses selesai seketika di lingkungan lokal tanpa antrean tertahan
        ProcessDueDiligenceJob::dispatchSync($company->id, $queryClean);

        return redirect()->route('search.result', $company->id);
    }

    /**
     * Tampilkan halaman Skeleton Loading jika proses masih berjalan.
     */
    public function loading(string $id)
    {
        $company = Company::findOrFail($id);

        if ($company->status === 'completed') {
            return redirect()->route('search.result', $company->id);
        }

        $data = [
            'title' => 'Menganalisis Reputasi — ' . $company->name,
            'company' => $company,
        ];

        return view('frontend.search.loading', $data);
    }

    /**
     * Endpoint API ringan untuk pengecekan status (AJAX polling).
     */
    public function status(string $id)
    {
        $company = Company::findOrFail($id);

        return response()->json([
            'status' => $company->status,
            'redirect_url' => route('search.result', $company->id),
        ]);
    }

    /**
     * Tampilkan halaman laporan hasil Due Diligence komprehensif.
     */
    public function result(string $id)
    {
        $company = Company::with(['metric', 'sources', 'news'])->findOrFail($id);

        if ($company->status === 'processing') {
            return redirect()->route('search.loading', $company->id);
        }

        $data = [
            'title' => $company->name . ' — Laporan Due Diligence & Reputasi',
            'company' => $company,
        ];

        return view('frontend.search.result', $data);
    }
}
