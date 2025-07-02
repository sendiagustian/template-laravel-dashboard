<?php

namespace App\Livewire\Admin\Menu;

use App\Livewire\Forms\CreateMenuForm;
use Livewire\Component;

class Create extends Component
{
    public CreateMenuForm $form;

    public function save()
    {
        $this->form->store();
    }

    public function render()
    {
        return view('pages.admin.menu.create');
    }
}
