<?php

declare(strict_types=1);

Namespace App\Schema;

interface Config
{
    /**
     * Dodaje nową kolumną do DataGrid.
     */
    public function addColumn(string $key, Column $column): Config;

    /**
     * Zwraca wszystkie kolumny dla danego DataGrid.
     */
    public function getColumns(): array;
}