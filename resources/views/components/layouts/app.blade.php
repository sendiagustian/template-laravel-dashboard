<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription ?? '' }}">
    <meta name="keywords" content="{{ $metaKeywords ?? '' }}">

    <title>{{ $title ?? 'Dashboard Template' }}</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/css/progress-bar.css') }}">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    <div class="flex h-screen bg-gray-50">
        {{-- SIDEBAR --}}
        <x-core.sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- DASHBOARD HEADER --}}
            {{-- <x-core.dashboard-header :title="$sectionTitle ?? ''"/> --}}
            <header class="h-[80px] px-6 py-4 bg-white shadow flex items-center justify-between">
                <x-core.breadcrumb />
            </header>

            {{-- MAIN CONTENT --}}
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-6">
                @if (isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </div>

    {{-- Alert Notification --}}
    @if (session('success') || session('error'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show" class="fixed top-6 right-6 z-50">
            @if (session('success'))
                <div class="bg-green-500 text-white px-6 py-4 rounded shadow flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @elseif(session('error'))
                <div class="bg-red-500 text-white px-6 py-4 rounded shadow flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif
        </div>
    @endif

    @livewireScripts
    @stack('scripts')
</body>

</html>
