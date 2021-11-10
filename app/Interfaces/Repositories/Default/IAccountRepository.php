<?php

namespace App\Interfaces\Repositories\Default;

interface IAccountRepository extends \App\Interfaces\Repositories\IRepository {
    public function create(?string $username, ?string $password): int;
}