<?php

use Illuminate\Support\Facades\Redirect;

$router->get('/', function () {
    return Redirect::to('https://github.com/timndus/test2#readme');
});