<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;
use App\Interfaces\Services\Default\IFileService;
use App\Settings\Default\FileSetting;

class FileController extends Controller
{
    public function __construct(
        private IFileService $service,
        private FileSetting $setting
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
