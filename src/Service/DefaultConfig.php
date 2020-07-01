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
    MoneyType
};

final class DefaultConfig extends Config
{
    public function addIntColumn(
        string $key,
        ?string $align = null,
        ...$args
    ): self {
        $numberType = new NumberType(...$args);
        $numberColumn = (new Column($align))
            ->withDataType($numberType);
        parent::addColumn($key, $numberColumn);
        return $this;
    }

    public function addTextColumn(
    string $key,
    ?string $align = null
    ): self {
        $textType = new TextType;
        $textColumn = (new Column($align))
            ->withDataType($textType);
        parent::addColumn($key, $textColumn);
        return $this;
    }

    public function addCurrencyColumn(
        string $key,
        string $currency,
        ?string $align = null,
        ...$args
    ): self {
        $currencyType = new MoneyType($currency, ...$args);
        $currencyColumn = (new Column($align))
            ->withDataType($currencyType);
        parent::addColumn($key, $currencyColumn);
        return $this;
    }

    public function addLinkColumn(
        string $key,
        ?string $align,
        ...$args
        ): self {
        $linkType = new MoneyType(...$args);
        $linkColumn = (new Column($align))
            ->withDataType($linkType);
        parent::addColumn($key, $linkColumn);
        return $this;
    }
}
