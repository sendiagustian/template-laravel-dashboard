<div>
    <div>
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Role Management</h1>
                <p class="text-gray-600 text-sm">Manage system roles and their permissions</p>
            </div>
            <a href="{{ route('admin.roles.create') }}"
                class="inline-flex items-center px-5 py-2 bg-primary hover:bg-primary-hover text-white rounded-lg font-medium transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Add New Role
            </a>
        </div>
    </div>

    <x-core.table :perPage="10" :columns="[
        ['field' => 'id', 'label' => 'ID'],
        ['field' => 'name', 'label' => 'Name'],
        ['field' => 'description', 'label' => 'Description'],
    ]" :datas="$roleItems" :search="false" :actions="['edit', 'delete']" />
</div>
