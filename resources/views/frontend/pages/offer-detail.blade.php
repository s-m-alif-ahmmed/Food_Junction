@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="{{ $offer->description ?? 'Special Offer Products' }}">
    <meta name="keywords" content="Food Junction, Offers, {{ $offer->name }}">
@endsection

@section('title')
    {{ $offer->name }} | Food Junction
@endsection

@section('content')

    @include('frontend.includes.top-nav-button')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">{{ $offer->name }}</p>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row pt-3 pb-5">
                @forelse($products as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 special-sweet-card mb-4">
                        <div class="card border-0 custom-shadow h-100">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-0 mb-3 d-flex flex-column">
                                <h5 class="fsw-bold">{{ $product->name }}</h5>
                                <p class="fsw-semibold mt-auto">
                                    {{ $product->discount_price ?? $product->price }} টাকা
                                    @if($product->discount_price)
                                        ( <span class="text-danger"><del>{{ $product->price }} টাকা</del></span> )
                                    @endif
                                </p>
                                <a href="{{ route('product.detail', $product->product_slug) }}" class="order-now-btn w-auto fw-bold">Order Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No products found for this offer.</h4>
                        <a href="{{ route('home') }}" class="btn background-gradient text-white mt-3">Back to Home</a>
                    </div>
                @endforelse

                <div class="col-12 mt-4 d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

@endsection
