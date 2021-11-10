<?php

namespace App\Settings\Default;

class AccountSetting extends \App\Settings\AccountSetting {
    public const USERNAME_INVALID = 'Username is invalid';
    public const USERNAME_LEN_MIN = 1;
    public const USERNAME_LEN_MAX = 32;

    public const PASSWORD_INVALID = 'Password is invalid';
    public const PASSWORD_LEN_MIN = 1;
    public const PASSWORD_LEN_MAX = 32;

}