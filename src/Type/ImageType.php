<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class ImageType implements DataType {
    
    private string $imgUrl;
    private string $sizeX = "16px";
    private string $sizeY = "16px";
    private string $image;

    public function format(string $value): string
    {
        return $value;
    }

    public function __construct(string $imgUrl, string $sizeX, string $sizeY, string $image)
    {
        $this->sizeX = $sizeX;
        $this->sizeY = $sizeY;
        $this->imgUrl = $imgUrl;
        $insertImg = '<img src="'.$imgUrl.'" width="'.$sizeX.'" height="'.$sizeY.'">';
        $this->$image = $insertImg;
    }

    public function addImage(): string
    {
        $image = $this->image;
        return print($image);
    }
}

