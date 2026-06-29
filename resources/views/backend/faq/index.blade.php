@extends('layouts.app-backend')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-[#1E293B] p-6 rounded-2xl border border-[#334155] shadow-sm">
        <div>
            <h2 class="text-lg font-bold text-white">Kelola Pertanyaan Umum (FAQ)</h2>
            <p class="text-xs text-[#94A3B8] mt-1">Atur daftar pertanyaan dan jawaban yang akan ditampilkan pada accordion pusat bantuan publik.</p>
        </div>
        <a href="{{ route('portal.faq.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold text-xs shadow-sm transition-all shrink-0">
            <i data-lucide="plus" class="w-4 h-4"></i>
            <span>Tambah FAQ Baru</span>
        </a>
    </div>

    <!-- Alert Notification -->
    @if(session('success'))
        <div class="p-4 rounded-xl bg-[#10B981]/20 border border-[#10B981]/30 text-[#10B981] text-xs font-bold flex items-center gap-2">
            <i data-lucide="check-circle" class="w-4 h-4 shrink-0"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Table -->
    <div class="bg-[#1E293B] rounded-2xl border border-[#334155] shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse min-w-[600px]">
                <thead>
                    <tr class="bg-[#0F172A] text-[#94A3B8] text-xs font-bold uppercase tracking-wider border-b border-[#334155]">
                        <th class="py-4 px-6 w-16 text-center">Urutan</th>
                        <th class="py-4 px-6 w-1/3">Pertanyaan</th>
                        <th class="py-4 px-6">Jawaban Singkat</th>
                        <th class="py-4 px-6 w-24 text-center">Status</th>
                        <th class="py-4 px-6 w-32 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#334155] text-sm text-[#E2E8F0]">
                    @forelse($faqs as $faq)
                        <tr class="hover:bg-[#334155]/50 transition-colors">
                            <td class="py-4 px-6 text-center font-bold text-[#38BDF8]">{{ $faq->order }}</td>
                            <td class="py-4 px-6 font-bold text-white">{{ $faq->question }}</td>
                            <td class="py-4 px-6 text-xs text-[#94A3B8]">{{ Str::limit($faq->answer, 80) }}</td>
                            <td class="py-4 px-6 text-center">
                                @if($faq->is_active)
                                    <span class="px-2.5 py-1 rounded-full bg-[#10B981]/20 text-[#10B981] text-[11px] font-bold">Aktif</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full bg-[#EF4444]/20 text-[#EF4444] text-[11px] font-bold">Nonaktif</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('portal.faq.edit', $faq->id) }}" class="p-2 rounded-lg bg-[#0F172A] hover:bg-[#334155] text-[#38BDF8] transition-colors" title="Edit">
                                        <i data-lucide="edit-2" class="w-4 h-4"></i>
                                    </a>
                                    <form action="{{ route('portal.faq.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 rounded-lg bg-[#0F172A] hover:bg-[#EF4444]/20 text-[#EF4444] transition-colors cursor-pointer" title="Hapus">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-[#94A3B8]">Belum ada FAQ yang dicatat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
