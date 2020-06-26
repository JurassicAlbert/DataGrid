<?php 

declare(strict_types=1);

namespace App\Service;

use App\Controller\StateController as State;

class HttpState extends State
{
    public static function create(State $state): State
    {
        return $state;
    }
}