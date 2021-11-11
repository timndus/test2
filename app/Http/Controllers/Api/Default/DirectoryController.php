<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;
use Facades\App\Services\DirectoryService;

class DirectoryController extends Controller
{
    public function __construct() {}
    
    public function create(Request $request) {
        DirectoryService::create($request->auth['account_id'], $request->name);

        return res([
            'msg' => 'done'
        ]);
    }

    public function index(Request $request) {
        $list = DirectoryService::getList($request->auth['account_id']);

        return res($list);
    }
}
