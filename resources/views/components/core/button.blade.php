@props([
    'primary' => false,
    'secondary' => false,
    'disabled' => false,
    'type' => 'button',
    'bgColor' => null,
])

@php
    $baseClasses = 'w-full font-bold py-3 px-4 rounded-lg transition duration-300 shadow-md';
    $primaryClasses = 'cursor-pointer ' . ($bgColor ?? 'bg-primary') . ' hover:bg-primary-hover text-white';
    $secondaryClasses =
        'cursor-pointer ' . ($bgColor ?? 'bg-gray-300') . ' text-gray-600 hover:bg-gray-400 hover:text-gray-800';
    $disabledClasses = ($bgColor ?? 'bg-gray-400') . ' text-black opacity-50 cursor-not-allowed';

    $type = $type ?? 'button';

    if ($primary) {
        $classes = $primaryClasses;
    } elseif ($secondary) {
        $classes = $secondaryClasses;
    } elseif ($disabled) {
        $classes = $disabledClasses;
    } else {
        $classes = 'bg-gray-200 text-gray-800 hover:bg-gray-300';
    }
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
