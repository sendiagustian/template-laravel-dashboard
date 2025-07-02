@props([
    'primary' => false,
    'secondary' => false,
    'disabled' => false,
    'type' => 'button',
    'bgColor' => null,
])

@php
    $baseClasses = 'w-auto font-bold py-3 px-4 rounded-lg transition duration-300 shadow-md';

    // Tentukan $classes berdasarkan urutan prioritas: disabled > primary > secondary > default
    if ($disabled) {
        $classes = ($bgColor ?? 'bg-gray-400') . ' text-black opacity-50 cursor-not-allowed';
    } elseif ($primary) {
        $classes = 'cursor-pointer ' . ($bgColor ?? 'bg-primary') . ' hover:bg-primary-hover text-white';
    } elseif ($secondary) {
        $classes =
            'cursor-pointer ' . ($bgColor ?? 'bg-gray-400') . ' text-white hover:bg-gray-300 hover:text-gray-800';
    } else {
        $classes = 'bg-gray-200 text-gray-800 hover:bg-gray-300';
    }

    $type = $type ?? 'button';

@endphp
<div>
    @if ($type === 'link')
        <x-core.link {{ $attributes->merge(['class' => $baseClasses . ' ' . $classes]) }}>
            {{ $slot }}
        </x-core.link>
    @else
        <button {{ $attributes->merge(['type' => $type, 'class' => $baseClasses . ' ' . $classes]) }}
            {{ $disabled ? 'disabled' : '' }}>
            {{ $slot }}
        </button>
    @endif
</div>
