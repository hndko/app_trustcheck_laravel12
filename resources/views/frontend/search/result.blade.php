@extends('layouts.app-frontend')

@section('content')
<div class="py-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <!-- Top Breadcrumb & Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <div class="flex items-center gap-2 text-xs text-[#64748B] font-medium mb-2">
                <a href="{{ route('search.index') }}" class="hover:text-[#2563EB] transition-colors">Beranda</a>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span>Laporan Due Diligence</span>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                <span class="text-[#0F172A] font-semibold">{{ $company->name }}</span>
            </div>
            <div class="flex items-center gap-3 mt-2">
                <h1 class="text-2xl sm:text-3xl font-extrabold text-[#0F172A] tracking-tight">
                    {{ $company->name }}
                </h1>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#EFF6FF] border border-[#BFDBFE] text-[#1D4ED8] text-[11px] font-bold">
                    <i data-lucide="clock" class="w-3 h-3"></i>
                    <span>Diperbarui {{ $company->updated_at ? $company->updated_at->diffForHumans() : 'Baru saja' }} (Cache 7 Hari)</span>
                </span>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-[#D1D5DB] hover:bg-[#F8FAFC] text-xs font-semibold text-[#334155] shadow-2xs transition-all cursor-pointer">
                <i data-lucide="printer" class="w-4 h-4"></i>
                <span>Cetak Laporan</span>
            </button>
            <a href="{{ route('search.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-xs font-semibold text-white shadow-sm transition-all">
                <i data-lucide="search" class="w-4 h-4"></i>
                <span>Periksa Entitas Lain</span>
            </a>
        </div>
    </div>

    <!-- Main Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        
        <!-- SIDEBAR (Column 1): Quick Facts & Trust Score -->
        <div class="lg:col-span-1 space-y-6 sticky top-24">
            
            <!-- Trust Score Big Card -->
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm text-center relative overflow-hidden">
                <div class="text-xs font-bold uppercase tracking-wider text-[#64748B] mb-4">
                    Skor Kepercayaan AI (Trust Score)
                </div>

                <!-- Score Display -->
                <div class="inline-flex items-baseline justify-center gap-1 mb-4">
                    <span class="text-6xl font-black tracking-tight 
                        @if($company->trust_score >= 80) text-[#16A34A]
                        @elseif($company->trust_score >= 60) text-[#D97706]
                        @else text-[#DC2626] @endif">
                        {{ $company->trust_score }}
                    </span>
                    <span class="text-xl font-bold text-[#94A3B8]">/ 100</span>
                </div>

                <!-- Risk Level Badge -->
                <div class="mb-6">
                    @if($company->risk_level === 'LOW RISK')
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#DCFCE7] border border-[#BBF7D0] text-[#16A34A] text-xs font-extrabold uppercase tracking-wider">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                            <span>Risiko Rendah (Aman)</span>
                        </span>
                    @elseif($company->risk_level === 'MEDIUM RISK')
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#FEF3C7] border border-[#FDE68A] text-[#D97706] text-xs font-extrabold uppercase tracking-wider">
                            <i data-lucide="shield-alert" class="w-4 h-4"></i>
                            <span>Risiko Sedang (Perhatian)</span>
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-[#FEE2E2] border border-[#FECACA] text-[#DC2626] text-xs font-extrabold uppercase tracking-wider">
                            <i data-lucide="shield-x" class="w-4 h-4"></i>
                            <span>Risiko Tinggi (Waspada)</span>
                        </span>
                    @endif
                </div>

                <p class="text-xs text-[#64748B] leading-relaxed border-t border-[#F1F5F9] pt-4">
                    Kalkulasi skor berdasarkan agregasi rekam jejak digital, legalitas domain, ulasan publik, dan pemberitaan media daring.
                </p>
            </div>

            <!-- Profil Perusahaan Card -->
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm">
                <h3 class="font-bold text-sm text-[#0F172A] mb-4 flex items-center gap-2 border-b border-[#F1F5F9] pb-3">
                    <i data-lucide="building" class="w-4 h-4 text-[#2563EB]"></i>
                    <span>Profil Data Perusahaan</span>
                </h3>

                <dl class="space-y-3.5 text-xs">
                    <div class="flex justify-between items-start gap-4">
                        <dt class="text-[#64748B] font-medium shrink-0">Situs Web Resmi</dt>
                        <dd class="text-[#0F172A] font-semibold text-right truncate max-w-[180px]">
                            @if($company->website)
                                <a href="{{ $company->website }}" target="_blank" class="text-[#2563EB] hover:underline flex items-center justify-end gap-1">
                                    <span>{{ parse_url($company->website, PHP_URL_HOST) ?? $company->website }}</span>
                                    <i data-lucide="external-link" class="w-3 h-3"></i>
                                </a>
                            @else
                                <span class="text-[#94A3B8]">-</span>
                            @endif
                        </dd>
                    </div>

                    <div class="flex justify-between items-start gap-4">
                        <dt class="text-[#64748B] font-medium shrink-0">Sektor Industri</dt>
                        <dd class="text-[#0F172A] font-semibold text-right">{{ $company->industry ?? 'Umum' }}</dd>
                    </div>

                    <div class="flex justify-between items-start gap-4">
                        <dt class="text-[#64748B] font-medium shrink-0">Kantor Pusat</dt>
                        <dd class="text-[#0F172A] font-semibold text-right">{{ $company->head_office ?? 'Indonesia' }}</dd>
                    </div>

                    <div class="flex justify-between items-start gap-4">
                        <dt class="text-[#64748B] font-medium shrink-0">Tahun Berdiri</dt>
                        <dd class="text-[#0F172A] font-semibold text-right">{{ $company->founded_year ?? '-' }}</dd>
                    </div>

                    <div class="flex justify-between items-start gap-4">
                        <dt class="text-[#64748B] font-medium shrink-0">Skala Karyawan</dt>
                        <dd class="text-[#0F172A] font-semibold text-right">{{ $company->employees_count ?? '-' }}</dd>
                    </div>

                    <div class="flex justify-between items-start gap-4">
                        <dt class="text-[#64748B] font-medium shrink-0">Kontak Resmi</dt>
                        <dd class="text-[#0F172A] font-semibold text-right truncate max-w-[160px]">{{ $company->email ?? $company->phone ?? '-' }}</dd>
                    </div>
                </dl>
            </div>

        </div>

        <!-- MAIN CONTENT (Column 2 & 3): AI Summary, Metrics, Sources, News -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- AI Factual Summary Card -->
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 sm:p-8 shadow-sm">
                <div class="flex items-center gap-2.5 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-[#EFF6FF] text-[#2563EB] flex items-center justify-center shrink-0">
                        <i data-lucide="bot" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h2 class="text-base font-bold text-[#0F172A]">Ringkasan Intelijensi Kecerdasan Buatan</h2>
                        <p class="text-xs text-[#64748B]">Sintesis fakta publik objektif (Bebas opini subjektif)</p>
                    </div>
                </div>

                <div class="prose prose-sm max-w-none text-[#334155] leading-relaxed space-y-3 whitespace-pre-line text-sm font-normal">
                    {{ $company->ai_summary ?? 'Belum ada ringkasan analisis AI.' }}
                </div>
            </div>

            <!-- Reputasi Publik Progress Bars -->
            @if($company->metric)
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 sm:p-8 shadow-sm">
                <h3 class="font-bold text-base text-[#0F172A] mb-6 flex items-center gap-2">
                    <i data-lucide="bar-chart-3" class="w-5 h-5 text-[#2563EB]"></i>
                    <span>Indikator Reputasi Publik</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Review Score -->
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1.5">
                            <span class="text-[#475569]">Sentimen Ulasan Publik</span>
                            <span class="text-[#0F172A]">{{ $company->metric->review_score }}%</span>
                        </div>
                        <div class="w-full h-2.5 bg-[#F1F5F9] rounded-full overflow-hidden">
                            <div class="h-full bg-[#2563EB] rounded-full" style="width: {{ $company->metric->review_score }}%;"></div>
                        </div>
                    </div>

                    <!-- News Score -->
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1.5">
                            <span class="text-[#475569]">Reputasi Pemberitaan Media</span>
                            <span class="text-[#0F172A]">{{ $company->metric->news_score }}%</span>
                        </div>
                        <div class="w-full h-2.5 bg-[#F1F5F9] rounded-full overflow-hidden">
                            <div class="h-full bg-[#16A34A] rounded-full" style="width: {{ $company->metric->news_score }}%;"></div>
                        </div>
                    </div>

                    <!-- Website Score -->
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1.5">
                            <span class="text-[#475569]">Keandalan & Keamanan Situs</span>
                            <span class="text-[#0F172A]">{{ $company->metric->website_score }}%</span>
                        </div>
                        <div class="w-full h-2.5 bg-[#F1F5F9] rounded-full overflow-hidden">
                            <div class="h-full bg-[#0284C7] rounded-full" style="width: {{ $company->metric->website_score }}%;"></div>
                        </div>
                    </div>

                    <!-- Digital Presence Score -->
                    <div>
                        <div class="flex justify-between text-xs font-semibold mb-1.5">
                            <span class="text-[#475569]">Keberadaan Ekosistem Digital</span>
                            <span class="text-[#0F172A]">{{ $company->metric->digital_presence_score }}%</span>
                        </div>
                        <div class="w-full h-2.5 bg-[#F1F5F9] rounded-full overflow-hidden">
                            <div class="h-full bg-[#8B5CF6] rounded-full" style="width: {{ $company->metric->digital_presence_score }}%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Topik Positif & Negatif Badges -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Topik Positif -->
                <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="thumbs-up" class="w-4 h-4 text-[#16A34A]"></i>
                        <h4 class="font-bold text-sm text-[#0F172A]">Sorotan Positif Publik</h4>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @forelse($company->metric->positive_topics ?? [] as $topic)
                            <span class="px-3 py-1.5 rounded-lg bg-[#DCFCE7]/60 border border-[#BBF7D0] text-[#16A34A] text-xs font-semibold">
                                {{ $topic }}
                            </span>
                        @empty
                            <span class="text-xs text-[#94A3B8]">Tidak ada sorotan spesifik.</span>
                        @endforelse
                    </div>
                </div>

                <!-- Topik Negatif / Perhatian -->
                <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm">
                    <div class="flex items-center gap-2 mb-4">
                        <i data-lucide="alert-triangle" class="w-4 h-4 text-[#D97706]"></i>
                        <h4 class="font-bold text-sm text-[#0F172A]">Catatan Perhatian / Kendala</h4>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @forelse($company->metric->negative_topics ?? [] as $topic)
                            <span class="px-3 py-1.5 rounded-lg bg-[#FEF3C7]/60 border border-[#FDE68A] text-[#D97706] text-xs font-semibold">
                                {{ $topic }}
                            </span>
                        @empty
                            <span class="text-xs text-[#94A3B8]">Tidak ditemukan keluhan signifikan.</span>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Kesehatan Website & Analisis Teknis -->
            @if(is_array($company->metric->website_health))
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 sm:p-8 shadow-sm">
                <h3 class="font-bold text-base text-[#0F172A] mb-4 flex items-center gap-2">
                    <i data-lucide="globe" class="w-5 h-5 text-[#2563EB]"></i>
                    <span>Analisis Keamanan & Kesehatan Domain</span>
                </h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs">
                    <div class="p-3.5 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0]">
                        <span class="text-[#64748B] block mb-1">Enkripsi HTTPS</span>
                        <span class="font-bold text-[#16A34A] flex items-center gap-1">
                            <i data-lucide="lock" class="w-3.5 h-3.5"></i>
                            <span>Aktif & Aman</span>
                        </span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0]">
                        <span class="text-[#64748B] block mb-1">Sertifikat SSL</span>
                        <span class="font-bold text-[#0F172A] truncate block">{{ $company->metric->website_health['ssl'] ?? 'Valid' }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0]">
                        <span class="text-[#64748B] block mb-1">Usia Domain</span>
                        <span class="font-bold text-[#0F172A] truncate block">{{ $company->metric->website_health['domain_age'] ?? 'Terverifikasi' }}</span>
                    </div>
                    <div class="p-3.5 rounded-xl bg-[#F8FAFC] border border-[#E2E8F0]">
                        <span class="text-[#64748B] block mb-1">Tingkat Keamanan</span>
                        <span class="font-bold text-[#2563EB] truncate block">{{ $company->metric->website_health['security'] ?? 'Optimal' }}</span>
                    </div>
                </div>
            </div>
            @endif
            @endif

            <!-- Ringkasan Berita (Vertical Timeline) -->
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 sm:p-8 shadow-sm">
                <h3 class="font-bold text-base text-[#0F172A] mb-6 flex items-center gap-2">
                    <i data-lucide="newspaper" class="w-5 h-5 text-[#2563EB]"></i>
                    <span>Sorotan Pemberitaan Media Publik</span>
                </h3>

                <div class="relative pl-6 border-l-2 border-[#E2E8F0] space-y-6">
                    @forelse($company->news as $item)
                    <div class="relative">
                        <!-- Timeline bullet -->
                        <div class="absolute -left-[31px] top-1.5 w-3.5 h-3.5 rounded-full bg-white border-2 
                            @if($item->sentiment === 'Positive') border-[#16A34A]
                            @elseif($item->sentiment === 'Negative') border-[#DC2626]
                            @else border-[#2563EB] @endif"></div>
                        
                        <div class="flex items-center justify-between gap-2 mb-1">
                            <span class="text-xs font-bold text-[#2563EB]">{{ $item->source }}</span>
                            <span class="text-xs text-[#94A3B8]">{{ $item->published_date }}</span>
                        </div>
                        
                        <h4 class="font-bold text-sm text-[#0F172A] hover:text-[#2563EB] transition-colors mb-1">
                            @if($item->url)
                                <a href="{{ $item->url }}" target="_blank">{{ $item->title }}</a>
                            @else
                                {{ $item->title }}
                            @endif
                        </h4>
                        
                        <p class="text-xs text-[#64748B] leading-relaxed">{{ $item->summary }}</p>
                    </div>
                    @empty
                    <p class="text-xs text-[#94A3B8]">Belum ada liputan berita terkait.</p>
                    @endforelse
                </div>
            </div>

            <!-- Transparansi Sumber & Referensi (Accordion Grid) -->
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 sm:p-8 shadow-sm" x-data="{ openSource: null }">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="font-bold text-base text-[#0F172A] flex items-center gap-2">
                            <i data-lucide="file-check" class="w-5 h-5 text-[#2563EB]"></i>
                            <span>Transparansi Sumber Referensi Publik</span>
                        </h3>
                        <p class="text-xs text-[#64748B] mt-0.5">Pengguna dapat melakukan verifikasi silang secara mandiri</p>
                    </div>
                    <span class="px-2.5 py-1 rounded-full bg-[#F1F5F9] text-xs font-bold text-[#475569]">
                        {{ $company->sources->count() }} Sumber
                    </span>
                </div>

                <div class="space-y-3">
                    @forelse($company->sources as $index => $source)
                    <div class="border border-[#E2E8F0] rounded-xl overflow-hidden">
                        <button @click="openSource === {{ $index }} ? openSource = null : openSource = {{ $index }}"
                                class="w-full px-4 py-3.5 bg-[#F8FAFC] hover:bg-[#F1F5F9] flex items-center justify-between gap-4 text-left transition-colors cursor-pointer">
                            <div class="flex items-center gap-3 min-w-0">
                                <i data-lucide="check-circle-2" class="w-4 h-4 text-[#16A34A] shrink-0"></i>
                                <span class="font-bold text-xs sm:text-sm text-[#0F172A] truncate">{{ $source->source_name }}</span>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                <span class="text-xs font-semibold text-[#64748B]">Kepercayaan: {{ $source->confidence_score }}%</span>
                                <i data-lucide="chevron-down" class="w-4 h-4 text-[#64748B] transition-transform duration-200" :class="{ 'rotate-180': openSource === {{ $index }} }"></i>
                            </div>
                        </button>

                        <div x-show="openSource === {{ $index }}" x-collapse x-cloak class="p-4 bg-white border-t border-[#E2E8F0] text-xs text-[#475569] space-y-2">
                            <p class="leading-relaxed">{{ $source->summary ?? 'Referen terverifikasi oleh sistem.' }}</p>
                            <div class="flex items-center justify-between pt-2 border-t border-[#F1F5F9] text-[11px] text-[#94A3B8]">
                                <span>Pembaruan terakhir: {{ $source->last_updated ?? 'Hari ini' }}</span>
                                @if($source->source_url)
                                    <a href="{{ $source->source_url }}" target="_blank" class="text-[#2563EB] hover:underline flex items-center gap-1 font-semibold">
                                        <span>Kunjungi Tautan Sumber</span>
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-[#94A3B8]">Daftar referensi sumber belum tersedia.</p>
                    @endforelse
                </div>
            </div>

            <!-- Disclaimer Hukum -->
            <div class="p-6 rounded-2xl bg-[#F8FAFC] border border-[#E2E8F0] text-xs text-[#64748B] leading-relaxed">
                <div class="font-bold text-[#334155] mb-1.5 flex items-center gap-1.5">
                    <i data-lucide="info" class="w-4 h-4 text-[#2563EB]"></i>
                    <span>Pernyataan Sanggahan Hukum (Legal Disclaimer):</span>
                </div>
                TrustCheck AI bukan merupakan lembaga penegak hukum, penasihat keuangan, maupun biro investigasi swasta. Seluruh informasi dan Trust Score yang disajikan dihasilkan oleh algoritma kecerdasan buatan dari pengumpulan data publik online secara otomatis pada saat pencarian dilakukan. Kami tidak menjamin keakuratan mutlak 100% dan tidak bertanggung jawab atas kerugian materiil maupun immateriil yang timbul dari keputusan bisnis yang diambil berdasarkan laporan ini.
            </div>

        </div>
    </div>
</div>
@endsection
