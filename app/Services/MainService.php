<?php

namespace App\Services;

use App\Settings\Setting;
use Illuminate\Support\Str;

class MainService
{
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

    public static function isValidLength(?string $param, int $min, int $max): bool {
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

}