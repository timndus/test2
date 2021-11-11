<?php

namespace App\Services;

use App\Settings\Setting;

class ProcessService
{
    public function getRunningProcessList(): array {
        $result = MainService::runScript('get-running-process-list.sh');

        $list = explode(PHP_EOL, $result);

        //removes last empty element
        array_pop($list);

        return $list;
    }
}