<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //---
         /*\App\Models\Logs::create([
                'datev' => now(),
                'event' => json_encode($e->errors()),
                'url' => $request->fullUrl(), // Optional: log the request URL
                'method' => $request->method(), // Optional: log HTTP method
            ]);*/
        //--
    })->create();
