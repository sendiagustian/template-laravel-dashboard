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
                <x-core.input-field type="text" name="search" placeholder="Search..." :class="'min-w-[28rem]'" />
            </div>
        @endif
        @if ($filterOptions !== null)
            <div class="relative">
                <select
                    class="border border-gray-300 rounded px-3 py-2 pr-8 appearance-none focus:outline-none focus:ring-1 focus:ring-[var(--color-primary)] transition duration-200">
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
                @if (count($actions) > 0)
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                @endif
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($visibleData as $row)
                <tr class="hover:bg-primary/30 transition duration-150 ease-in-out">
                    {{-- Render each column data --}}
                    @foreach ($columns as $col)
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ data_get($row, $col['field'] ?? $col) }}
                        </td>
                    @endforeach
                    @if (count($actions) > 0)
                        {{-- Actions Column --}}
                        @php
                            $usernameSession = auth()->user()->username;
                            if ($isUserTable) {
                                if ($row['username'] === $usernameSession) {
                                    $actions = ['edit'];
                                } else {
                                    $actions = ['edit', 'delete'];
                                }
                            }

                        @endphp
                        <td class="flex px-6 py-4 whitespace-nowrap">
                            @if (in_array('edit', $actions))
                                <div class="flex mr-2 mb-2 items-center justify-center">
                                    <x-core.link href="{{ request()->url() . '/edit?id=' . $row['id'] }}">
                                        <x-bi-pencil-square class="w-[25px] h-[25px] text-blue-500" />
                                    </x-core.link>
                                </div>
                            @endif
                            @if (in_array('delete', $actions))
                                <div class="flex mr-2 items-center justify-center">
                                    <form action="{{ request()->url() . '/delete/' . $row['id'] }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cursor-pointer">
                                            <x-bi-trash-fill class="w-[25px] h-[25px] text-red-500" />
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @if (in_array('view', $actions))
                                <div class="flex mr-2 mb-2 items-center justify-center">
                                    <x-core.link href="{{ request()->url() . '/view/' . $row['id'] }}">
                                        <x-bi-eye-fill class="w-[25px] h-[25px] text-green-500" />
                                    </x-core.link>
                                </div>
                            @endif
                        </td>
                    @endif
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
