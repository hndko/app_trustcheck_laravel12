@extends('layouts.app-backend')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-[#1E293B] p-6 rounded-2xl border border-[#334155] shadow-sm">
        <div>
            <h2 class="text-lg font-bold text-white">Kelola Pengguna Sistem</h2>
            <p class="text-xs text-[#94A3B8] mt-1">Daftar akun pengelola yang memiliki akses ke dasbor analitik dan konfigurasi TrustCheck AI.</p>
        </div>
        <a href="{{ route('portal.users.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold text-xs shadow-sm transition-all shrink-0">
            <i data-lucide="user-plus" class="w-4 h-4"></i>
            <span>Tambah Pengguna Baru</span>
        </a>
    </div>

    <!-- Users Table -->
    <div class="bg-[#1E293B] rounded-2xl border border-[#334155] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[650px]">
                <thead>
                    <tr class="bg-[#0F172A] text-[#94A3B8] text-xs font-bold uppercase tracking-wider border-b border-[#334155]">
                        <th class="py-4 px-6">Nama Lengkap</th>
                        <th class="py-4 px-6">Alamat Email</th>
                        <th class="py-4 px-6 w-36">Role Hak Akses</th>
                        <th class="py-4 px-6 w-36 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155] text-sm text-[#E2E8F0]">
                    @forelse($users as $user)
                        <tr class="hover:bg-[#334155]/50 transition-colors">
                            <td class="py-4 px-6 font-semibold flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-[#2563EB]/20 text-[#38BDF8] border border-[#2563EB]/40 flex items-center justify-center font-bold text-xs shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span>{{ $user->name }}</span>
                            </td>
                            <td class="py-4 px-6 text-xs text-[#94A3B8]">{{ $user->email }}</td>
                            <td class="py-4 px-6">
                                @forelse($user->roles as $role)
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $role->name === 'superadmin' ? 'bg-[#A855F7]/20 text-[#D8B4FE] border border-[#A855F7]/30' : 'bg-[#2563EB]/20 text-[#38BDF8] border border-[#2563EB]/30' }}">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase bg-[#64748B]/20 text-[#94A3B8] border border-[#64748B]/30">Staf Pengelola</span>
                                @endforelse
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('portal.users.edit', $user->id) }}" class="p-2 rounded-lg bg-[#334155] hover:bg-[#475569] text-white transition-colors" title="Edit Pengguna">
                                        <i data-lucide="edit-3" class="w-4 h-4"></i>
                                    </a>
                                    @if($user->email !== 'superadmin@example.com' && $user->id !== auth()->id())
                                    <form action="{{ route('portal.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-[#EF4444]/20 hover:bg-[#EF4444] text-[#EF4444] hover:text-white transition-colors cursor-pointer" title="Hapus Pengguna">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-xs text-[#94A3B8]">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
