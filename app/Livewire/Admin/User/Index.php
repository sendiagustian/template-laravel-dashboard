<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{

    public function render()
    {
        // Mengambil data user beserta relasi roles-nya
        $users = User::with('roles')
            ->whereDoesntHave('roles', function ($query) {
                $query->where('name', 'superadmin');
            })
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role' => $user->roles->pluck('name')->implode(', '),
                ];
            })
            ->toArray();

        return view('pages.admin.user.index', ['users' => $users]);
    }
}
