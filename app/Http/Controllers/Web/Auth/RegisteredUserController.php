<?php

namespace App\Http\Controllers\Web\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Ichtrojan\Otp\Otp;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller {
    /**
     * Display the registration view.
     */
    public function create(): View {
        return view('frontend/auth/register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function showForgotPasswordForm()
    {
        return view('frontend.auth.forgot-password');
    }

    public function handleForgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found'])->withInput();
        }

        $this->send_otp($user, 'forget');

        session(['email' => $user->email]);
        return redirect()->route('otp.verify.form')->with('status', 'OTP sent successfully');
    }

    public function showOtpVerificationForm()
    {
        return view('frontend.auth.otp-verification');
    }

    public function handleOtpVerification(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6',
        ]);

        $email = session('email');
        if (!$email) {
            return redirect()->route('forgot.password')->with('error', 'Session expired. Please try again.');
        }

        $verify = (new Otp)->validate($email, $request->otp);
        if ($verify->status) {
            $user = User::where('email', $email)->first();
            $token = Str::random(40);
            $user->reset_code = $token;
            $user->reset_code_expires_at = now()->addMinutes(15);
            $user->save();

            return redirect()->route('reset.password.form', ['token' => $token]);
        }

        return back()->with('error', $verify->message);
    }

    public function showResetForm($token)
    {
        return view('frontend.auth.change-password', ['token' => $token]);
    }

    public function handleResetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:6',
        ]);

        $user = User::where('reset_code', $request->token)->first();
        if (!$user) {
            return back()->with('error', 'Invalid token');
        }

        if ($user->reset_code_expires_at < now()) {
            return back()->with('error', 'Token expired');
        }

        $user->password = Hash::make($request->password);
        $user->reset_code = null;
        $user->reset_code_expires_at = null;
        $user->save();

        return redirect()->route('login')->with('status', 'Password reset successfully');
    }

    public function send_otp(User $user,$mailType = 'verify')
    {
        $otp  = (new Otp)->generate($user->email, 'numeric', 6, 60);
        $message = $mailType === 'verify' ? 'Verify Your Email Address' : 'Reset Your Password';
        \Mail::to($user->email)->send(new \App\Mail\OTP($otp->token,$user,$message,$mailType));
        return $otp;
    }

}
