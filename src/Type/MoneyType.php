<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class MoneyType extends NumberType implements DataType  {

    private string $currency = "PLN";
    private string $decimalPoint = ",";
    private string $thousandsSeparator = "&nbsp;";
    private int $decimalsPrecision = 2;
    private bool $roundingDirection = 0;
    private bool $disablingPrecision = 0;
    private string $value;
    private float $number;

    public function format(string $value): string
    {
        return $value;
    }

    public function __construct(
        string $currency,
        string $decimalPoint,
        string $thousandsSeparator,
        int $decimalsPrecision,
        bool $roundingDirection,
        bool $disablingPrecision,
        float $number
        ) {

        $this->number = parent::__construct(
            $decimalPoint,
            $thousandsSeparator,
            $decimalsPrecision,
            $roundingDirection,
            $disablingPrecision,
            $number
        );
        $this->value=$number.$currency;
    }
}

