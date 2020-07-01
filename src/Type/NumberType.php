<?php

declare(strict_types=1);

namespace App\Type;

use App\Schema\DataType as DataTypeFormatter;

class NumberType implements DataTypeFormatter
{
    private $decimalPoint;
    private $thousandsSeparator;
    private $decimalsPrecision;
    private $roundingDirection;
    private $disablingPrecision;

    public function format(string $value): string
    {
        //var_dump("VALUE: ".$value);
        if ((is_numeric($value) == false)) {
            return $value = "⚠";
        }
        if ($this->disablingPrecision) {
            $this->decimalsPrecision = 0;
        }
        if (
            $this->roundingDirection
            && is_numeric($this->roundingDirection)
        ) {
            $value = $this->roundNumber((float) $value, $this->decimalsPrecision, $this->roundingDirection);
        }
        //var_dump("VALUE2: ".$value);
        $value = number_format(
            (float) $value,
            $this->decimalsPrecision,
            $this->thousandsSeparator,
            $this->decimalPoint

        );
        return $value;
    }

    public function __construct(
        ?bool $disablingPrecision = null,
        ?int $roundingDirection = 0,
        ?int $decimalsPrecision = 2,
        ?string $thousandsSeparator = ",",
        ?string $decimalPoint = " "
    ) {
        $this->disablingPrecision = $disablingPrecision;
        $this->decimalPoint = $decimalPoint;
        $this->thousandsSeparator = $thousandsSeparator;
        $this->decimalsPrecision = $decimalsPrecision;
        $this->roundingDirection = $roundingDirection;
    }

    private function roundNumber(float $number, int $decimalsPrecision, int $roundingDirection): float
    {
        $mode = "PHP_ROUND_HALF_UP";
        if ($roundingDirection == 2) {
            $mode = "PHP_ROUND_HALF_DOWN";
        }
        if ($roundingDirection == 3) {
            $mode = "PHP_ROUND_HALF_EVEN";
        }
        if ($roundingDirection == 4) {
            $mode = "PHP_ROUND_HALF_ODD";
        }
        $number = round($number, $decimalsPrecision, $mode);
        return $number;
    }
}
