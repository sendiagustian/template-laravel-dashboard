<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\EditUserForm;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public EditUserForm $form;
    public User $user;

    public function mount()
    {
        $id = (int) request()->query('id');

        $this->user = User::findOrFail($id);

        $this->form->name = $this->user->name;
        $this->form->role = $this->user->roles->first()->id ?? null;
    }


    public function render()
    {
        $id = (int) request()->query('id');

        $roles = Role::where('name', '!=', 'superadmin')->get();

        return view(
            'pages.admin.user.edit',
            [
                'user' => $this->user,
                'roles' => $roles
            ]
        );
    }

    public function edit()
    {
        $this->form->update($this->user);
    }
}
