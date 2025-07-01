<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil semua role terlebih dahulu
        $superadminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $userRole = Role::where('name', 'user')->first();

        // Pastikan role tidak null sebelum melanjutkan
        if (!$superadminRole || !$adminRole || !$editorRole || !$userRole) {
            $this->command->error('Satu atau lebih role tidak ditemukan. Jalankan RoleSeeder terlebih dahulu.');
            return;
        }

        // 2. Definisikan data user dummy
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@mail.com',
                'password' => 'password',
                'role' => $superadminRole,
            ],
            [
                'name' => 'Admin User',
                'email' => 'admin@mail.com',
                'password' => 'password',
                'role' => $adminRole,
            ],
            [
                'name' => 'Editor User',
                'email' => 'editor@mail.com',
                'password' => 'password',
                'role' => $editorRole,
            ],
            [
                'name' => 'Regular User',
                'email' => 'user@mail.com',
                'password' => 'password',
                'role' => $userRole,
            ],
        ];

        // 3. Looping dan buat user, lalu assign role
        foreach ($users as $userData) {
            // Buat atau update user berdasarkan email
            $user = User::updateOrCreate(
                ['email' => $userData['email']], // Kunci unik untuk mencari
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                ]
            );

            // Gunakan sync untuk memastikan user hanya memiliki role ini.
            // Ini aman untuk dijalankan berkali-kali.
            $user->roles()->sync([$userData['role']->id]);
        }

        // Beri pesan sukses di console
        $this->command->info('User dummy berhasil dibuat dan role telah di-assign.');
    }
}
