<?php

use App\Http\Controllers\Api\Default\AccountController;
use App\Http\Controllers\Api\Default\AuthController;

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
