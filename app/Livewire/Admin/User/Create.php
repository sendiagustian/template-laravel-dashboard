<?php

namespace App\Livewire\Admin\User;

use App\Livewire\Forms\CreateUserForm;
use App\Models\Role;
use Livewire\Component;

class Create extends Component
{
    public CreateUserForm $form;

    public function render()
    {
        $roles = Role::where('name', '!=', 'superadmin')->get();

        return view(
            'pages.admin.user.create',
            ['roles' => $roles]
        );
    }

    public function save()
    {
        $this->form->store();
    }
}
