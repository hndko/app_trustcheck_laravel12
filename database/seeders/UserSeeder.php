<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat role superadmin, permission, dan akun pengguna awal.
     */
    public function run(): void
    {
        // Bersihkan cache permission spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat daftar permission dasar sistem
        $permissions = [
            'access_portal_kelola',
            'manage_users',
            'manage_faqs',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Buat role superadmin
        $superadminRole = Role::firstOrCreate(['name' => 'superadmin']);

        // Buat pengguna pengelola sistem utama
        $admin = User::firstOrCreate(
            ['email' => 'admin@trustcheck.id'],
            [
                'name' => 'Superadmin TrustCheck AI',
                'password' => Hash::make('password'),
            ]
        );

        // Berikan role superadmin ke pengguna utama
        if (!$admin->hasRole('superadmin')) {
            $admin->assignRole($superadminRole);
        }
    }
}
