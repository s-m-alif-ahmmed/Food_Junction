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
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">Offer Products</p>
                </div>
            </div>
        </div>

        <div class="container pb-5">
            <div class="row py-3">
                @foreach($products->take(4) as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-0 mb-3 h-100">
                                <h5 class="fsw-bold">{{ $product->name }}</h5>
                                <p class="fsw-semibold">{{ $product->price }} টাকা ( <span class="text-danger"><del>৮৫০ টাকা</del></span> )</p>
                                <a href="{{ route('product.detail', $product->product_slug) }}" class="order-now-btn w-auto fw-bold">Order Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">All Products</p>
                </div>
            </div>
        </div>

        <div class="container pb-5">
            <div class="row py-3">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-0 mb-3 h-100">
                                <h5 class="fsw-bold">{{ $product->name }}</h5>
                                <p class="fsw-semibold">{{ $product->price }} টাকা ( <span class="text-danger"><del>৮৫০ টাকা</del></span> )</p>
                                <a href="{{ route('product.detail', $product->product_slug) }}" class="order-now-btn w-auto fw-bold">Order Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container-fluid p-0 m-0 overflow-hidden bottom-banner">
            <div class="row">
                <div class="cta-footer">
                    <div class="cta">
                        <img class="image img-fluid w-100" src="{{ asset('frontend/images/section/home/bottom-banner.png') }}" />
                        <div class="text">Are you ready to order with the best deals?</div>
                        <a href="{{ route('products') }}" class="button">
                            <div class="text2">Proceed to order</div>
                            <div class="icon">
                                <img src="{{ asset('frontend/images/icons/arrow.svg') }}" alt="">
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
