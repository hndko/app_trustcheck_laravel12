<!DOCTYPE html>
<html lang="id" class="h-full bg-[#F8FAFC]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TrustCheck AI — Mesin Pencari Due Diligence & Reputasi Perusahaan' }}</title>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-full flex flex-col font-sans text-[#0F172A] antialiased bg-[#F8FAFC]">

    <!-- Top Navigation Bar -->
    <header class="bg-white border-b border-[#E5E7EB] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('search.index') }}" class="flex items-center gap-2.5 font-bold text-xl tracking-tight text-[#0F172A] hover:opacity-90 transition-opacity">
                <div class="w-9 h-9 rounded-xl bg-[#2563EB] flex items-center justify-center text-white shadow-sm shrink-0">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <span>TrustCheck <span class="text-[#2563EB] font-extrabold">AI</span></span>
            </a>

            <div class="flex items-center gap-4">
                <div class="hidden sm:flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#F1F5F9] border border-[#E2E8F0] text-xs font-semibold text-[#475569]">
                    <span class="w-2 h-2 rounded-full bg-[#16A34A]"></span>
                    <span>Provider Aktif: {{ strtoupper(config('ai.default', 'GEMINI')) }}</span>
                </div>
                <a href="{{ route('search.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-sm font-semibold shadow-sm transition-all duration-150">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    <span>Cari Baru</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-[#E5E7EB] mt-auto py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-[#64748B]">
            <div class="flex items-center gap-2">
                <i data-lucide="info" class="w-4 h-4 text-[#2563EB]"></i>
                <span>TrustCheck AI bertindak murni sebagai agregator informasi publik dan intelijensi due diligence independen.</span>
            </div>
            <div>
                &copy; {{ date('Y') }} TrustCheck AI. Seluruh Hak Cipta Dilindungi Undang-Undang.
            </div>
        </div>
    </footer>

    <!-- Initialize Lucide Icons after render -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>
