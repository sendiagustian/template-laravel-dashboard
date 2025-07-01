<div>
    <div class="min-h-screen flex flex-col md:flex-row">

        <!-- Bagian Kiri: Form Login -->
        <div class="w-full md:w-1/2 flex flex-col justify-center items-center p-8 md:p-12 lg:p-24 order-2 md:order-1">
            <div class="w-full max-w-md">
                <h1 class="text-3xl font-bold mb-8 text-gray-900">Welcome back</h1>

                <form wire:submit="login">
                    <!-- Input Email -->
                    <x-core.input-field wire:model="form.email" type="email" name="email" id="email" label="Email"
                        placeholder="Email" required="true" class="mb-4" />

                    <!-- Input Password -->
                    <x-core.input-field wire:model="form.password" type="password" name="password" id="password"
                        label="Password" placeholder="Password" required="true" class="mb-4" />

                    <!-- Tombol Sign In -->
                    <div>
                        <x-core.button primary="true" type="submit">
                            SIGN IN
                        </x-core.button>
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
