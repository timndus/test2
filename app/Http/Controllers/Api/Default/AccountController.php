<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;

use App\Interfaces\Repositories\Default\IAccountRepository;
use App\Settings\Default\AccountSetting;

class AccountController extends Controller
{
    public function __construct(
        protected IAccountRepository $repository,
        private AccountSetting $setting
    ) {}
    
    public function create(Request $request) {
        $id = $this->repository->create($request->username, $request->password);
        return res([
            'id' => $id
        ], $this->setting::HTTP_CODE_CREATED);
    }
}
