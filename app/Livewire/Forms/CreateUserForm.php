<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateUserForm extends Form
{
    #[Validate('required|min:3')]
    public $name = '';

    #[Validate('required|min:3|unique:users')]
    public $username = '';

    #[Validate('required|email|unique:users')]
    public $email = '';

    #[Validate('required|exists:roles,id')]
    public $role = null;

    #[Validate('required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).+$/')]
    public $password = '';

    #[Validate('required|same:password')]
    public $password_confirmation = '';

    public function store()
    {
        $this->validate();

        try {

            $user = User::create([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => bcrypt($this->password), // Hash the password
            ]);

            $user->roles()->attach($this->role);

            session()->flash('success', 'User created successfully!');
            return redirect()->route('admin.users'); // Redirect to the users list page
        } catch (\Exception $e) {
            // Handle any exceptions that occur during user creation
            session()->flash('error', 'Failed to create user: ' . $e->getMessage());
            return;
        }
    }
}
