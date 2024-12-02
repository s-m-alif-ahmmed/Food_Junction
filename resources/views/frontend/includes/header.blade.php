<nav class="navbar navbar-expand-lg bg-white navbar-nav sticky-top">
    <div class="container justify-content-between">
        <a class="navbar-brand" href="{{ route('home') }}">
            <img class="img-fluid header-img" src="{{ asset('/frontend/images/brands/food_junction.png') }}" alt="" style="max-height: 50px;">
        </a>

        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-sm-0 text-center mx-auto mx-sm-auto">
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('sweets') }}">Sweets</a>
                </li>
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link fw-bold" href="#">About Us</a>--}}
{{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="{{ route('contact') }}">Contact</a>
                </li>
                @if(Auth::check())
                    @if(Auth::user()->role == 'Super Admin')
                        <li class="nav-item d-lg-none d-md-none d-sm-block">
                            <a class="nav-link fw-bold" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                    @elseif(Auth::user()->role == 'Admin')
                        <li class="nav-item d-lg-none d-md-none d-sm-block">
                            <a class="nav-link fw-bold" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                    @elseif(Auth::user()->role == 'User')
                        <li class="nav-item d-lg-none d-md-none d-sm-block">
                            <a class="nav-link fw-bold" href="{{ route('user.dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item d-lg-none d-md-none d-sm-block">
                        <a class="nav-link fw-bold" href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">Logout</a>
                        <form action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item d-lg-none d-md-none d-sm-block">
                        <a class="nav-link fw-bold" href="{{ route('login') }}">Login/Register</a>
                    </li>
                @endif
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link fw-bold" href="#">Concept</a>--}}
{{--                </li>--}}
            </ul>

        </div>

        <div class="d-flex justify-content-end" id="navbarSupportedContent">
            <div class="d-none d-lg-block px-2">
                @if(Auth::check())
                    @if(Auth::user()->role == 'Super Admin')
                        <div class="collapse navbar-collapse dropdown-center p-0 m-0" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav dropdown-center p-0 m-0">
                                <li class="nav-item dropdown dropdown-center p-0 m-0">
                                    <button class="btn m-0 p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-user text-dark"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                                                Logout
                                            </a>
                                            <form action="{{ route('logout') }}" method="post" id="logoutForm">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    @elseif(Auth::user()->role == 'Admin')

                        <div class="collapse navbar-collapse dropdown-center p-0 m-0" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav dropdown-center p-0 m-0">
                                <li class="nav-item dropdown dropdown-center p-0 m-0">
                                    <button class="btn m-0 p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-user text-dark"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                                                Logout
                                            </a>
                                            <form action="{{ route('logout') }}" method="post" id="logoutForm">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    @elseif(Auth::user()->role == 'User')
                        <div class="collapse navbar-collapse dropdown-center p-0 m-0" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav dropdown-center p-0 m-0">
                                <li class="nav-item dropdown dropdown-center p-0 m-0">
                                    <button class="btn m-0 p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-user text-dark"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                                Dashboard
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                                                Logout
                                            </a>
                                            <form action="{{ route('logout') }}" method="post" id="logoutForm">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                    @endif
                @else
                    <div class="collapse navbar-collapse dropdown-center p-0 m-0" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav dropdown-center p-0 m-0">
                            <li class="nav-item dropdown dropdown-center p-0 m-0">
                                <button class="btn m-0 p-0" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-regular fa-user text-dark"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('login') }}">Login/Register</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                @endif
            </div>
            <div class="d-none d-lg-block px-2">
                <a href="{{ route('cart') }}">
                    <i class="fa-solid fa-cart-shopping text-dark"></i>
                </a>
            </div>
            <div class="d-none d-lg-block px-2">
                <a href="">
                    <i class="fa-solid fa-magnifying-glass text-dark"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    .btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active{
        border: none;
    }
    .dropdown-menu{
        justify-content: center;
    }
</style>
