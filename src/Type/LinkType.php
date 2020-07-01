<?php

declare(strict_types=1);

namespace App\Type;

use App\Schema\DataType as DataTypeFormatter;

class LinkType implements DataTypeFormatter
{
    private $linkTag;
    private $color;
    private $availableColors = [
        "primary",
        "warning",
        "danger",
        "success",
        "info"
    ];
    private $link;

    public function format(string $value): string
    {
        if (in_array($this->color, $this->availableColors) == false) {
            return $value = "⚠";
        }
        $value = filter_var($value, FILTER_SANITIZE_URL);
        if ($this->linkTag) {
            $value = '<button onclick="window.location.href=' . $value . '" class="btn btn-' . $this->color . '" >link</button>';
        } else {
            $value = '<a href="' . $value . '" class="link text-' . $this->color . '">link</a>';
        }
        return $value;
    }

    public function __construct(
        ?bool $linkTag = 0,
        ?string $color = "primary"
    ) {

        $this->linkTag = $linkTag;
        $this->color = $color;
    }
}
