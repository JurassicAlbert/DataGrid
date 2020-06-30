<?php 

declare(strict_types=1);

namespace App\Controller;

use App\Schema\State;

class StateController implements State
{
    public $currentPage;
    private $orderBy;
    private $orderASC;
    private $orderDESC;
    private $rows;

    public function __construct(int $currentPage, ?string $orderBy = null, bool $orderASC, bool $orderDESC, int $rows) {
        $this->currentPage = $currentPage;
        $this->orderBy = $orderBy;
        $this->orderASC = $orderASC;
        $this->orderDESC = $orderDESC;
        $this->rows = $rows;
    }

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
            return $this->orderDESC;
    }

    public function isOrderAsc(): bool
    {
            return $this->orderASC;
    }

    public function getRowsPerPage(): int
    {
        return $this->rows;
    }
}