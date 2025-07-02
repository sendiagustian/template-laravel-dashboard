<div class="p-6 bg-white rounded shadow" x-data="{
    isLoading: false,
    submitForm() {
        console.log('Form submitted');
        this.isLoading = true;
        $wire.edit().then(() => {
            this.isLoading = false;
            console.log('Edit method executed successfully');
        });
    }
}">

    {{-- Edit User Form --}}
    <h2 class="text-2xl font-bold mb-6">Edit User</h2>
    <form @submit.prevent="submitForm">
        <div class="grid grid-cols-1 md:grid-cols-1">
            <x-core.input-field x-ref="name" wire:model="form.name" type="text" name="name" id="name"
                label="Full Name" placeholder="Full Name" required="true" class="mb-2" value="{{ $user->name }}" />

            <x-core.input-field x-ref="username" type="text" name="username" id="username" label="Username"
                placeholder="Username" required="true" class="mb-2" value="{{ $user->username }}" disabled="true" />

            <x-core.input-field x-ref="email" type="email" name="email" id="email" label="Email"
                placeholder="Email" required="true" class="mb-2" value="{{ $user->email }}" disabled="true" />

            <x-core.input-select label="Role" wire:model="form.role" name="role" :options="$roles->map(fn($role) => ['value' => $role->id, 'label' => $role->name])->toArray()"
                model="form.role" required="true" placeholder="Select Role" value="{{ $user->role }}" />

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
                    Update User
                </x-core.button>
            </template>
        </div>
    </form>
</div>
