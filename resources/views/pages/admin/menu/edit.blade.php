<div class="p-6 bg-white rounded shadow" x-data="{
    isLoading: false,
    submitForm() {
        this.isLoading = true;
        $wire.edit().then(() => {
            this.isLoading = false;
        });
    }
}">

    {{-- Edit Menu Form --}}
    <h2 class="text-2xl font-bold mb-6">Edit Menu</h2>
    <form @submit.prevent="submitForm">
        <div class="grid grid-cols-1 md:grid-cols-1">
            <x-core.input-field x-ref="name" wire:model="form.name" type="text" name="name" id="name"
                label="Menu Name" placeholder="Menu Name..." required="true" class="mb-2" />

            <x-core.input-field x-ref="url" wire:model="form.url" type="text" name="url" id="url"
                label="Menu URL" placeholder="Menu URL..." required="true" class="mb-2" />

            <x-core.input-field x-ref="icon" wire:model="form.icon" type="text" name="icon" id="icon"
                label="Menu Icon" placeholder="Menu Icon..." required="true" class="mb-2" />

            <x-core.input-field x-ref="parent_id" wire:model="form.parent_id" type="number" name="parent_id"
                id="parent_id" label="Menu Parent ID" placeholder="Menu Parent ID..." class="mb-2" />

            <x-core.input-field x-ref="order" wire:model="form.order" type="number" name="order" id="order"
                label="Menu Order" placeholder="Menu Order..." required="true" class="mb-2" />

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
                        Edit Menu
                    </x-core.button>
                </template>
            </div>
    </form>
</div>
