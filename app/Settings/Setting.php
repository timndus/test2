<?php

namespace App\Settings;

class Setting {
    public const HTTP_CODE_OK = 200;
    public const HTTP_CODE_CREATED = 201;
    public const HTTP_CODE_UNAUTHORIZED = 401;
    public const HTTP_CODE_PAYMENT_REQUIRED = 402;
    public const HTTP_CODE_FORBIDDEN = 403;
    public const HTTP_CODE_NOT_FOUND = 404;
    public const HTTP_CODE_CONFLICT = 409;
    public const HTTP_CODE_UNPROCESSABLE_ENTITY = 422;
    public const HTTP_CODE_TOO_MANY_REQUESTS = 429;
    public const HTTP_CODE_INTERNAL_SERVER_ERROR = 500;

    public const ADMIN_API_VERSION_PREFIX = '/v1';
    public const DEFAULT_API_VERSION_PREFIX = '/v1';

    public const INTERNAL_SERVER_ERROR = 'Internal Server Error';
    public const TOO_MANY_REQUESTS = 'Too Many Requests';
    public const NOT_FOUND = 'Not Found';
    public const EXIST = 'Already Exist';
    public const REQUIRED_PARAM = 'Required param: ';
    public const INVALID_PARAM = 'Invalid param: ';
    public const UNKNOWN_MESSAGE = 'Unknown message';
    public const FAILED = 'Failed';
    public const STORE_FAILED = 'Store failed';
    public const STORE_CACHE_FAILED = 'Store cache failed';
    public const UNPROCESSABLE_ENTITY = 'Unprocessable entity';
    public const INVALID_FILE = 'Invalid file';
    public const PAYMENT_REQUIRED = 'Payment Required';
    public const EMAIL_LEN_MIN = 3;
    public const EMAIL_LEN_MAX = 254;
    public const PASSWORD_LEN_MIN = 8;
    public const PASSWORD_LEN_MAX = 64;
    public const EMAIL_INVALID = 'Email is invalid';
    public const PASSWORD_INVALID = 'Password is invalid';
    public const IS_REGISTERED = 'Already registered';

    public static function required($param) {
        return self::REQUIRED_PARAM . $param;
    }

    public static function invalid($param) {
        return self::INVALID_PARAM . $param;
    }

}