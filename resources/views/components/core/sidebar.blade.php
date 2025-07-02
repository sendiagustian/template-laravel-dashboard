{{-- resources/views/components/core/sidebar.blade.php --}}
@props([
    'isOpen' => false,
    'menuItems' => [],
    'activeSection' => null,
])

{{-- Mobile backdrop --}}
@if ($isOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden" x-on:click="$dispatch('toggle-sidebar')"></div>
@endif

{{-- Sidebar --}}
<div class="fixed inset-y-0 left-0 z-50 w-75 bg-white shadow-xl transform transition-transform duration-300 ease-in-out
        lg:translate-x-0 lg:static lg:inset-0
        {{ $isOpen ? 'translate-x-0' : '-translate-x-full' }}"
    x-data>
    {{-- Header --}}
    <div class="max-h-[92px] flex items-center justify-between p-6">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                <span class="text-white font-bold">H</span>
            </div>
            <div>
                <h1 class="text-lg font-bold text-gray-900">Hijrah Admin</h1>
                <p class="text-xs text-gray-600">Management Panel</p>
            </div>
        </div>
        {{-- <button x-on:click="$dispatch('toggle-sidebar')" class="lg:hidden p-2 rounded-lg hover:bg-gray-100"
            type="button">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button> --}}
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-2 space-y-2">
        @php
            // Group menu items by parent_id and sort by 'order'
            $grouped = collect($menuItems)->sortBy('order')->groupBy('parent_id');

            // Helper to build menu tree recursively
            function buildMenuTree($parentId, $grouped)
            {
                return $grouped->get($parentId, collect())->map(function ($item) use ($grouped) {
                    $children = buildMenuTree($item['id'], $grouped);
                    $item['children'] = $children->isNotEmpty() ? $children->toArray() : [];
                    return $item;
                });
            }

            // Build the menu tree starting from parent_id == null
            $menuTree = buildMenuTree(null, $grouped);

            // Find orphaned children (menu items that have parent_id but parent not in menuItems)
            $allIds = collect($menuItems)->pluck('id')->all();
            $orphans = collect($menuItems)
                ->filter(function ($item) use ($allIds) {
                    return $item['parent_id'] !== null && !in_array($item['parent_id'], $allIds);
                })
                ->sortBy('order');
        @endphp

        {{-- Render menu tree --}}
        <p class="font-medium mb-2">Menu</p>
        @foreach ($menuTree as $item)
            @if (!empty($item['children']))
                {{-- Parent Menu with Children --}}
                <div x-data="{ open: {{ request()->is(ltrim($item['url'], '/')) ? 'true' : 'false' }} }">
                    <button @click="open = !open"
                        class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-left transition-all
                            {{ request()->is(ltrim($item['url'], '/')) ||
                            collect($item['children'])->contains(function ($child) {
                                return Str::contains(request()->url(), $child['url']);
                            })
                                ? 'bg-primary/20 text-[var(--color-primary)] border-r-2 border-[var(--color-primary)] font-medium'
                                : 'text-gray-700 hover:bg-primary/20' }}">
                        @if (!empty($item['icon']))
                            <x-dynamic-component :component="$item['icon']" class="w-5 h-5" />
                        @endif
                        <span class="font-medium flex-1 text-left">{{ $item['name'] }}</span>
                        {{-- Chevron --}}
                        <svg :class="{ 'rotate-90': open }" class="w-4 h-4 ml-auto transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    @php
                        $hasActiveChild = collect($item['children'])->contains(function ($child) {
                            return Str::contains(request()->url(), $child['url']);
                        });
                    @endphp
                    <div x-show="open" class="pl-8 space-y-1 mt-1" x-transition x-init="open = {{ request()->is(ltrim($item['url'], '/')) || $hasActiveChild ? 'true' : 'false' }}">
                        @foreach ($item['children'] as $child)
                            <x-core.link href="{{ $child['url'] }}"
                                class="cursor-pointer w-full flex items-center space-x-3 px-4 py-2 rounded-lg text-left transition-all
                                    {{ Str::contains(request()->url(), $child['url'])
                                        ? 'bg-primary/10 text-[var(--color-primary)] font-medium'
                                        : 'text-gray-600 hover:bg-primary/10' }}">
                                @if (!empty($child['icon']))
                                    <x-dynamic-component :component="$child['icon']" class="w-5 h-5" />
                                @endif
                                <span class="font-normal">{{ $child['name'] }}</span>
                            </x-core.link>
                        @endforeach
                    </div>
                </div>
            @else
                {{-- Single Menu --}}
                <x-core.link href="{{ $item['url'] }}"
                    class="cursor-pointer w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-left transition-all
                        {{ request()->is(ltrim($item['url'], '/'))
                            ? 'bg-primary/20 text-[var(--color-primary)] border-r-2 border-[var(--color-primary)] font-medium'
                            : 'text-gray-700 hover:bg-primary/20' }}">
                    @if (!empty($item['icon']))
                        <x-dynamic-component :component="$item['icon']" class="w-5 h-5" />
                    @endif
                    <span class="font-medium">{{ $item['name'] }}</span>
                </x-core.link>
            @endif
        @endforeach

        {{-- Render orphaned children (menu items with parent_id but parent not present) --}}
        @foreach ($orphans as $item)
            <x-core.link href="{{ $item['url'] }}"
                class="cursor-pointer w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-left transition-all
                    {{ request()->is(ltrim($item['url'], '/'))
                        ? 'bg-primary/20 text-[var(--color-primary)] border-r-2 border-[var(--color-primary)] font-medium'
                        : 'text-gray-700 hover:bg-primary/20' }}">
                @if (!empty($item['icon']))
                    <x-dynamic-component :component="$item['icon']" class="w-5 h-5" />
                @endif
                <span class="font-medium">{{ $item['name'] }}</span>
            </x-core.link>
        @endforeach
    </nav>

    {{-- Footer --}}
    <div class="absolute bottom-0 left-0 w-full p-2 border-t border-gray-200 bg-white">
        <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg">
            <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=50&h=50&fit=crop"
                alt="Admin" class="w-10 h-10 rounded-full" />
            <div class="flex-1">
                <p class="text-sm font-medium text-gray-900">Ahmad Rahman</p>
                <p class="text-xs text-gray-600">Administrator</p>
            </div>
        </div>
        <x-core.button href="{{ route('logout') }}" type="link" primary="true" bgColor="bg-red-600"
            class="w-full flex items-center space-x-3 px-4 mb-2 hover:bg-red-800 hover:text-white rounded-lg transition-colors">
            {{-- Replace with your LogOut icon --}}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
            </svg>
            <span class="font-medium">Logout</span>
        </x-core.button>
    </div>
</div>
