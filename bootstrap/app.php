<?php
// bootstrap/app.php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        // Add admin routes here
        then: function () {
            Route::middleware('web')
                ->prefix('admin')
                ->name('admin.')
                ->group(base_path('routes/admin.php'));
        },
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Tidak perlu register middleware custom karena kita pakai auth:admin built-in
        // Middleware custom AdminAuth bisa dihapus atau tetap ada untuk keperluan lain
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();