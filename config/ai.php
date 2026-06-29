<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default AI Provider
    |--------------------------------------------------------------------------
    |
    | Opsi yang tersedia: "openai", "gemini", "claude", "openrouter", "custom"
    | Pilih salah satu provider yang ingin digunakan sebagai driver utama.
    |
    */

    'default' => env('AI_PROVIDER', 'gemini'),

    /*
    |--------------------------------------------------------------------------
    | AI Providers Configuration
    |--------------------------------------------------------------------------
    |
    | Konfigurasi lengkap untuk masing-masing penyedia layanan LLM.
    | Masukkan API Key Anda pada file .env sesuai provider yang dipilih.
    |
    */

    'providers' => [

        'openai' => [
            'base_url' => env('OPENAI_BASE_URL', 'https://api.openai.com/v1'),
            'api_key' => env('OPENAI_API_KEY'),
            'model' => env('OPENAI_MODEL', 'gpt-4o-mini'),
            'timeout' => env('AI_TIMEOUT', 30),
        ],

        'gemini' => [
            'base_url' => env('GEMINI_BASE_URL', 'https://generativelanguage.googleapis.com/v1beta'),
            'api_key' => env('GEMINI_API_KEY'),
            'model' => env('GEMINI_MODEL', 'gemini-2.5-flash'),
            'timeout' => env('AI_TIMEOUT', 30),
        ],

        'claude' => [
            'base_url' => env('CLAUDE_BASE_URL', 'https://api.anthropic.com/v1'),
            'api_key' => env('CLAUDE_API_KEY'),
            'model' => env('CLAUDE_MODEL', 'claude-3-5-sonnet-20241022'),
            'version' => env('CLAUDE_VERSION', '2023-06-01'),
            'timeout' => env('AI_TIMEOUT', 30),
        ],

        'openrouter' => [
            'base_url' => env('OPENROUTER_BASE_URL', 'https://openrouter.ai/api/v1'),
            'api_key' => env('OPENROUTER_API_KEY'),
            'model' => env('OPENROUTER_MODEL', 'google/gemini-2.5-flash-001'),
            'site_name' => env('APP_NAME', 'TrustCheck AI'),
            'site_url' => env('APP_URL', 'http://localhost'),
            'timeout' => env('AI_TIMEOUT', 30),
        ],

        'custom' => [
            'base_url' => env('CUSTOM_AI_BASE_URL', 'https://api.customllm.com/v1'),
            'api_key' => env('CUSTOM_AI_API_KEY'),
            'model' => env('CUSTOM_AI_MODEL', 'llama-3.3-70b-instruct'),
            'timeout' => env('AI_TIMEOUT', 30),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Live Search & Scraping Providers (Phase 2)
    |--------------------------------------------------------------------------
    */
    'search' => [
        'provider' => env('SEARCH_PROVIDER', 'tavily'),
        'tavily_api_key' => env('TAVILY_API_KEY'),
        'serpapi_api_key' => env('SERPAPI_API_KEY'),
        'timeout' => 15,
    ],

    'scraping' => [
        'firecrawl_api_key' => env('FIRECRAWL_API_KEY'),
        'jina_reader_url' => 'https://r.jina.ai/',
        'timeout' => 15,
    ],

    'cache_ttl_days' => env('CACHE_TTL_DAYS', 7),

];
