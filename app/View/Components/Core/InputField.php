<?php

namespace App\View\Components\Core;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    public string $type;
    public string $name;
    public ?string $id;
    public ?string $label;
    public string $placeholder;
    public string $value;
    public bool $required;
    /**
     * Create a new component instance.
     */
    public function __construct($type = 'text', $name = '', ?string $id = null, ?string $label = null, $placeholder = '', $value = '', $required = false)
    {
        $this->type = $type;
        $this->name = $name;
        $this->id = $id;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.input-field');
    }
}
