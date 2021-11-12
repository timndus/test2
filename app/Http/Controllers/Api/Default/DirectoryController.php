<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;

use App\Interfaces\Services\Default\IDirectoryService;
use App\Settings\Default\DirectorySetting;

class DirectoryController extends Controller
{
    public function __construct(
        protected IDirectoryService $service,
        private DirectorySetting $setting
    ) {}
    
    public function create(Request $request) {
        $this->service->create($request->auth['account_id'], $request->name);

        return res([
            'msg' => 'done'
        ], $this->setting::HTTP_CODE_CREATED);
    }

    public function index(Request $request) {
        $list = $this->service->getList($request->auth['account_id']);

        return res($list);
    }
}
