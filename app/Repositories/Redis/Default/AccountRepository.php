<?php

namespace App\Repositories\Redis\Default;

use App\Settings\Default\AccountSetting;

class AccountRepository extends \App\Repositories\Redis\AccountRepository implements \App\Interfaces\Repositories\Default\IAccountRepository
{
    public $table = 'account';

    public function __construct(
        public AccountSetting $setting
    ) {}
   
}
