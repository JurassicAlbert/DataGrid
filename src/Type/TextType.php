<?php 

declare(strict_types=1);

namespace App\Type;

use App\Schema\DataType;

class TextType implements DataType 
{

    public function format(string $value): string
    {
        if (is_string(gettype($value))) {
            $value = filter_var($value, FILTER_SANITIZE_STRING);
            return $value;
        }
        return $value= "⚠";
    }
}

