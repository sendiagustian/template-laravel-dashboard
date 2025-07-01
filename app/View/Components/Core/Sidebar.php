<?php

namespace App\View\Components\Core;

use App\Models\Menu;
use App\Models\Role;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public bool $isOpen; // Default value for isOpen
    public array $menuItems;
    public $activeSection;

    public function __construct()
    {
        $this->isOpen = false;
        $this->activeSection = '/admin/dashboard';

        $user = auth()->user();
        $userRole = $user->roles()->first();
        $roleMenus = Role::where('name', $userRole->name)->first();
        $menus = $roleMenus->menus->map(function ($menu) {
            return $menu->only(['id', 'name', 'url', 'icon', 'parent_id', 'order']);
        })->toArray();

        // Map the menus from the user's role to the menuItems array
        $this->menuItems = $menus;
    }

    public function setActiveSection(string $path): void
    {
        $this->activeSection = $path;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.sidebar');
    }
}
