<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk membuat permission dan pengelola sistem default.
     */
    public function run(): void
    {
        // Bersihkan cache permission spatie
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat permission spesifik (tanpa role)
        $permission = Permission::firstOrCreate(['name' => 'access_portal_kelola']);

        // Buat pengguna pengelola sistem
        $admin = User::firstOrCreate(
            ['email' => 'admin@trustcheck.id'],
            [
                'name' => 'Pengelola Utama TrustCheck AI',
                'password' => Hash::make('password'),
            ]
        );

        // Berikan izin ke pengelola
        if (!$admin->hasPermissionTo($permission)) {
            $admin->givePermissionTo($permission);
        }
    }
}
