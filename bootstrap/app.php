<?php

use App\Http\Middleware\ProfissionalAutenticado;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //registrando o meu middleware
        $middleware->alias([
            'session.timeout' => \App\Http\Middleware\RedirectOnSessionTimeout::class,
            'profissional.auth' => ProfissionalAutenticado::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
