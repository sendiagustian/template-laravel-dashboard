<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Form;

class AuthForm extends Form
{
    public string $email = '';

    public string $password = '';

    public function authenticate(): User|null
    {
        // Logic for user authentication goes here
        $user = User::where('email', $this->email)->first();

        if (!$user) {
            return null;
        }

        $validPassword = password_verify($this->password, $user->password);
        if (!$validPassword) {
            return null;
        }

        return $user;
    }
}
