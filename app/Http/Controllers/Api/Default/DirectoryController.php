<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;

use App\Interfaces\Services\Default\IDirectoryService;

class DirectoryController extends Controller
{
    public function __construct(
        protected IDirectoryService $service
    ) {}
    
    public function create(Request $request) {
        $this->service->create($request->auth['account_id'], $request->name);

        return res([
            'msg' => 'done'
        ]);
    }

    public function index(Request $request) {
        $list = $this->service->getList($request->auth['account_id']);

        return res($list);
    }
}
