@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction - Reset Password">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets, Reset Password">
@endsection

@section('title')
    Food Junction | Forgot Password
@endsection

@section('content')
    <section class="login-signup-page py-5">
        <div class="container" id="container">

            <div class="form-container sign-in">
                <form action="{{ route('otp.verify') }}" method="POST">
                    @csrf
                    <h1>OTP Verification</h1>

                    @if (session('status'))
                        <div class="alert alert-success w-100 text-center">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger w-100 text-center">
                            {{ session('error') }}
                        </div>
                    @endif

                    <span class="pb-2">Enter the otp for verification</span>

                    <input type="number" name="otp" placeholder="Otp" value="{{ old('otp') }}" required />
                    @error('email')
                    <span class="text-danger text-start w-100 ps-3">{{ $message }}</span>
                    @enderror

                    <button type="submit">OTP Verify</button>
                </form>
            </div>

            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-right">
                        <h1>Hello, there!</h1>
                        <p>Register with your personal details to use all of site features.</p>
                        <a href="{{ route('register') }}" class="" id="register">Sign Up</a>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

@push('styles')
    <style>
        .login-signup-page {
            background: linear-gradient(to right, #f0953a, #b01920);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .login-signup-page .container {
            background-color: white;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .login-signup-page .container p {
            font-size: 14px;
            line-height: 20px;
            letter-spacing: .3px;
            margin: 20px 0;
        }

        .login-signup-page .form-container h1 {
            font-size: 32px;
        }

        @media screen and (max-width: 576px) {
            .login-signup-page .form-container h1 {
                font-size: 24px;
            }
        }

        .container span {
            font-size: 12px;
        }

        .login-signup-page .container a {
            text-decoration: none;
            background-color: transparent;
            color: #ffffff;
            font-size: 12px;
            padding: 10px 45px;
            border: 2px solid white;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .login-signup-page .container button {
            background-color: #b77128;
            color: #ffffff;
            font-size: 12px;
            padding: 10px 45px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            cursor: pointer;
            text-transform: uppercase;
            margin-top: 10px;
        }

        .login-signup-page .container .forgot-password-btn {
            color: #0a3622;
            text-align: start;
        }

        .login-signup-page .container form {
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px 0;
            height: 100%;
        }

        .login-signup-page .container input {
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .login-signup-page .form-container {
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            padding: 20px 20px 20px 0;
            transition: all .6s ease-in-out;
        }

        .login-signup-page .toggle-container {
            position: absolute;
            top: 0;
            left: 50%;
            width: 50%;
            height: 100%;
            overflow: hidden;
            transition: all .6s ease-in-out;
            border-radius: 80px 0 0 80px;
            z-index: 1000;
        }

        .login-signup-page .container.active .toggle-container {
            transform: translateX(-100%);
            border-radius: 0 80px 80px 0;
        }

        .login-signup-page .toggle {
            height: 100%;
            background: linear-gradient(to right, #f79a3f, #b01920);
            color: #fff;
            position: relative;
            left: 0%;
            width: 100%;
        }

        .login-signup-page .toggle-panel {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
        }
    </style>
@endpush
