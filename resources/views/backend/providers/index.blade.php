@extends('layouts.app-backend')

@section('content')
<div class="space-y-6 max-w-6xl mx-auto" x-data="{ selectedProvider: '{{ $defaultProvider }}', activeTab: '{{ $defaultProvider }}' }">
    <!-- Header -->
    <div class="bg-[#1E293B] p-6 rounded-2xl border border-[#334155] shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-white flex items-center gap-2">
                <i data-lucide="cpu" class="w-5 h-5 text-[#38BDF8]"></i>
                <span>Kelola Provider & Driver AI Aktif</span>
            </h2>
            <p class="text-xs text-[#94A3B8] mt-1">Konfigurasi kunci API dan pilih model kecerdasan buatan utama yang akan mengekstraksi data due diligence secara real-time tanpa mengubah berkas <code class="text-[#38BDF8] bg-[#0F172A] px-1.5 py-0.5 rounded">.env</code>.</p>
        </div>
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-xl bg-[#0F172A] border border-[#334155] text-xs font-semibold text-[#10B981] shrink-0">
            <span class="w-2 h-2 rounded-full bg-[#10B981] animate-pulse"></span>
            <span>Driver Aktif: <strong class="uppercase text-white" x-text="selectedProvider"></strong></span>
        </div>
    </div>

    <form action="{{ route('portal.providers.update') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Provider Switcher Cards -->
        <div class="bg-[#1E293B] p-6 rounded-2xl border border-[#334155] shadow-sm space-y-4">
            <label class="block text-xs font-bold uppercase tracking-wider text-[#94A3B8]">1. Pilih Provider Utama (Active Driver Switcher)</label>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3">
                @php
                    $providerOptions = [
                        'gemini' => ['name' => 'Google Gemini', 'icon' => 'sparkles', 'color' => 'text-[#38BDF8]'],
                        'openai' => ['name' => 'OpenAI GPT', 'icon' => 'zap', 'color' => 'text-[#10B981]'],
                        'claude' => ['name' => 'Anthropic Claude', 'icon' => 'brain', 'color' => 'text-[#F59E0B]'],
                        'openrouter' => ['name' => 'OpenRouter AI', 'icon' => 'network', 'color' => 'text-[#A78BFA]'],
                        'custom' => ['name' => 'Custom LLM API', 'icon' => 'server', 'color' => 'text-[#EC4899]'],
                    ];
                @endphp

                @foreach($providerOptions as $key => $meta)
                <label @click="selectedProvider = '{{ $key }}'; activeTab = '{{ $key }}'" 
                       :class="selectedProvider === '{{ $key }}' ? 'bg-[#2563EB]/10 border-[#2563EB] shadow-sm' : 'bg-[#0F172A] border-[#334155] hover:border-[#475569]'"
                       class="relative flex flex-col items-center justify-center p-4 rounded-xl border cursor-pointer transition-all text-center group">
                    <input type="radio" name="default_provider" value="{{ $key }}" x-model="selectedProvider" class="sr-only">
                    <i data-lucide="{{ $meta['icon'] }}" class="w-6 h-6 mb-2 {{ $meta['color'] }} group-hover:scale-110 transition-transform"></i>
                    <span class="text-xs font-bold text-white">{{ $meta['name'] }}</span>
                    <span :class="selectedProvider === '{{ $key }}' ? 'opacity-100' : 'opacity-0'" class="absolute top-2 right-2 w-2 h-2 rounded-full bg-[#2563EB] transition-opacity"></span>
                </label>
                @endforeach
            </div>
        </div>

        <!-- Provider Configuration Tabs -->
        <div class="bg-[#1E293B] rounded-2xl border border-[#334155] shadow-sm overflow-hidden">
            <div class="p-6 border-b border-[#334155] flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-sm font-bold text-white uppercase tracking-wider">2. Pengaturan Kredensial & Model Parameter</h3>
                    <p class="text-xs text-[#94A3B8] mt-0.5">Atur API Key dan Model ID untuk setiap penyedia layanan.</p>
                </div>
                <!-- Tabs Nav -->
                <div class="flex flex-wrap gap-1 bg-[#0F172A] p-1 rounded-xl border border-[#334155]">
                    @foreach($providerOptions as $key => $meta)
                    <button type="button" @click="activeTab = '{{ $key }}'"
                            :class="activeTab === '{{ $key }}' ? 'bg-[#2563EB] text-white font-bold' : 'text-[#94A3B8] hover:text-white font-medium'"
                            class="px-3 py-1.5 rounded-lg text-xs transition-all cursor-pointer">
                        {{ strtoupper($key) }}
                    </button>
                    @endforeach
                </div>
            </div>

            <div class="p-6">
                <!-- Google Gemini Form -->
                <div x-show="activeTab === 'gemini'" class="space-y-4">
                    <div class="flex items-center gap-2 text-sm font-bold text-[#38BDF8] pb-2 border-b border-[#334155]/50">
                        <i data-lucide="sparkles" class="w-4 h-4"></i>
                        <span>Konfigurasi Google Gemini (Rekomendasi Utama)</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Gemini API Key</label>
                            <input type="password" name="providers[gemini][api_key]" value="{{ $providers['gemini']['api_key'] ?? '' }}" placeholder="AIzaSy..." class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                            <span class="text-[11px] text-[#64748B] mt-1 block">Dapatkan kunci gratis melalui Google AI Studio.</span>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Model ID</label>
                            <input type="text" name="providers[gemini][model]" value="{{ $providers['gemini']['model'] ?? 'gemini-2.5-flash' }}" placeholder="gemini-2.5-flash" class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                            <span class="text-[11px] text-[#64748B] mt-1 block">Contoh: <code class="text-white">gemini-2.5-flash</code> atau <code class="text-white">gemini-1.5-pro</code>.</span>
                        </div>
                    </div>
                </div>

                <!-- OpenAI Form -->
                <div x-show="activeTab === 'openai'" class="space-y-4" style="display: none;">
                    <div class="flex items-center gap-2 text-sm font-bold text-[#10B981] pb-2 border-b border-[#334155]/50">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                        <span>Konfigurasi OpenAI GPT</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">OpenAI API Key</label>
                            <input type="password" name="providers[openai][api_key]" value="{{ $providers['openai']['api_key'] ?? '' }}" placeholder="sk-proj-..." class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Model ID</label>
                            <input type="text" name="providers[openai][model]" value="{{ $providers['openai']['model'] ?? 'gpt-4o-mini' }}" placeholder="gpt-4o-mini" class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Claude Form -->
                <div x-show="activeTab === 'claude'" class="space-y-4" style="display: none;">
                    <div class="flex items-center gap-2 text-sm font-bold text-[#F59E0B] pb-2 border-b border-[#334155]/50">
                        <i data-lucide="brain" class="w-4 h-4"></i>
                        <span>Konfigurasi Anthropic Claude</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Anthropic API Key</label>
                            <input type="password" name="providers[claude][api_key]" value="{{ $providers['claude']['api_key'] ?? '' }}" placeholder="sk-ant-..." class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Model ID</label>
                            <input type="text" name="providers[claude][model]" value="{{ $providers['claude']['model'] ?? 'claude-3-5-sonnet-20241022' }}" placeholder="claude-3-5-sonnet-20241022" class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>

                <!-- OpenRouter Form -->
                <div x-show="activeTab === 'openrouter'" class="space-y-4" style="display: none;">
                    <div class="flex items-center gap-2 text-sm font-bold text-[#A78BFA] pb-2 border-b border-[#334155]/50">
                        <i data-lucide="network" class="w-4 h-4"></i>
                        <span>Konfigurasi OpenRouter AI (Multi-Model Gateway)</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">OpenRouter API Key</label>
                            <input type="password" name="providers[openrouter][api_key]" value="{{ $providers['openrouter']['api_key'] ?? '' }}" placeholder="sk-or-v1-..." class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Model ID (OpenRouter Slug)</label>
                            <input type="text" name="providers[openrouter][model]" value="{{ $providers['openrouter']['model'] ?? 'google/gemini-2.5-flash-001' }}" placeholder="google/gemini-2.5-flash-001" class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>

                <!-- Custom LLM Form -->
                <div x-show="activeTab === 'custom'" class="space-y-4" style="display: none;">
                    <div class="flex items-center gap-2 text-sm font-bold text-[#EC4899] pb-2 border-b border-[#334155]/50">
                        <i data-lucide="server" class="w-4 h-4"></i>
                        <span>Konfigurasi Custom LLM Base URL (Llama / Mistral / Self-Hosted)</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Base Endpoint URL</label>
                            <input type="url" name="providers[custom][base_url]" value="{{ $providers['custom']['base_url'] ?? 'https://api.customllm.com/v1' }}" placeholder="https://api.customllm.com/v1" class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Custom API Key</label>
                            <input type="password" name="providers[custom][api_key]" value="{{ $providers['custom']['api_key'] ?? '' }}" placeholder="custom-token-..." class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-[#E2E8F0] mb-1.5">Model ID</label>
                            <input type="text" name="providers[custom][model]" value="{{ $providers['custom']['model'] ?? 'llama-3.3-70b-instruct' }}" placeholder="llama-3.3-70b-instruct" class="w-full px-4 py-2.5 rounded-xl bg-[#0F172A] border border-[#334155] text-white text-xs focus:border-[#2563EB] focus:outline-none transition-colors">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Submit -->
            <div class="p-6 bg-[#0F172A]/50 border-t border-[#334155] flex items-center justify-end">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#2563EB] hover:bg-[#1D4ED8] text-white font-bold text-xs shadow-sm transition-all cursor-pointer">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan Perubahan & Aktifkan Provider</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
