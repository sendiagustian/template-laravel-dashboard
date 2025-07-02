<?php

namespace App\View\Components\Core;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    public bool $primary;
    public bool $secondary;
    public bool $disabled;
    public string $type;
    public ?string $bgColor;

    public function __construct($primary = false, $secondary = false, $disabled = false, $type = 'button', $bgColor = null)
    {
        $this->type = $type;
        $this->primary = $primary;
        $this->secondary = $secondary;
        $this->disabled = $disabled;
        $this->bgColor = $bgColor;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.button');
    }
}
