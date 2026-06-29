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
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="min-h-screen flex font-sans text-[#F8FAFC] antialiased bg-[#0F172A]">

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

    <div class="min-h-screen w-full flex">
        <!-- Kolom Kiri (Visual Brand Panel - Hidden on Mobile, 50% on Desktop) -->
        <div class="hidden lg:flex lg:w-1/2 bg-linear-to-br from-[#0F172A] via-[#1E293B] to-[#0F172A] border-r border-[#334155] p-12 relative overflow-hidden flex-col justify-between">
            <!-- Pola Geometris / Subtle Background Decoration -->
            <div class="absolute inset-0 opacity-5" style="background-image: radial-gradient(#38BDF8 1px, transparent 1px); background-size: 24px 24px;"></div>
            
            <div class="relative z-10">
                <a href="{{ route('search.index') }}" class="inline-flex items-center gap-2.5 font-extrabold text-2xl tracking-tight text-white">
                    <div class="w-10 h-10 rounded-xl bg-[#2563EB] flex items-center justify-center text-white shadow-sm">
                        <i data-lucide="shield-check" class="w-6 h-6"></i>
                    </div>
                    <span>TrustCheck <span class="text-[#38BDF8]">AI</span></span>
                </a>
            </div>

            <!-- Quote & Statement Misi -->
            <div class="relative z-10 max-w-lg space-y-6">
                <div class="w-12 h-12 rounded-2xl bg-[#2563EB]/10 border border-[#2563EB]/20 flex items-center justify-center text-[#38BDF8]">
                    <i data-lucide="quote" class="w-6 h-6"></i>
                </div>
                <blockquote class="text-xl sm:text-2xl font-bold text-white leading-relaxed">
                    "Reputasi dan transparansi adalah fondasi utama dalam pengambilan keputusan bisnis tingkat enterprise."
                </blockquote>
                <div class="space-y-1">
                    <div class="text-sm font-bold text-[#E2E8F0]">Sistem Due Diligence & Intelijensi Perusahaan</div>
                    <div class="text-xs text-[#94A3B8]">Ekstraksi informasi publik otomatis bertenaga AI dengan pengawasan objektif.</div>
                </div>
            </div>

            <!-- Footer Left -->
            <div class="relative z-10 flex items-center justify-between text-xs text-[#64748B]">
                <span>&copy; {{ date('Y') }} TrustCheck AI. Hak Cipta Dilindungi.</span>
                <span class="flex items-center gap-1.5 text-[#10B981] font-semibold">
                    <span class="w-2 h-2 rounded-full bg-[#10B981]"></span>
                    Enterprise Security Active
                </span>
            </div>
        </div>

        <!-- Kolom Kanan (Form Card - 100% on Mobile, 50% on Desktop) -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 bg-[#0F172A]">
            <div class="max-w-md w-full space-y-8">
                <!-- Mobile Header Logo (Visible only on lg:hidden) -->
                <div class="text-center lg:hidden">
                    <a href="{{ route('search.index') }}" class="inline-flex items-center gap-2.5 font-extrabold text-2xl tracking-tight text-white mb-2">
                        <div class="w-10 h-10 rounded-xl bg-[#2563EB] flex items-center justify-center text-white shadow-sm">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <span>TrustCheck <span class="text-[#38BDF8]">AI</span></span>
                    </a>
                </div>

                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-white">Akses Portal Kelola Sistem</h2>
                    <p class="text-xs sm:text-sm text-[#94A3B8] mt-1.5">Silakan masukkan kredensial akun administrator Anda untuk melanjutkan.</p>
                </div>

                @if($errors->any())
                    <div class="p-4 rounded-xl bg-[#EF4444]/10 border border-[#EF4444] text-[#EF4444] text-xs font-bold flex items-center gap-2.5 animate-fade-in">
                        <i data-lucide="alert-triangle" class="w-5 h-5 shrink-0"></i>
                        <span>{{ $errors->first() }}</span>
                    </div>
                @endif

                <!-- Login Form Card -->
                <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-6 sm:p-8 shadow-sm">
                    <form action="{{ route('auth.authenticate') }}" method="POST" class="space-y-6" x-data="{ loading: false }" @submit="loading = true">
                        @csrf
                        <div>
                            <label for="email" class="block text-xs font-bold text-[#E2E8F0] uppercase tracking-wider mb-2">Alamat Email Resmi</label>
                            <div class="relative">
                                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                                    placeholder="superadmin@example.com"
                                    class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] text-white placeholder-[#64748B] text-sm focus:outline-none focus:border-[#2563EB] focus:ring-1 focus:ring-[#2563EB] transition-all pl-11">
                                <i data-lucide="mail" class="w-5 h-5 text-[#64748B] absolute left-3.5 top-3.5"></i>
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-xs font-bold text-[#E2E8F0] uppercase tracking-wider mb-2">Kata Sandi</label>
                            <div class="relative">
                                <input type="password" name="password" id="password" required
                                    placeholder="••••••••••••"
                                    class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] text-white placeholder-[#64748B] text-sm focus:outline-none focus:border-[#2563EB] focus:ring-1 focus:ring-[#2563EB] transition-all pl-11">
                                <i data-lucide="lock" class="w-5 h-5 text-[#64748B] absolute left-3.5 top-3.5"></i>
                            </div>
                        </div>

                        <div class="flex items-center justify-between text-xs">
                            <label class="flex items-center gap-2 cursor-pointer text-[#94A3B8] hover:text-white transition-colors">
                                <input type="checkbox" name="remember" class="rounded bg-[#0F172A] border-[#334155] text-[#2563EB] focus:ring-0">
                                <span>Ingat sesi masuk saya</span>
                            </label>
                        </div>

                        <button type="submit" :disabled="loading" :class="loading ? 'opacity-75 cursor-wait' : 'hover:bg-[#1D4ED8] cursor-pointer'" class="w-full py-3 px-4 rounded-xl bg-[#2563EB] text-white font-extrabold text-sm shadow-sm transition-all flex items-center justify-center gap-2">
                            <span x-show="!loading">Masuk ke Portal Kelola</span>
                            <span x-show="loading" style="display: none;">Memverifikasi Sesi...</span>
                            <i x-show="!loading" data-lucide="arrow-right" class="w-4 h-4"></i>
                            <i x-show="loading" data-lucide="loader-2" class="w-4 h-4 animate-spin" style="display: none;"></i>
                        </button>
                    </form>
                </div>

                <div class="text-center text-xs text-[#64748B] pt-2">
                    <a href="{{ route('search.index') }}" class="hover:text-[#38BDF8] transition-colors inline-flex items-center gap-1.5 font-semibold">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Kembali ke Mesin Pencari Publik</span>
                    </a>
                </div>
            </div>
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
