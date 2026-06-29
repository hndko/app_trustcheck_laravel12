<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\DataCorrection;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Ekspor laporan due diligence berformat PDF dengan kop resmi TrustCheck AI.
     */
    public function exportPdf(string $id)
    {
        $company = Company::with(['metric', 'sources', 'news'])->findOrFail($id);

        $data = [
            'title' => 'Laporan Due Diligence — ' . $company->name,
            'company' => $company,
            'generatedAt' => now()->translatedFormat('d F Y H:i'),
        ];

        $pdf = Pdf::loadView('frontend.company.pdf', $data);
        $pdf->setPaper('a4', 'portrait');

        $filename = 'Laporan-Due-Diligence-' . Str::slug($company->name) . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Simpan laporan koreksi data hasil analisis AI dari pengguna publik.
     */
    public function storeCorrection(Request $request, string $id)
    {
        $company = Company::findOrFail($id);

        $request->validate([
            'reporter_name' => 'nullable|string|max:100',
            'reporter_email' => 'nullable|email|max:100',
            'correction_details' => 'required|string|min:10|max:2000',
        ], [
            'correction_details.required' => 'Rincian koreksi data wajib diisi.',
            'correction_details.min' => 'Rincian koreksi minimal 10 karakter agar dapat kami verifikasi.',
            'reporter_email.email' => 'Format alamat email tidak valid.',
        ]);

        DataCorrection::create([
            'company_id' => $company->id,
            'reporter_name' => $request->reporter_name,
            'reporter_email' => $request->reporter_email,
            'correction_details' => $request->correction_details,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Laporan koreksi data berhasil dikirim. Tim editorial dan AI kami akan melakukan peninjauan ulang.');
    }
}
