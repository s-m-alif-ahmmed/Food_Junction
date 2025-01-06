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
                <form id="searchForm" method="GET">
                    @csrf
                    <div class="input-group search-modal mb-3">
                        <input type="text" class="form-control search-input" name="search" id="search" placeholder="Search product" aria-label="Search product" aria-describedby="basic-addon2">
                        <button type="button" id="searchButton" class="input-group-text">
                            <img src="{{ asset('frontend/images/icons/search.svg') }}" alt="Search">
                        </button>
                    </div>
                </form>

                <div id="search-list" style="height: 500px; overflow-y: scroll; overflow-x: hidden;">
                    <!-- Search results will be dynamically inserted here -->
                </div>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            // Search button click handler
            $('#searchButton').on('click', function () {
                var value = $('#search').val().trim(); // Get and trim the input value

                if (value.length > 0) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('search') }}",
                        data: { search: value },
                        success: function (response) {
                            if (response.searchProducts && response.searchProducts.length > 0) {
                                renderSearchResults(response.searchProducts);
                            } else {
                                $('#search-list').html('<p class="text-muted text-center">No Product Found!</p>');
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX Error:", error);
                            $('#search-list').html('<p class="text-muted text-center">Error fetching products!</p>');
                        }
                    });
                } else {
                    $('#search-list').empty(); // Clear results if input is empty
                }
            });

            // Function to render search results
            function renderSearchResults(searchProducts) {
                let html = '';
                searchProducts.forEach(function (product) {
                    html += `
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-3 col-sm-3 col-3">
                                <a class="text-decoration-none text-black" href="/product/detail/${product.product_slug}">
                                    <img src="/${product.image}" class="img-fluid rounded-start" alt="${product.name}" style="height: 100px;">
                                </a>
                            </div>
                            <div class="col-md-9 col-sm-9 col-9">
                                <div class="card-body">
                                    <a class="text-decoration-none text-black" href="/product/detail/${product.product_slug}">
                                        <h5 class="card-title fs-18 fsw-bold">${product.name}</h5>
                                        <p class="card-text fs-14">${product.price} টাকা (<span><del class="text-danger">${product.discount_price} টাকা</del></span>)</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
                $('#search-list').html(html); // Update the search list
            }
        });
    </script>

@endpush


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
                <a class="text-decoration-none text-black" href="{{ route('products') }}">All Categories</a>
            </li>
            @foreach($categories as $category)
                <li class="list-unstyled">
                    <a class="text-decoration-none text-black" href="{{ route('category.products', $category->category_slug) }}">{{ $category->name }}</a>
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
