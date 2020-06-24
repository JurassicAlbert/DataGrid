<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class DataTimeType implements DataType {
    
    private string $dateTime;
    private string $dateTimeFormat;

    public function format(string $value): string
    {
        return $value;
    }

    public function __construct(string $dateTime, string $dateTimeFormat)
    {
        $this->dateTime = date_format($dateTime, $dateTimeFormat);
    }
}

