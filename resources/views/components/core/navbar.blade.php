<div>
    {{-- Top Bar --}}
    <div class="bg-[var(--color-primary-hover)] text-white py-2 text-sm">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1">
                    {{-- Replace with your icon component --}}
                    <x-bi-phone-fill class="w-4 h-4" />
                    <span>+62-21-12345678</span>
                </div>
                <div class="flex items-center space-x-1">
                    <x-bi-mailbox2-flag class="w-4 h-4" />
                    <span>info@hajjumrahtravel.com</span>
                </div>
            </div>
            <x-core.link href="{{ route('admin.dashboard') }}"
                class="bg-primary hover:bg-[#31a081] hover:text-white px-3 py-1 rounded text-xs transition-colors">
                Dashboard
            </x-core.link>
        </div>
    </div>

    {{-- Main Navbar --}}
    <nav class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                {{-- Logo --}}
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">H</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-[color:var(--color-primary)]">Hijrah Travel</h1>
                        <p class="text-xs text-gray-600">Haji & Umrah Terpercaya</p>
                    </div>
                </div>

                {{-- Desktop Navigation --}}
                <div class="hidden md:flex space-x-8">
                    <x-core.link href="#">
                        Home
                    </x-core.link>
                    <x-core.link href="#">
                        Home
                    </x-core.link>
                    <x-core.link href="#">
                        Home
                    </x-core.link>
                    <x-core.link href="#">
                        Home
                    </x-core.link>
                </div>

                {{-- CTA Button --}}
                <div class="hidden md:block">
                    <x-core.button primary="true" type="button"> Daftar Sekarang </x-core.button>
                </div>

                {{-- Mobile Menu Button --}}
                {{-- <button class="md:hidden" wire:click="toggleMobileMenu">
                    @if ($isMobileMenuOpen)
                        <x-icons.x class="w-6 h-6" />
                    @else
                        <x-icons.menu class="w-6 h-6" />
                    @endif
                </button> --}}
            </div>
        </div>

        {{-- Mobile Menu --}}
        {{-- @if ($isMobileMenuOpen)
            <div class="md:hidden bg-white border-t">
                <div class="container mx-auto px-4 py-4 space-y-4">
                    @foreach ($navItems as $item)
                        <button wire:click="mobileNavigate('{{ $item['id'] }}')"
                            class="block w-full text-left py-2 font-medium transition-colors {{ $currentPage === $item['id'] ? 'text-emerald-600' : 'text-gray-700' }}">
                            {{ $item['label'] }}
                        </button>
                    @endforeach
                    <button
                        class="w-full bg-primary hover:bg-primary-hover text-white py-2 rounded-lg font-medium transition-colors">
                        Daftar Sekarang
                    </button>
                </div>
            </div>
        @endif --}}
    </nav>
</div>
