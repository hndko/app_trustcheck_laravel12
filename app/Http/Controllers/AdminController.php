<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\SearchHistory;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tampilkan dasbor analitik internal dan penggunaan token AI.
     */
    public function dashboard()
    {
        $totalCompanies = Company::count();
        $completedCount = Company::where('status', 'completed')->count();
        $averageScore = Company::where('status', 'completed')->avg('trust_score') ?: 0;

        $lowRiskCount = Company::where('status', 'completed')->where('risk_level', 'LOW RISK')->count();
        $mediumRiskCount = Company::where('status', 'completed')->where('risk_level', 'MEDIUM RISK')->count();
        $highRiskCount = Company::where('status', 'completed')->where('risk_level', 'HIGH RISK')->count();

        // Estimasi konsumsi token AI (Asumsi ~2.850 token per analisis due diligence lengkap)
        $estimatedTokens = $completedCount * 2850;

        $recentCompanies = Company::orderByDesc('updated_at')->take(8)->get();
        $popularSearches = SearchHistory::orderByDesc('search_count')->take(6)->get();

        $data = [
            'title' => 'Dasbor Analitik & Monitoring — TrustCheck Kelola',
            'totalCompanies' => $totalCompanies,
            'completedCount' => $completedCount,
            'averageScore' => round($averageScore, 1),
            'estimatedTokens' => number_format($estimatedTokens, 0, ',', '.'),
            'lowRiskCount' => $lowRiskCount,
            'mediumRiskCount' => $mediumRiskCount,
            'highRiskCount' => $highRiskCount,
            'recentCompanies' => $recentCompanies,
            'popularSearches' => $popularSearches,
        ];

        return view('backend.dashboard.index', $data);
    }
}
