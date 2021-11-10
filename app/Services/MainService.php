<?php

namespace App\Services;

use App\Settings\Setting;
use Illuminate\Support\Str;

class MainService
{
    public static function checkPassword(
        string $password,
        int $length_min = Setting::PASSWORD_LEN_MIN,
        int $length_max = Setting::PASSWORD_LEN_MAX,
        int $http_code = Setting::HTTP_CODE_UNPROCESSABLE_ENTITY,
        string $msg = Setting::PASSWORD_INVALID
    ): void {
        if(!self::isValidPassword($password, $length_min, $length_max)) {
            err($http_code, $msg);
        }
    }

    public static function isValidPassword(
        string $password,
        int $length_min = Setting::PASSWORD_LEN_MIN,
        int $length_max = Setting::PASSWORD_LEN_MAX
    ): bool {
        if(self::isValidLength($password, $length_min, $length_max)) {
            return true;
        }

        return false;
    }

    public static function filter($entity, $keys, $except = false) {
        if(!$entity) {
            return $entity;
        }

        if(!$except) {
            $res = [];
            foreach ($keys as $key) {
                if(array_key_exists($key, $entity)) {
                    $res[$key] = $entity[$key];
                }
            }
            $entity = $res;
        } else {
            foreach ($keys as $key) {
                if(array_key_exists($key, $entity)) {
                    unset($entity[$key]);
                }
            }
        }

        return $entity;
    }

    public static function isValidLength(string $param, int $min, int $max): bool {
        $len = strlen(utf8_decode($param));
        if($len >= $min && $len <= $max) {
            return true;
        } else {
            return false;
        }
    }

    public static function generateRandomNumber($min_number, $max_number) {
        return rand($min_number, $max_number);
    }

    public static function getCurrentEpoch() {
        return microtime(true);
    }
    
    public static function isName(string $name, int $len_min, int $len_max): bool {
        /**
         * starts with [a-zA-Z0-9]
         * may contain [- _] but must be followed by a [a-zA-Z0-9]
         */

        $pattern = '/^([a-zA-Z0-9]+([- _][a-zA-Z0-9]+)*){' . $len_min . ',' . $len_max . '}$/';
        return preg_match($pattern, $name) ? true : false;
    }

    public static function isValidUsername($username, $min, $max){
        /**
         *  Only contains alphanumeric characters, underscore and dot.
         *  Underscore and dot can't be at the end or start of a username (e.g _username / username_ / .username / username.).
         *  Underscore and dot can't be next to each other (e.g user_.name).
         *  Underscore or dot can't be used multiple times in a row (e.g user__name / user..name).
         */
        if(preg_match('/^(?=[a-zA-Z0-9._]{'.$min.','.$max.'}$)(?!.*[_.]{2})[^_.].*[^_.]$/', $username)) {
            return true;
        }

        return false;
    }
}