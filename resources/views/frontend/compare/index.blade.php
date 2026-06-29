@extends('layouts.app-frontend')

@section('content')
<div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10 pb-8 border-b border-[#E5E7EB]">
        <div>
            <div class="flex items-center gap-2 text-xs font-semibold text-[#64748B] mb-2">
                <a href="{{ route('search.index') }}" class="hover:text-[#2563EB] transition-colors">Beranda</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-[#0F172A]">Komparasi Reputasi</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                Matriks Perbandingan Entitas
            </h1>
            <p class="text-sm text-[#475569] mt-1">Bandingkan indikator due diligence, Trust Score AI, dan risiko operasional dari beberapa perusahaan sekaligus.</p>
        </div>

        <!-- Selector Form -->
        <form action="{{ route('compare.index') }}" method="GET" class="flex flex-wrap items-center gap-3" x-data="{
            selected: {{ json_encode($selectedIds) }},
            updateQuery() {
                window.location.href = '{{ route('compare.index') }}?companies=' + this.selected.join(',');
            }
        }">
            <div class="relative min-w-[260px]">
                <select x-model="selected" @change="updateQuery()" multiple class="hidden">
                </select>
                <div class="text-xs font-bold text-[#475569] mb-1">Pilih Perusahaan untuk Dibandingkan (Maks. 3):</div>
                <div class="flex flex-wrap gap-2">
                    @foreach($allCompleted as $comp)
                        <a href="{{ route('compare.index') }}?companies={{ implode(',', array_unique(array_merge(in_array($comp->id, $selectedIds) ? array_diff($selectedIds, [$comp->id]) : $selectedIds, [$comp->id]))) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold border transition-all {{ in_array($comp->id, $selectedIds) ? 'bg-[#2563EB] text-white border-[#2563EB] shadow-2xs' : 'bg-white text-[#334155] border-[#D1D5DB] hover:bg-[#F8FAFC]' }}">
                            <span>{{ $comp->name }}</span>
                            @if(in_array($comp->id, $selectedIds))
                                <i data-lucide="check" class="w-3.5 h-3.5"></i>
                            @else
                                <i data-lucide="plus" class="w-3.5 h-3.5 text-[#94A3B8]"></i>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </form>
    </div>

    @if($selectedCompanies->isEmpty())
        <div class="bg-white rounded-2xl border border-[#E5E7EB] p-12 text-center max-w-xl mx-auto shadow-sm">
            <div class="w-16 h-16 rounded-2xl bg-[#EFF6FF] text-[#2563EB] flex items-center justify-center mx-auto mb-4">
                <i data-lucide="git-compare" class="w-8 h-8"></i>
            </div>
            <h3 class="text-lg font-bold text-[#0F172A] mb-2">Belum Ada Perusahaan Dipilih</h3>
            <p class="text-sm text-[#64748B] mb-6">Silakan klik atau pilih minimal 2 nama perusahaan yang telah dianalisis pada daftar di atas untuk menampilkan tabel perbandingan berdampingan.</p>
            <a href="{{ route('search.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold text-sm shadow-sm transition-all">
                <i data-lucide="search" class="w-4 h-4"></i>
                <span>Cari & Analisis Perusahaan Baru</span>
            </a>
        </div>
    @else
        <!-- Comparison Side-by-Side Matrix Table -->
        <div class="bg-white rounded-2xl border border-[#E5E7EB] shadow-sm overflow-hidden overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[700px]">
                <thead>
                    <tr class="bg-[#F8FAFC] border-b border-[#E5E7EB]">
                        <th class="py-5 px-6 text-xs font-extrabold text-[#475569] uppercase tracking-wider w-1/4">Indikator Analisis</th>
                        @foreach($selectedCompanies as $comp)
                            <th class="py-5 px-6 text-center border-l border-[#E5E7EB] w-1/4">
                                <a href="{{ route('search.result', $comp->id) }}" class="text-base font-extrabold text-[#0F172A] hover:text-[#2563EB] transition-colors block mb-1">
                                    {{ $comp->name }}
                                </a>
                                <span class="text-[11px] font-medium text-[#64748B] block">{{ $comp->industry ?: 'Umum' }}</span>
                            </th>
                        @endforeach
                        @for($i = count($selectedCompanies); $i < 3; $i++)
                            <th class="py-5 px-6 text-center border-l border-[#E5E7EB] bg-[#F1F5F9]/50 text-xs font-semibold text-[#94A3B8] italic w-1/4">
                                Slot Kosong<br><span class="text-[10px] font-normal">Pilih entitas lain di atas</span>
                            </th>
                        @endfor
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#E5E7EB] text-sm">
                    <!-- Trust Score AI -->
                    <tr>
                        <td class="py-5 px-6 font-bold text-[#0F172A] bg-[#F8FAFC]/50">
                            <div class="flex items-center gap-2">
                                <i data-lucide="shield-check" class="w-4 h-4 text-[#2563EB]"></i>
                                <span>Trust Score AI</span>
                            </div>
                        </td>
                        @foreach($selectedCompanies as $comp)
                            <td class="py-5 px-6 text-center border-l border-[#E5E7EB]">
                                <div class="text-3xl font-black text-[#1D4ED8]">{{ $comp->trust_score }}<span class="text-sm font-normal text-[#64748B]">/100</span></div>
                            </td>
                        @endforeach
                        @for($i = count($selectedCompanies); $i < 3; $i++) <td class="border-l border-[#E5E7EB] bg-[#F8FAFC]/30"></td> @endfor
                    </tr>

                    <!-- Risk Level -->
                    <tr>
                        <td class="py-5 px-6 font-bold text-[#0F172A] bg-[#F8FAFC]/50">
                            <div class="flex items-center gap-2">
                                <i data-lucide="alert-triangle" class="w-4 h-4 text-[#D97706]"></i>
                                <span>Tingkat Risiko</span>
                            </div>
                        </td>
                        @foreach($selectedCompanies as $comp)
                            <td class="py-5 px-6 text-center border-l border-[#E5E7EB]">
                                @php
                                    $badgeColor = 'bg-[#DC2626] text-white';
                                    if ($comp->risk_level === 'LOW RISK') $badgeColor = 'bg-[#16A34A] text-white';
                                    if ($comp->risk_level === 'MEDIUM RISK') $badgeColor = 'bg-[#D97706] text-white';
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-md text-xs font-extrabold tracking-wide uppercase {{ $badgeColor }}">
                                    {{ $comp->risk_level }}
                                </span>
                            </td>
                        @endforeach
                        @for($i = count($selectedCompanies); $i < 3; $i++) <td class="border-l border-[#E5E7EB] bg-[#F8FAFC]/30"></td> @endfor
                    </tr>

                    <!-- Website & Domain Score -->
                    <tr>
                        <td class="py-4 px-6 font-semibold text-[#334155]">Reputasi Domain Resmi</td>
                        @foreach($selectedCompanies as $comp)
                            <td class="py-4 px-6 text-center font-bold text-[#0F172A] border-l border-[#E5E7EB]">
                                {{ $comp->metric ? $comp->metric->website_score . '/100' : '-' }}
                            </td>
                        @endforeach
                        @for($i = count($selectedCompanies); $i < 3; $i++) <td class="border-l border-[#E5E7EB] bg-[#F8FAFC]/30"></td> @endfor
                    </tr>

                    <!-- Public Review Sentiment -->
                    <tr>
                        <td class="py-4 px-6 font-semibold text-[#334155]">Sentimen Ulasan Publik</td>
                        @foreach($selectedCompanies as $comp)
                            <td class="py-4 px-6 text-center font-bold text-[#0F172A] border-l border-[#E5E7EB]">
                                {{ $comp->metric ? $comp->metric->review_score . '/100' : '-' }}
                            </td>
                        @endforeach
                        @for($i = count($selectedCompanies); $i < 3; $i++) <td class="border-l border-[#E5E7EB] bg-[#F8FAFC]/30"></td> @endfor
                    </tr>

                    <!-- News Coverage Score -->
                    <tr>
                        <td class="py-4 px-6 font-semibold text-[#334155]">Liputan Berita Media</td>
                        @foreach($selectedCompanies as $comp)
                            <td class="py-4 px-6 text-center font-bold text-[#0F172A] border-l border-[#E5E7EB]">
                                {{ $comp->metric ? $comp->metric->news_score . '/100' : '-' }}
                            </td>
                        @endforeach
                        @for($i = count($selectedCompanies); $i < 3; $i++) <td class="border-l border-[#E5E7EB] bg-[#F8FAFC]/30"></td> @endfor
                    </tr>

                    <!-- Head Office & Employees -->
                    <tr>
                        <td class="py-4 px-6 font-semibold text-[#334155]">Lokasi & Skala Karyawan</td>
                        @foreach($selectedCompanies as $comp)
                            <td class="py-4 px-6 text-center text-xs text-[#475569] border-l border-[#E5E7EB]">
                                <div class="font-bold text-[#0F172A] mb-0.5">{{ $comp->head_office ?: '-' }}</div>
                                <div>{{ $comp->employees_count ?: '-' }}</div>
                            </td>
                        @endforeach
                        @for($i = count($selectedCompanies); $i < 3; $i++) <td class="border-l border-[#E5E7EB] bg-[#F8FAFC]/30"></td> @endfor
                    </tr>

                    <!-- Action Links -->
                    <tr class="bg-[#F8FAFC]/60">
                        <td class="py-5 px-6 font-bold text-[#334155]">Tindakan Lanjutan</td>
                        @foreach($selectedCompanies as $comp)
                            <td class="py-5 px-6 text-center border-l border-[#E5E7EB]">
                                <div class="flex flex-col gap-2 justify-center">
                                    <a href="{{ route('search.result', $comp->id) }}" class="inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-xs font-bold shadow-2xs transition-all">
                                        <span>Lihat Laporan Penuh</span>
                                        <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                    </a>
                                    <a href="{{ route('company.pdf', $comp->id) }}" class="inline-flex items-center justify-center gap-1.5 px-3 py-1.5 rounded-lg bg-white border border-[#D1D5DB] hover:bg-[#F1F5F9] text-[#334155] text-[11px] font-semibold transition-all">
                                        <i data-lucide="file-down" class="w-3.5 h-3.5 text-[#2563EB]"></i>
                                        <span>Unduh PDF</span>
                                    </a>
                                </div>
                            </td>
                        @endforeach
                        @for($i = count($selectedCompanies); $i < 3; $i++) <td class="border-l border-[#E5E7EB] bg-[#F8FAFC]/30"></td> @endfor
                    </tr>
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
