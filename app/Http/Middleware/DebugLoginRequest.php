<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class DebugLoginRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        Log::info('LOGIN POST RECEIVED', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            '_token' => $request->input('_token'),
            'session_id' => session()->getId(),
            'session_token' => session()->token(),
            'cookie_xsrf' => $request->cookie('XSRF-TOKEN'),
            'session_cookie' => $request->cookie(config('session.cookie')),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return $next($request);
    }
}
