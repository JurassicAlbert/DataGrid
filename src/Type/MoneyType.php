<?php

declare(strict_types=1);

namespace App\Type;

use App\Type\NumberType;


class MoneyType extends NumberType
{
    private $currency;
    private $supportedCurrency = ["PLN", "USD", "BHD"];

    public function format(string $value): string
    {
        $value = parent::format($value);
        if (in_array($this->currency, $this->supportedCurrency) == true) {
            $value .= " " . $this->currency;
        } else {
            $value = "⚠";
        }
        return $value;
    }

    public function __construct(?string $currency = "PLN", ...$numberArgs)
    {
        $this->currency = $currency;
        parent::__construct(...$numberArgs);
    }
}
