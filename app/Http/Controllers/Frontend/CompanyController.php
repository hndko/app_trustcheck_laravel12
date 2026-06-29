<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Company;
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
}
