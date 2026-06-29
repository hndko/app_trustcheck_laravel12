@extends('layouts.app-backend')

@section('content')
<div class="space-y-8 max-w-7xl mx-auto">
    <!-- Top KPI Banner -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- KPI 1 -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-[#94A3B8] uppercase tracking-wider">Total Entitas Diproses</span>
                <div class="w-10 h-10 rounded-xl bg-[#2563EB]/20 text-[#38BDF8] flex items-center justify-center">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white mb-1">{{ $totalCompanies }}</div>
            <div class="text-xs text-[#10B981] font-semibold flex items-center gap-1">
                <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i>
                <span>{{ $completedCount }} Selesai Dianalisis</span>
            </div>
        </div>

        <!-- KPI 2 -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-[#94A3B8] uppercase tracking-wider">Rata-Rata Trust Score</span>
                <div class="w-10 h-10 rounded-xl bg-[#10B981]/20 text-[#10B981] flex items-center justify-center">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white mb-1">{{ $averageScore }}<span class="text-sm font-normal text-[#94A3B8]">/100</span></div>
            <div class="text-xs text-[#94A3B8]">Skor kredibilitas gabungan AI</div>
        </div>

        <!-- KPI 3 -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-[#94A3B8] uppercase tracking-wider">Estimasi Token AI</span>
                <div class="w-10 h-10 rounded-xl bg-[#F59E0B]/20 text-[#FBBF24] flex items-center justify-center">
                    <i data-lucide="cpu" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white mb-1">{{ $estimatedTokens }}</div>
            <div class="text-xs text-[#FBBF24] font-semibold">Konsumsi prompt & ekstraksi</div>
        </div>

        <!-- KPI 4 -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-6 shadow-sm">
            <div class="flex items-center justify-between mb-4">
                <span class="text-xs font-bold text-[#94A3B8] uppercase tracking-wider">Efisiensi Cache TTL</span>
                <div class="w-10 h-10 rounded-xl bg-[#8B5CF6]/20 text-[#A78BFA] flex items-center justify-center">
                    <i data-lucide="zap" class="w-5 h-5"></i>
                </div>
            </div>
            <div class="text-3xl font-black text-white mb-1">7 <span class="text-base font-normal text-[#94A3B8]">Hari</span></div>
            <div class="text-xs text-[#A78BFA] font-semibold">Aktif menghemat kuota LLM</div>
        </div>
    </div>

    <!-- Risk Level Breakdown -->
    <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-6 shadow-sm">
        <h3 class="text-sm font-bold text-white uppercase tracking-wider mb-6 flex items-center gap-2">
            <i data-lucide="pie-chart" class="w-4 h-4 text-[#38BDF8]"></i>
            <span>Distribusi Tingkat Risiko (Risk Level Distribution)</span>
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-[#0F172A] rounded-xl p-5 border border-[#334155]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-extrabold text-[#10B981] uppercase">Low Risk</span>
                    <span class="text-xl font-black text-white">{{ $lowRiskCount }}</span>
                </div>
                <div class="w-full h-2 rounded-full bg-[#1E293B] overflow-hidden">
                    <div class="h-full bg-[#10B981] rounded-full" style="width: {{ $completedCount > 0 ? ($lowRiskCount / $completedCount) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div class="bg-[#0F172A] rounded-xl p-5 border border-[#334155]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-extrabold text-[#F59E0B] uppercase">Medium Risk</span>
                    <span class="text-xl font-black text-white">{{ $mediumRiskCount }}</span>
                </div>
                <div class="w-full h-2 rounded-full bg-[#1E293B] overflow-hidden">
                    <div class="h-full bg-[#F59E0B] rounded-full" style="width: {{ $completedCount > 0 ? ($mediumRiskCount / $completedCount) * 100 : 0 }}%"></div>
                </div>
            </div>

            <div class="bg-[#0F172A] rounded-xl p-5 border border-[#334155]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-extrabold text-[#EF4444] uppercase">High Risk</span>
                    <span class="text-xl font-black text-white">{{ $highRiskCount }}</span>
                </div>
                <div class="w-full h-2 rounded-full bg-[#1E293B] overflow-hidden">
                    <div class="h-full bg-[#EF4444] rounded-full" style="width: {{ $completedCount > 0 ? ($highRiskCount / $completedCount) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Analyses Table -->
    <div class="bg-[#1E293B] rounded-2xl border border-[#334155] shadow-sm overflow-hidden">
        <div class="p-6 border-b border-[#334155] flex items-center justify-between">
            <h3 class="text-sm font-bold text-white uppercase tracking-wider flex items-center gap-2">
                <i data-lucide="history" class="w-4 h-4 text-[#38BDF8]"></i>
                <span>Log Aktivitas Analisis Due Diligence Terkini</span>
            </h3>
            <span class="text-xs text-[#94A3B8]">8 Entitas Terakhir</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-[#0F172A] text-[#94A3B8] text-xs font-bold uppercase tracking-wider border-b border-[#334155]">
                        <th class="py-4 px-6">Nama Perusahaan</th>
                        <th class="py-4 px-6">Industri</th>
                        <th class="py-4 px-6 text-center">Status</th>
                        <th class="py-4 px-6 text-center">Trust Score</th>
                        <th class="py-4 px-6 text-center">Risk Level</th>
                        <th class="py-4 px-6 text-right">Waktu Pembaruan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155] text-sm text-[#E2E8F0]">
                    @forelse($recentCompanies as $comp)
                        <tr class="hover:bg-[#334155]/50 transition-colors">
                            <td class="py-4 px-6 font-bold text-white">
                                <a href="{{ route('search.result', $comp->id) }}" class="hover:text-[#38BDF8] transition-colors">
                                    {{ $comp->name }}
                                </a>
                            </td>
                            <td class="py-4 px-6 text-xs text-[#94A3B8]">{{ $comp->industry ?: 'Umum' }}</td>
                            <td class="py-4 px-6 text-center">
                                @if($comp->status === 'completed')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#10B981]/20 text-[#10B981] text-[11px] font-bold">Selesai</span>
                                @elseif($comp->status === 'processing')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#F59E0B]/20 text-[#FBBF24] text-[11px] font-bold">Proses</span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-[#EF4444]/20 text-[#EF4444] text-[11px] font-bold">Gagal</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center font-black text-[#38BDF8]">{{ $comp->trust_score }}</td>
                            <td class="py-4 px-6 text-center">
                                @php
                                    $badge = 'bg-[#EF4444]/20 text-[#EF4444]';
                                    if ($comp->risk_level === 'LOW RISK') $badge = 'bg-[#10B981]/20 text-[#10B981]';
                                    if ($comp->risk_level === 'MEDIUM RISK') $badge = 'bg-[#F59E0B]/20 text-[#FBBF24]';
                                @endphp
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-extrabold uppercase {{ $badge }}">{{ $comp->risk_level }}</span>
                            </td>
                            <td class="py-4 px-6 text-right text-xs text-[#94A3B8]">{{ $comp->updated_at ? $comp->updated_at->diffForHumans() : '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-[#94A3B8]">Belum ada data analisis perusahaan yang tercatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
