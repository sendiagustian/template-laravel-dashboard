@php
    $lastPage = (int) ceil($total / $perPage);
    $from = $total > 0 ? ($currentPage - 1) * $perPage + 1 : 0;
    $to = min($currentPage * $perPage, $total);
    $visibleData = $getPaginatedData($datas);
@endphp

<div class="p-4 bg-white rounded border border-gray-200">
    <div class="flex items-center justify-between mb-4">
        @if ($search)
            <div class="flex items-center space-x-2">
                <input type="text" placeholder="Search users..." class="border rounded px-3 py-2 w-96" />
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
                {{-- @if ($actions)
                    <th class="px-6 py-3">Actions</th>
                @endif --}}
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($visibleData as $row)
                <tr>
                    @foreach ($columns as $col)
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ data_get($row, $col['field'] ?? $col) }}
                        </td>
                    @endforeach
                    {{-- @if ($actions)
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <x-core.link href="{{ route('#', $row['id']) }}"
                                    class="text-blue-500 hover:underline">Edit</x-core.link>
                            </div>
                            <div>
                                <x-core.link href="{{ route('#', $row['id']) }}"
                                    class="text-red-500 hover:underline">Delete</x-core.link>
                            </div>
                        </td>
                    @endif --}}
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) }}" class="px-6 py-4 text-center text-gray-400">
                        No data found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination Footer --}}
    <div class="flex items-center justify-between mt-4">
        <div class="text-sm text-gray-500 px-2">
            Showing {{ $from }} to {{ $to }} of {{ $total }} results
        </div>
        @if ($lastPage > 1)
            <div class="flex space-x-2">
                {{-- Previous --}}
                <x-core.link href="?page={{ $currentPage - 1 }}" :disabled="$currentPage == 1"
                    class="px-4 py-2 rounded border text-sm"
                    onclick="window.location.search = '?page={{ $currentPage - 1 }}'">
                    Previous
                </x-core.link>
                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $lastPage; $i++)
                    <x-core.link href="?page={{ $i }}" :active="$currentPage == $i" :disabled="$currentPage == $i"
                        class="px-4 py-2 rounded border text-sm {{ $currentPage == $i ? 'bg-primary text-white' : 'bg-white hover:bg-gray-100' }}"
                        onclick="window.location.search = '?page={{ $i }}'">
                        {{ $i }}
                    </x-core.link>
                @endfor
                {{-- Next --}}
                <x-core.link href="?page={{ $currentPage + 1 }}" :disabled="$currentPage == $lastPage"
                    class="px-4 py-2 rounded border text-sm">
                    Next
                </x-core.link>
            </div>
        @endif
    </div>
</div>
