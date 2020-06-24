<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class NumberType implements DataType {

    private string $decimalPoint = ",";
    private string $thousandsSeparator = "&nbsp;";
    private int $decimalsPrecision = 2;
    private bool $roundingDirection = 0;
    private bool $disablingPrecision = 0;
    private float $number;

    public function format(string $value): string
    {
        return $value;
    }

    public function __construct(
        string $decimalPoint,
        string $thousandsSeparator,
        int $decimalsPrecision,
        bool $roundingDirection,
        bool $disablingPrecision,
        float $number
        ) {
        if ($disablingPrecision) {
            $this->decimalsPrecision = 0;
        }
        if (
            $roundingDirection
            && is_numeric($roundingDirection)
            ) {
           $number = $this->roundNumber($number, $decimalsPrecision, $roundingDirection);
        } else {
            return "Error: Can't round number.";
        }
        $number = number_format(
            $number,
            $decimalsPrecision,
            $decimalPoint,
            $thousandsSeparator
        );
        $this->number = floatval($number);
    }

    private function roundNumber(float $number, int $decimalsPrecision, int $roundingDirection): float
    {
        $mode = "PHP_ROUND_HALF_UP";
        if($roundingDirection==2) {
           $mode = $mode="PHP_ROUND_HALF_DOWN";
        }
        if($roundingDirection==3) {
           $mode = $mode="PHP_ROUND_HALF_EVEN";
        }
        if($roundingDirection==4) {
           $mode = $mode="PHP_ROUND_HALF_ODD";
        }
        $number = round($number, $decimalsPrecision, $mode);
        return $number;
    }
}

