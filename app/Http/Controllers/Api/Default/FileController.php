<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;
use Facades\App\Services\FileService;

class FileController extends Controller
{
    public function __construct() {}
    
    public function create(Request $request) {
        FileService::create($request->auth['account_id'], $request->name);

        return res([
            'msg' => 'done'
        ]);
    }
}
