<?php

namespace App\Livewire\Role;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $roles = Role::all();
        $roleItems = $roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'description' => $role->description,
            ];
        })->toArray();

        return view('pages.role.index', [
            'roleItems' => $roleItems,
        ]);
    }
}
