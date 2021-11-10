<?php

namespace App\Repositories\Redis\Default;

use App\Settings\Default\AuthSetting;

class AuthRepository extends \App\Repositories\Redis\AuthRepository implements \App\Interfaces\Repositories\Default\IAuthRepository
{
    public $table = 'example';

    public function __construct(
        public AuthSetting $setting
    ) {}
}
