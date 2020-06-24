<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class RawType implements DataType {
    
    private string $rawInformation;

    public function format(string $value): string
    {
        return $value;
    }

    public function __construct(string $rawInformation)
    {
        $this->$rawInformation = $rawInformation;
    }

    public function displayInformation($rawInformation): string
    {
        return print(htmlspecialchars($rawInformation));
    }
}