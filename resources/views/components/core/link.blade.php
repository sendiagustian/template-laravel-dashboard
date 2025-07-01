@props(['active' => false])

@php
    $baseClasses = 'font-medium transition-colors hover:text-[color:var(--color-primary-hover)]';
    $classes = $active ?? false ? ' active' : '';
@endphp

<a wire:navigate {{ $attributes->merge(['class' => $baseClasses . $classes]) }}>
    {{ $slot }}
</a>
