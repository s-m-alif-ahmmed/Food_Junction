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
                    <a class="nav-link fw-bold" href="#">Sweets</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-bold" href="#">Concept</a>
                </li>
            </ul>

        </div>

        <div class="d-flex justify-content-end" id="navbarSupportedContent">
            <div class="d-none d-lg-block px-2">
                @if(Auth::check())
                    @if(Auth::user()->role == 'Super Admin')
                    <a href="{{ route('dashboard') }}">
                        <i class="fa-regular fa-user text-dark"></i>
                    </a>
                    @elseif(Auth::user()->role == 'Admin')
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="fa-regular fa-user text-dark"></i>
                        </a>
                    @elseif(Auth::user()->role == 'User')
                        <a href="{{ route('user.dashboard') }}">
                            <i class="fa-regular fa-user text-dark"></i>
                        </a>
                        <a href="" onclick="event.preventDefault(); document.getElementById('logoutForm').submit()">
                            Logout
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
                <a href="">
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
