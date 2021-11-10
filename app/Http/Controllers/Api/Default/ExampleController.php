<?php

namespace App\Http\Controllers\Api\Default;

use Illuminate\Http\Request;

use App\Interfaces\Repositories\Default\IExampleRepository;

class ExampleController extends Controller
{
    public function __construct(
        protected IExampleRepository $repository
    ) {}
    
}
