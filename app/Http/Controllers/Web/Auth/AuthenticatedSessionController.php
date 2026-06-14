<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        Log::info('LOGIN PAGE LOADED', [
            'session_id' => session()->getId(),
            'session_token' => session()->token(),
            'csrf_token' => csrf_token(),
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        return view('frontend/auth/login');
    }

    /**
     * Handle an incoming authentication request.
     */
//    public function store(LoginRequest $request): RedirectResponse
//    {
//        $request->authenticate();
//
//        $request->session()->regenerate();
//
//        $role = $request->user()->role;
//
//        if ($role === 'Super Admin' || $role === 'Admin') {
//            return redirect()->intended(route('admin.dashboard', absolute: false));
//        }
//
//        return redirect()->intended(route('user.dashboard', absolute: false));
//    }

    public function store(LoginRequest $request): RedirectResponse
    {
        try {
            Log::info('Login attempt started', [
                'email' => $request->email,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'session_id_before' => session()->getId(),
            ]);

            $request->authenticate();

            Log::info('Authentication successful', [
                'user_id' => auth()->id(),
                'role' => auth()->user()->role,
            ]);

            $request->session()->regenerate();

            Log::info('Session regenerated', [
                'session_id_after' => session()->getId(),
            ]);

            $role = $request->user()->role;

            if (in_array($role, ['Super Admin', 'Admin'])) {

                Log::info('Admin redirect', [
                    'user_id' => auth()->id(),
                    'role' => $role,
                ]);

                return redirect()->intended(route('admin.dashboard', false));
            }

            Log::info('User redirect', [
                'user_id' => auth()->id(),
                'role' => $role,
            ]);

            return redirect()->intended(route('user.dashboard', false));

        } catch (\Throwable $e) {

            Log::error('Login failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            throw $e;
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
