<?php

namespace App\Repositories\Redis;

use App\Services\MainService;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redis;

class Repository
{
    use \App\Repositories\TRepository;

    public function store(array $info): int {
        $info = $this->addCreatedAt($info);
        $info = $this->addId($info);

        //actual data
        Redis::HMSET(
            $this->table . '::id:' . $info['id'],
            $info
        );

        //for search
        foreach ($info as $key => $value) {
            Redis::ZADD($this->table . '_id_zset::' . $key . ':' . $value, $info['created_at'], $info['id']);
        }

        //keeps id list
        Redis::ZADD($this->table . '_id_zset', $info['created_at'], $info['id']);

        return $info['id'];
    }

    public function find(int | null | array $queries, int $v = 0): ?array {
        if (!is_array($queries)) {
            $entity = Redis::HGETALL($this->table . '::id:' . $queries);
            return $entity ?? null;
        } else {
            $id_list = $this->getIdList($queries);
            return $id_list ? $this->find($id_list[0]) : null;
        }
    }

    public function getId(int | null | array $queries): ?int {
        if(!$queries) {
            return null;
        }

        if(!is_array($queries)) {
            $exist = Redis::EXISTS($this->table . '::id:' . $queries);
            return $exist ? $queries : null;
        }

        $id_list = $this->getIdList($queries);
        return $id_list ? $id_list[0] : null;
    }

    public function all(array $queries = [], int $v = 0): array {
        $id_list = $this->getIdList($queries);
        
        $list = [];
        foreach ($id_list as $id) {
            array_push($list, $this->find($id));
        }

        return $list;
    }

    public function getIdList(array $queries = [], ?string $order = null): array {
        $order = $order ? strtolower($order) : 'asc';
        if($order == 'desc') {
            $id_list = Redis::ZREVRANGE($this->table . '_id_zset', 0, -1);
        } else {
            $id_list = Redis::ZRANGE($this->table . '_id_zset', 0, -1);
        }
        
        if(!$queries) {
            return $id_list;
        }

        $id_list = $this->filterId($id_list, $queries);
        return $id_list;
    }

    public function update(int $id, array $info): int {
        $entity = $this->findOrFail($id);
        foreach ($info as $key => $value) {
            if(array_key_exists($key, $entity)) {
                //delete from hash and prevent new empty property
                if(is_null($value)) {
                    Redis::HDEL($this->table . '::id:' . $info['id'], $key);
                    unset($info[$key]);
                }
                
                //delete old search index
                Redis::ZREM($this->table . '_id_zset::' . $key . ':' . $entity[$key], $id);
            } else {
                if(is_null($value)) {
                    unset($info[$key]);
                }
            }
        }

        //actual data
        Redis::HMSET(
            $this->table . '::id:' . $info['id'],
            $info
        );

        //for search
        foreach ($info as $key => $value) {
            Redis::ZADD($this->table . '_id_zset::' . $key . ':' . $value, $info['created_at'], $id);
        }

        return $id;
    }

    public function destroy(int | null $id): int {
        $entity = $this->find($id);
        if(!$entity) {
            return null;
        }

        Redis::DEL($this->table . '::id:' . $id);
        foreach ($entity as $key => $value) {
            Redis::ZREM($this->table . '_id_zset::' . $key . ':' . $value, $id);
        }

        Redis::ZREM($this->table . '_id_zset', $id);

        return $id;
    }

    public function beginTransaction(): void {

    }

    public function commit(): void {
        
    }

    private function getNewId() {
        return Redis::INCR('last_' . $this->table . '_id');
    }

    private function filterId($id_list, $queries) {
        foreach ($queries as $key => $value) {
            $tmp_id_list = Redis::ZRANGE($this->table . '_id_zset::' . $key . ':' . $value, 0, -1);
            $id_list = array_intersect($id_list, $tmp_id_list);
        }
        
        return array_values($id_list);
    }

    private function addId(array $info): array {
        if(!array_key_exists('id', $info)) {
            $info['id'] = $this->getNewId();
        }

        return $info;
    }

}
