{{-- Properti dari class komponen (name, label, id, dll.) sudah otomatis tersedia di sini --}}

<div class="mb-4">
    {{-- Tampilkan label jika ada --}}
    @if ($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-600 mb-1">
            {{ $label }}
            {{-- Tambahkan tanda bintang jika input wajib diisi --}}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}" @required($required) @disabled($disabled)
        {{ $attributes->class([
            'w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[var(--color-primary)] transition duration-200',
            'cursor-not-allowed opacity-50' => $disabled,
        ]) }}>
</div>
