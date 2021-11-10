<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

use App\Settings\BaseSetting;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        if($exception instanceof \App\Services\ExceptionService) {
            return $exception->render();
        }

        if(!config('app.debug')) {
            if($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                $http_code = $exception->getStatusCode();
                $msg = $exception->getMessage();
            } else {
                $http_code = BaseSetting::HTTP_CODE_INTERNAL_SERVER_ERROR;
                $msg = BaseSetting::INTERNAL_SERVER_ERROR;
            }

            return err($http_code, $msg);
        }

        return parent::render($request, $exception);
    }
}
