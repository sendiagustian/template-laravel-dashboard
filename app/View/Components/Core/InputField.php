<?php

namespace App\View\Components\Core;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputField extends Component
{
    /**
     * Create a new component instance.
     * Menggunakan PHP 8 Constructor Property Promotion untuk kode yang lebih bersih.
     */
    public function __construct(
        public string $name,
        public ?string $label = null,
        public ?string $id = null,
        public string $type = 'text',
        public string $value = '',
        public string $placeholder = '',
        public bool $required = false,
        public bool $disabled = false,
    ) {
        // Jika ID tidak diberikan, gunakan 'name' sebagai ID default.
        // Ini penting untuk menghubungkan <label> dengan <input>.
        $this->id = $id ?? $this->name;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.input-field');
    }
}