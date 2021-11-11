<?php

namespace App\Repositories\QueryBuilder;

use Illuminate\Support\Facades\DB;

class Repository
{
    use \App\Repositories\TRepository;

    public function store(array $info): int {
        $info = $this->addCreatedAt($info);

        $id = DB::table($this->table)->insertGetId($info);

        $this->checkStoreResult($id);

        return $id;
    }

    public function find(int | null | array $queries, int $v = 0): ?array {
        if(!is_array($queries)) {
            $entity = DB::table($this->table)->find($queries);
            if(!$entity) {
                return null;
            }

            return json_decode(json_encode($entity), true);
        } else {
            $id_list = $this->getIdList($queries);
            if(!$id_list) {
                return null;
            }

            return $this->find($id_list[0]);
        }
    }

    public function findOrFail(int | null | array $queries): array {
        return [];
    }

    public function getId(int | null | array $queries): ?int {
        if(!$queries) {
            return null;
        }

        if(!is_array($queries)) {
            $exist = DB::table($this->table)->where('id', $queries)->exists();
            return $exist ? $queries : null;
        }

        $id_list = $this->getIdList($queries);
        return $id_list ? $id_list[0] : null;
    }

    public function getIdOrFail(int | null | array $queries): int {
        return 1;
    }

    public function all(array $queries = [], int $v = 0): array {
        return [];
    }

    public function getIdList(array $queries = [], ?string $order = null): array {
        $query = DB::table($this->table);
        foreach ($queries as $key => $value) {
            $query = $query->where($key, $value);
        }

        $order = $order ? strtolower($order) : 'asc';
        $id_list = $query->orderBy('id', $order)->pluck('id')->values()->all();
        return $id_list;
    }

    public function update(int $id, array $info): int {
        return 1;
    }

    public function destroy(int | null $id): int {
        return 1;
    }

    public function checkExist(int | null $id): void {

    }

    public function isExist(int | null $id): bool {
        return false;
    }

    public function checkNotExist(int | null $id): void {

    }

    public function beginTransaction(): void {

    }

    public function commit(): void {

    }

}
