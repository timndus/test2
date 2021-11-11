<?php

namespace App\Repositories\Redis\Default;

use App\Services\MainService;
use App\Settings\Default\AccountSetting;
use Facades\App\Services\FileSystemService;

class AccountRepository extends \App\Repositories\Redis\AccountRepository implements \App\Interfaces\Repositories\Default\IAccountRepository
{
    public $table = 'account';

    public function __construct(
        public AccountSetting $setting
    ) {}

    public function create(?string $username, ?string $password): int {
        $this->checkUsername($username);
        $this->checkIsNotRegistered($username);
        $this->checkPassword($password);

        $this->createHomeDirectory($username);

        return parent::store([
            'username' => $username,
            'password' => $password
        ]);
    }

    private function createHomeDirectory(string $username): void {
        $path = '/opt/myprogram/' . $username;
        FileSystemService::createDirectory($path);
    }

    private function checkUsername(?string $username): void {
        if(!$this->isValidUsername($username)) {
            err($this->setting::HTTP_CODE_UNPROCESSABLE_ENTITY, $this->setting::USERNAME_INVALID);
        }
    }

    private function isValidUsername(?string $username): bool {
        /**
         *  Only contains alphanumeric characters, underscore and dot.
         *  Underscore and dot can't be at the end or start of a username (e.g _username / username_ / .username / username.).
         *  Underscore and dot can't be next to each other (e.g user_.name).
         *  Underscore or dot can't be used multiple times in a row (e.g user__name / user..name).
         */

        $min = $this->setting::USERNAME_LEN_MIN;
        $max = $this->setting::USERNAME_LEN_MAX;

        if(preg_match('/^(?=[a-zA-Z0-9._]{'.$min.','.$max.'}$)(?!.*[_.]{2})[^_.].*[^_.]$/', $username)) {
            return true;
        }

        return false;
    }

    private function checkIsNotRegistered(?string $username) {
        $id = $this->getId([
            'username' => $username
        ]);
        if($id) {
            err($this->setting::HTTP_CODE_CONFLICT, $this->setting::IS_REGISTERED);
        }
    }

    private function checkPassword(?string $password): void {
        if(!$this->isValidPassword($password)) {
            err($this->setting::HTTP_CODE_UNPROCESSABLE_ENTITY, $this->setting::PASSWORD_INVALID);
        }
    }

    private function isValidPassword(?string $password): bool {
        if(MainService::isValidLength($password, $this->setting::PASSWORD_LEN_MIN, $this->setting::PASSWORD_LEN_MAX)) {
            return true;
        }

        return false;
    }

   
}
