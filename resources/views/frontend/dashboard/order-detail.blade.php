@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Order Details | Food Junction">
    <meta name="keywords" content="Food Junction, order, order detail, tracking">
@endsection

@section('title')
    Order #{{ $order->tracking_id }} | Dashboard
@endsection

@section('content')
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

<section class="user-dashboard-page">
    {{-- Hero Header --}}
    <div class="container-fluid">
        <div class="row background-gradient">
            <div class="col-md-12 text-center py-3">
                <p class="text-uppercase fw-bold text-white mt-3 mb-0 fs-32">Order Details</p>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center bg-transparent">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}" class="text-decoration-none text-white">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}" class="text-decoration-none text-white">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-white active" aria-current="page">
                            #{{ $order->tracking_id }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container my-4">

        {{-- Order Status Banner --}}
        <div class="alert
            @if($order->status === 'pending')  alert-warning
            @elseif($order->status === 'complete') alert-success
            @elseif($order->status === 'return')   alert-secondary
            @else alert-danger
            @endif d-flex align-items-center gap-2 mb-4" role="alert">
            <i class="fa-solid
                @if($order->status === 'pending')  fa-clock
                @elseif($order->status === 'complete') fa-circle-check
                @elseif($order->status === 'return')   fa-rotate-left
                @else fa-circle-xmark
                @endif"></i>
            <div>
                <strong>Order Status:</strong> {{ ucfirst($order->status) }}
                &nbsp;|&nbsp;
                <strong>Tracking ID:</strong> <code>{{ $order->tracking_id }}</code>
                &nbsp;|&nbsp;
                <strong>Placed:</strong> {{ $order->created_at->setTimezone('Asia/Dhaka')->format('M d, Y h:ia') }}
            </div>
        </div>

        <div class="row">
            {{-- ─── LEFT: Order Items ────────────────────────────────── --}}
            <div class="col-lg-8 col-md-8 col-sm-12 col-12 mb-3">
                <div class="card p-3">
                    <p class="fs-20 fsw-bold mb-3">Ordered Items</p>

                    @if($orderDetails->isNotEmpty())
                        @foreach($orderDetails as $item)
                        <div class="row border-bottom py-3">
                            {{-- Product Image --}}
                            <div class="col-lg-2 col-md-3 col-sm-3 col-3">
                                <a href="{{ $item->product ? route('product.detail', $item->product->product_slug) : '#' }}">
                                    <div class="cart-img">
                                        <img src="{{ asset($item->product->image ?? '/frontend/images/section/home/Malaichop-500x500.jpg') }}"
                                             alt="{{ $item->product_name }}" />
                                    </div>
                                </a>
                            </div>

                            {{-- Product Details --}}
                            <div class="col-lg-8 col-md-7 col-sm-7 col-7">
                                <div>
                                    {{-- Name (use snapshot, fallback to live product) --}}
                                    <a href="{{ $item->product ? route('product.detail', $item->product->product_slug) : '#' }}"
                                       class="sweet-name text-black text-decoration-none">
                                        {{ $item->product_name }}
                                    </a>

                                    <div class="cart-page mt-1">
                                        {{-- Quantity / Weight --}}
                                        <span class="cart-weight">
                                            @if($item->variant_unit)
                                                {{ $item->variant_unit }}
                                            @elseif($item->unit_type === 'kg')
                                                {{ $item->unit_value < 1000
                                                    ? englishToBengali($item->unit_value) . ' গ্রাম'
                                                    : englishToBengali($item->unit_value / 1000) . ' কেজি' }}
                                            @else
                                                {{ $item->quantity }} pcs
                                            @endif
                                        </span>

                                        {{-- Unit Price --}}
                                        <p class="cart-price mb-1">
                                            {{ englishToBengali($item->unit_price) }}Tk
                                            @if($item->discount_amount > 0)
                                                <span class="discount-price">
                                                    (<del>{{ englishToBengali($item->original_price) }}Tk</del>)
                                                </span>
                                            @endif
                                        </p>

                                        {{-- Line Total --}}
                                        <span class="single-cart-total-price">
                                            Subtotal: <strong>{{ englishToBengali(number_format($item->total_price, 2)) }}Tk</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted">No items found for this order.</p>
                    @endif
                </div>

                {{-- Delivery Info --}}
                <div class="card p-3 mt-3">
                    <p class="fs-18 fsw-bold mb-3">Delivery Information</p>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small">Recipient Name</p>
                            <p class="fsw-semibold">{{ $order->name }}</p>
                        </div>
                        @if($order->email)
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small">Email</p>
                            <p class="fsw-semibold">{{ $order->email }}</p>
                        </div>
                        @endif
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small">Phone</p>
                            <p class="fsw-semibold">{{ $order->number }}</p>
                        </div>
                        @if($order->whatsapp_number)
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small">WhatsApp</p>
                            <p class="fsw-semibold">{{ $order->whatsapp_number }}</p>
                        </div>
                        @endif
                        <div class="col-md-12">
                            <p class="text-muted mb-1 small">Delivery Address</p>
                            <p class="fsw-semibold">{{ $order->address }}</p>
                        </div>
                        @if($order->note)
                        <div class="col-md-12">
                            <p class="text-muted mb-1 small">Note</p>
                            <p class="fsw-semibold">{{ $order->note }}</p>
                        </div>
                        @endif
                        @if($order->delivery_zone)
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small">Delivery Zone</p>
                            <p class="fsw-semibold text-capitalize">{{ $order->delivery_zone }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ─── RIGHT: Order Summary ─────────────────────────────── --}}
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="card p-3 mb-3">
                    <p class="fsw-bold fs-20 mb-3">Order Summary</p>

                    {{-- Subtotal --}}
                    <div class="d-flex justify-content-between mb-2">
                        <p class="mb-0">Subtotal</p>
                        <p class="fsw-semibold mb-0">{{ englishToBengali(number_format($order->subtotal, 2)) }}Tk</p>
                    </div>

                    {{-- Offer Discount --}}
                    @if($order->offer_discount > 0)
                    <div class="d-flex justify-content-between mb-2">
                        <p class="mb-0 text-success">Offer Discount</p>
                        <p class="fsw-semibold mb-0 text-success">
                            − {{ englishToBengali(number_format($order->offer_discount, 2)) }}Tk
                        </p>
                    </div>
                    @endif

                    {{-- Coupon Discount --}}
                    @if($order->coupon_discount > 0)
                    <div class="d-flex justify-content-between mb-2">
                        <p class="mb-0 text-success">
                            Coupon
                            @if($order->coupon_code)
                                <span class="badge bg-success ms-1" style="font-size:11px;">{{ $order->coupon_code }}</span>
                            @endif
                        </p>
                        <p class="fsw-semibold mb-0 text-success">
                            − {{ englishToBengali(number_format($order->coupon_discount, 2)) }}Tk
                        </p>
                    </div>
                    @endif

                    {{-- Total Discount line (only if there is discount) --}}
                    @if($order->total_discount > 0)
                    <div class="d-flex justify-content-between mb-2 border-top pt-2">
                        <p class="mb-0 text-success fsw-semibold">Total Saved</p>
                        <p class="fsw-semibold mb-0 text-success">
                            − {{ englishToBengali(number_format($order->total_discount, 2)) }}Tk
                        </p>
                    </div>
                    @endif

                    {{-- Delivery Fee --}}
                    <div class="d-flex justify-content-between mb-2">
                        <p class="mb-0">Delivery Fee</p>
                        <p class="fsw-semibold mb-0">
                            @if($order->is_free_delivery || $order->delivery_fee == 0)
                                <span class="text-success">Free</span>
                            @else
                                {{ englishToBengali(number_format($order->delivery_fee, 2)) }}Tk
                            @endif
                        </p>
                    </div>

                    {{-- Grand Total --}}
                    <div class="d-flex justify-content-between border-top pt-2 mt-2">
                        <p class="fsw-bold fs-18 mb-0">Total</p>
                        <p class="fsw-bold fs-18 mb-0">
                            {{ englishToBengali(number_format($order->final_total, 2)) }}Tk
                        </p>
                    </div>
                </div>

                {{-- Back Button --}}
                <a href="{{ route('dashboard') }}" class="btn background-gradient text-white border-0 w-100">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to Dashboard
                </a>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    @if(session('t-success'))
        showSuccessToast("{{ session('t-success') }}");
    @endif
    @if(session('t-error'))
        showErrorToast("{{ session('t-error') }}");
    @endif
</script>
@endpush
