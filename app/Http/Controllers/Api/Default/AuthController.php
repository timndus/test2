<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;

use App\Interfaces\Repositories\Default\IAuthRepository;

class AuthController extends Controller
{
    public function __construct(
        protected IAuthRepository $repository
    ) {}
    
    public function create(Request $request) {
        $auth = $this->repository->create($request->username, $request->password);
        return res($auth);
    }
}
