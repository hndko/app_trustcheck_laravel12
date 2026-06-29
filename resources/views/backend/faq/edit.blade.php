@extends('layouts.app-backend')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center gap-4 bg-[#1E293B] p-6 rounded-2xl border border-[#334155] shadow-sm">
        <a href="{{ route('portal.faq.index') }}" class="p-2 rounded-xl bg-[#0F172A] hover:bg-[#334155] text-[#94A3B8] hover:text-white transition-colors">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h2 class="text-lg font-bold text-white">Edit FAQ</h2>
            <p class="text-xs text-[#94A3B8] mt-0.5">Perbarui teks pertanyaan atau jawaban pada pusat bantuan publik.</p>
        </div>
    </div>

    @if($errors->any())
        <div class="p-4 rounded-xl bg-[#EF4444]/20 border border-[#EF4444]/30 text-[#EF4444] text-xs font-bold flex items-center gap-2">
            <i data-lucide="alert-triangle" class="w-4 h-4 shrink-0"></i>
            <span>{{ $errors->first() }}</span>
        </div>
    @endif

    <div class="bg-[#1E293B] rounded-2xl border border-[#334155] p-6 shadow-sm">
        <form action="{{ route('portal.faq.update', $faq->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label for="question" class="block text-xs font-bold text-[#E2E8F0] uppercase tracking-wider mb-2">Pertanyaan</label>
                <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}" required
                    class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] text-white placeholder-[#64748B] text-sm focus:outline-none focus:border-[#38BDF8] transition-colors">
            </div>

            <div>
                <label for="answer" class="block text-xs font-bold text-[#E2E8F0] uppercase tracking-wider mb-2">Jawaban Penjelasan</label>
                <textarea name="answer" id="answer" rows="5" required
                    class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] text-white placeholder-[#64748B] text-sm focus:outline-none focus:border-[#38BDF8] transition-colors">{{ old('answer', $faq->answer) }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="order" class="block text-xs font-bold text-[#E2E8F0] uppercase tracking-wider mb-2">Nomor Urut Tampilan</label>
                    <input type="number" name="order" id="order" value="{{ old('order', $faq->order) }}" required
                        class="w-full px-4 py-3 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-sm focus:outline-none focus:border-[#38BDF8] transition-colors">
                </div>

                <div class="flex items-center pt-6">
                    <label class="flex items-center gap-3 cursor-pointer text-sm font-semibold text-[#E2E8F0]">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }} class="rounded bg-[#0F172A] border-[#334155] text-[#2563EB] focus:ring-0 w-5 h-5">
                        <span>Aktifkan & Tampilkan di Portal</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 border-t border-[#334155] flex justify-end gap-3">
                <a href="{{ route('portal.faq.index') }}" class="px-5 py-2.5 rounded-xl bg-[#0F172A] hover:bg-[#334155] text-xs font-bold text-[#94A3B8] hover:text-white transition-colors">Batal</a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white text-xs font-extrabold shadow-sm transition-all cursor-pointer">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
