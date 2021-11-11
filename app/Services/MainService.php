<?php

namespace App\Services;

use App\Settings\Setting;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class MainService
{
    public static function runScript(string $name): mixed {
        $process = new Process(['sh', __DIR__ . '/../Scripts/' . $name]);
        $process->run();

        // executes after the command finishes
        if(!$process->isSuccessful()) {
            err(Setting::HTTP_CODE_INTERNAL_SERVER_ERROR, setting::INTERNAL_SERVER_ERROR);
        } else {
            $result = $process->getOutput();
        }

        return $result;
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

    public static function isValidLength(?string $param, int $min, int $max): bool {
        $len = strlen(utf8_decode($param));
        if($len >= $min && $len <= $max) {
            return true;
        } else {
            return false;
        }
    }

    public static function generateRandomString($len) {
        return Str::random($len);
    }

    public static function generateRandomNumber($min_number, $max_number) {
        return rand($min_number, $max_number);
    }

    public static function getCurrentEpoch($nano = true) {
        $epoch = microtime(true);
        return $nano ? $epoch : round($epoch);
    }

}