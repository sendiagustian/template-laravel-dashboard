@php
    $inputId = $id ?? $name;
@endphp

<div class="mb-2">
    @if ($label)
        <label for="{{ $inputId }}" class="block text-sm font-medium text-gray-700 mb-1">
            {{ $label }}@if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    <div class="relative">
        <select
            {{ $attributes->merge([
                'name' => $name,
                'id' => $inputId,
                'required' => $required,
                'class' =>
                    'appearance-none w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-[var(--color-primary)] transition duration-200',
            ]) }}
            @if ($model) wire:model="{{ $model }}" @endif>
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $option)
                <option value="{{ $option['value'] ?? ($option->id ?? $option) }}">
                    {{ $option['label'] ?? ($option->name ?? $option) }}
                </option>
            @endforeach
        </select>
        <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-gray-700">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </span>
    </div>
    @error($model ?? $name)
        <span class="text-sm text-red-600">{{ $message }}</span>
    @enderror
</div>
