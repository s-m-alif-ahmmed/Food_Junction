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
                    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($home_banners as $image)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    @php
                                        $offer = $image->offers->first();
                                    @endphp
                                    @if($offer)
                                        <a href="{{ route('offer.detail', $offer->id) }}">
                                            <img src="{{ asset( $image->image ?? '/frontend/images/section/home/hero_banner.png') }}" class="d-block w-100" alt="{{ $offer->name }}">
                                        </a>
                                    @else
                                        <img src="{{ asset( $image->image ?? '/frontend/images/section/home/hero_banner.png') }}" class="d-block w-100" alt="Banner">
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
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
                @forelse($offer_products->take(4) as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-0 mb-3 h-100">
                                <h5 class="fsw-bold">{{ $product->name }}</h5>
                                <p class="fsw-semibold">{{ $product->discount_price ?? $product->price }} টাকা @if($product->discount_price)( <span class="text-danger"><del>{{ $product->price }} টাকা</del></span> ) @endif </p>
                                <a href="{{ route('product.detail', $product->product_slug) }}" class="order-now-btn w-auto fw-bold">Order Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No offer products available at the moment.</p>
                    </div>
                @endforelse
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
                @foreach($all_products as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-0 mb-3 h-100">
                                <h5 class="fsw-bold">{{ $product->name }}</h5>
                                <p class="fsw-semibold">{{ $product->discount_price ?? $product->price }} টাকা @if($product->discount_price)( <span class="text-danger"><del>{{ $product->price }} টাকা</del></span> ) @endif </p>
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
                        <img class="image img-fluid w-100" src="{{ asset( $home_bottom_banner->image ?? 'frontend/images/section/home/bottom-banner.png') }}" />
                        <div class="text">{{ $home_bottom_banner->title ?? 'Are you ready to order with the best deals?' }}</div>
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
