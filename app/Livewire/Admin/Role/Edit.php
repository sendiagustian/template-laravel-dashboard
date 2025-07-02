<?php

namespace App\Livewire\Admin\Role;

use App\Livewire\Forms\EditRoleForm;
use App\Models\Role;
use Livewire\Component;

class Edit extends Component
{
    public Role $role;
    public EditRoleForm $form;

    public function mount()
    {
        $id = (int) request()->query('id');
        $this->role = Role::findOrFail($id);

        $this->form->name = $this->role->name;
        $this->form->description = $this->role->description;
    }

    public function edit()
    {
        $this->form->update($this->role);
    }

    public function render()
    {
        return view('pages.admin.role.edit');
    }
}
