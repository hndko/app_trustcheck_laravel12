@extends('layouts.app-frontend')

@section('content')
<div class="py-16 sm:py-24 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
    <!-- Hero Header -->
    <div class="text-center max-w-3xl mx-auto">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-[#EFF6FF] border border-[#BFDBFE] text-[#1D4ED8] text-xs font-bold uppercase tracking-wider mb-6">
            <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
            <span>Intelijensi Due Diligence & Verifikasi Reputasi</span>
        </div>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-[#0F172A] tracking-tight leading-tight mb-4">
            Ketahui Reputasi Perusahaan Sebelum Mengambil Keputusan Bisnis
        </h1>
        <p class="text-lg text-[#475569] leading-relaxed">
            Mesin pencari independen bertenaga kecerdasan buatan untuk menganalisis rekam jejak, ulasan publik, transparansi domain, dan kelayakan operasional perusahaan di Indonesia.
        </p>
    </div>

    <!-- Search Box Card -->
    <div class="bg-white rounded-2xl border border-[#E5E7EB] shadow-md p-4 sm:p-6 max-w-3xl mx-auto">
        <form action="{{ route('search.process') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <div class="relative grow">
                <div class="absolute inset-y-0 inset-s-0 pl-4 flex items-center pointer-events-none text-[#64748B]">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                </div>
                <input type="text" name="query" value="{{ old('query') }}" required minlength="2" maxlength="100"
                    placeholder="Masukkan nama perusahaan atau instansi (Contoh: PT Telkom Indonesia)..."
                    class="w-full pl-11 pr-4 py-3.5 rounded-xl border border-[#D1D5DB] focus:border-[#2563EB] focus:ring-2 focus:ring-[#2563EB]/20 text-sm font-medium text-[#0F172A] placeholder-[#94A3B8] outline-none transition-all">
            </div>
            <button type="submit" class="shrink-0 inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold text-sm shadow-sm transition-all duration-150 cursor-pointer">
                <span>Mulai Analisis</span>
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>

        @if($errors->any())
        <div class="mt-3 p-3 rounded-lg bg-[#FEF2F2] border border-[#FECACA] text-[#DC2626] text-xs font-semibold flex items-center gap-2">
            <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
            <span>{{ $errors->first('query') }}</span>
        </div>
        @endif

        <!-- Contoh Pencarian & Popular Searches -->
        <div class="mt-5 pt-4 border-t border-[#F1F5F9]">
            <div class="text-xs font-semibold text-[#64748B] mb-2.5 flex items-center gap-1.5">
                <i data-lucide="trending-up" class="w-3.5 h-3.5 text-[#2563EB]"></i>
                <span>Pencarian Populer Saat Ini:</span>
            </div>
            <div class="flex flex-wrap gap-2">
                @forelse($popularSearches as $item)
                <form action="{{ route('search.process') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="query" value="{{ $item->query }}">
                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-[#F8FAFC] hover:bg-[#EFF6FF] border border-[#E2E8F0] hover:border-[#BFDBFE] text-xs font-semibold text-[#334155] hover:text-[#1D4ED8] transition-all cursor-pointer inline-flex items-center gap-1">
                        <span>{{ $item->query }}</span>
                        <span class="text-[#94A3B8] font-normal">({{ $item->search_count }})</span>
                    </button>
                </form>
                @empty
                <span class="text-xs text-[#94A3B8]">Belum ada data pencarian populer.</span>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Feature Highlights Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4 border-t border-[#E5E7EB]">
        <div class="bg-white p-6 rounded-2xl border border-[#E5E7EB] shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-[#EFF6FF] text-[#2563EB] flex items-center justify-center mb-4">
                <i data-lucide="building-2" class="w-5 h-5"></i>
            </div>
            <h3 class="font-bold text-base text-[#0F172A] mb-2">Informasi Perusahaan</h3>
            <p class="text-xs text-[#64748B] leading-relaxed">
                Mengumpulkan data resmi dari situs perusahaan, registrasi WHOIS domain, dan identitas korporasi secara terpadu.
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-[#E5E7EB] shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-[#EFF6FF] text-[#2563EB] flex items-center justify-center mb-4">
                <i data-lucide="message-square" class="w-5 h-5"></i>
            </div>
            <h3 class="font-bold text-base text-[#0F172A] mb-2">Reputasi Publik</h3>
            <p class="text-xs text-[#64748B] leading-relaxed">
                Menyaring ulasan konsumen, pemberitaan media daring, dan sentimen publik secara netral tanpa opini subjektif.
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-[#E5E7EB] shadow-sm">
            <div class="w-10 h-10 rounded-xl bg-[#EFF6FF] text-[#2563EB] flex items-center justify-center mb-4">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
            </div>
            <h3 class="font-bold text-base text-[#0F172A] mb-2">Analisis Teknis Website</h3>
            <p class="text-xs text-[#64748B] leading-relaxed">
                Memeriksa status keamanan HTTPS, validitas sertifikat SSL, serta rekam jejak digital situs web perusahaan.
            </p>
        </div>
    </div>

    <!-- Comparison Call to Action Banner -->
    <div class="bg-linear-to-r from-[#1E293B] to-[#0F172A] rounded-2xl p-6 sm:p-8 text-white shadow-md flex flex-col sm:flex-row items-center justify-between gap-6 border border-[#334155]">
        <div class="space-y-2 text-center sm:text-left">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#2563EB]/20 border border-[#2563EB]/40 text-[#38BDF8] text-xs font-bold">
                <i data-lucide="git-compare" class="w-3.5 h-3.5"></i>
                <span>Fitur Unggulan</span>
            </div>
            <h3 class="text-xl font-extrabold tracking-tight">Ingin Membandingkan Reputasi Beberapa Perusahaan?</h3>
            <p class="text-xs text-[#94A3B8] max-w-xl">
                Bandingkan hingga 3 entitas perusahaan secara berdampingan untuk melihat perbandingan Trust Score, tingkat risiko, sentimen publik, dan fakta ulasan sebelum Anda mengambil keputusan bisnis.
            </p>
        </div>
        <a href="{{ route('compare.index') }}" class="px-6 py-3.5 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-extrabold text-sm shadow-sm transition-all shrink-0 flex items-center gap-2 cursor-pointer">
            <span>Buka Matriks Komparasi</span>
            <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>

    <!-- Dynamic FAQ Accordion Section -->
    <div class="pt-8 border-t border-[#E5E7EB] space-y-6" x-data="{ activeAccordion: null }">
        <div class="text-center max-w-2xl mx-auto space-y-2">
            <h2 class="text-2xl font-extrabold text-[#0F172A] tracking-tight">Pertanyaan Umum (FAQ)</h2>
            <p class="text-xs text-[#64748B]">Temukan jawaban mengenai cara kerja, metodologi perhitungan skor, dan kebijakan objektivitas TrustCheck AI.</p>
        </div>

        <div class="max-w-3xl mx-auto space-y-3">
            @forelse($faqs as $faq)
                <div class="bg-white rounded-2xl border border-[#E5E7EB] shadow-sm overflow-hidden transition-all">
                    <button type="button" 
                        @click="activeAccordion = activeAccordion === {{ $faq->id }} ? null : {{ $faq->id }}" 
                        class="w-full p-5 text-left font-bold text-sm text-[#0F172A] flex items-center justify-between gap-4 hover:bg-[#F8FAFC] transition-colors cursor-pointer">
                        <span>{{ $faq->question }}</span>
                        <i data-lucide="chevron-down" class="w-5 h-5 text-[#64748B] shrink-0 transition-transform duration-200" :class="{ 'rotate-180': activeAccordion === {{ $faq->id }} }"></i>
                    </button>
                    <div x-show="activeAccordion === {{ $faq->id }}" x-collapse x-cloak class="px-5 pb-5 pt-1 text-xs text-[#475569] leading-relaxed border-t border-[#F1F5F9] bg-[#F8FAFC]/50">
                        {{ $faq->answer }}
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-xs text-[#94A3B8]">Belum ada data pertanyaan umum.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
