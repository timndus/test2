<?php

namespace App\Repositories\Redis\Default;

use App\Services\MainService;
use App\Settings\Default\AuthSetting;
use App\Interfaces\Repositories\Default\IAccountRepository;

class AuthRepository extends \App\Repositories\Redis\AuthRepository implements \App\Interfaces\Repositories\Default\IAuthRepository
{
    public $table = 'auth';

    public function __construct(
        public AuthSetting $setting,
        private IAccountRepository $accountRepository
    ) {}

    public function create(?string $username, ?string $password): array {
        $account_id = $this->checkAccountExist($username, $password);

        // generate token
        $token = MainService::generateRandomString($this->setting::TOKEN_LEN);

        // store
        $id = parent::store([
            'account_id' => $account_id,
            'token' => $token
        ]);

        $auth = $this->find($id);
        $auth = MainService::filter($auth, ['id', 'token']);
        
        return $auth;
    }

    private function checkAccountExist(?string $username, ?string $password): int {
        $account_id = $this->accountRepository->getId([
            'username' => $username,
            'password' => $password
        ]);

        $this->accountRepository->checkExist($account_id);

        return $account_id;
    }
}
