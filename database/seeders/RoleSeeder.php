<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'superadmin',
                'description' => 'Memiliki akses penuh ke semua fitur sistem.'
            ],
            [
                'name' => 'admin',
                'description' => 'Akses administratif untuk mengelola konten dan pengguna.'
            ],
            [
                'name' => 'editor',
                'description' => 'Dapat membuat, mengedit, dan mempublikasikan konten.'
            ],
            [
                'name' => 'user',
                'description' => 'Pengguna standar dengan akses terbatas.'
            ],
        ];

        // Looping data dan masukkan ke database
        foreach ($roles as $roleData) {
            Role::updateOrCreate(
                ['name' => $roleData['name']], // Kunci unik untuk mencari
                $roleData                      // Data untuk di-update atau di-create
            );
        }
    }
}
