<?php

namespace App\Livewire\Forms;

use App\Models\Role;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditRoleForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';
    #[Validate('required|string|max:255')]
    public string $description = '';

    public function update(Role $role)
    {
        $this->validate();

        try {
            $role->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('success', 'Role updated successfully!');
            return redirect()->route('admin.roles');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during role creation
            session()->flash('error', 'Failed to update role: ' . $e->getMessage());
            return;
        }
    }
}
