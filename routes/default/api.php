<?php

use App\Http\Controllers\Api\Default\AccountController;

// account
$router->group(['prefix' => '/account'], function() use($router){

    $router->post('/',
        [AccountController::class, 'create']
    );

});