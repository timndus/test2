<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;

use App\Interfaces\Repositories\Default\IAuthRepository;

class AuthController extends Controller
{
    public function __construct(
        protected IAuthRepository $repository
    ) {}
    
}
