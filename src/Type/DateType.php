<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class DateType implements DataType
{
    
    private string $date;
    private string $dateFormat;

    public function format(string $value): string
    {
        return $value;
    }

    public function __construct(string $date, string $dateFormat)
    {
        $this->dateTime = date_format($date, $dateFormat);
    }
}

