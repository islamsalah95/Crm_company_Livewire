<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\Employ;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use App\Http\Middleware\DashSuperAdmin;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        // $middleware->append(\App\Http\Middleware\SetLocale::class);
        $middleware->alias([
            'superAdmin' => DashSuperAdmin::class,
            'admin' => Admin::class,
            'employ' => Employ::class,
            'setLocale' => SetLocale::class

        ]);


    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withEvents(discover: [
        __DIR__.'/../app/Domain/Listeners',
    ])->create();
