<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman form login portal kelola.
     */
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('portal.dashboard');
        }

        $data = [
            'title' => 'Masuk Portal Kelola — TrustCheck AI',
        ];

        return view('auth.login', $data);
    }

    /**
     * Proses autentikasi login pengguna.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Cek apakah user memiliki izin akses portal kelola (spatie permission tanpa role)
            if (!Auth::user()->can('access_portal_kelola')) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak memiliki izin untuk mengakses portal kelola sistem.',
                ]);
            }

            activity()->log('Pengguna berhasil masuk ke portal kelola');

            return redirect()->intended(route('portal.dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial yang Anda masukkan tidak cocok dengan data sistem kami.',
        ])->onlyInput('email');
    }

    /**
     * Proses keluar dari sistem (logout).
     */
    public function logout(Request $request)
    {
        activity()->log('Pengguna keluar dari portal kelola');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}
