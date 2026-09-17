@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction - Reset Password">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets, Reset Password">
@endsection

@section('title')
    Food Junction | Reset Password
@endsection

@section('content')

    <section class="login-signup-page py-5">
        <div class="auth-card" id="container">

            <div class="form-container sign-up">
                <form action="{{ route('reset.password') }}" method="POST" id="resetPasswordForm">
                    @csrf

                    <h1 class="auth-title">Reset Password</h1>

                    <span class="auth-subtitle">Enter your new password below to secure your account</span>

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="input-field-group password-field-wrap">
                        <input type="password" name="password" id="resetPassword" placeholder="New Password" required autocomplete="new-password" />
                        <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('resetPassword', this)" aria-label="Toggle password visibility">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-danger text-start w-100 ps-1 pb-1" style="font-size: 12px;">{{ $message }}</span>
                    @enderror

                    <div class="input-field-group password-field-wrap">
                        <input type="password" name="password_confirmation" id="resetPasswordConfirm" placeholder="Confirm New Password" required autocomplete="new-password" />
                        <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('resetPasswordConfirm', this)" aria-label="Toggle password confirmation visibility">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger text-start w-100 ps-1 pb-1" style="font-size: 12px;">{{ $message }}</span>
                    @enderror
                    @error('confirm_password')
                        <span class="text-danger text-start w-100 ps-1 pb-1" style="font-size: 12px;">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="auth-btn">Reset Password</button>

                    <div class="mobile-switch-box d-md-none">
                        <span>Remembered your password?</span>
                        <a href="{{ route('login') }}" class="mobile-switch-link">Sign In</a>
                    </div>
                </form>
            </div>

            <div class="toggle-container d-none d-md-block">
                <div class="toggle">
                    <div class="toggle-panel">
                        <h1>Remember Password?</h1>
                        <p>If you remember your login credentials, you can return to sign in to your account.</p>
                        <a href="{{ route('login') }}" class="toggle-outline-btn" id="login">Sign In</a>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('styles')
    <style>
        .login-signup-page {
            background: linear-gradient(135deg, #f0953a 0%, #e25822 50%, #b01920 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: calc(100vh - 140px);
            padding: 40px 15px;
        }

        .login-signup-page .auth-card {
            background-color: #ffffff;
            border-radius: 28px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
            width: 780px;
            max-width: 100%;
            min-height: 480px;
            display: flex;
        }

        .login-signup-page .auth-title {
            font-size: 28px;
            font-weight: 700;
            color: #222222;
            margin-bottom: 6px;
        }

        .login-signup-page .auth-subtitle {
            font-size: 13px;
            color: #666666;
            margin-bottom: 18px;
            text-align: center;
        }

        .login-signup-page form {
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 35px 35px;
            height: 100%;
            width: 100%;
        }

        .login-signup-page .input-field-group {
            position: relative;
            width: 100%;
            margin: 6px 0;
        }

        .login-signup-page input[type="text"],
        .login-signup-page input[type="email"],
        .login-signup-page input[type="password"],
        .login-signup-page input[type="number"] {
            background-color: #f4f6f8;
            border: 1.5px solid transparent;
            padding: 12px 16px;
            font-size: 13.5px;
            border-radius: 10px;
            width: 100%;
            outline: none;
            color: #333333;
            transition: all 0.25s ease;
        }

        .login-signup-page input:focus {
            background-color: #ffffff;
            border-color: #f0953a;
            box-shadow: 0 0 0 3px rgba(240, 149, 58, 0.18);
        }

        .login-signup-page .password-field-wrap {
            position: relative;
        }

        .login-signup-page .password-field-wrap input {
            padding-right: 42px !important;
        }

        .login-signup-page .password-toggle-btn {
            position: absolute !important;
            right: 8px !important;
            top: 50% !important;
            transform: translateY(-50%) !important;
            background: transparent !important;
            border: none !important;
            padding: 6px !important;
            margin: 0 !important;
            color: #888888 !important;
            cursor: pointer !important;
            font-size: 15px !important;
            line-height: 1 !important;
            z-index: 5 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 30px !important;
            height: 30px !important;
            border-radius: 50% !important;
            box-shadow: none !important;
            transition: color 0.2s ease, background-color 0.2s ease !important;
        }

        .login-signup-page .password-toggle-btn:hover {
            color: #b01920 !important;
            background-color: rgba(0, 0, 0, 0.05) !important;
        }

        .login-signup-page .auth-btn {
            background: linear-gradient(135deg, #f0953a 0%, #b01920 100%);
            color: #ffffff !important;
            font-size: 13px;
            padding: 12px 40px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: 0.6px;
            cursor: pointer;
            text-transform: uppercase;
            margin-top: 14px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 14px rgba(176, 25, 32, 0.25);
        }

        .login-signup-page .auth-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(176, 25, 32, 0.38);
        }

        .login-signup-page .auth-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        /* Desktop split layout */
        @media screen and (min-width: 769px) {
            .login-signup-page .form-container {
                position: absolute;
                top: 0;
                left: 0;
                height: 100%;
                width: 50%;
                padding: 10px;
            }

            .login-signup-page .toggle-container {
                position: absolute;
                top: 0;
                left: 50%;
                width: 50%;
                height: 100%;
                overflow: hidden;
                border-radius: 80px 0 0 80px;
                z-index: 10;
            }

            .login-signup-page .toggle {
                height: 100%;
                background: linear-gradient(135deg, #f79a3f 0%, #b01920 100%);
                color: #ffffff;
                position: relative;
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
                padding: 0 35px;
                text-align: center;
                top: 0;
            }

            .login-signup-page .toggle-panel h1 {
                font-size: 26px;
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 12px;
            }

            .login-signup-page .toggle-panel p {
                font-size: 13.5px;
                line-height: 22px;
                letter-spacing: 0.2px;
                color: rgba(255, 255, 255, 0.9);
                margin-bottom: 22px;
            }

            .login-signup-page .toggle-outline-btn {
                text-decoration: none;
                background-color: transparent;
                color: #ffffff;
                font-size: 12px;
                padding: 10px 36px;
                border: 2px solid #ffffff;
                border-radius: 10px;
                font-weight: 600;
                letter-spacing: 0.6px;
                cursor: pointer;
                text-transform: uppercase;
                transition: all 0.3s ease;
            }

            .login-signup-page .toggle-outline-btn:hover {
                background-color: #ffffff;
                color: #b01920;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            }
        }

        /* Mobile specific layout */
        @media screen and (max-width: 768px) {
            .login-signup-page {
                padding: 25px 12px;
            }

            .login-signup-page .auth-card {
                width: 100%;
                max-width: 440px;
                min-height: auto;
                border-radius: 20px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .login-signup-page .form-container {
                position: static;
                width: 100%;
                height: auto;
                padding: 0;
            }

            .login-signup-page form {
                padding: 32px 22px;
            }

            .login-signup-page .auth-title {
                font-size: 24px;
            }

            .login-signup-page .mobile-switch-box {
                margin-top: 20px;
                text-align: center;
                font-size: 13px;
                color: #666666;
            }

            .login-signup-page .mobile-switch-link {
                color: #b01920;
                font-weight: 700;
                text-decoration: none;
                margin-left: 5px;
            }

            .login-signup-page .mobile-switch-link:hover {
                color: #f0953a;
                text-decoration: underline;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        (function() {
            var form = document.getElementById('resetPasswordForm');
            if (form) {
                form.addEventListener('submit', function() {
                    var submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.textContent = 'Resetting Password...';
                    }
                });
            }
        })();
    </script>
@endpush
