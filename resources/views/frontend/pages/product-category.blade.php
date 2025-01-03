@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Products | Food Junction
@endsection

@section('content')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">All Products</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="row py-3">
                    @foreach($products as $product)
                        <div class="col-md-4 special-sweet-card">
                            <div class="card border-0 custom-shadow">
                                <div class="sweet-image">
                                    <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name ?? 'No Product' }}">
                                </div>
                                <div class="card-body border-0 text-center mb-3 h-100">
                                    <h5 class="card-title fsw-bold">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->short_description }}</p>
                                    <a href="{{ route('product.detail', $product->product_slug) }}" class="order-now-btn fw-bold">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
