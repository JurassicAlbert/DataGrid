<?php

declare(strict_types=1);

namespace App\Controller;

use App\Schema\{
    Config,
    Column
};

class ConfigController implements Config
{
    private $key;
    private $alignColumn;
    private $columns = [];

    public function addColumn(string $key, Column $column): Config
    {
        $this->key = $key;
        $column
            ->withLabel($key)
            ->withAlign($this->alignColumn);
        $this->columns[] = $column;
        return $this;
    }

    public function getColumns(): array
    {
        return $this->columns;
    }

    public function __construct(?string $alignColumn = "center") 
    {
        $this->alignColumn = $alignColumn;
    }
}