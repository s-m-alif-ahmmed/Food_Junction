<?php

use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware(['web', 'auth', 'Super Admin'])
                ->prefix('super-admin')
                ->group(base_path('routes/superAdmin.php'));

            Route::middleware(['web', 'auth', 'Admin'])
                ->prefix('admin')
                ->group(base_path('routes/backend.php'));

            Route::middleware(['web', 'auth', 'Admin'])
                ->prefix('admin/settings')
                ->group(base_path('routes/settings.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'Admin' => AdminMiddleware::class,
            'Super Admin' => SuperAdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
