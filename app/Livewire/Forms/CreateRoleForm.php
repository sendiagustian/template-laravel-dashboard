<?php

namespace App\Livewire\Forms;

use App\Models\Role;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateRoleForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';
    #[Validate('required|string|max:255')]
    public string $description = '';

    public function store()
    {
        $this->validate();

        try {
            Role::create([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('success', 'Role created successfully!');
            return redirect()->route('admin.roles');
        } catch (\Exception $e) {
            // Handle any exceptions that occur during role creation
            session()->flash('error', 'Failed to create role: ' . $e->getMessage());
            return;
        }
    }
}
