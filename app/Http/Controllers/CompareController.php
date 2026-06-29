<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /**
     * Tampilkan matriks perbandingan reputasi antar perusahaan.
     */
    public function index(Request $request)
    {
        $allCompleted = Company::where('status', 'completed')->orderBy('name')->get();

        $selectedIds = array_filter(explode(',', (string) $request->input('companies', '')));

        if (empty($selectedIds)) {
            // Default: ambil maksimal 3 perusahaan yang sudah completed sebagai contoh perbandingan awal
            $selectedCompanies = Company::with(['metric'])->where('status', 'completed')->take(3)->get();
        } else {
            $selectedCompanies = Company::with(['metric'])
                ->whereIn('id', $selectedIds)
                ->take(3)
                ->get();
        }

        $data = [
            'title' => 'Komparasi Reputasi Perusahaan — TrustCheck AI',
            'allCompleted' => $allCompleted,
            'selectedCompanies' => $selectedCompanies,
            'selectedIds' => $selectedCompanies->pluck('id')->toArray(),
        ];

        return view('frontend.compare.index', $data);
    }
}
