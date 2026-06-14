@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
    <!-- Prevent caching to avoid CSRF token mismatch (419 Page Expired) -->
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
@endsection

@section('title')
    Food Junction | Login & Signup
@endsection

@section('content')

    <section class="login-signup-page py-5">
        <div class="container" id="container">

            <div class="form-container sign-in">
                <form action="{{ route('login') }}" method="POST" id="loginForm">
                    @csrf
                    <h1>Sign In</h1>

                    @if(session('error'))
                        <span class="text-danger text-center w-100" style="font-size: 13px;">{{ session('error') }}</span>
                    @endif

                    <span>or use your email and password</span>

                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                    @error('email')
                    <span class="text-danger text-start w-100 ps-3">{{ $message }}</span>
                    @enderror
                    <input type="password" name="password" placeholder="Password" required />
                    @error('password')
                    <span class="text-danger text-start w-100 ps-3">{{ $message }}</span>
                    @enderror
                    <div class="text-center">
                        <a href="{{ route('forgot.password') }}" class="forgot-password-btn">Forgot Password?</a>
                    </div>
                    <button type="submit">Sign In</button>
                </form>
            </div>

            <div class="toggle-container">
                <div class="toggle">

                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Subscriber!</h1>
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
        .login-signup-page{
            background: linear-gradient(to right, #f0953a, #b01920);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 100vh;
        }

        .login-signup-page .container{
            background-color: white;
            border-radius: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .35);
            position: relative;
            overflow: hidden;
            width: 768px;
            max-width: 100%;
            min-height: 480px;
        }

        .login-signup-page .container p{
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

        .container span{
            font-size: 12px;
        }

        .login-signup-page .container a{
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

        .login-signup-page .container button{
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

        .login-signup-page .container .forgot-password-btn{
            color: #0a3622;
            text-align: start;
        }

        .login-signup-page .container form{
            background-color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 40px 0;
            height: 100%;
        }

        .login-signup-page .container input{
            background-color: #eee;
            border: none;
            margin: 8px 0;
            padding: 10px 15px;
            font-size: 13px;
            border-radius: 8px;
            width: 100%;
            outline: none;
        }

        .login-signup-page .form-container{
            position: absolute;
            top: 0;
            height: 100%;
            width: 50%;
            padding: 20px 20px 20px 0;
            transition: all .6s ease-in-out;
        }

        .login-signup-page .toggle-container{
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

        .login-signup-page .container.active .toggle-container{
            transform: translateX(-100%);
            border-radius: 0 80px 80px 0;
        }

        .login-signup-page .toggle{
            height: 100%;
            background: linear-gradient(to right, #f79a3f, #b01920);
            color: #fff;
            position: relative;
            left: 0%;
            width: 100%;
        }

        .login-signup-page .toggle-panel{
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

@push('scripts')
    <script>
        // ---- CSRF Token Auto-Refresh for Login Form ----
        // This prevents 419 errors on mobile and desktop by ensuring
        // the CSRF token is always fresh before form submission.

        (function() {
            var loginForm = document.getElementById('loginForm');
            if (!loginForm) return;

            // 1. Force reload if page is loaded from bfcache (Back-Forward Cache)
            window.addEventListener('pageshow', function(event) {
                if (event.persisted) {
                    window.location.reload();
                }
            });

            // 2. Refresh CSRF token when the page becomes visible again (tab switch, screen unlock)
            document.addEventListener('visibilitychange', function() {
                if (document.visibilityState === 'visible') {
                    refreshCsrfToken();
                }
            });

            // 3. Refresh CSRF token when the window regains focus
            window.addEventListener('focus', function() {
                refreshCsrfToken();
            });

            // 4. Intercept form submission: fetch a fresh token before submitting
            loginForm.addEventListener('submit', function(event) {
                event.preventDefault();
                var form = this;
                var submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.textContent = 'Signing In...';
                }

                // Fetch a fresh CSRF token, then submit
                fetch('{{ route("login") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    },
                    credentials: 'same-origin'
                })
                .then(function(response) { return response.text(); })
                .then(function(html) {
                    // Extract fresh CSRF token from the fetched page
                    var match = html.match(/name="_token"[^>]*value="([^"]+)"/);
                    if (match && match[1]) {
                        var tokenInput = form.querySelector('input[name="_token"]');
                        if (tokenInput) {
                            tokenInput.value = match[1];
                        }
                        // Also update the meta tag
                        var metaToken = document.querySelector('meta[name="csrf-token"]');
                        if (metaToken) {
                            metaToken.setAttribute('content', match[1]);
                        }
                    }
                    // Now submit the form with the fresh token
                    form.submit();
                })
                .catch(function() {
                    // If fetch fails, submit anyway (let server handle it)
                    form.submit();
                });
            });

            // Helper: refresh the CSRF token silently
            function refreshCsrfToken() {
                fetch('{{ route("login") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'text/html'
                    },
                    credentials: 'same-origin'
                })
                .then(function(response) { return response.text(); })
                .then(function(html) {
                    var match = html.match(/name="_token"[^>]*value="([^"]+)"/);
                    if (match && match[1]) {
                        var tokenInput = document.querySelector('#loginForm input[name="_token"]');
                        if (tokenInput) {
                            tokenInput.value = match[1];
                        }
                        var metaToken = document.querySelector('meta[name="csrf-token"]');
                        if (metaToken) {
                            metaToken.setAttribute('content', match[1]);
                        }
                    }
                })
                .catch(function() {
                    // Silent fail - next submit will attempt refresh anyway
                });
            }
        })();
    </script>
@endpush

