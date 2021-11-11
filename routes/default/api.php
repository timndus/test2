<?php

use App\Http\Controllers\Api\Default\AccountController;
use App\Http\Controllers\Api\Default\AuthController;
use App\Http\Controllers\Api\Default\ProcessController;
use App\Http\Controllers\Api\Default\DirectoryController;
use App\Http\Controllers\Api\Default\FileController;

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

// directory
$router->group(['prefix' => '/directory'], function() use($router){

    $router->group(['middleware' => 'api.default.auth'], function () use ($router) {
        $router->post('/',
            [DirectoryController::class, 'create']
        );

        $router->get('/',
            [DirectoryController::class, 'index']
        );
    });
    
});

// file
$router->group(['prefix' => '/file'], function() use($router){

    $router->group(['middleware' => 'api.default.auth'], function () use ($router) {
        $router->post('/',
            [FileController::class, 'create']
        );
    });
    
});
