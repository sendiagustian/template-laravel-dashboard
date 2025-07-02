<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class EditUserForm extends Form
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|exists:roles,id')]
    public $role = null;

    public function update(User $user)
    {
        $this->validate();
        try {

            // Update the user details
            $user->update([
                'name' => $this->name,
            ]);

            // Sync the user's roles
            $user->roles()->sync([$this->role]);

            session()->flash('success', 'User updated successfully!');
            return redirect()->route('admin.users'); // Redirect to the users list page
        } catch (\Exception $e) {
            // Handle any exceptions that occur during user update
            session()->flash('error', 'Failed to update user: ' . $e->getMessage());
            return;
        }
    }
}
