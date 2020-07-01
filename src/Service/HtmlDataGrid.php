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
        foreach ($columnSet as $column) {
            $label = $column->getLabel();
            $renderHeaders[] = $label;
            $labelType[$label] = $column->getDataType();
            if ($column->getAlign()) {
                $labelAlign[$label] = $column->getAlign();
            }
        }

        for ($i = $gridEl; $i < $renderRows; $i++) {
            foreach ($renderHeaders as $label) {
                $formatColumn = $labelType[$label];
                if (isset(($rows[$i][$label]))) {
                    $renderBody[$i][$label] = $formatColumn->format((string) $rows[$i][$label]);
                    preg_replace('/\s/u', '&nbsp;', $renderBody[$i][$label]);
                } else {
                    $renderBody[$i][$label] = "⚠";
                }
            }
        }
        foreach ($renderBody as $body) {
            $this->htmlBody .= "<tr>";
            foreach ($renderHeaders as $label) {
                $this->htmlBody .= "<td class='text-".$labelAlign[$label]."'>".$body[$label]."</td>";
            }
            $this->htmlBody .= "</tr>";
        }
        foreach ($renderHeaders as $th) {
            $this->htmlHead .= "" .
                "<th class='text-".$labelAlign[$th]."'><input class='btn btn-link border-0 p-0' type='submit' name='order' id='order' value='" . $th . "'>";
            if ($th == $sortKey) {
                if ($orderType == 1) {
                    $this->htmlHead .= " <i class='fa fa-arrow-up'></i>" .
                        "<input type='hidden' name='orderDESC' id='orderDESC' value='1'>";
                }
                if ($orderType == 2) {
                    $this->htmlHead .= " <i class='fa fa-arrow-down'></input>" .
                        "<input type='hidden' name='orderReset' id='orderReset' value='1'>";
                }
                $this->order = $orderType;
            }
            $this->htmlHead .= "</th>";
        }
         if ($this->sortKey) {
            usort($renderBody, function ($a, $b) {
                if (is_numeric($a[$this->sortKey])) {
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
        $pagInput = "<input type='checkbox' class='invisible p-0 m-0' name='page' id='page' value='" . $currPage . "' checked>";
        for ($n = 1; $n <= $pages; $n++) {
            if ($n == $currPage) {
                $cActive = 'active';
            }
            $pagInput .= "<li class='page-item " . $cActive . "'>" .
                "<input type='submit' name='page' class='page-link' value='" . $n . "'>" .
                "</li>";
            $cActive = '';
        }
        $rows = "<input id='rows' name='rows' type='number' max='9' min='1' value='" . $rowsPerPage . "'>";
        $_SESSION['order'] = $this->order;
        $_SESSION['tableHead'] = $this->htmlHead;
        $_SESSION['tableBody'] = $this->htmlBody;
        $_SESSION['tablePagination'] = $pagInput;
        $_SESSION['rows'] = $rows;
        header("Location: views/base");
    }
/* 
    private function createHtmlBody(array $rows, array $label, array $keys, ?int $sorted = 0, int $gridEl, int $renderRows)
    {
        if ($sorted == true) {
            $trTag['open'] = "<tr>";
            $trTag['close'] = "</tr>";
            $tdTag['open'] = "<td>";
            $tdTag['close'] = "</td>";
        }
        for ($i = $gridEl; $i < $renderRows; $i++) {
            $this->htmlBody .= $trTag['open']."error";
            foreach ($keys as $key) {
                $formatColumn = $label[$key];
                if (isset(($rows[$i][$key]))) {
                    $render[$i][$key] = $formatColumn->format((string) $rows[$i][$key]);
                    preg_replace('/\s/u', '&nbsp;', $render[$i][$key]);
                } else {
                    $render[$i][$key] = "⚠";
                }
                $this->htmlBody .= $tdTag['open'] . $render[$i][$key] . $tdTag['close'];
            }
            $this->htmlBody .= $trTag['closed'];
        }
        if ($sorted == 0) {
            if($this->sortKey) {
                usort($render, function ($a, $b) {
                    if (is_numeric($a[$this->sortKey])) {
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
           
            $sorted = 1;
            $this->createHtmlBody($rows, $label, $keys, $sorted, $gridEl, $renderRows);
        }
    } */
}