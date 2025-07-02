<?php

namespace App\Livewire\Admin\Menu;

use App\Livewire\Forms\EditMenuForm;
use App\Models\Menu;
use Livewire\Component;

class Edit extends Component
{
    public Menu $menu;
    public EditMenuForm $form;

    public function mount()
    {
        $id = (int) request()->query('id');

        $this->menu = Menu::findOrFail($id);

        $this->form->name = $this->menu->name;
        $this->form->url = $this->menu->url;
        $this->form->icon = $this->menu->icon;
        $this->form->parent_id = $this->menu->parent_id;
        $this->form->order = $this->menu->order;
    }

    public function edit()
    {
        $this->form->update($this->menu);
    }

    public function render()
    {
        return view('pages.admin.menu.edit');
    }
}
