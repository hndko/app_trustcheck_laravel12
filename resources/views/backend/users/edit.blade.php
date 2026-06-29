@extends('layouts.app-backend')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Header -->
    <div class="bg-[#1E293B] p-6 rounded-2xl border border-[#334155] shadow-sm flex items-center justify-between">
        <div>
            <h2 class="text-lg font-bold text-white">Edit Pengguna: {{ $user->name }}</h2>
            <p class="text-xs text-[#94A3B8] mt-1">Perbarui data profil atau ubah role hak akses pengguna.</p>
        </div>
        <a href="{{ route('portal.users.index') }}" class="inline-flex items-center gap-2 px-3 py-2 rounded-xl bg-[#334155] hover:bg-[#475569] text-white font-bold text-xs transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Card -->
    <div class="bg-[#1E293B] p-6 sm:p-8 rounded-2xl border border-[#334155] shadow-sm">
        <form action="{{ route('portal.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required 
                    class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors">
                @error('name')
                    <span class="text-xs text-[#EF4444] block">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required 
                    class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors">
                @error('email')
                    <span class="text-xs text-[#EF4444] block">{{ $message }}</span>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="role" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Role Hak Akses</label>
                <select name="role" id="role" class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors">
                    <option value="">Staf Pengelola Biasa</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ (old('role') ? old('role') === $role->name : $user->hasRole($role->name)) ? 'selected' : '' }}>
                            {{ strtoupper($role->name) }}
                        </option>
                    @endforeach
                </select>
                <p class="text-[11px] text-[#64748B]">Superadmin memiliki hak atas seluruh fitur sistem tanpa kecuali.</p>
            </div>

            <div class="p-4 rounded-xl bg-[#0F172A] border border-[#334155] space-y-4">
                <div class="flex items-center gap-2 text-xs font-bold text-[#38BDF8]">
                    <i data-lucide="key" class="w-4 h-4"></i>
                    <span>Ubah Kata Sandi (Opsional)</span>
                </div>
                <p class="text-[11px] text-[#94A3B8]">Kosongkan kedua kolom di bawah jika Anda tidak ingin merubah kata sandi pengguna ini.</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Kata Sandi Baru</label>
                        <input type="password" name="password" id="password" minlength="8"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#1E293B] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors"
                            placeholder="Minimal 8 karakter">
                        @error('password')
                            <span class="text-xs text-[#EF4444] block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" minlength="8"
                            class="w-full px-4 py-2.5 rounded-xl bg-[#1E293B] border border-[#334155] focus:border-[#38BDF8] text-white text-sm focus:outline-none transition-colors"
                            placeholder="Ulangi kata sandi baru">
                    </div>
                </div>
            </div>

            <div class="pt-4 flex items-center justify-end gap-3 border-t border-[#334155]">
                <a href="{{ route('portal.users.index') }}" class="px-5 py-2.5 rounded-xl bg-[#334155] hover:bg-[#475569] text-white font-bold text-xs transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold text-xs shadow-sm transition-colors cursor-pointer">
                    Perbarui Data
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
