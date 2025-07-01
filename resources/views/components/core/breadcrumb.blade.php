@php
    $segments = array_values(
        array_filter(request()->segments(), function ($segment) {
            return $segment !== 'admin';
        }),
    );
    $url = url('/');
@endphp

<nav aria-label="breadcrumb">
    <ol style="display: flex; list-style: none; padding: 0; margin: 0; align-items: center; gap: 16px;">
        <li>
            <x-core.link href="{{ url('/admin/dashboard') }}"
                style="color: #374151; text-decoration: none; font-weight: 500;">Home</x-core.link>
        </li>
        @foreach ($segments as $index => $segment)
            <li style="color: #9ca3af; margin: 0 8px;">/</li>
            @php
                $url .= '/' . $segment;
                $isLast = $index === count($segments) - 1;
                $label = ucfirst(str_replace('-', ' ', $segment));
            @endphp
            <li>
                @if ($isLast)
                    <span style="color: #6b7280;">{{ $label }}</span>
                @else
                    <x-core.link href="{{ $url }}"
                        style="color: #374151; text-decoration: none; font-weight: 500;">{{ $label }}</x-core.link>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
