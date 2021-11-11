<?php

namespace App\Interfaces\Services\Default;

interface IDirectoryService extends \App\Interfaces\Services\IService {
    public function create(int $account_id, ?string $name): void;
    public function getList(int $account_id): array;
}