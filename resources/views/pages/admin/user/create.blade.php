<div class="p-6 bg-white rounded shadow" x-data="{
    isLoading: false,
    submitForm() {
        this.isLoading = true;
        $wire.save().then(() => {
            this.isLoading = false;
        });
    }
}">

    {{-- Create User Form --}}
    <h2 class="text-2xl font-bold mb-6">Create User</h2>
    <form @submit.prevent="submitForm">
        <div class="grid grid-cols-1 md:grid-cols-1">
            <x-core.input-field x-ref="name" wire:model="form.name" type="text" name="name" id="name"
                label="Full Name" placeholder="Full Name" required="true" class="mb-2" />

            <x-core.input-field x-ref="username" wire:model="form.username" type="text" name="username"
                id="username" label="Username" placeholder="Username" required="true" class="mb-2" />

            <x-core.input-field x-ref="email" wire:model="form.email" type="email" name="email" id="email"
                label="Email" placeholder="Email" required="true" class="mb-2" />

            <x-core.input-select label="Role" name="role" :options="$roles->map(fn($role) => ['value' => $role->id, 'label' => $role->name])->toArray()" model="form.role" required="true"
                placeholder="Select Role" />

            <x-core.input-field x-ref="password" wire:model="form.password" type="password" name="password"
                id="password" label="Password" placeholder="Password" required="true" minlength="8" class="mb-2" />

            <x-core.input-field x-ref="password_confirmation" wire:model="form.password_confirmation" type="password"
                name="password_confirmation" id="password_confirmation" label="Confirm Password"
                placeholder="Confirm Password" required="true" minlength="8" />

            <!-- Password Requirements -->
            <div class="text-sm text-gray-600 bg-gray-50 rounded">
                <p class="font-medium mb-2">Password requirements:</p>
                <ul class="list-disc list-inside space-y-1">
                    <li>Minimum 8 characters</li>
                    <li>At least one uppercase letter</li>
                    <li>At least one lowercase letter</li>
                    <li>At least one number</li>
                    <li>At least one special character (!@#$%^&*)</li>
                </ul>
            </div>
        </div>

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
                <x-core.button disabled="true" type="button" class="mt-4 flex justify-center items-center">
                    <div class="animate-spin rounded-full size-4 border-b-2 border-white mr-2"></div>
                    Processing...
                </x-core.button>
            </template>
            <template x-if="!isLoading">
                <x-core.button primary="true" type="submit" class="mt-4">
                    Create User
                </x-core.button>
            </template>
        </div>
    </form>
</div>
