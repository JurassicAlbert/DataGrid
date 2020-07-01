<?php

declare(strict_types=1);

namespace App\Controller;

use App\Schema\{
    Column,
    DataType
};

class ColumnController implements Column
{
    private $label;
    private $type;
    private $align;

    public function withLabel(string $label): Column
    {
        $this->label = $label;
        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function withDataType(DataType $type): Column
    {
        $this->type = $type;
        return $this;
    }

    public function getDataType(): DataType
    {
        return $this->type;
    }

    public function withAlign(string $align): Column
    {
        $this->align = $align;
        return $this;
    }

    public function getAlign(): string
    {
        return $this->align;
    }
}