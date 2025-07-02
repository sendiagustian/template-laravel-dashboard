<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\Forms\CreateRoleForm;
use Livewire\Component;

class Create extends Component
{
    public CreateRoleForm $form;

    public function save()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('pages.admin.role.create');
    }
}
