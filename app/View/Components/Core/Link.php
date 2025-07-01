<?php

namespace App\View\Components\Core;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    public bool $active;
    public bool $disabled;
    /**
     * Create a new component instance.
     */
    public function __construct(bool $active = false, bool $disabled = false)
    {
        $this->active = $active;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.link');
    }
}
