@extends('layouts.app-backend')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Top Welcome Banner -->
    <div class="bg-linear-to-r from-[#1E293B] via-[#1E293B] to-[#0F172A] rounded-2xl border border-[#334155] p-6 sm:p-8 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
        <div class="space-y-2 relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#2563EB]/10 border border-[#2563EB]/30 text-[#38BDF8] text-xs font-bold">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                <span>Enterprise Due Diligence Engine</span>
            </div>
            <h2 class="text-xl sm:text-2xl font-black text-white tracking-tight">Pusat Kendali & Intelijensi Perusahaan</h2>
            <p class="text-xs sm:text-sm text-[#94A3B8] max-w-2xl leading-relaxed">Pantau ekstraksi data publik, performa model LLM aktif, serta distribusi reputasi bisnis secara real-time dengan pengawasan objektif.</p>
        </div>
        <div class="flex items-center gap-3 relative z-10 shrink-0">
            <a href="{{ route('portal.providers.index') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-xs font-bold shadow-sm transition-all">
                <i data-lucide="cpu" class="w-4 h-4"></i>
                <span>Kelola Provider AI</span>
            </a>
            <a href="{{ route('search.index') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#0F172A] hover:bg-[#334155] border border-[#334155] text-[#E2E8F0] text-xs font-bold transition-all">
                <i data-lucide="search" class="w-4 h-4"></i>
                <span>Cari Perusahaan</span>
            </a>
        </div>
    </div>

    <!-- Top KPI Banner -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- KPI 1 -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] hover:border-[#38BDF8]/40 p-6 shadow-sm transition-all">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-extrabold text-[#94A3B8] uppercase tracking-wider">Total Entitas Diproses</span>
                <div class="w-10 h-10 rounded-xl bg-[#2563EB]/10 border border-[#2563EB]/20 text-[#38BDF8] flex items-center justify-center shrink-0">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white tracking-tight mb-2">{{ number_format($totalCompanies) }}</div>
            <div class="text-xs text-[#10B981] font-bold flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                <span>{{ number_format($completedCount) }} Selesai Dianalisis</span>
            </div>
        </div>

        <!-- KPI 2 -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] hover:border-[#10B981]/40 p-6 shadow-sm transition-all">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-extrabold text-[#94A3B8] uppercase tracking-wider">Rata-Rata Trust Score</span>
                <div class="w-10 h-10 rounded-xl bg-[#10B981]/10 border border-[#10B981]/20 text-[#10B981] flex items-center justify-center shrink-0">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white tracking-tight mb-2">{{ $averageScore }}<span class="text-sm font-semibold text-[#64748B]">/100</span></div>
            <div class="text-xs text-[#94A3B8] font-medium">Skor kredibilitas gabungan AI</div>
        </div>

        <!-- KPI 3 -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] hover:border-[#F59E0B]/40 p-6 shadow-sm transition-all">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-extrabold text-[#94A3B8] uppercase tracking-wider">Estimasi Token AI</span>
                <div class="w-10 h-10 rounded-xl bg-[#F59E0B]/10 border border-[#F59E0B]/20 text-[#FBBF24] flex items-center justify-center shrink-0">
                    <i data-lucide="cpu" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white tracking-tight mb-2">{{ number_format($estimatedTokens) }}</div>
            <div class="text-xs text-[#FBBF24] font-bold flex items-center gap-1">
                <i data-lucide="activity" class="w-3.5 h-3.5"></i>
                <span>Konsumsi prompt & ekstraksi</span>
            </div>
        </div>

        <!-- KPI 4 -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] hover:border-[#8B5CF6]/40 p-6 shadow-sm transition-all">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-extrabold text-[#94A3B8] uppercase tracking-wider">Efisiensi Cache TTL</span>
                <div class="w-10 h-10 rounded-xl bg-[#8B5CF6]/10 border border-[#8B5CF6]/20 text-[#A78BFA] flex items-center justify-center shrink-0">
                    <i data-lucide="zap" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white tracking-tight mb-2">{{ config('ai.cache_ttl_days', 7) }} <span class="text-base font-bold text-[#64748B]">Hari</span></div>
            <div class="text-xs text-[#A78BFA] font-bold">Aktif menghemat kuota LLM</div>
        </div>
    </div>

    <!-- Risk Level Breakdown -->
    <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-6 sm:p-8 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 pb-4 border-b border-[#334155]">
            <div>
                <h3 class="text-sm font-extrabold text-white uppercase tracking-wider flex items-center gap-2">
                    <i data-lucide="pie-chart" class="w-4 h-4 text-[#38BDF8]"></i>
                    <span>Distribusi Tingkat Risiko (Risk Level Distribution)</span>
                </h3>
                <p class="text-xs text-[#94A3B8] mt-1">Proporsi klasifikasi risiko berdasarkan keseluruhan entitas perusahaan yang selesai diproses.</p>
            </div>
            <span class="text-xs font-bold text-[#64748B] uppercase">Total Diuji: {{ number_format($completedCount) }}</span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-[#0F172A] rounded-xl p-5 border border-[#334155]">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-extrabold text-[#10B981] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                        Low Risk (Risiko Rendah)
                    </span>
                    <span class="text-xl font-black text-white">{{ number_format($lowRiskCount) }} <span class="text-xs font-normal text-[#64748B]">({{ $completedCount > 0 ? round(($lowRiskCount / $completedCount) * 100) : 0 }}%)</span></span>
                </div>
                <div class="w-full h-2 rounded-full bg-[#1E293B] overflow-hidden">
                    <div class="h-full bg-[#10B981] rounded-full transition-all duration-500" style="width: {{ $completedCount > 0 ? ($lowRiskCount / $completedCount) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div class="bg-[#0F172A] rounded-xl p-5 border border-[#334155]">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-extrabold text-[#F59E0B] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#F59E0B]"></span>
                        Medium Risk (Risiko Sedang)
                    </span>
                    <span class="text-xl font-black text-white">{{ number_format($mediumRiskCount) }} <span class="text-xs font-normal text-[#64748B]">({{ $completedCount > 0 ? round(($mediumRiskCount / $completedCount) * 100) : 0 }}%)</span></span>
                </div>
                <div class="w-full h-2 rounded-full bg-[#1E293B] overflow-hidden">
                    <div class="h-full bg-[#F59E0B] rounded-full transition-all duration-500" style="width: {{ $completedCount > 0 ? ($mediumRiskCount / $completedCount) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div class="bg-[#0F172A] rounded-xl p-5 border border-[#334155]">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-xs font-extrabold text-[#EF4444] uppercase tracking-wider flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#EF4444]"></span>
                        High Risk (Risiko Tinggi)
                    </span>
                    <span class="text-xl font-black text-white">{{ number_format($highRiskCount) }} <span class="text-xs font-normal text-[#64748B]">({{ $completedCount > 0 ? round(($highRiskCount / $completedCount) * 100) : 0 }}%)</span></span>
                </div>
                <div class="w-full h-2 rounded-full bg-[#1E293B] overflow-hidden">
                    <div class="h-full bg-[#EF4444] rounded-full transition-all duration-500" style="width: {{ $completedCount > 0 ? ($highRiskCount / $completedCount) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Analyses Table -->
    <div class="bg-[#1E293B] rounded-2xl border border-[#334155] shadow-sm overflow-hidden">
        <div class="p-6 border-b border-[#334155] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-sm font-extrabold text-white uppercase tracking-wider flex items-center gap-2">
                    <i data-lucide="history" class="w-4 h-4 text-[#38BDF8]"></i>
                    <span>Log Aktivitas Analisis Due Diligence Terkini</span>
                </h3>
                <p class="text-xs text-[#94A3B8] mt-1">Daftar riwayat verifikasi entitas perusahaan yang masuk ke dalam sistem.</p>
            </div>
            <span class="px-3 py-1 rounded-lg bg-[#0F172A] border border-[#334155] text-xs font-bold text-[#94A3B8] shrink-0">8 Entitas Terakhir</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-150">
                <thead>
                    <tr class="bg-[#0F172A] text-[#94A3B8] text-[11px] font-extrabold uppercase tracking-wider border-b border-[#334155]">
                        <th class="py-4 px-6">Nama Perusahaan</th>
                        <th class="py-4 px-6">Sektor Industri</th>
                        <th class="py-4 px-6 text-center">Status Pemrosesan</th>
                        <th class="py-4 px-6 text-center">Trust Score</th>
                        <th class="py-4 px-6 text-center">Klasifikasi Risiko</th>
                        <th class="py-4 px-6 text-right">Waktu Pembaruan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155] text-sm text-[#E2E8F0]">
                    @forelse($recentCompanies as $comp)
                        <tr class="hover:bg-[#334155]/40 transition-colors">
                            <td class="py-4 px-6 font-bold text-white">
                                <a href="{{ route('search.result', $comp->id) }}" target="_blank" class="hover:text-[#38BDF8] transition-colors flex items-center gap-2">
                                    <span>{{ $comp->name }}</span>
                                    <i data-lucide="external-link" class="w-3.5 h-3.5 text-[#64748B]"></i>
                                </a>
                            </td>
                            <td class="py-4 px-6 text-xs text-[#94A3B8] font-medium">{{ $comp->industry ?: 'Sektor Umum / Publik' }}</td>
                            <td class="py-4 px-6 text-center">
                                @if($comp->status === 'completed')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#10B981]/10 border border-[#10B981]/20 text-[#10B981] text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#10B981]"></span>
                                        Selesai
                                    </span>
                                @elseif($comp->status === 'processing')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#F59E0B]/10 border border-[#F59E0B]/20 text-[#FBBF24] text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#F59E0B] animate-ping"></span>
                                        Proses AI
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EF4444]/10 border border-[#EF4444]/20 text-[#EF4444] text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#EF4444]"></span>
                                        Gagal
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="font-black text-base {{ $comp->trust_score >= 80 ? 'text-[#10B981]' : ($comp->trust_score >= 60 ? 'text-[#FBBF24]' : 'text-[#EF4444]') }}">{{ $comp->trust_score }}</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="px-3 py-1 rounded-md text-[11px] font-extrabold uppercase tracking-wider {{ $comp->risk_level === 'LOW RISK' ? 'bg-[#10B981]/15 text-[#10B981] border border-[#10B981]/30' : ($comp->risk_level === 'MEDIUM RISK' ? 'bg-[#F59E0B]/15 text-[#FBBF24] border border-[#F59E0B]/30' : 'bg-[#EF4444]/15 text-[#EF4444] border border-[#EF4444]/30') }}">{{ $comp->risk_level }}</span>
                            </td>
                            <td class="py-4 px-6 text-right text-xs text-[#94A3B8] font-medium">{{ $comp->updated_at ? $comp->updated_at->diffForHumans() : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-[#94A3B8]">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <div class="w-12 h-12 rounded-full bg-[#0F172A] border border-[#334155] flex items-center justify-center text-[#64748B]">
                                        <i data-lucide="inbox" class="w-6 h-6"></i>
                                    </div>
                                    <div class="text-sm font-bold text-white">Belum Ada Data Analisis</div>
                                    <div class="text-xs text-[#64748B]">Lakukan pencarian nama perusahaan pertama Anda di portal publik.</div>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
