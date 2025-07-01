@props([
    'columns' => [],
    'datas' => [],
    'search' => false,
    'filterOptions' => [],
    'filterLabel' => 'All Status',
    'currentPage' => 1,
    'perPage' => 10,
    'total' => 0,
    'actions' => null,
])

@php
    $lastPage = (int) ceil($total / $perPage);
@endphp

<div class="p-4 bg-white rounded shadow-lg">
    <div class="flex items-center justify-between mb-4">
        @if ($search)
            <div class="flex items-center space-x-2">
                <input type="text" placeholder="Search..." class="border rounded px-3 py-2" />
            </div>
        @endif
        @if (count($filterOptions))
            <div class="relative">
                <select class="border rounded px-3 py-2 pr-8 appearance-none">
                    <option value="">{{ $filterLabel }}</option>
                    @foreach ($filterOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                <span class="pointer-events-none absolute inset-y-0 right-2 flex items-center text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </span>
            </div>
        @endif
    </div>
    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                @foreach ($columns as $col)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        {{ $col['label'] ?? $col }}
                    </th>
                @endforeach
                @if ($actions)
                    <th class="px-6 py-3">Actions</th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($datas as $row)
                <tr>
                    @foreach ($columns as $col)
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ data_get($row, $col['field'] ?? $col) }}
                        </td>
                    @endforeach
                    @if ($actions)
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $actions($row) }}
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + ($actions ? 1 : 0) }}"
                        class="px-6 py-4 text-center text-gray-400">
                        No data found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Manual Pagination --}}
    @if ($lastPage > 1)
        <div class="mt-4 flex justify-center space-x-1">
            {{-- Previous --}}
            <button
                class="px-3 py-1 rounded {{ $currentPage == 1 ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200' }}"
                @if ($currentPage == 1) disabled @endif
                onclick="window.location.search = '?page={{ $currentPage - 1 }}'">
                &laquo;
            </button>
            {{-- Page Numbers --}}
            @for ($i = 1; $i <= $lastPage; $i++)
                <button
                    class="px-3 py-1 rounded {{ $currentPage == $i ? 'bg-blue-500 text-white' : 'bg-gray-100 hover:bg-gray-200' }}"
                    onclick="window.location.search = '?page={{ $i }}'">
                    {{ $i }}
                </button>
            @endfor
            {{-- Next --}}
            <button
                class="px-3 py-1 rounded {{ $currentPage == $lastPage ? 'bg-gray-200 text-gray-400 cursor-not-allowed' : 'bg-gray-100 hover:bg-gray-200' }}"
                @if ($currentPage == $lastPage) disabled @endif
                onclick="window.location.search = '?page={{ $currentPage + 1 }}'">
                &raquo;
            </button>
        </div>
    @endif
</div>
