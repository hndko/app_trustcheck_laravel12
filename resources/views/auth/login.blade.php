<!DOCTYPE html>
<html lang="id" class="h-full bg-[#0F172A]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Masuk Portal Kelola — TrustCheck AI' }}</title>
    <!-- Tailwind CSS v4 -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    @endif
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="h-full flex items-center justify-center font-sans text-[#F8FAFC] antialiased bg-[#0F172A] px-4">

    <div class="max-w-md w-full space-y-8">
        <!-- Logo & Header -->
        <div class="text-center">
            <a href="{{ route('search.index') }}" class="inline-flex items-center gap-2.5 font-extrabold text-2xl tracking-tight text-white mb-2">
                <div class="w-10 h-10 rounded-xl bg-[#2563EB] flex items-center justify-center text-white shadow-sm">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <span>TrustCheck <span class="text-[#38BDF8]">AI</span></span>
            </a>
            <h2 class="text-xl font-bold text-[#E2E8F0]">Akses Portal Kelola Sistem</h2>
            <p class="text-xs text-[#94A3B8] mt-1">Silakan masukkan alamat email dan kata sandi pengelola resmi.</p>
        </div>

        <!-- Alert Notification -->
        @if(session('success'))
            <div class="p-4 rounded-xl bg-[#10B981]/20 border border-[#10B981]/30 text-[#10B981] text-xs font-bold flex items-center gap-2">
                <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="p-4 rounded-xl bg-[#EF4444]/20 border border-[#EF4444]/30 text-[#EF4444] text-xs font-bold flex items-center gap-2">
                <i data-lucide="alert-triangle" class="w-4 h-4 shrink-0"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <!-- Login Form Card -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-8 shadow-sm">
            <form action="{{ route('auth.authenticate') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-xs font-bold text-[#E2E8F0] uppercase tracking-wider mb-2">Alamat Email</label>
                    <div class="relative">
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            placeholder="admin@trustcheck.id"
                            class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] text-white placeholder-[#64748B] text-sm focus:outline-none focus:border-[#38BDF8] transition-colors pl-11">
                        <i data-lucide="mail" class="w-5 h-5 text-[#64748B] absolute left-3.5 top-3.5"></i>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-xs font-bold text-[#E2E8F0] uppercase tracking-wider mb-2">Kata Sandi</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            placeholder="••••••••••••"
                            class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] text-white placeholder-[#64748B] text-sm focus:outline-none focus:border-[#38BDF8] transition-colors pl-11">
                        <i data-lucide="lock" class="w-5 h-5 text-[#64748B] absolute left-3.5 top-3.5"></i>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center gap-2 cursor-pointer text-[#94A3B8] hover:text-white transition-colors">
                        <input type="checkbox" name="remember" class="rounded bg-[#0F172A] border-[#334155] text-[#2563EB] focus:ring-0">
                        <span>Ingat sesi masuk saya</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-3 px-4 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-extrabold text-sm shadow-sm transition-all flex items-center justify-center gap-2 cursor-pointer">
                    <span>Masuk ke Portal Kelola</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>

        <div class="text-center text-xs text-[#64748B]">
            <a href="{{ route('search.index') }}" class="hover:text-[#38BDF8] transition-colors inline-flex items-center gap-1">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i>
                <span>Kembali ke Mesin Pencari Publik</span>
            </a>
        </div>
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
