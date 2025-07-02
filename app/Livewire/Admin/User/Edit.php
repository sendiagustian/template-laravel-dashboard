<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\EditUserForm;
use App\Models\Role;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public EditUserForm $form;

    public function render()
    {
        $id = (int) request()->query('id');

        $user = User::findOrFail($id);
        $roles = Role::where('name', '!=', 'superadmin')->get();

        return view(
            'pages.admin.user.edit',
            [
                'user' => $user,
                'roles' => $roles
            ]
        );
    }

    public function edit()
    {
        $this->form->update();
    }
}
