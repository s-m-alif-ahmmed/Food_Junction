@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Food Junction
@endsection

@section('content')

    <section class="login-signup-page py-5">
        <div class="container" id="container">

            <div class="form-container sign-up">
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <h1>Create Account</h1>

{{--                    <div class="social-icons">--}}
{{--                        <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>--}}
{{--                        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>--}}
{{--                        <a href="#" class="icon"><i class="fa-brands fa-youtube"></i></a>--}}
{{--                        <a href="#" class="icon"><i class="fa-brands fa-x-twitter"></i></a>--}}
{{--                    </div>--}}

                    <span>or use your email for register</span>

                    <input type="text" name="name" placeholder="Full Name" required />
                    @error('name')
                    <span class="textt-danger">{{ $message }}</span>
                    @enderror
                    <input type="email" name="email" placeholder="Email" required />
                    @error('email')
                    <span class="textt-danger">{{ $message }}</span>
                    @enderror
                    <input type="password" name="password" placeholder="Password" required autocomplete="new-password" />
                    @error('password')
                    <span class="textt-danger">{{ $message }}</span>
                    @enderror
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password" />
                    @error('confirm_password')
                    <span class="textt-danger">{{ $message }}</span>
                    @enderror
                    <button type="submit">Sign Up</button>
                </form>
            </div>

            <div class="form-container sign-in">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <h1>Sign In</h1>
{{--                    <div class="social-icons">--}}
{{--                        <a href="#" class="icon"><i class="fa-brands fa-google"></i></a>--}}
{{--                        <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>--}}
{{--                        <a href="#" class="icon"><i class="fa-brands fa-youtube"></i></a>--}}
{{--                        <a href="#" class="icon"><i class="fa-brands fa-x-twitter"></i></a>--}}
{{--                    </div>--}}
                    <span>or use your email and password</span>
                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required />
                    @error('email')
                    <span class="textt-danger">{{ $message }}</span>
                    @enderror
                    <input type="password" name="password" placeholder="Password" required />
                    @error('password')
                    <span class="textt-danger">{{ $message }}</span>
                    @enderror
                    <a href="#">Forgot Password?</a>
                    <button type="submit">Sign In</button>
                </form>
            </div>

            <div class="toggle-container">
                <div class="toggle">

                    <div class="toggle-panel toggle-left">
                        <h1>Welcome Back!</h1>
                        <p>Enter your personal details to use all of site features.</p>
                        <button class="hidden" id="login">Sign In</button>
                    </div>

                    <div class="toggle-panel toggle-right">
                        <h1>Hello, Subscriber!</h1>
                        <p>Register with your personal details to use all of site features.</p>
                        <button class="hidden" id="register">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        .login-signup-page{
            background-color: #c9d6ff;
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

        .container span{
            font-size: 12px;
        }

        .login-signup-page .container a{
            color: #333;
            font-size: 13px;
            text-decoration: none;
            margin: 15px 0 10px;
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

        .login-signup-page .container button.hidden{
            background-color: transparent;
            border-color: #fff;
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
            transition: all .6s ease-in-out;
        }

        .login-signup-page .sign-in{
            left: 0;
            width: 50%;
            z-index: 2;
        }

        .login-signup-page .container.active .sign-in{
            transform: translateX(100%);
        }

        .login-signup-page .sign-up{
            left: 0;
            width: 50%;
            opacity: 0;
            z-index: 1;
        }

        .login-signup-page  .container.active .sign-up{
            transform: translateX(100%);
            opacity: 1;
            z-index: 5;
            animation: move .6s;
        }

        @keyframes move{
            0%, 49.99%{
                opacity: 0;
                z-index: 1;
            }
            50%, 100%{
                opacity: 1;
                z-index: 5;
            }
        }

        /*.login-signup-page  .social-icons{*/
        /*    margin: 20px 0;*/
        /*}*/

        /*.login-signup-page .social-icons a{*/
        /*    border: 1px solid #ccc;*/
        /*    color: #ffffff;*/
        /*    background-color: #B77128;*/
        /*    border-radius: 20%;*/
        /*    display: inline-flex;*/
        /*    justify-content: center;*/
        /*    align-items: center;*/
        /*    margin: 0 3px;*/
        /*    width: 40px;*/
        /*    height: 40px;*/
        /*}*/

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
            background-color: #b01920;
            height: 100%;
            background: linear-gradient(to right, #f79a3f, #b01920);
            color: #fff;
            position: relative;
            left: -100%;
            height: 100%;
            width: 200%;
            transform: translate(0);
            transition: all .6s ease-in-out;
        }

        .login-signup-page .container.container.active .toggle{
            transform: translateX(50%);
        }

        .login-signup-page .toggle-panel{
            position: absolute;
            width: 50%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 0 30px;
            text-align: center;
            top: 0;
            transform: translateX(0);
            transition: all .6s ease-in-out;
        }

        .login-signup-page .toggle-left{
            transform: translateX(-200%);
        }

        .login-signup-page .container.active .toggle-left{
            transform: translateX(0);
        }

        .login-signup-page .toggle-right{
            right: 0;
            transform: translateX(0);
        }

        .login-signup-page .container.active .toggle-right{
            transform: translateX(200%);
        }

    </style>
@endpush

@push('scripts')
    <script>
        const container = document.getElementById("container");
        const registerBtn = document.getElementById("register");

        const loginBtn = document.getElementById("login");

        registerBtn.addEventListener("click", () => {
            container.classList.add("active");
        });

        loginBtn.addEventListener("click", () => {
            container.classList.remove("active");
        });

    </script>
@endpush
