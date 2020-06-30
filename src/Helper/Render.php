<?php 

declare(strict_types=1);

namespace App\Helper;
use App\Schema\{
    State,
    Config,
    DataGrid
};

trait Render
{
    private $config;
    private $gridEl = 0;

    public function withConfig(Config $config): DataGrid
    {
        $this->config = $config;
        return $this;
    }

    public function render(array $rows, State $state): void
    {
        $columnSet = $this->config->getColumns();
        $currPage = $state->getCurrentPage();
        $rowsPerPage = $state->getRowsPerPage();
        if($rowsPerPage <= 0) {
            $rowsPerPage = 1;
        }
        $renderRows = $rowsPerPage*$currPage;
        $count = count($rows);
        $orderBy = $state->getOrderBy();
        $orderType = $state->isOrderASC() + $state->isOrderDesc();
        $this->configPage($columnSet, $rows, $rowsPerPage, $currPage, $count, $renderRows, $orderBy, $orderType);
    }

    private function configPage($columnSet, $rows, $rowsPerPage, $currPage, $count, $renderRows, $orderBy, $orderType)
    {
        if ($renderRows > $count) 
        {
            $renderRows = $count;
        }
        if ($currPage > 1) 
        {
            $this->gridEl = ($renderRows-$rowsPerPage);
        }
        $pages = ceil($count/$rowsPerPage);
        $this->prependRender($columnSet, $rows, $this->gridEl, $renderRows, $currPage, $pages, $rowsPerPage, $orderBy, $orderType);
    }
}