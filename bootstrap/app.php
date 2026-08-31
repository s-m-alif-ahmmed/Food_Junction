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
            $superAdminPath = file_exists(base_path('routes/superAdmin.php')) 
                ? base_path('routes/superAdmin.php') 
                : (file_exists(base_path('routes/superadmin.php')) ? base_path('routes/superadmin.php') : null);

            if ($superAdminPath) {
                Route::middleware(['web', 'auth', 'Super Admin'])
                    ->prefix('super-admin')
                    ->group($superAdminPath);
            }

            if (file_exists(base_path('routes/backend.php'))) {
                Route::middleware(['web', 'auth', 'Admin'])
                    ->prefix('admin')
                    ->group(base_path('routes/backend.php'));
            }

            if (file_exists(base_path('routes/settings.php'))) {
                Route::middleware(['web', 'auth', 'Admin'])
                    ->prefix('admin/settings')
                    ->group(base_path('routes/settings.php'));
            }
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
            'nocache' => \App\Http\Middleware\NoCache::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            if ($e->getStatusCode() === 419) {
                \Log::warning('419 CSRF Error Encountered', [
                    'url' => $request->fullUrl(),
                    'method' => $request->method(),
                    '_token' => $request->input('_token'),
                    'session_token' => $request->hasSession() ? $request->session()->token() : null,
                    'session_id' => $request->hasSession() ? session()->getId() : null,
                    'ip' => $request->ip(),
                    'user_agent' => $request->userAgent(),
                ]);

                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'message' => 'Your session has expired. Please refresh the page and try again.',
                    ], 419);
                }

                return redirect()->route('login')
                    ->withInput($request->except('_token', 'password', 'password_confirmation'))
                    ->with('error', 'Your session expired due to inactivity. Please try signing in again.');
            }
        });
    })->create();
