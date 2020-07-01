<?php

declare(strict_types=1);

namespace App\Type;

use App\Schema\DataType as DataTypeFormatter;

class DataTimeType implements DataTypeFormatter
{

    private $formatDays;
    private $formatHours;

    public function format(string $value): string
    {
        $date = new DateTime();
        if (
            is_a($value, $date) == false
            || $this->formatDays < 1
            || $this->formatDays > 7
            || $this->formatHours > 4
        ) {
            return "⚠";
        }
        if ($this->formatDays == 1) {
            $this->formatDays = "Ymd";
        }
        if ($this->formatDays == 2) {
            $this->formatDays = "m.d.y";
        }
        if ($this->formatDays == 3) {
            $this->formatDays = "j, n, Y";
        }
        if ($this->formatDays == 4) {
            $this->formatDays = '\i\t \i\s \t\h\e jS \d\a\y';
        } 
        if ($this->formatDays == 5) {
            $this->formatDays = "D M j T Y";
        }
        if ($this->formatDays == 6) {
            $this->formatDays = "F j, Y, ";
        } 
        if ($this->formatDays == 7) {
            $this->formatDays = "Y-m-d";
        }
        if ($this->formatHours == 1) {
            $this->formatHours = "H:i:s";
        }
        if ($this->formatHours == 2) {
            $this->formatHours = "G:i:s";
        }
        if ($this->formatHours == 3) {
            $this->formatHours = "g:i a";
        }
        if ($this->formatHours == 4) {
            $this->formatHours = "H-I-S";
        }
        $format = $this->formatDays." ".$this->formatHours;
        $value = $date->format($this->format);
        return $value;
    }

    public function __construct(?string $formatDays = 1, ?string $formatHours = 0)
    {
        $this->formatDays = $formatDays;
        $this->formatHours = $formatHours;
    }
}