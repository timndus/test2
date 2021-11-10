<?php

namespace App\Repositories;

use App\Services\MainService;

trait TRepository {
    protected function addCreatedAt(array $info): array {
        if(!array_key_exists('created_at', $info)) {
            $info['created_at'] = MainService::getCurrentEpoch();
        }

        return $info;
    }

    protected function checkStoreResult(int | null $id): void {
        if(!$id) {
            err($this->setting::HTTP_CODE_INTERNAL_SERVER_ERROR, $this->setting::STORE_FAILED);
        }
    }

    public function checkExist(int |null $id): void {
        if(!$this->isExist($id)) {
            err($this->setting::HTTP_CODE_NOT_FOUND, $this->setting::NOT_FOUND);
        }
    }

    public function isExist(int | null $id): bool {
        return $this->getId($id) ? true : false;
    }

    public function checkNotExist(int | null $id): void {
        if($this->isExist($id)) {
            err($this->setting::HTTP_CODE_CONFLICT, $this->setting::EXIST);
        }
    }

    protected function checkPassword(string $password): void {
        MainService::checkPassword($password);
    }

    public function checkIsNotRegistered($email) {
        $id = $this->getId([
            'email' => $email
        ]);
        if($id) {
            err($this->setting::HTTP_CODE_UNPROCESSABLE_ENTITY, $this->setting::IS_REGISTERED);
        }
    }

    public function getIdOrFail(int | null | array $queries): int {
        $id = $this->getId($queries);
        if($id) {
            return $id;
        }
        
        err($this->setting::HTTP_CODE_NOT_FOUND, $this->setting::NOT_FOUND);
    }

    public function findOrFail(int | null | array $queries): array {
        $id = $this->getIdOrFail($queries);
        return $this->find($id);
    }
}