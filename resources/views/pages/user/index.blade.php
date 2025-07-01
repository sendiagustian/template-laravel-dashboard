<div>
    <x-core.table :columns="[
        ['field' => 'id', 'label' => 'ID'],
        ['field' => 'username', 'label' => 'Username'],
        ['field' => 'role', 'label' => 'Role'],
        ['field' => 'name', 'label' => 'Name'],
        ['field' => 'email', 'label' => 'Email'],
    ]" :datas="$users" :search="true" :filterOptions="['active' => 'Active', 'inactive' => 'Inactive']" :filterLabel="'All Status'" />
</div>
