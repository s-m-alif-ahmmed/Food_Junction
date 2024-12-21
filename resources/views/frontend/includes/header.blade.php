<nav class="navbar navbar-expand-lg bg-white navbar-nav sticky-top">
    <div class="container justify-content-between">
        <button class="navbar-toggler ms-auto justify-content-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="">
            <div class="justify-content-start">
                <button class="btn border-0">
                    <i class="fa-solid fa-magnifying-glass text-dark"></i>
                </button>
            </div>
        </div>

        <div class="justify-content-center">
            <a class="navbar-brand justify-content-center" href="{{ route('home') }}">
                <img class="img-fluid header-img" src="{{ asset('/frontend/images/brands/food_junction.png') }}" alt="" style="max-height: 50px;">
            </a>
        </div>

        <div class="d-flex justify-content-end">
            <div class="d-none d-lg-block px-2">
                @if(Auth::check())
                    @if(Auth::user()->role == 'Super Admin')
                        <div class="dropdown-center p-0 m-0" id="navbarNavDarkDropdown">
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

                        <div class="dropdown-center p-0 m-0" id="navbarNavDarkDropdown">
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
                        <div class="dropdown-center p-0 m-0" id="navbarNavDarkDropdown">
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
                    <div class="dropdown-center p-0 m-0" id="navbarNavDarkDropdown">
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
