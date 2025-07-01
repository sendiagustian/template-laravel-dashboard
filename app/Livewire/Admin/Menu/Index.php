<?php

namespace App\Livewire\Admin\Menu;

use App\Models\Menu;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $menus = Menu::all();
        $menuItems = $menus->map(function ($menu) {
            return [
                'id' => $menu->id,
                'name' => $menu->name,
                'url' => $menu->url,
                'icon' => $menu->icon,
                'order' => $menu->order,
                'parent_id' => $menu->parent_id,
            ];
        })->toArray();
        return view('pages.admin.menu.index', [
            'menuItems' => $menuItems,
        ]);
    }
}
