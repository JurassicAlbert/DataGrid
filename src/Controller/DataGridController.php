<?php 

declare(strict_types=1);

namespace App\Controller;

use App\Schema\DataGrid;
use App\Helper\Render;

abstract class DataGridController implements DataGrid
{
    use Render;
    
    private function prependRender($columnSet, $rows, $gridEl, $renderRows): void
    {
        $text = "";
        foreach ($columnSet as $column) 
        {
           $text .= $column->getLabel()."&nbsp;";
        }
        $text .= PHP_EOL;
        for ($i = $gridEl; $i < $renderRows; $i++)
        {
            foreach ($columnSet as $column)
            {
               $text .= $rows[$i][$column->getLabel()]." | ";
            }
            $text .= PHP_EOL;
        }
        echo nl2br($text);
    }
}