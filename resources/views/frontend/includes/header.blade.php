<nav class="navbar navbar-expand-lg bg-white navbar-nav sticky-top">
    <div class="container justify-content-between">
        <button class="navbar-toggler justify-content-start text-yellow border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sideNavbar" aria-controls="staticBackdrop">
            <img src="{{ asset('frontend/images/icons/dot-bar.svg') }}" />
        </button>

        <div class="d-lg-block d-md-none d-sm-none d-none">
            <div class="justify-content-start">
                <button class="btn border-0" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <img src="{{ asset('frontend/images/icons/search.svg') }}" alt="">
                </button>
            </div>
        </div>

        <div class="justify-content-center">
            <a class="navbar-brand justify-content-center" href="{{ route('home') }}">
                <img class="img-fluid header-img" src="{{ asset('/frontend/images/brands/food_junction.png') }}" alt="" style="max-height: 50px;">
            </a>
        </div>

        <div class="d-flex justify-content-end">
            <div class="d-lg-block d-md-none d-sm-none d-none px-2">
                @if(Auth::check())
                    @if(Auth::user()->role == 'Super Admin')
                        <div class="border-0 dropdown-hover" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item border-0">
                                    <div class="dropdown-center">
                                        <button class="btn m-0 p-0 border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-user text-yellow"></i>
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
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @elseif(Auth::user()->role == 'Admin')
                        <div class="border-0 dropdown-hover" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item border-0">
                                    <div class="dropdown-center">
                                        <button class="btn m-0 p-0 border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-user text-yellow"></i>
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
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @elseif(Auth::user()->role == 'User')
                        <div class="border-0 dropdown-hover" id="navbarNavDarkDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item border-0">
                                    <div class="dropdown-center">
                                        <button class="btn m-0 p-0 border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa-regular fa-user text-yellow"></i>
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
                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endif
                @else
                    <div class="border-0 dropdown-hover" id="navbarNavDarkDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item border-0">
                                <div class="dropdown-center">
                                    <button class="btn m-0 p-0 border-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-regular fa-user text-yellow"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('login') }}">
                                                Login/Register
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endif
            </div>
            <div class="d-flex px-2">
                <div class="d-lg-none d-md-block d-sm-block d-block">
                    <button class="btn py-0 my-0 border-0" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <img src="{{ asset('frontend/images/icons/search.svg') }}" />
                    </button>
                </div>
                <div class="">
                    <a href="{{ route('cart') }}">
                        <img src="{{ asset('frontend/images/icons/shopping-cart.svg') }}" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Search</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="" method="POST" >
                    @csrf
                    @method('GET')

                    <div class="input-group search-modal mb-3">
                        <input type="text" class="form-control search-input" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <button type="submit" class="input-group-text" id="basic-addon2">
                            <img src="{{ asset('frontend/images/icons/search.svg') }}" alt="">
                        </button>
                    </div>

                </form>

                <p class="text-muted text-center">No Product Found!</p>
            </div>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="sideNavbar" aria-labelledby="staticBackdropLabel">
    <div class="offcanvas-header">
        <a class="navbar-brand justify-content-center" href="{{ route('home') }}">
            <img class="img-fluid header-img" src="{{ asset('/frontend/images/brands/food_junction.png') }}" alt="" style="max-height: 50px;">
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <?php
        $categories = \App\Models\Category::where('status', 'active')->latest()->get()
        ?>
        <ul>
            <li class="list-unstyled">
                <a class="text-decoration-none text-black" href="">All Categories</a>
            </li>
            @foreach($categories as $category)
                <li class="list-unstyled">
                    <a class="text-decoration-none text-black" href="">{{ $category->name }}</a>
                </li>
            @endforeach
            @if(Auth::check())
                @if(Auth::user()->role == 'Super Admin')
                    <li class="list-unstyled">
                        <a class="text-decoration-none text-black" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <a class="text-decoration-none text-black" href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            Logout
                        </a>
                    </li>
                    <form action="{{ route('logout') }}" method="post" id="logoutForm">
                        @csrf
                    </form>
                @elseif(Auth::user()->role == 'Admin')
                    <li class="list-unstyled">
                        <a class="text-decoration-none text-black" href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <a class="text-decoration-none text-black" href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            Logout
                        </a>
                    </li>
                    <form action="{{ route('logout') }}" method="post" id="logoutForm">
                        @csrf
                    </form>
                @elseif(Auth::user()->role == 'User')
                    <li class="list-unstyled">
                        <a class="text-decoration-none text-black" href="{{ route('user.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="list-unstyled">
                        <a class="text-decoration-none text-black" href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            Logout
                        </a>
                    </li>
                    <form action="{{ route('logout') }}" method="post" id="logoutForm">
                        @csrf
                    </form>
                @endif
            @else
                <li class="list-unstyled">
                    <a class="text-decoration-none text-black" href="{{ route('login') }}">
                        Login/Register
                    </a>
                </li>
            @endif
        </ul>
    </div>
</div>


<style>
    .btn-check:checked+.btn, .btn.active, .btn.show, .btn:first-child:active, :not(.btn-check)+.btn:active{
        border: none;
    }
    .dropdown-menu{
        justify-content: center;
    }

    .dropdown-hover:hover .dropdown-menu {
        display: block;
        opacity: 1;
        visibility: visible;
    }
    .dropdown-menu {
        display: none;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease-in-out, visibility 0.2s ease-in-out;
    }

    .offcanvas-body{
        padding: 0;
    }

    .offcanvas-body ul>li{
        padding-top: 10px;
    }

    .btn-close:focus{
        box-shadow: none;
        outline: none;
    }

    .search-input:focus{
        box-shadow: none;
        outline: none;
        border: 1px solid var(--yellow);
    }

    .search-input,
    .search-modal button{
        border: 1px solid var(--yellow);
    }

</style>
