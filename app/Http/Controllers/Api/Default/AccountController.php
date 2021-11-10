<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;

use App\Interfaces\Repositories\Default\IAccountRepository;

class AccountController extends Controller
{
    public function __construct(
        protected IAccountRepository $repository
    ) {}
    
}
