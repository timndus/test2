<?php

namespace App\Interfaces\Services\Default;

interface IProcessService extends \App\Interfaces\Services\IService {
    public function getRunningProcessList(): array;
}