<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class MoneyType extends NumberType implements DataType
{

    private string $currency = "PLN";
    private string $value;

    public function format(string $value): string
    {
        return $value;
    }

    public function __construct(NumberType $number, $currency)
    {
        $number = $number->getNumber();
        $number = strval($number);
        $this->value=$number.$currency;
    }

    /*
    public function __construct()
    {
        $this->value = __CLASS__.$currency;
    }
    */
}
