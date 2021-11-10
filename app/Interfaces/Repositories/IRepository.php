<?php

namespace App\Interfaces\Repositories;

interface IRepository {
    public function store(array $info): int;
    public function find(int | null | array $queries, int $v = 0): ?array;
    public function getId(int | null | array $queries): ?int;
    public function getIdOrFail(int | null | array $queries): int;
    public function all(array $queries = [], int $v = 0): array;
    public function getIdList(array $queries = [], ?string $order = null): array;
    public function update(int $id, array $info): int;
    public function destroy(int | null $id): int;
    public function checkExist(int | null $id): void;
    public function isExist(int | null $id): bool;
    public function checkNotExist(int | null $id): void;
    public function beginTransaction(): void;
    public function commit(): void;
}