<?php

namespace App\Services\Default;

use App\Services\MainService;

class ProcessService implements \App\Interfaces\Services\Default\IProcessService
{    
    /**
     * getRunningProcessList
     *
     * @return array Ex: ['htop', 'ps']
     */
    public function getRunningProcessList(): array {
        $result = MainService::runScript('get-running-process-list.sh');

        $list = explode(PHP_EOL, $result);

        //removes last empty element
        array_pop($list);

        return $list;
    }
}