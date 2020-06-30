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
        var_dump($rowsPerPage);
        $renderRows = $rowsPerPage*$currPage;
        var_dump($rowsPerPage);
        $count = count($rows);
        $orderBy = $state->getOrderBy();
        $orderType = $state->isOrderASC() + $state->isOrderDesc();
        $config = $this->configPage($columnSet, $rows, $rowsPerPage, $currPage, $count, $renderRows, $orderBy, $orderType);
        $this->prependRender(...$config);
    }

    private function configPage($columnSet, $rows, $rowsPerPage, $currPage, $count, $renderRows, $orderBy, $orderType)
    {
        if ($renderRows > $count) 
        {
            $renderRows = $count;
        }
        $pages = ceil($count/$rowsPerPage);
        $gridEl = ($renderRows - $rowsPerPage);
        $args = [$columnSet, $rows, $gridEl, $renderRows, $currPage, $pages, $rowsPerPage, $orderBy, $orderType];
        return $args;
    }
}