@props([
    'type' => 'text',
    'name',
    'id' => null,
    'label' => null,
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'class' => '',
])

@php
    $inputId = $id ?? $name;
@endphp

<div class="mb-4">
    @if ($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-600 mb-1">
            {{ $label }}@if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <input type="{{ $type }}" id="{{ $inputId }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}" @if ($required) required @endif
        {{ $attributes->merge(['class' => "w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-200 $class"]) }}>
</div>
