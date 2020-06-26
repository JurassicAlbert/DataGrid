<?php 

declare(strict_types=1);

namespace App\Trait;

trait Currency
{

    private string $currency = "PLN";
    private string $value;

    public function format(string $value): string
    {
        parent::format();
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

