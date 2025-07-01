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
    public array $filterOptions;
    public string $filterLabel;

    public int $currentPage;
    public int $perPage;
    public int $total;

    public function getPaginatedData(): array
    {
        $offset = ($this->currentPage - 1) * $this->perPage;
        return array_slice($this->datas, $offset, $this->perPage);
    }

    public function __construct(
        array $columns,
        array $datas,
        bool $search,
        array $filterOptions,
        string $filterLabel,
        int $currentPage = 1,
        int $perPage = 10,
        int $total = 0
    ) {
        $this->columns = $columns;
        $this->datas = $datas;
        $this->search = $search;
        $this->filterOptions = $filterOptions;
        $this->filterLabel = $filterLabel;
        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->total = $total;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.core.table');
    }
}
