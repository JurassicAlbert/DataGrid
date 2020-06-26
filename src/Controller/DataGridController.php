<?php 

declare(strict_types=1);

namespace App\Controller;

use DataGrid;
use Config;
use State;

class DataGridController implements DataGrid
{
    private $config;
    private array $gridRender;

    public function withConfig(Config $config): DataGrid
    {
        $this->config = $config;
        return $this;
    }

    public function render(array $rows, State $state): void
    {
        $prepareRows = $this->sortData($rows, $state);
        $pageSize = $state->getRowsPerPage();
        $this->gridRender = $this->prepareRender($prepareRows, $pageSize);
    }

    private function sortData($array, $state): array
    {
        $sortKey = $state->getOrderBy();
        $array = array_column($array, $sortKey);
        $sortMode = $state->isOrderDesc();
        $sortMode ? rsort($array) : natsort($array);
        return $array;
    }

    private function prepareRender($array, $pageSize): array
    {
        $pages = [];
        $n = $i = 0;
        foreach ($array as $row)
        {
            $pages[$n] = array_push($pagesToRender, $row);
            if ($pageSize = $i) 
            {
                $i = 0;
                $n++;
            }
            $i++;
        }
        return $pages;
    }
    
}