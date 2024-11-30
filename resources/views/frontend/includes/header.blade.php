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
{{--                <li class="nav-item">--}}
{{--                    <a class="nav-link fw-bold" href="#">Concept</a>--}}
{{--                </li>--}}
            </ul>

        </div>

        <div class="d-flex justify-content-end" id="navbarSupportedContent">
            <div class="d-none d-lg-block px-2">
                @if(Auth::check())
                    @if(Auth::user()->role == 'Super Admin')
                        <a href="{{ route('dashboard') }}">
                            <i class="fa-regular fa-user text-dark"></i>
                        </a>
                        <a href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                        </a>
                        <form action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                        </form>
                    @elseif(Auth::user()->role == 'Admin')
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-regular fa-user text-dark"></i>
                        </a>
                        <a href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                        </a>
                        <form action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                        </form>
                    @elseif(Auth::user()->role == 'User')
                        <a href="{{ route('user.dashboard') }}">
                            <i class="fa-regular fa-user text-dark"></i>
                        </a>
                        <a href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
                        </a>
                        <form action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                        </form>

                    @endif
                @else
                    <a href="{{ route('login') }}">
                        <i class="fa-regular fa-user text-dark"></i>
                    </a>
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
