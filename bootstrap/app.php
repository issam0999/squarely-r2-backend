<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
<<<<<<< HEAD
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
=======
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
<<<<<<< HEAD
=======

>>>>>>> 4307c3883626c90fdc7410bdd38355ee166b76cc
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
