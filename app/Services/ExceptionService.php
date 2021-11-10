<?php

namespace App\Services;

use App\Settings\BaseSetting;

class ExceptionService extends \Exception {
    public $msg;

    public function __construct(
        public $http_code,
        $msg = null,
        public $meta_data = []
    ) {
        $this->msg = $msg;
    }

    public function render() {
        $response = [];
        $response['err']['msg'] = $this->msg ? $this->msg : BaseSetting::UNKNOWN_MESSAGE;

        if($this->meta_data) {
            $response['meta_data'] = $this->meta_data;
        }

        return response()->json(
            $response,
            $this->http_code
        );
    }
    
}
