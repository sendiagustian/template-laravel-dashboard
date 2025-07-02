<?php

namespace App\View\Components\Core;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputSelect extends Component
{
    public string $label;
    public string $name;
    public ?string $id;
    public array $options;
    public $model;
    public bool $required;
    public string $placeholder;
    public ?string $value;

    public function __construct(
        string $label = '',
        string $name,
        ?string $id = null,
        array $options = [],
        $model = null,
        bool $required = false,
        string $placeholder = 'Select Option',
        ?string $value = null
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->options = $options;
        $this->model = $model;
        $this->required = $required;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.input-select');
    }
}
