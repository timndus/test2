<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;

use App\Interfaces\Repositories\Default\IAuthRepository;
use App\Settings\Default\AuthSetting;

class AuthController extends Controller
{
    public function __construct(
        protected IAuthRepository $repository,
        private AuthSetting $setting
    ) {}
    
    public function create(Request $request) {
        $auth = $this->repository->create($request->username, $request->password);
        return res($auth, $this->setting::HTTP_CODE_CREATED);
    }
}
