<div>
    <x-core.table :columns="[
        ['field' => 'id', 'label' => 'ID'],
        ['field' => 'name', 'label' => 'Name'],
        ['field' => 'url', 'label' => 'URL'],
        ['field' => 'icon', 'label' => 'Icon'],
    ]" :datas="$menuItems" :search="true" :filterOptions="['active' => 'Active', 'inactive' => 'Inactive']" :filterLabel="'All Status'" />
</div>
