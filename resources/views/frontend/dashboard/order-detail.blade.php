@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Order Details | Dashboard
@endsection

@push('styles')
    <style>

    </style>
@endpush

@section('content')

    <section class="user-dashboard-page">
        <div class="container-fluid">
            <div class="row background-gradient">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold text-white mt-3 mb-0 fs-32">My Profile</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23ffffff'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-white">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">My Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row py-3">
                <div class="col-lg-8 col-md-8 col-sm-12 col-12 mb-2">
                    <div class="card p-3">
                        <p class="fs-20 fsw-bold">Order History</p>
                        @if($orderDetails->isNotEmpty())
                            @foreach($orderDetails as $orderDetail)
                                    <?php
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

                                    $price = banglaToEnglish($orderDetail->product->price);
                                    $product_type = $orderDetail->product->product_type;

                                    if ($product_type == 'Sweet'){
                                        $gm = $price / 1000;
                                        $total = $gm * $orderDetail->weight;
                                    }elseif ($product_type == 'Product'){
                                        $quantity = $orderDetail->quantity;
                                        $total = $price * $quantity;
                                    }

                                    ?>
                                <div class="row border-bottom py-2">
                                    <div class="col-lg-2 col-md-3 col-sm-3 col-3">
                                        <a href="{{ route('product.detail', $orderDetail->product->product_slug ) }}">
                                            <div class="cart-img">
                                                <img src="{{ asset($orderDetail->product->image ?? '/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-lg-8 col-md-7 col-sm-7 col-7">
                                        <div>
                                            <div>
                                                <a href="{{ route('product.detail', $orderDetail->product->product_slug ) }}" class="sweet-name text-black text-decoration-none">
                                                    {{ $orderDetail->product->name ?? 'Product Name' }}
                                                </a>
                                            </div>
                                            <div class="cart-page">
                                            <span class="cart-weight">
                                                @if($orderDetail->weight)
                                                    {{ $orderDetail->weight < 1000 ? englishToBengali($orderDetail->weight) . ' গ্রাম' : englishToBengali($orderDetail->weight / 1000) . ' কেজি' }}
                                                @elseif($orderDetail->quantity)
                                                    {{ $orderDetail->quantity }} pcs
                                                @endif
                                            </span>
                                                <p class="cart-price">{{ $orderDetail->product->price ?? '0' }}Tk
                                                    @if($orderDetail->product->discount_price)
                                                        <span class="discount-price">(<del>{{ $orderDetail->product->discount_price }}Tk</del>)</span>
                                                    @endif
                                                </p>
                                                <span class="single-cart-total-price">
                                                Total: {{ englishToBengali($total) ?? '0' }}Tk
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>No orders found.</p>
                        @endif
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                    <div class="card p-3">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="fsw-bold fs-20">Order Summery</p>
                            </div>
                            <div class="col-md-12 d-flex justify-content-between">
                                <p>Subtotal</p>
                                <p class="fsw-semibold">{{ $order->order_total }}Tk</p>
                            </div>
                            @if($order->login_discount)
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Login Discount</p>
                                    <p class="fsw-semibold">-{{ $order->login_discount }}Tk</p>
                                </div>
                            @endif
                            <div class="col-md-12 d-flex justify-content-between">
                                <p>Delivery Fee</p>
                                <p class="fsw-semibold">{{ ($order->delivery_fee == 0) ? 'Free' : $order->delivery_fee.'Tk' }}</p>
                            </div>
                            <div class="col-md-12 d-flex justify-content-between">
                                <p class="fsw-semibold">Total</p>
                                <p class="fsw-semibold">{{ $order->estimate_total }}Tk</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@push('scripts')
    <script>

    </script>

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

