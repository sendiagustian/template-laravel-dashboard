<div class="p-6 bg-white rounded shadow" x-data="{
    isLoading: false,
    submitForm() {
        this.isLoading = true;
        $wire.save().then(() => {
            this.isLoading = false;
        });
    }
}">

    {{-- Create Role Form --}}
    <h2 class="text-2xl font-bold mb-6">Create Role</h2>
    <form @submit.prevent="submitForm">
        <div class="grid grid-cols-1 md:grid-cols-1">
            <x-core.input-field x-ref="name" wire:model="form.name" type="text" name="name" id="name"
                label="Role Name" placeholder="Role Name..." required="true" class="mb-2" />

            <x-core.input-field x-ref="description" wire:model="form.description" type="text" name="description"
                id="description" label="Role Description" placeholder="Role Description..." required="true"
                class="mb-2" />

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
                        Create Role
                    </x-core.button>
                </template>
            </div>
    </form>
</div>
