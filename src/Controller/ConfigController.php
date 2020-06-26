<?php 

declare(strict_types=1);

namespace App\Service;

use Config;
use Column;

class ConfigController implements Config, Column
{
    private string $key;
    private $columns;

    public function addColumn(string $key, Column $column): Config
    {
        $this->key = $key;
        $this->columns->add($column);
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }
}