<?php

namespace App\Repositories\QueryBuilder\Default;

use App\Settings\Default\AccountSetting;

class AccountRepository extends \App\Repositories\QueryBuilder\AccountRepository implements \App\Interfaces\Repositories\Default\IAccountRepository
{
    public $table = 'account';

    public function __construct(
        public AccountSetting $setting
    ) {}
   
}
