<?php

use App\Http\Middleware\SuperAdminMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\TokenMismatchException;
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
        $middleware->trustProxies(
            at: '*',
            headers: \Illuminate\Http\Request::HEADER_X_FORWARDED_FOR |
                     \Illuminate\Http\Request::HEADER_X_FORWARDED_HOST |
                     \Illuminate\Http\Request::HEADER_X_FORWARDED_PORT |
                     \Illuminate\Http\Request::HEADER_X_FORWARDED_PROTO |
                     \Illuminate\Http\Request::HEADER_X_FORWARDED_AWS_ELB
        );

        $middleware->alias([
            'Admin' => AdminMiddleware::class,
            'Super Admin' => SuperAdminMiddleware::class,
            'debug.login' => \App\Http\Middleware\DebugLoginRequest::class,
            'nocache' => \App\Http\Middleware\NoCache::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {

        $exceptions->render(function (
            \Symfony\Component\HttpKernel\Exception\HttpException $e,
                                                                  $request
        ) {

            if ($e->getStatusCode() === 419) {

                \Log::error('419 CSRF Error', [
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),

                    '_token' => $request->input('_token'),

                    'session_token' => $request->session()->token(),

                    'session_id' => session()->getId(),

                    'cookie_xsrf' => $request->cookie('XSRF-TOKEN'),

                    'session_cookie' => $request->cookie(config('session.cookie')),

                    'all_cookies' => $request->cookies->all(),

                    'ip' => $request->ip(),

                    'user_agent' => $request->userAgent(),

                    'referer' => $request->headers->get('referer'),
                ]);
            }
        });
    })->create();
