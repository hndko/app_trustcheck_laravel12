<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Tampilkan formulir edit profil pengguna saat ini.
     */
    public function edit()
    {
        $user = auth()->user();
        $data = [
            'title' => 'Pengaturan Profil Saya — TrustCheck Kelola',
            'user' => $user,
        ];

        return view('backend.profile.edit', $data);
    }

    /**
     * Perbarui data profil pengguna saat ini.
     */
    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => 'nullable|required_with:password|string',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Alamat email sudah digunakan oleh akun lain.',
            'current_password.required_with' => 'Kata sandi saat ini wajib diisi jika ingin merubah kata sandi.',
            'password.min' => 'Kata sandi baru minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Kata sandi saat ini yang Anda masukkan salah.']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('portal.profile.edit')
            ->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
