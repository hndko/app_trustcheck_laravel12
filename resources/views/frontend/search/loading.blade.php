@extends('layouts.app-frontend')

@section('content')
<div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8"
     x-data="{
        status: '{{ $company->status }}',
        poll() {
            if (this.status === 'completed') {
                window.location.href = '{{ route('search.result', $company->id) }}';
                return;
            }
            fetch('{{ route('search.status', $company->id) }}')
                .then(res => res.json())
                .then(data => {
                    this.status = data.status;
                    if (data.status === 'completed') {
                        window.location.href = data.redirect_url;
                    }
                })
                .catch(err => console.error(err));
        }
     }"
     x-init="setInterval(() => poll(), 2000)">

    <!-- Status Banner -->
    <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 mb-8 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-[#EFF6FF] text-[#2563EB] flex items-center justify-center animate-pulse shrink-0">
                <i data-lucide="cpu" class="w-6 h-6"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-[#0F172A]">Sedang Mengumpulkan & Menganalisis Data Reputasi...</h2>
                <p class="text-xs text-[#64748B]">Sistem AI sedang mengekstraksi informasi dari domain resmi, berita online, dan ulasan publik untuk <strong class="text-[#0F172A]">{{ $company->name }}</strong>.</p>
            </div>
        </div>
        <div class="px-4 py-2 rounded-lg bg-[#F1F5F9] border border-[#E2E8F0] text-xs font-bold text-[#475569] flex items-center gap-2 shrink-0">
            <span class="w-2 h-2 rounded-full bg-[#D97706] animate-ping"></span>
            <span>Status: PROSES KECERDASAN BUATAN</span>
        </div>
    </div>

    <!-- Skeleton Loading Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 animate-pulse">
        <!-- Sidebar Skeleton -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm">
                <div class="h-4 bg-[#E2E8F0] rounded w-1/2 mb-4"></div>
                <div class="h-16 bg-[#F1F5F9] rounded-xl w-3/4 mb-6"></div>
                <div class="space-y-3">
                    <div class="h-3 bg-[#E2E8F0] rounded w-full"></div>
                    <div class="h-3 bg-[#E2E8F0] rounded w-5/6"></div>
                    <div class="h-3 bg-[#E2E8F0] rounded w-4/6"></div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm">
                <div class="h-4 bg-[#E2E8F0] rounded w-2/3 mb-4"></div>
                <div class="space-y-4">
                    <div class="h-8 bg-[#F1F5F9] rounded w-full"></div>
                    <div class="h-8 bg-[#F1F5F9] rounded w-full"></div>
                    <div class="h-8 bg-[#F1F5F9] rounded w-full"></div>
                </div>
            </div>
        </div>

        <!-- Main Content Skeleton -->
        <div class="lg:col-span-2 space-y-6">
            <!-- AI Summary Skeleton -->
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm">
                <div class="h-5 bg-[#E2E8F0] rounded w-1/3 mb-4"></div>
                <div class="space-y-3">
                    <div class="h-3 bg-[#F1F5F9] rounded w-full"></div>
                    <div class="h-3 bg-[#F1F5F9] rounded w-full"></div>
                    <div class="h-3 bg-[#F1F5F9] rounded w-11/12"></div>
                    <div class="h-3 bg-[#F1F5F9] rounded w-4/5"></div>
                </div>
            </div>

            <!-- Reputation Breakdown Skeleton -->
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm">
                <div class="h-5 bg-[#E2E8F0] rounded w-1/4 mb-6"></div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="h-20 bg-[#F1F5F9] rounded-xl w-full"></div>
                    <div class="h-20 bg-[#F1F5F9] rounded-xl w-full"></div>
                    <div class="h-20 bg-[#F1F5F9] rounded-xl w-full"></div>
                    <div class="h-20 bg-[#F1F5F9] rounded-xl w-full"></div>
                </div>
            </div>

            <!-- Sources Skeleton -->
            <div class="bg-white rounded-2xl border border-[#E5E7EB] p-6 shadow-sm">
                <div class="h-5 bg-[#E2E8F0] rounded w-1/3 mb-4"></div>
                <div class="space-y-4">
                    <div class="h-16 bg-[#F1F5F9] rounded-xl w-full"></div>
                    <div class="h-16 bg-[#F1F5F9] rounded-xl w-full"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
