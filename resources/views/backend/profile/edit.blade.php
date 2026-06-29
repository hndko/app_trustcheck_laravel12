@extends('layouts.app-backend')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-[#1E293B] p-6 rounded-2xl border border-[#334155] shadow-sm">
        <h2 class="text-lg font-bold text-white">Pengaturan Profil Saya</h2>
        <p class="text-xs text-[#94A3B8] mt-1">Perbarui informasi nama lengkap, alamat email, atau kata sandi akun yang sedang Anda gunakan.</p>
    </div>

    <!-- Alert Notifications -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-[#10B981]/20 border border-[#10B981]/30 text-[#10B981] text-xs font-bold flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="p-4 rounded-xl bg-[#EF4444]/20 border border-[#EF4444]/30 text-[#EF4444] text-xs font-bold space-y-1">
            <div class="flex items-center gap-2">
                <i data-lucide="alert-triangle" class="w-4 h-4 shrink-0"></i>
                <span>Terdapat kesalahan pada isian formulir:</span>
            </div>
            <ul class="list-disc list-inside font-normal pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form Card -->
    <div class="bg-[#1E293B] p-6 sm:p-8 rounded-2xl border border-[#334155] shadow-sm">
        <form action="{{ route('portal.profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                    class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors">
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                    class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors">
            </div>

            <div class="p-4 rounded-xl bg-[#0F172A] border border-[#334155] space-y-4">
                <div class="flex items-center gap-2 text-xs font-bold text-[#38BDF8]">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    <span>Perubahan Kata Sandi (Opsional)</span>
                </div>
                <p class="text-[11px] text-[#94A3B8]">Kosongkan seluruh kolom kata sandi di bawah jika Anda tidak ingin merubah kata sandi akun Anda.</p>

                <div class="space-y-2">
                    <label for="current_password" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" id="current_password"
                        class="w-full px-4 py-2.5 rounded-xl bg-[#1E293B] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors"
                        placeholder="Masukkan kata sandi lama Anda">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="space-y-2">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password" minlength="8"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#1E293B] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors"
                            placeholder="Minimal 8 karakter">
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Konfirmasi Kata Sandi Baru</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" minlength="8"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#1E293B] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors"
                            placeholder="Ulangi kata sandi baru">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-[#334155]">
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold text-xs shadow-sm transition-colors cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
