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

    @include('frontend.includes.top-nav-button')


    <section class="hero-section">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('/frontend/images/section/home/hero_banner.png') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('/frontend/images/section/home/hero_banner.png') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('/frontend/images/section/home/hero_banner.png') }}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid pb-3">
            <div class="row background-gradient">
                <div class="col-lg-12 text-center">
                    <p class="fs-40 fsw-semibold text-white">Offer Products</p>
                </div>
            </div>
        </div>

        <div class="container pb-5">
            <div class="row">
                @foreach($products->take(4) as $product)
                    <div class="col-lg-3 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-0 mb-3 h-100">
                                <h5 class="fsw-bold">{{ $product->name }}</h5>
                                <p class="fsw-semibold">{{ $product->price }} টাকা ( <span class="text-danger"><del>৮৫০ টাকা</del></span> )</p>
                                <a href="{{ route('sweets.detail', $product->product_slug) }}" class="order-now-btn w-auto fw-bold">Order Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container-fluid pb-3">
            <div class="row background-gradient">
                <div class="col-lg-12 text-center">
                    <p class="fs-40 fsw-semibold text-white">All Products</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row pb-5">
                <div class="row py-3">
                    @foreach($products as $product)
                        <div class="col-lg-3 special-sweet-card">
                            <div class="card border-0 custom-shadow">
                                <div class="sweet-image">
                                    <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                                </div>
                                <div class="card-body border-0 mb-3 h-100">
                                    <h5 class="fsw-bold">{{ $product->name }}</h5>
                                    <p class="fsw-semibold">{{ $product->price }} টাকা ( <span class="text-danger"><del>৮৫০ টাকা</del></span> )</p>
                                    <a href="{{ route('sweets.detail', $product->product_slug) }}" class="order-now-btn w-auto fw-bold">Order Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container-fluid bottom-banner" style="background-image: url('../frontend/images/section/home/bottom-banner.png')">
            <div class="row">
                <div class="col-md-5 justify-content-center mx-auto">
                    <p class="text-center fs-52 text-white fw-bold">Are you ready to order with the best deals?</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 justify-content-center mx-auto">
                    <a href="{{ route('sweets') }}" class="text-decoration-none text-white fs-24 fsw-bold bg-danger rounded-2 px-5 py-2 ">Proceed To Order</a>
                </div>
            </div>
        </div>

    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>

    <script type="text/javascript">
        $(document).on('ready', function() {
            $(".center").slick({
                dots: false,
                infinite: false,
                centerMode: false,
                autoplay: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 992, // Mobile breakpoint
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            autoplay: true,        // Enable auto slide in mobile view
                            autoplaySpeed: 2000,   // Auto slide every 2 seconds
                            infinite: true,        // Infinite scrolling in mobile view
                            dots: true             // Enable dots in mobile view if needed
                        }
                    },
                    {
                        breakpoint: 768, // Mobile breakpoint
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: true,        // Enable auto slide in mobile view
                            autoplaySpeed: 2000,   // Auto slide every 2 seconds
                            infinite: true,        // Infinite scrolling in mobile view
                            dots: true             // Enable dots in mobile view if needed
                        }
                    }
                ]
            });
            $(".testimonial").slick({
                dots: true,
                infinite: true,
                centerMode: false,
                autoplay: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 768, // Mobile breakpoint
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: true,        // Enable auto slide in mobile view
                            autoplaySpeed: 2000,   // Auto slide every 2 seconds
                            infinite: true,        // Infinite scrolling in mobile view
                            dots: true             // Enable dots in mobile view if needed
                        }
                    }
                ]
            });
        });
    </script>

@endsection
