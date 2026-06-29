<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Tampilkan daftar seluruh pengguna sistem.
     */
    public function index()
    {
        $users = User::with('roles')->orderBy('name')->get();
        $data = [
            'title' => 'Kelola Pengguna Sistem — TrustCheck Kelola',
            'users' => $users,
        ];

        return view('backend.users.index', $data);
    }

    /**
     * Tampilkan formulir pembuatan pengguna baru.
     */
    public function create()
    {
        $roles = Role::orderBy('name')->get();
        $data = [
            'title' => 'Tambah Pengguna Baru — TrustCheck Kelola',
            'roles' => $roles,
        ];

        return view('backend.users.create', $data);
    }

    /**
     * Simpan pengguna baru ke dalam database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'nullable|string|exists:roles,name',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Alamat email sudah terdaftar di sistem.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($request->filled('role')) {
            $user->assignRole($request->role);
        } else {
            // Berikan izin default jika tidak memilih role
            $user->givePermissionTo('access_portal_kelola');
        }

        return redirect()->route('portal.users.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan.');
    }

    /**
     * Tampilkan formulir edit pengguna.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name')->get();
        $data = [
            'title' => 'Edit Pengguna: ' . $user->name . ' — TrustCheck Kelola',
            'user' => $user,
            'roles' => $roles,
        ];

        return view('backend.users.edit', $data);
    }

    /**
     * Perbarui data pengguna di database.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'nullable|string|exists:roles,name',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.unique' => 'Alamat email sudah terdaftar di sistem.',
            'password.min' => 'Kata sandi minimal terdiri dari 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if ($request->filled('role')) {
            $user->syncRoles([$request->role]);
        } else {
            $user->syncRoles([]);
            $user->givePermissionTo('access_portal_kelola');
        }

        return redirect()->route('portal.users.index')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Hapus pengguna dari database.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        if ($user->id === auth()->id() || $user->email === 'admin@trustcheck.id') {
            return redirect()->route('portal.users.index')
                ->with('error', 'Akun superadmin utama atau akun Anda sendiri tidak dapat dihapus.');
        }

        $user->delete();

        return redirect()->route('portal.users.index')
            ->with('success', 'Pengguna berhasil dihapus dari sistem.');
    }
}
