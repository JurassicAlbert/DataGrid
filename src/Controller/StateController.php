<?php 

declare(strict_types=1);

namespace App\Controller;

use State;

class StateController implements State
{
    private int $currentPage;
    private string $orderBy;
    private bool $orderType;
    private int $rows;

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function isOrderDesc(): bool
    {
        return ! $this->orderType;
    }

    public function isOrderAsc(): bool
    {
        return $this->orderType;
    }

    public function getRowsPerPage(): int
    {
        return $this->rows;
    }
}