<?php

declare(strict_types=1);

namespace App\Type;

use App\Schema\DataType as DataTypeFormatter;

class DataTimeType implements DataTypeFormatter
{

    private $format;

    public function format(string $value): string
    {
        $date = new DateTime();
        $value = "⚠";
        if (
            is_a($value, $date) == false
            || $this->format <= 0
            || $this->format > 10
        ) {
            return $value;
        }
        if ($this->format == 1) {
            $this->format = "Ymd";
        }
        if ($this->format == 2) {
            $this->format = "m.d.y";
        }
        if ($this->format == 3) {
            $this->format = "j, n, Y";
        }
        if ($this->format == 4) {
            $this->format = "H:i:s";
        }
        if ($this->format == 5) {
            $this->format = '\i\t \i\s \t\h\e jS \d\a\y.';
        }
        if ($this->format == 6) {
            $this->format = "H:i:s";
        }
        if ($this->format == 7) {
            $this->format = "Y-m-d H:i:s";
        }
        if ($this->format == 8) {
            $this->format = "D M j G:i:s T Y";
        }
        if ($this->format == 9) {
            $this->format = 'H:m:s \m \i\s\ \m\o\n\t\h';
        }
        if ($this->format == 10) {
            $this->format = "F j, Y, g:i a";
        }
        $value = $date->format($this->format);
        return $value;
    }

    public function __construct(?int $format = 1)
    {
        $this->format = $format;
    }
}