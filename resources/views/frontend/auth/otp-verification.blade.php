@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction - OTP Verification">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets, OTP, Verification">
@endsection

@section('title')
    Food Junction | OTP Verification
@endsection

@section('content')

    <section class="login-signup-page py-5">
        <div class="auth-card" id="container">

            <div class="form-container sign-in">
                <form action="{{ route('otp.verify') }}" method="POST" id="otpForm">
                    @csrf
                    <h1 class="auth-title">OTP Verification</h1>

                    @if (session('status'))
                        <div class="alert alert-success w-100 py-2 text-center my-2" style="font-size: 13px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger w-100 py-2 text-center my-2" style="font-size: 13px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <span class="auth-subtitle">Enter the 4 or 6-digit OTP code sent to your email</span>

                    <div class="input-field-group">
                        <input type="number" name="otp" id="otpCode" placeholder="Enter OTP Code" value="{{ old('otp') }}" required style="letter-spacing: 3px; font-weight: 600; text-align: center;" />
                    </div>
                    @error('otp')
                        <span class="text-danger text-start w-100 ps-1 pb-1" style="font-size: 12px;">{{ $message }}</span>
                    @enderror

                    <button type="submit" class="auth-btn">Verify OTP</button>

                    <div class="mobile-switch-box d-md-none">
                        <span>Remembered your password?</span>
                        <a href="{{ route('login') }}" class="mobile-switch-link">Sign In</a>
                    </div>
                </form>
            </div>

            <div class="toggle-container d-none d-md-block">
                <div class="toggle">
                    <div class="toggle-panel toggle-right">
                        <h1>Need Help?</h1>
                        <p>If you did not receive an OTP or already remembered your credentials, you can return to sign in.</p>
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
            padding: 40px 35px;
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
            var form = document.getElementById('otpForm');
            if (form) {
                form.addEventListener('submit', function() {
                    var submitBtn = this.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.disabled = true;
                        submitBtn.textContent = 'Verifying OTP...';
                    }
                });
            }
        })();
    </script>
@endpush
