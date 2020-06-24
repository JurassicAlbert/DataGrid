<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class TextType implements DataType {

    private string $text;

    public function format(string $text): string
    {
        $this->$text = filter_var($text, FILTER_SANITIZE_STRING);
        return $this->$text;
    }
}

