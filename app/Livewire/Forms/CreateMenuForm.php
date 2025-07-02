<?php

namespace App\Livewire\Forms;

use App\Models\Menu;
use Livewire\Attributes\Validate;
use Livewire\Form;

class CreateMenuForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|string|max:255')]
    public string $url = '';

    #[Validate('required|string|max:255')]
    public string $icon = '';

    #[Validate('nullable|integer|max:255')]
    public int $parent_id = 0;

    #[Validate('required|integer|min:0')]
    public int $order = 0;

    public function store()
    {
        $this->validate();

        try {
            Menu::create([
                'name' => $this->name,
                'url' => $this->url,
                'icon' => $this->icon,
                'parent_id' => $this->parent_id == 0 ? null : $this->parent_id,
                'order' => $this->order,
            ]);

            session()->flash('success', 'Menu created successfully.');
            return redirect()->route('admin.menus');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to create menu: ' . $e->getMessage());
            return;
        }
    }
}
