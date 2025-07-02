<div x-data="{
    isLoading: false,
    submitForm() {
        this.isLoading = true;
        $wire.login().then(() => {
            this.isLoading = false;
        });
    }
}">
    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Bagian Kiri: Form Login -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 md:p-12 lg:p-24 order-2 md:order-1">
            <div class="w-full max-w-md">
                <h1 class="text-3xl font-bold mb-8 text-gray-900">Welcome back</h1>

                <form @submit.prevent="submitForm">
                    <!-- Input Email -->
                    <x-core.input-field x-ref="email" wire:model.defer="form.email" type="email" name="email"
                        id="email" label="Email" placeholder="Email" required="true" class="mb-1" />

                    <!-- Input Password -->
                    <x-core.input-field x-ref="password" wire:model.defer="form.password" type="password"
                        name="password" id="password" label="Password" placeholder="Password" required="true"
                        class="mb-1" />

                    <!-- Tombol Sign In -->
                    <div>
                        @if ($errors->any())
                            <div class="mt-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <template x-if="isLoading">
                            <x-core.button primary="true" type="button" class="w-full flex justify-center items-center"
                                disabled>
                                <div class="animate-spin rounded-full size-4 border-b-2 border-white mr-2"></div>
                                Processing...
                            </x-core.button>
                        </template>
                        <template x-if="!isLoading">
                            <x-core.button primary="true" type="submit" class="w-full">
                                Sign In
                            </x-core.button>
                        </template>
                    </div>
                </form>
            </div>
        </div>

        <!-- Bagian Kanan: Gambar -->
        <div class="w-full md:w-1/2 order-1 md:order-2 h-64 md:h-auto">
            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?q=80&w=2071&auto=format&fit=crop"
                alt="Gambar interior ruangan yang terang dengan tirai dan tanaman kering di dalam vas"
                class="w-full h-full object-cover">
        </div>
    </div>
</div>
