<?php

declare(strict_types=1);

namespace App\Service;

use App\Controller\{
    ConfigController as Config,
    ColumnController as Column
};
use App\Type\{
    NumberType,
    TextType,
    MoneyType,
    LinkType,
    RawType,
    ImageType
};

final class DefaultConfig extends Config
{
    public function addIntColumn(
        string $key,
        ?bool $disablePrecision = true,
        ...$args
    ): self {
        $numberType = new NumberType($disablePrecision, ...$args);
        $numberColumn = (new Column())
            ->withDataType($numberType);
        $this->addColumn($key, $numberColumn);
        return $this;
    }

    public function addFloatColumn(
        string $key,
        ...$args
    ): self {
        $numberType = new NumberType(...$args);
        $numberColumn = (new Column())
            ->withDataType($numberType);
        $this->addColumn($key, $numberColumn);
        return $this;
    }

    public function addCurrencyColumn(
        string $key,
        string $currency,
        ...$args
    ): self {
        $currencyType = new MoneyType($currency, ...$args);
        $currencyColumn = (new Column())
            ->withDataType($currencyType);
        $this->addColumn($key, $currencyColumn);
        return $this;
    }

    public function addTextColumn(string $key): self 
    {
        $textType = new TextType;
        $textColumn = (new Column())
            ->withDataType($textType);
        $this->addColumn($key, $textColumn);
        return $this;
    }

    public function addLinkColumn(
        string $key,
        ...$args
        ): self {
        $linkType = new LinkType(...$args);
        $linkColumn = (new Column())
            ->withDataType($linkType);
        $this->addColumn($key, $linkColumn);
        return $this;
    }

    public function addImageColumn(
        string $key,
        ...$args
        ): self {
        $imageType = new ImageType(...$args);
        $imageColumn = (new Column())
            ->withDataType($imageType);
        $this->addColumn($key, $imageColumn);
        return $this;
    }

    public function addRawColumn(
        string $key,
        ...$args
        ): self {
        $rawType = new RawType(...$args);
        $rawColumn = (new Column())
            ->withDataType($rawType);
        $this->addColumn($key, $rawColumn);
        return $this;
    }
}
