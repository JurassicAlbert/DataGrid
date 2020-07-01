<?php

declare(strict_types=1);

namespace App\Type;

use App\Type\DataTimeType;

class DataType extends DataTimeType
{
    private $format;

    public function __construct($format)
    {
        $this->format = $format;
        parent::__construct($format, null);
    }
}
