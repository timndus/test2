<?php

use App\Http\Controllers\Api\Default\AccountController;
use App\Http\Controllers\Api\Default\AuthController;
use App\Http\Controllers\Api\Default\ProcessController;

// account
$router->group(['prefix' => '/account'], function() use($router){

    $router->post('/',
        [AccountController::class, 'create']
    );

});

// auth
$router->group(['prefix' => '/auth'], function() use($router){

    $router->post('/',
        [AuthController::class, 'create']
    );

});

// process
$router->group(['prefix' => '/process'], function() use($router){

    $router->group(['middleware' => 'api.default.auth'], function () use ($router) {
        $router->get('/running',
            [ProcessController::class, 'getRunningProcessList']
        );
    });
    
});
