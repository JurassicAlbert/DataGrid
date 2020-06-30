<?php 

declare(strict_types=1);

namespace App\Type;

use App\Schema\DataType as DataTypeFormatter;

class RawType implements DataTypeFormatter 
{
    public function format(string $value): string 
    {
            return $value;
    }
}