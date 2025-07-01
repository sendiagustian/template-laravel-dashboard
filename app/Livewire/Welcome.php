<?php

namespace App\Livewire;

use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        return view('pages.welcome')->layout('components.layouts.guest');
    }
}
