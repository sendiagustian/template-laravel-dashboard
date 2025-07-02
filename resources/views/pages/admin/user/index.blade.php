<div class="p-6">
    {{-- HEADER --}}
    <div>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
                <p class="text-gray-600 text-sm">Manage system users and their permissions</p>
            </div>
            <x-core.link href="{{ route('admin.users.create') }}"
                class="inline-flex items-center px-5 py-2 bg-primary hover:bg-primary-hover text-white rounded-lg font-medium transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add New User
            </x-core.link>
        </div>
    </div>

    <x-core.table :columns="[
        ['field' => 'id', 'label' => 'ID'],
        ['field' => 'username', 'label' => 'Username'],
        ['field' => 'role', 'label' => 'Role'],
        ['field' => 'name', 'label' => 'Name'],
        ['field' => 'email', 'label' => 'Email'],
    ]" :datas="$users" :search="true" :actions="['edit', 'delete']" :isUserTable="true" />

</div>
