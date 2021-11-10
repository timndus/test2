<?php

namespace App\Interfaces\Repositories\Default;

interface IAuthRepository extends \App\Interfaces\Repositories\IRepository {
    public function create(?string $username, ?string $password): array;
}