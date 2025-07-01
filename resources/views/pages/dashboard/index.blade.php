@php
    $stats = [
        [
            'title' => 'Total Users',
            'value' => '1,234',
            'change' => '+12%',
            'trend' => 'up',
            'icon' => 'users',
            'color' => 'bg-blue-500',
        ],
        [
            'title' => 'Active Articles',
            'value' => '89',
            'change' => '+5%',
            'trend' => 'up',
            'icon' => 'file-text',
            'color' => 'bg-green-500',
        ],
        [
            'title' => 'Available Packages',
            'value' => '24',
            'change' => '-2%',
            'trend' => 'down',
            'icon' => 'package',
            'color' => 'bg-purple-500',
        ],
        [
            'title' => 'Gallery Items',
            'value' => '156',
            'change' => '+18%',
            'trend' => 'up',
            'icon' => 'image',
            'color' => 'bg-orange-500',
        ],
    ];

    $recentActivities = [
        [
            'id' => 1,
            'action' => 'New user registered',
            'user' => 'Siti Aminah',
            'time' => '2 minutes ago',
            'type' => 'user',
        ],
        [
            'id' => 2,
            'action' => 'Article published',
            'user' => 'Ahmad Rahman',
            'time' => '1 hour ago',
            'type' => 'article',
        ],
        [
            'id' => 3,
            'action' => 'Package updated',
            'user' => 'Muhammad Ali',
            'time' => '3 hours ago',
            'type' => 'package',
        ],
        [
            'id' => 4,
            'action' => 'Gallery image uploaded',
            'user' => 'Fatimah Al-Zahra',
            'time' => '5 hours ago',
            'type' => 'gallery',
        ],
    ];
@endphp

@php
    // SVG icon map
    $iconSvgs = [
        'users' =>
            '<svg class="text-white w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m9-7a4 4 0 11-8 0 4 4 0 018 0zm6 6a4 4 0 00-3-3.87"></path></svg>',
        'file-text' =>
            '<svg class="text-white w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 16h8M8 12h8m-6 8h6a2 2 0 002-2V7.83a2 2 0 00-.59-1.41l-3.83-3.83A2 2 0 0013.17 2H6a2 2 0 00-2 2v16a2 2 0 002 2z"></path></svg>',
        'package' =>
            '<svg class="text-white w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4a2 2 0 001-1.73z"></path><path stroke-linecap="round" stroke-linejoin="round" d="M3.27 6.96L12 12.01l8.73-5.05"></path></svg>',
        'image' =>
            '<svg class="text-white w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect width="20" height="16" x="2" y="4" rx="2" ry="2"/><circle cx="8.5" cy="9.5" r="1.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 15l-5-5L5 21"></path></svg>',
    ];
@endphp

<div class="space-y-8">
    {{-- Stats Grid --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($stats as $stat)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600">{{ $stat['title'] }}</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stat['value'] }}</p>
                        <div
                            class="flex items-center mt-2 {{ $stat['trend'] === 'up' ? 'text-green-600' : 'text-red-600' }}">
                            @if ($stat['trend'] === 'up')
                                {{-- Trending Up Icon --}}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3">
                                    </path>
                                </svg>
                            @else
                                {{-- Trending Down Icon --}}
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18">
                                    </path>
                                </svg>
                            @endif
                            <span class="text-sm font-medium ml-1">{{ $stat['change'] }}</span>
                            <span class="text-xs text-gray-600 ml-1">from last month</span>
                        </div>
                    </div>
                    <div class="w-12 h-12 {{ $stat['color'] }} rounded-lg flex items-center justify-center">
                        {{-- Icon --}}
                        {!! $iconSvgs[$stat['icon']] ?? '' !!}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Content Grid --}}
    <div class="grid lg:grid-cols-3 gap-8">
        {{-- Recent Activities --}}
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Activities</h3>
                    <button
                        class="text-[var(--color-primary)] hover:text-[var(--color-primary-hover)] text-sm font-medium">
                        View All
                    </button>
                </div>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @foreach ($recentActivities as $activity)
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center">
                                {{-- Activity Icon --}}
                                <x-bi-activity class="text-[var(--color-primary)] w-6 h-6" />
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900">
                                    {{ $activity['action'] }}
                                </p>
                                <p class="text-xs text-gray-600">
                                    by {{ $activity['user'] }} • {{ $activity['time'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <x-core.button primary="true"> Add New User </x-core.button>
                <x-core.button primary="true">
                    Create Article
                </x-core.button>
                <x-core.button primary="true">
                    Add Package
                </x-core.button>
                <x-core.button primary="true">
                    Upload Image
                </x-core.button>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="grid lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">User Growth</h3>
            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                <p class="text-gray-500">Chart placeholder - User growth over time</p>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Package Performance</h3>
            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                <p class="text-gray-500">Chart placeholder - Package booking trends</p>
            </div>
        </div>
    </div>
</div>
