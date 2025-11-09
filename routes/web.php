<?php

use Illuminate\Support\Env;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [Env::get('APP_NAME', 'Squarely') => '2.0.0'];
});

require __DIR__ . '/auth.php';
