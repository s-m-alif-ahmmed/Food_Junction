@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Cart | Food Junction
@endsection

@php

    if (!function_exists('englishToBengali')) {
        function englishToBengali($englishString) {
            $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $bengaliNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            return strtr($englishString, array_combine($englishNumbers, $bengaliNumbers));
        }
    }

    if (!function_exists('banglaToEnglish')) {
        function banglaToEnglish($bengaliString) {
            $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $bengaliNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            return strtr($bengaliString, array_combine($bengaliNumbers, $englishNumbers));
        }
    }

@endphp

@section('content')

    <section class="cart-page">
        <div class="container-fluid">
            <div class="row background-gradient">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold text-white mt-3 mb-0 fs-32">My Cart</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23ffffff'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-white">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">My Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row bg-black text-center">
                <p class="fs-20 text-white mb-1">Order Only For Dhaka</p>
            </div>
        </div>
        <div class="container my-4">
            <div class="row">
                @if(isset($cart) && $cart->items->isNotEmpty())

                    <div class="col-md-8 py-2">
                        <div class="card p-3">
                            @foreach($cart->items as $item)

                                <div class="row border-bottom py-2">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-3">
                                        <a href="{{ route('product.detail', $item->product->product_slug ?? '') }}">
                                            <div class="cart-img">
                                                <img src="{{ asset($item->product->image ?? '/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-7">
                                        <div>
                                            <div>
                                                <a href="{{ route('product.detail', $item->product->product_slug ?? '') }}" class="sweet-name">
                                                    {{ $item->product->name ?? 'Product Name' }}
                                                </a>
                                            </div>
                                            <div>
                                                <span class="cart-weight">
                                                    @if($item->variant_unit)
                                                        {{ $item->variant_unit }}
                                                    @elseif($item->unit_type == 'kg')
                                                        {{ $item->unit_value < 1000 ? englishToBengali($item->unit_value) . ' গ্রাম' : englishToBengali($item->unit_value / 1000) . ' কেজি' }}
                                                    @else
                                                        {{ $item->quantity }} pcs
                                                    @endif
                                                </span>
                                                <p class="cart-price">{{ $item->unit_price }}Tk
                                                    @if($item->product && $item->product->discount_price)
                                                        <span class="discount-price">(<del>{{ $item->product->price }}Tk</del>)</span>
                                                    @endif
                                                </p>
                                                <span class="single-cart-total-price">
                                                    Total: {{ englishToBengali($item->total_price) ?? '0' }}Tk
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                        <form action="{{ route('remove.cart', ['id' => $item->product_id]) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('POST')

                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}" />

                                            <button type="submit" class="btn p-0 m-0 border-0 bg-transparent">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="col-md-4 py-2">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="fsw-bold fs-20">Order Summery</p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Subtotal</p>
                                    <p class="fsw-semibold">{{ englishToBengali($cart->subtotal) }}Tk</p>
                                </div>
                                @if($cart->discount > 0)
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <p>Discount</p>
                                        <p class="fsw-semibold">-{{ englishToBengali($cart->discount) }}Tk</p>
                                    </div>
                                @endif
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Delivery Fee</p>
                                    <p class="fsw-semibold">
                                        {{ $cart->delivery_fee <= 0 ? 'Free' : englishToBengali($cart->delivery_fee). 'Tk' }}
                                    </p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p class="fsw-semibold">Total</p>
                                    <p class="fsw-semibold">{{ englishToBengali($cart->total) }}Tk</p>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('checkout') }}" class="btn background-gradient text-white border-0 w-100 fs-18 fsw-semibold">Go To Checkout <i class="fa-solid fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-12 text-center">
                        <div class="">
                            <p class="fsw-semibold fs-20">Your cart is currently empty.</p>
                        </div>
                        <div class="">
                            <a href="{{ route('products') }}" class="btn review-btn">Return to products</a>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </section>

@endsection

@push('scripts')
    <script>
        // Trigger toaster based on session messages
        @if (session('t-success'))
        showSuccessToast("{{ session('t-success') }}");
        @endif

        @if (session('t-error'))
        showErrorToast("{{ session('t-error') }}");
        @endif
    </script>

@endpush
