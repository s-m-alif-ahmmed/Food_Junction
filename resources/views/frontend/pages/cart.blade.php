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

                                @php
                                    $unit = $item->unit;
                                    $unitText = match($unit) {
                                        'gm' => 'গ্রাম',
                                        'pc' => 'পিস',
                                        'pcs' => 'পিস',
                                        default => ucfirst($unit),
                                     };
                                @endphp

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
                                                    @if($item->variant_quantity && $item->unit)
                                                        {{ englishToBengali($item->quantity) }} x {{ englishToBengali(number_format($item->variant_quantity, 0)) }} {{ $unitText }}
                                                    @elseif($item->variant_name)
                                                        {{ englishToBengali($item->quantity) }} x {{ $unitText }}
                                                    @else
                                                        {{ englishToBengali($item->quantity) }} {{ ucfirst(number_format($item->unit, 0) ?? $unitText) }}
                                                    @endif
                                                </span>
                                                <p class="cart-price">{{ englishToBengali(number_format($item->unit_price, 0)) }} টাকা
                                                    @if($item->variant && $item->variant->sale_price)
                                                        <span class="discount-price">(<del>{{ englishToBengali(number_format($item->variant->price, 0)) }} টাকা</del>)</span>
                                                    @elseif($item->product && $item->product->discount_price)
                                                        <span class="discount-price">(<del>{{ englishToBengali(number_format($item->product->price, 0)) }} টাকা</del>)</span>
                                                    @endif
                                                </p>
                                                <span class="single-cart-total-price">
                                                    Total: {{ englishToBengali(number_format($item->total, 0)) ?? '0' }} টাকা
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

                                {{-- Delivery Zone Selector --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fsw-semibold">Delivery Zone <span class="text-danger">*</span></label>
                                    <select id="delivery-zone-select" class="form-select"
                                            onchange="setDeliveryZone(this.value)" required >
                                        <option value="" disabled {{ !$cart->delivery_zone ? 'selected' : '' }}>-- Select Zone --</option>
                                        <option value="inside_dhaka"  {{ $cart->delivery_zone === 'inside_dhaka'  ? 'selected' : '' }}>Inside Dhaka</option>
                                        <option value="outside_dhaka" {{ $cart->delivery_zone === 'outside_dhaka' ? 'selected' : '' }}>Outside Dhaka</option>
                                    </select>
                                    @if($cart->delivery_zone === 'outside_dhaka')
                                        <small class="text-muted mt-1 d-block">&#9888; Outside Dhaka delivery fee: 120 টাকা. Some offers may not apply.</small>
                                    @elseif($cart->delivery_zone === 'inside_dhaka')
                                        <small class="text-success mt-1 d-block">&#10003; Inside Dhaka &mdash; standard delivery rate applies.</small>
                                    @else
                                        <small class="text-muted mt-1 d-block">Please select your delivery zone to see the correct delivery fee.</small>
                                    @endif
                                </div>

                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Subtotal</p>
                                    <p class="fsw-semibold" data-subtotal>{{ englishToBengali(number_format($cart->subtotal, 2)) }} টাকা</p>
                                </div>
                                @if($cart->discount > 0)
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <p>Discount</p>
                                        <p class="fsw-semibold">-{{ englishToBengali(number_format($cart->discount, 2)) }} টাকা</p>
                                    </div>
                                @endif
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Delivery Fee</p>
                                    <p class="fsw-semibold" data-delivery-fee>
                                        {{ $cart->delivery_fee <= 0 ? 'Free' : englishToBengali(number_format($cart->delivery_fee, 2)) . ' টাকা' }}
                                    </p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p class="fsw-semibold">Total</p>
                                    <p class="fsw-semibold" id="grand-total">{{ englishToBengali(number_format($cart->total, 2)) }} টাকা</p>
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
        function setDeliveryZone(zone) {
            if (!zone) return;
            const select = document.getElementById('delivery-zone-select');
            if (select) select.disabled = true;

            $.ajax({
                url: "{{ route('cart.delivery.zone') }}",
                method: 'POST',
                data: { zone: zone, _token: $('meta[name="csrf-token"]').attr('content') },
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        const feeEl = $('[data-delivery-fee]');
                        if (data.is_free) {
                            feeEl.text('Free');
                        } else {
                            feeEl.text(englishToBengali(parseFloat(data.delivery_fee).toFixed(2)) + ' টাকা');
                        }
                        $('#grand-total').text(englishToBengali(parseFloat(data.total).toFixed(2)) + ' টাকা');

                        const hint = document.querySelector('#delivery-zone-select + small');
                        if (hint) {
                            if (zone === 'outside_dhaka') {
                                hint.className = 'text-muted mt-1 d-block';
                                hint.textContent = '⚠ Outside Dhaka delivery fee: 120.00 টাকা. Some offers may not apply.';
                            } else {
                                hint.className = 'text-success mt-1 d-block';
                                hint.textContent = '✓ Inside Dhaka — standard delivery rate applies.';
                            }
                        }
                        showSuccessToast('Delivery zone updated!');
                    } else {
                        showErrorToast(data.message || 'Failed to update delivery zone.');
                    }
                },
                error: function () { showErrorToast('Failed to update delivery zone.'); },
                complete: function () { if (select) select.disabled = false; }
            });
        }

        function englishToBengali(number) {
            const d = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
            return number.toString().replace(/[0-9]/g, n => d[n]);
        }

        // Trigger toaster based on session messages
        @if (session('t-success'))
        showSuccessToast("{{ session('t-success') }}");
        @endif
        @if (session('t-error'))
        showErrorToast("{{ session('t-error') }}");
        @endif
    </script>
@endpush
