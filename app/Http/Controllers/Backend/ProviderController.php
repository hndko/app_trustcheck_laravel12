<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProviderController extends Controller
{
    /**
     * Tampilkan halaman kelola provider AI.
     */
    public function index(): View
    {
        $data['title'] = 'Kelola Provider AI';
        $data['defaultProvider'] = config('ai.default', 'gemini');
        $data['providers'] = config('ai.providers', []);

        return view('backend.providers.index', $data);
    }

    /**
     * Perbarui konfigurasi dan switch provider AI aktif.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'default_provider' => 'required|string|in:openai,gemini,claude,openrouter,custom',
            'providers' => 'nullable|array',
        ]);

        Setting::updateOrCreate(
            ['key' => 'ai_default_provider'],
            ['value' => $request->default_provider]
        );

        if ($request->has('providers')) {
            Setting::updateOrCreate(
                ['key' => 'ai_provider_configs'],
                ['value' => json_encode($request->providers)]
            );
        }

        return back()->with('success', 'Konfigurasi dan provider AI aktif berhasil diperbarui. Sistem kini menggunakan driver ' . strtoupper($request->default_provider) . '.');
    }
}
