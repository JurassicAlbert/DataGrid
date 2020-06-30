<?php 

declare(strict_types=1);

namespace App\Type;

use App\Schema\DataType as DataTypeFormatter;

class ImageType implements DataTypeFormatter
{   
    private $imgUrl;
    private $sizeX;
    private $sizeY;
    
    public function format(string $value): string
    {
        if (filter_var($value, FILTER_VALIDATE_URL) == false)
        {
            return $value = "⚠";
        }
        $value = $insertImg = '<img src="'.$value.'" width="'.$this->sizeX.'" height="'.$this->sizeY.'">';
        return $value;
    }

    public function __construct(
        ?string $imgUrl = "https://thaibah.com/dev/assets/img/default-img.jpg",
        ?string $sizeX = "16px",
        ?string $sizeY = "16px"
        ) {
        $this->imgUrl = $imgUrl;
        $this->sizeX = $sizeX;
        $this->sizeY = $sizeY;
    }
}

