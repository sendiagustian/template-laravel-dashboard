<?php

namespace App\View\Components\Core;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public array $columns;
    public array $datas;
    public bool $search;
    // public bool $action;
    public array $filterOptions;
    public string $filterLabel;
    public int $currentPage;
    public int $perPage;
    public int $total;

    public function getPaginatedData($datas): array
    {
        $offset = ($this->currentPage - 1) * $this->perPage;
        return array_slice($datas, $offset, $this->perPage);
    }

    public function __construct(
        array $columns,
        array $datas,
        bool $search,
        array $filterOptions,
        string $filterLabel,
        // bool $action = false,
        int $perPage = 15
    ) {
        $this->columns = $columns;
        $this->search = $search;
        // $this->action = $action;
        $this->filterOptions = $filterOptions;
        $this->filterLabel = $filterLabel;
        $this->currentPage = (int) request()->query('page', 1);
        $this->perPage = $perPage;
        $this->total = $datas ? count($datas) : 0;
        $this->datas = $datas;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.table');
    }
}
