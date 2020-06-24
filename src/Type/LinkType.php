<?php 

declare(strict_types=1);

namespace App\Type;

use DataType;

class LinkType implements DataType {
    
    private bool $linkTag;
    private string $bootstrapClass;
    private string $link;
    private string $linkText;

    public function format(string $value): string
    {
        return $value;
    }

    public function __construct(bool $linkTag, ?string $bootstrapClass, string $link, string $linkText)
    {
        $this->$link = '<a href="'.$link.'" class="'.$bootstrapClass.'"></a>';
        if ($linkTag) {
            $this->$link = '<button onclick="window.location.href='.$link.'">'.$linkText.'</button>';
        }
    }

    public function addLink(): string
    {
        $link = $this->link;
        return print($link);
    }
}