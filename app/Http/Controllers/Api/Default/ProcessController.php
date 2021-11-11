<?php

namespace App\Http\Controllers\Api\Default;

use Facades\App\Services\ProcessService;

class ProcessController extends Controller
{
    public function __construct() {}
    
    public function getRunningProcessList() {
        $list = ProcessService::getRunningProcessList();
        return res($list);
    }
}
