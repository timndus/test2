<?php

namespace App\Http\Controllers\Api\Default;

use App\Interfaces\Services\Default\IProcessService;

class ProcessController extends Controller
{
    public function __construct(
        protected IProcessService $service
    ) {}
    
    public function getRunningProcessList() {
        $list = $this->service->getRunningProcessList();
        return res($list);
    }
}
