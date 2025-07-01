<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ambil Role dari database
        $superadminRole = Role::where('name', 'superadmin')->first();
        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();

        // 2. Ambil semua Menu dari database
        $allMenus = Menu::all();

        // --- Penugasan untuk Super Admin ---
        if ($superadminRole) {
            // Super admin mendapatkan akses ke semua menu.
            // pluck('id') akan mengambil semua id dari koleksi menu.
            $superadminRole->menus()->sync($allMenus->pluck('id'));
            $this->command->info('Super Admin menus assigned.');
        }

        // --- Penugasan untuk Admin ---
        if ($adminRole) {
            // Admin mendapatkan semua menu KECUALI 'Manajemen Role'
            $adminMenus = $allMenus->filter(function ($menu) {
                return $menu->url !== '/admin/roles';
            });
            $adminRole->menus()->sync($adminMenus->pluck('id'));
            $this->command->info('Admin menus assigned.');
        }

        // --- Penugasan untuk Editor ---
        if ($editorRole) {
            // Editor hanya mendapatkan menu Artikel dan Galeri
            $editorMenus = $allMenus->filter(function ($menu) {
                return in_array($menu->url, ['/admin/dashboard', '/admin/articles', '/admin/galleries']);
            });
            $editorRole->menus()->sync($editorMenus->pluck('id'));
            $this->command->info('Editor menus assigned.');
        }
    }
}
