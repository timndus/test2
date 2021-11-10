<?php

namespace App\Services\Default;

use Illuminate\Http\Request;

use App\Interfaces\Repositories\Default\IAuthRepository;

class AclService
{
    public function __construct(
        private IAuthRepository $authRepository
    ) {}

    public function getAuthenticatedRequest(Request $request) {
        $token = $request->bearerToken();
        $auth = $this->authRepository->find(['token' => $token]);
        if(!$auth) {
            err($this->authRepository->setting::HTTP_CODE_UNAUTHORIZED, $this->authRepository->setting::UNAUTHORIZED);
        }

        $request->merge([
            'auth' => $auth
        ]);

        return $request;
    }   

}
