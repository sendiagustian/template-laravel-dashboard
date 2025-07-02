<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\AuthForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public AuthForm $form;


    public function login()
    {
        $user = $this->form->authenticate();

        if (!$user) {
            return redirect('login')->with(['error' => 'Email or password invalid.']);
        }

        $authenticatable = Auth::attempt([
            'email' => $this->form->email,
            'password' => $this->form->password,
        ]);

        if ($authenticatable) {
            session()->regenerate();
            return redirect('/admin/dashboard')->with(['success' => 'You are logged in.']);
        } else {
            return redirect('login')->with(['error' => 'Email or password invalid.']);
        }
    }

    public function render()
    {
        return view('pages.auth.login')->layout('components.layouts.guest');
    }


}
