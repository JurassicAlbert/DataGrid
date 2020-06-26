<?php 

declare(strict_types=1);

namespace App\Service;

use App\Controller\DataGridController as DataGrid;

class HtmlDataGrid extends DataGrid
{

    public function render(): void
    {
       echo __CLASS__;
    }

    
}