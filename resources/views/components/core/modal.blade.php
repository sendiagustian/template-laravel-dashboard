<div class="fixed inset-0 flex items-center justify-center z-50 bg-gray/50">
    <div class="bg-white rounded-lg shadow-md w-full max-w-lg border border-gray-200">
        <div class="flex justify-between items-center border-b border-gray-200 px-6 py-4">
            <div class="flex items-stretch justify-between w-full">
                <h3 class="text-lg font-semibold">{{ $title ?? 'Modal Title' }}</h3>
                <x-antdesign-close-circle @click="showModal = false" class="cursor-pointer w-6 h-6 text-gray-600" />
            </div>
        </div>
        <div class="p-2">
            {{ $slot }}
        </div>
        @yield('actions')
    </div>
</div>
