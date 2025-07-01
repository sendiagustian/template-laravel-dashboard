@props(['active' => false, 'disabled' => false])

@php
    $baseClasses = 'font-medium transition-colors]';
    $classes = $active ?? false ? ' active' : '';
    $classes .=
        $disabled ?? false
            ? ' cursor-not-allowed text-gray-400'
            : ' cursor-pointer hover:text-[color:var(--color-primary-hover)';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $baseClasses . $classes]) }}>
    {{ $slot }}
</a>
