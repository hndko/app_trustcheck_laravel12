<!DOCTYPE html>
<html lang="id" class="h-full bg-[#0F172A]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'TrustCheck AI — Admin Panel' }}</title>
    <!-- Tailwind CSS v4 & Alpine.js -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    @endif
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="min-h-full flex font-sans text-[#F8FAFC] antialiased bg-[#0F172A]">

    <!-- Sidebar Navigation -->
    <aside class="w-64 bg-[#1E293B] border-r border-[#334155] flex flex-col shrink-0">
        <div class="h-16 flex items-center px-6 border-b border-[#334155]">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 font-extrabold text-lg tracking-tight text-white">
                <div class="w-8 h-8 rounded-lg bg-[#2563EB] flex items-center justify-center text-white shrink-0">
                    <i data-lucide="shield-alert" class="w-4 h-4"></i>
                </div>
                <span>TrustCheck <span class="text-[#38BDF8]">Admin</span></span>
            </a>
        </div>

        <nav class="p-4 space-y-1 grow">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#2563EB] text-white font-bold text-sm shadow-sm transition-all">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span>Dasbor Analitik</span>
            </a>
            <a href="{{ route('search.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#94A3B8] hover:bg-[#334155] hover:text-white font-semibold text-sm transition-all">
                <i data-lucide="external-link" class="w-5 h-5"></i>
                <span>Kembali ke Portal Publik</span>
            </a>
            <a href="{{ route('compare.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#94A3B8] hover:bg-[#334155] hover:text-white font-semibold text-sm transition-all">
                <i data-lucide="git-compare" class="w-5 h-5"></i>
                <span>Matriks Komparasi</span>
            </a>
        </nav>

        <!-- System Configuration Status Panel -->
        <div class="p-4 border-t border-[#334155]">
            <div class="bg-[#0F172A] rounded-xl p-3 border border-[#334155]">
                <div class="text-[11px] font-bold text-[#64748B] uppercase mb-1">Status Kecerdasan Buatan</div>
                <div class="flex items-center justify-between text-xs font-semibold text-[#E2E8F0] mb-2">
                    <span>Provider</span>
                    <span class="text-[#38BDF8] font-bold">{{ strtoupper(config('ai.default', 'GEMINI')) }}</span>
                </div>
                <div class="flex items-center justify-between text-xs font-semibold text-[#E2E8F0]">
                    <span>Cache TTL</span>
                    <span class="text-[#10B981] font-bold">{{ config('ai.cache_ttl_days', 7) }} Hari</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="grow flex flex-col min-w-0 bg-[#0F172A]">
        <header class="h-16 bg-[#1E293B] border-b border-[#334155] flex items-center justify-between px-8">
            <h1 class="text-lg font-bold text-white">{{ $title ?? 'Dasbor Admin' }}</h1>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 rounded-full bg-[#0F172A] border border-[#334155] text-xs font-semibold text-[#94A3B8] flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                    Sistem Aktif & Terjadwal
                </span>
            </div>
        </header>

        <main class="grow p-8 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- Initialize Lucide Icons -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>
