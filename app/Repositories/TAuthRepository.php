<?php

namespace App\Repositories;

use App\Services\MainService;

// a shared code for all AuthRepository implementations (Querybuilder and Redis in this case)
trait TAuthRepository {
    use TRepository;
}