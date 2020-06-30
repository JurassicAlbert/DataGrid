<?php 

declare(strict_types=1);

namespace App\Service;

use App\Controller\DataGridController as DataGrid;
use App\Helper\Render;

final class HtmlDataGrid extends DataGrid
{
    private $htmlBody;
    private $htmlHead;
    private $sortKey;
    private $order;
    use Render;

    private function prependRender($columnSet, $rows, $gridEl, $renderRows, $currPage, $pages, $rowsPerPage, $sortKey, $orderType): void
    { 
        $this->sortKey = $sortKey;
        foreach ($columnSet as $column)
        {
            $label = $column->getLabel();
            $renderHeaders[] = $label;
        }
        for ($i = $gridEl; $i < $renderRows; $i++)
        {
            foreach ($columnSet as $column)
            {
                $label = $column->getLabel();
                $formatColumn = $column->getDataType();
                if (isset(($rows[$i][$label])))
                {
                    $renderBody[$i][$label] = $formatColumn->format((string) $rows[$i][$label]);
                    preg_replace('/\s/u', '&nbsp;', $renderBody[$i][$label]);
                }
            }
        }
        foreach ($renderHeaders as $th)
        {
            $this->htmlHead .= "".
            "<th><input class='btn btn-link border-0 p-0' type='submit' name='order' id='order' value='".$th."'>";
            if ($th == $sortKey)
            {
                if ($orderType == 1) {
                    $this->htmlHead .= " <i class='fa fa-arrow-up'></i>".
                    "<input type='hidden' name='orderDESC' id='orderDESC' value='1'>";
                }
                if ($orderType == 2) {
                    $this->htmlHead .= " <i class='fa fa-arrow-down'></input>".
                    "<input type='hidden' name='orderReset' id='orderReset' value='1'>";;
                }
                $this->order = $orderType;  
            }
            $this->htmlHead .= "</th>";
        }
        if($this->sortKey) {
            usort($renderBody, function($a, $b)
            {
                if(is_numeric($a[$this->sortKey])) {
                    if ($this->order == 1) {
                        return $a[$this->sortKey] > $b[$this->sortKey];
                    }
                    if ($this->order == 2) {
                        return $a[$this->sortKey] < $b[$this->sortKey];
                    }
                }
                if ($this->order == 1) {
                    return $a[$this->sortKey] < $b[$this->sortKey];
                }
                if ($this->order == 2) {
                    return $a[$this->sortKey] <=> $b[$this->sortKey];
                }
            });
        }
        foreach ($renderBody as $body) {
            $this->htmlBody .= "<tr>";
            foreach ($body as $b) {
                $this->htmlBody .= "<td>".$b."</td>";
            }
            $this->htmlBody .= "</tr>";
        }
        $pagInput =  '';
        for ($n = 1; $n <= $pages; $n++)
        {
            if($n == $currPage) {
                $cActive = 'active';
            }
            $pagInput .= "<li class='page-item ".$cActive."'>".
            "<input type='submit' name='pages[]' class='page-link' value='".$n."'>".
            "</li>";
            $cActive = '';
        }
        $rows = "<input id='rows' name='rows' type='number' max='9' min='1' value='".$rowsPerPage."'>";
        $_SESSION['tableHead'] = $this->htmlHead;
        $_SESSION['tableBody'] = $this->htmlBody;
        $_SESSION['tablePagination'] = $pagInput;
        $_SESSION['rows'] = $rows;
        header("Location: views/base");
        //print($this->html);
    }
}