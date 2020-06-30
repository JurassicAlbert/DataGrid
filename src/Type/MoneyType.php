<?php 

declare(strict_types=1);

namespace App\Type;

use App\Helper\Number;

use App\Schema\DataType as DataTypeFormatter;

class MoneyType implements DataTypeFormatter
{
    use Number;
}

