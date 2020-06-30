<?php 

declare(strict_types=1);

namespace App\Controller;

use App\Schema\DataGrid;
use App\Helper\Render;

class DataGridController implements DataGrid
{
    use Render;
    
    private function prependRender($columnSet, $rows, $gridEl, $renderRows): void
    {
        foreach ($columnSet as $column) 
        {
           $renderHeaders[] = $column->getLabel();
        }
        for ($i = $gridEl; $i < $renderRows; $i++)
        {
            foreach ($columnSet as $column)
            {
               $renderBody[$i] =  $rows[$i][$column->getLabel()];
            }
        }
    }
    
}