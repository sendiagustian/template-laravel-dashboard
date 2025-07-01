<div>
    <x-core.table :columns="[
        ['field' => 'id', 'label' => 'ID'],
        ['field' => 'name', 'label' => 'Name'],
        ['field' => 'description', 'label' => 'Description'],
    ]" :datas="$roleItems" :search="true" :filterOptions="['active' => 'Active', 'inactive' => 'Inactive']" :filterLabel="'All Status'" />
</div>
