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

            <div class="flex items-center gap-3 sm:gap-4">
                <a href="{{ route('compare.index') }}" class="hidden md:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-[#475569] hover:text-[#2563EB] hover:bg-[#F1F5F9] transition-all">
                    <i data-lucide="git-compare" class="w-4 h-4"></i>
                    <span>Komparasi</span>
                </a>
                <div class="hidden lg:flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-[#F1F5F9] border border-[#E2E8F0] text-xs font-semibold text-[#475569]">
                    <span class="w-2 h-2 rounded-full bg-[#16A34A]"></span>
                    <span>AI: {{ strtoupper(config('ai.default', 'GEMINI')) }}</span>
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

    <!-- Global Toast Notification -->
    @if(session('success') || session('error'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2 sm:translate-y-0 sm:translate-x-4"
         x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed bottom-6 right-6 z-50 max-w-sm w-full bg-[#1E293B] border {{ session('success') ? 'border-[#16A34A]' : 'border-[#DC2626]' }} text-white p-4 rounded-xl shadow-lg flex items-start gap-3.5">
        <div class="w-8 h-8 rounded-lg {{ session('success') ? 'bg-[#16A34A]/20 text-[#16A34A]' : 'bg-[#DC2626]/20 text-[#DC2626]' }} flex items-center justify-center shrink-0">
            <i data-lucide="{{ session('success') ? 'check-circle-2' : 'alert-circle' }}" class="w-5 h-5"></i>
        </div>
        <div class="grow pt-0.5">
            <div class="text-xs font-bold uppercase tracking-wider {{ session('success') ? 'text-[#16A34A]' : 'text-[#DC2626]' }}">
                {{ session('success') ? 'Berhasil' : 'Perhatian' }}
            </div>
            <p class="text-xs text-[#E2E8F0] mt-0.5 leading-relaxed">{{ session('success') ?? session('error') }}</p>
        </div>
        <button @click="show = false" class="text-[#64748B] hover:text-white transition-colors p-1 rounded-lg cursor-pointer">
            <i data-lucide="x" class="w-4 h-4"></i>
        </button>
    </div>
    @endif

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
