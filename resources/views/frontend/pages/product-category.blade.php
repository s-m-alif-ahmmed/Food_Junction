@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    {{ $category->name }} - Products | Food Junction
@endsection

@section('content')

    @include('frontend.includes.top-nav-button')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">{{ $category->name }}</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="row py-3">
                    @foreach($products as $product)
                        <div class="col-lg-3 col-md-3 col-sm-6 col-6 special-sweet-card">
                            <div class="card border-0 custom-shadow">
                                <div class="sweet-image">
                                    <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                                </div>
                                <div class="card-body border-0 mb-3 h-100">
                                    <h5 class="fsw-bold">{{ $product->name }}</h5>
                                    @php
                                        $minVariant = $product->variants
                                             ->where('status', 'Active')
                                             ->sortBy(function($variant) {
                                                 return $variant->sale_price ?? $variant->price;
                                             })
                                             ->first();

                                         $price = $minVariant?->price ?? 0;
                                         $discount = $minVariant?->sale_price;
                                         $quantity = $minVariant?->quantity;
                                         $unit = $minVariant?->unit;
                                         $variantType = $minVariant?->variant_type;
                                    @endphp
                                    <div class="d-flex justify-content-between">
                                        <p class="fsw-semibold">
                                            {{ number_format($discount ?? $price, 0) }} টাকা
                                            @if($discount)
                                                (
                                                <span class="text-danger">
                                                <del>{{ number_format($price, 0) }} টাকা</del>
                                            </span>
                                                )
                                            @endif
                                        </p>

                                        <p class="fsw-semibold me-1">
                                            {{ $quantity }} {{ $unit }}
                                            ({{ strtoupper($variantType) }})
                                        </p>
                                    </div>
                                    <a href="{{ route('product.detail', $product->product_slug) }}" class="order-now-btn w-auto fw-bold">Order Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
