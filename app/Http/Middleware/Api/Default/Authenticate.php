<?php

namespace App\Http\Middleware\Api\Default;

use Closure;
use Illuminate\Http\Request;

use App\Services\Default\AclService;

class Authenticate
{
    public function __construct(
        private AclService $aclService
    ) {}

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request = $this->aclService->getAuthenticatedRequest($request);
        return $next($request);
    }
}
