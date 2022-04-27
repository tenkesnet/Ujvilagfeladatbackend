<?php

namespace Bardo\Ujvilagbackend\Service;

interface Database
{
    public function existsTable(string $table): bool;
    public function existsRow(string $sql): bool;
    public function execute(string $sql): bool;
    public function query(string $sql): array;
}
