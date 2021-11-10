<?php

if (!function_exists('err')) {
    function err($http_code, $msg = null, $meta_data = []) {
        throw new \App\Services\ExceptionService($http_code, $msg, $meta_data);
    }

    function res($data, $http_status_code = 200) {
        if(!is_array($data)) {
            $data = $data ? $data : new \stdClass();
        }
        
        return response()->json(
            [
                'data' => $data
            ],
            $http_status_code
        );
    }
}