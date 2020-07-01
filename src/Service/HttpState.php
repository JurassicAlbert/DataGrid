<?php 

namespace App\Service;

use App\Controller\StateController;

final class HttpState extends StateController
{
    public static function create()
    {
        $page = 1;
        $orderBy = ""; 
        $rows = $maxRows = 9;
        $orderASC = 0;
        $orderDESC = 0;
        if (isset($_GET['page']))
        {
            $page = $_GET['page'];
        }
        if (
            isset($_GET['rows'])
            && intval($_GET['rows']) <= $maxRows
            )
        {
            $rows = intval($_GET['rows']);
        }
        if (isset($_GET['order']))
        {
            $orderDESC = 0;
            $orderASC = 1;
            $orderBy = strval($_GET['order']);
            if(isset($_GET['orderDESC'])) {
                $orderDESC = 1;
                $orderASC = 1;
            }
            if(isset($_GET['orderReset'])) {
                $orderDESC = 0;
                $orderASC = 0;
            }
        }
        return new StateController($page, $orderBy, $orderASC, $orderDESC, $rows);
    }
}