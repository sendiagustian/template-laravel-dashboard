<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        return view('pages.landing.welcome')->layout('components.layouts.guest');
    }
}
