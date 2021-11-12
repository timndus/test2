<?php

namespace App\Repositories;

use App\Services\MainService;

use Facades\App\Services\FileSystemService;

// a shared code for all AccountRepository implementations (Querybuilder and Redis in this case)
trait TAccountRepository {
    use TRepository;
}