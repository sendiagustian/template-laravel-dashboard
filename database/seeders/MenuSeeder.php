<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Menu Induk: Manajemen Sistem
            [
                'name' => 'Dashboard',
                'url' => '/admin/dashboard',
                'icon' => 'bi-house-fill',
                'order' => 1,
            ],
            // Menu Level Atas (tanpa induk)
            [
                'name' => 'Manajemen Profil',
                'url' => '/admin/profile',
                'icon' => 'antdesign-profile',
                'order' => 2,
            ],
            [
                'name' => 'Manajemen Sistem',
                'url' => '#', // URL '#' menandakan ini hanya menu induk
                'icon' => 'bi-database-fill',
                'order' => 3,
                'children' => [
                    [
                        'name' => 'Manajemen User',
                        'url' => '/admin/users',
                        'icon' => 'bi-person-fill',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Manajemen Role',
                        'url' => '/admin/roles',
                        'icon' => 'antdesign-user-switch-o',
                        'order' => 2,
                    ],
                    [
                        'name' => 'Manajemen Menu',
                        'url' => '/admin/menus',
                        'icon' => 'bi-menu-button-fill',
                        'order' => 3,
                    ],
                ]
            ],
            // Menu Induk: Manajemen Konten
            [
                'name' => 'Manajemen Konten',
                'url' => '#',
                'icon' => 'bi-images',
                'order' => 4,
                'children' => [
                    [
                        'name' => 'Manajemen Artikel',
                        'url' => '/admin/articles',
                        'icon' => 'bi-images',
                        'order' => 1,
                    ],
                    [
                        'name' => 'Manajemen Galeri',
                        'url' => '/admin/galleries',
                        'icon' => 'bi-images',
                        'order' => 2,
                    ],
                    [
                        'name' => 'Manajemen Paket',
                        'url' => '/admin/packages',
                        'icon' => 'bi-images',
                        'order' => 3,
                    ],
                ]
            ],
        ];

        // Fungsi rekursif untuk membuat menu
        $createMenu = function ($menus, $parentId = null) use (&$createMenu) {
            foreach ($menus as $menuData) {
                // Pisahkan data anak dari data induk
                $children = $menuData['children'] ?? null;
                unset($menuData['children']);

                // Tambahkan parent_id
                $menuData['parent_id'] = $parentId;

                // Buat atau update menu
                $menu = Menu::updateOrCreate(
                    ['name' => $menuData['name']], // Kunci unik yang benar
                    $menuData
                );

                // Jika ada anak, panggil fungsi ini lagi untuk anak-anaknya
                if ($children) {
                    $createMenu($children, $menu->id);
                }
            }
        };

        // Mulai proses pembuatan menu dari level atas
        $createMenu($menus);

        $this->command->info('Menu dummy berhasil dibuat.');
    }
}
