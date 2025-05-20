@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Checkout | Food Junction
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

    <section class="checkout-page">
        <div class="container-fluid">
            <div class="row background-gradient">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold text-white mt-3 mb-0 fs-32">Checkout</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23ffffff'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-white">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cart') }}" class="text-decoration-none text-white">Cart</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row bg-black text-center">
                <p class="fs-20 text-white mb-1">Order Only For Dhaka</p>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="container my-4">
            <form action="{{ route('new.order') }}" method="post">
                @csrf
                @method('POST')

                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12 py-2">
                        <div class="card p-3">
                            <div class="">
                                <p class="fs-24 fsw-semibold">Billing Details</p>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="formGroupExampleInput" placeholder="Example input placeholder">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Email <span>(Optional)</span></label>
                                <input type="text" class="form-control" name="email" id="formGroupExampleInput2" placeholder="Another input placeholder">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="number" id="formGroupExampleInput" placeholder="Example input placeholder">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Whatsapp Number(Optional)</label>
                                <input type="text" class="form-control" name="whatsapp_number" id="formGroupExampleInput" placeholder="Example input placeholder">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Address</label>
                                <textarea class="form-control" name="address" id="formGroupExampleInput2" placeholder="Another input placeholder" cols="30" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Note(Optional)</label>
                                <textarea class="form-control" name="note" id="formGroupExampleInput" placeholder="Another input placeholder" cols="30" rows="3"></textarea>
                            </div>
                            <div class="d-flex mb-3">
                                <label for="all_terms" class="form-label me-2">
                                    <input type="checkbox" class="" name="all_terms" id="all_terms" value="yes" placeholder="Example input placeholder">
                                    Accept all Terms and Conditions
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 py-2">
                        <div class="card p-3 mb-2">
                            @foreach($carts as $cart)

                            <div class="row py-2">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <a href="{{ route('product.detail', $cart['product_slug'] ) }}">
                                        <div class="cart-img">
                                            <img src="{{ asset($cart->product->image ?? '/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-7 checkout-cart-sweets">
                                    <div>
                                        <div>
                                            <a href="{{ route('product.detail', $cart['product_slug'] ) }}" class="sweet-name">
                                                {{ $cart['product']['name'] }}
                                            </a>
                                        </div>
                                        <div>
                                            <span class="cart-weight">
                                                @if($cart['product']['product_type'] == 'Sweet')
                                                    {{ $cart['weight'] < 1000 ? englishToBengali($cart['weight']) . ' গ্রাম' : englishToBengali($cart['weight'] / 1000) . ' কেজি' }}
                                                @elseif($cart['product']['product_type'] == 'Product')
                                                    {{ $cart->quantity ?? '' }} pcs
                                                @endif
                                            </span>
                                            <p class="cart-price">
                                                {{ englishToBengali($cart['price']) ?? '0' }}Tk
                                                @if($cart['product']['discount_price'])
                                                <span class="discount-price">(<del>{{ englishToBengali($cart['product']['price']) }}Tk</del>)</span>
                                                @endif
                                            </p>
                                            <span class="single-cart-total-price">
                                                Subtotal: {{ englishToBengali($cart['line_total']) ?? '0' }}Tk
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                    <button class="btn" onclick="removeFromCart('{{ $cart['product']['id'] }}')">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <div class="card p-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="fsw-bold fs-20">Order Summary</p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Subtotal</p>
                                    <p class="fsw-semibold" data-subtotal>{{ englishToBengali( number_format( round($total_info['sub_total']), 2) ) }}Tk</p>
                                    <input type="hidden" name="order_total" value="{{ $total_info['sub_total'] }}">
                                </div>
                                @if($total_info['login_discount'])
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <p>Login Discount</p>
                                        <p class="fsw-semibold" data-login-discount>-{{ englishToBengali( number_format( round($total_info['login_discount']), 2) ) }}Tk</p>
                                        <input type="hidden" name="login_discount" value="{{ $total_info['login_discount'] }}">
                                    </div>
                                @endif
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Delivery Fee</p>
                                    <p class="fsw-semibold" data-delivery-fee>{{  ($total_info['delivery_fee'] == 0) ? 'Free' : englishToBengali(number_format(number_format( round($total_info['delivery_fee']), 2) ).'Tk') }}</p>
                                    <input type="hidden" name="delivery_fee" value="{{ $total_info['delivery_fee'] }}">
                                </div>

                                @if(session()->has('applied_coupon'))
                                    <!-- Show Coupon Discount -->
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <p>Coupon Discount</p>
                                        <p class="fsw-semibold" data-coupon-discount>- {{ englishToBengali( number_format( round( session('applied_coupon.discount') ), 2) ) }}Tk</p>
                                        <input type="hidden" name="discount" value="{{ session('applied_coupon.discount') }}">
                                    </div>
                                @endif

                                <!-- This is where the coupon section will be inserted -->
                                <div class="col-md-12 d-flex justify-content-between" data-total-row>
                                    <p class="fsw-semibold">Total</p>
                                    <p class="fsw-semibold" id="grand-total">{{ englishToBengali( number_format( round( session('applied_coupon.total') ?? $total_info['total'] ), 2) ) }}Tk</p>
                                    <input type="hidden" name="estimate_total" value="{{ session('applied_coupon.total') ?? $total_info['total'] }}">
                                </div>

                                <!-- Apply Coupon Section -->
                                @if(!session()->has('applied_coupon'))
                                    <div class="col-md-12 d-flex justify-content-between" id="apply-coupon-section">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control coupon-input" name="coupon" placeholder="Add Promo Code">
                                            <button type="button" class="input-group-text bg-danger text-white coupon-btn"
                                                    onclick="applyCoupon()">Apply</button>
                                        </div>
                                    </div>

                                    <div class="col-md-12 d-flex justify-content-between d-none" id="remove-coupon-section">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control coupon-input" name="coupon" placeholder="Add Promo Code" readonly>
                                            <button type="button" class="input-group-text bg-dark text-white remove-coupon-btn"
                                                    onclick="removeCoupon()">Remove</button>
                                        </div>
                                    </div>

                                @else
                                    <!-- Hide Apply Coupon Section on load -->
                                    <div class="col-md-12 d-flex justify-content-between d-none" id="apply-coupon-section">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control coupon-input" name="coupon" placeholder="Add Promo Code">
                                            <button type="button" class="input-group-text bg-danger text-white coupon-btn"
                                                    onclick="applyCoupon()">Apply</button>
                                        </div>
                                    </div>

                                    <!-- Show Remove Coupon Section -->
                                    <div class="col-md-12 d-flex justify-content-between" id="remove-coupon-section">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control coupon-input" name="coupon" value="{{ session('applied_coupon.code') }}" readonly>
                                            <button type="button" class="input-group-text bg-dark text-white remove-coupon-btn"
                                                    onclick="removeCoupon()">Remove</button>
                                        </div>
                                    </div>

                                @endif

                                <div class="col-md-12">
                                    @if($carts->count() > 0)
                                        <button type="submit" class="btn background-gradient text-white border-0 w-100 fs-18 fsw-semibold">
                                            Place Order <i class="fa-solid fa-long-arrow-right"></i>
                                        </button>
                                    @else
                                        <a href="{{ route('products') }}" class="btn background-gradient text-white border-0 w-100 fs-18 fsw-semibold">
                                            Go to Shop <i class="fa-solid fa-long-arrow-right"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </section>

@endsection

@push('scripts')

    <script>
        function applyCoupon() {
            const couponCode = $('[name="coupon"]').val().trim();

            if (!couponCode) {
                showErrorToast('Please enter a coupon code');
                return;
            }

            const applyBtn = $('.coupon-btn');
            const applySection = $('#apply-coupon-section');
            const removeSection = $('#remove-coupon-section');

            applyBtn.prop('disabled', true).text('Applying...');

            $.ajax({
                url: "{{ route('coupon.check') }}",
                method: 'POST',
                data: {
                    coupon: couponCode,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        showSuccessToast(data.message);

                        // Toggle UI correctly
                        applySection.addClass('d-none');
                        removeSection.removeClass('d-none');
                        window.location.reload();

                        // Set coupon value
                        $('#remove-coupon-section input[name="coupon"]').val(couponCode);
                    } else {
                        showErrorToast(data.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr);
                    showErrorToast('Failed to apply coupon');
                },
                complete: function () {
                    applyBtn.prop('disabled', false).text('Apply');
                }
            });
        }

        function removeCoupon() {
            const removeBtn = $('.remove-coupon-btn');
            const applySection = $('#apply-coupon-section');
            const removeSection = $('#remove-coupon-section');

            removeBtn.prop('disabled', true).text('Removing...');

            $.ajax({
                url: "{{ route('coupon.remove') }}",
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        showSuccessToast(data.message);

                        // Toggle UI correctly
                        removeSection.addClass('d-none');
                        applySection.removeClass('d-none');
                        window.location.reload();

                        // Reset input
                        $('#apply-coupon-section input[name="coupon"]').val('');
                    } else {
                        showErrorToast(data.message);
                    }
                },
                error: function (xhr) {
                    console.error(xhr);
                    showErrorToast('Failed to remove coupon');
                },
                complete: function () {
                    removeBtn.prop('disabled', false).text('Remove');
                }
            });
        }

        function englishToBengali(number) {
            const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            const bengaliDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            return number.toString().replace(/[0-9]/g, d => bengaliDigits[d]);
        }
    </script>


    <script>
        function removeFromCart(productId) {
            $.ajax({
                url: '{{ route('remove.cart') }}', // Use the correct route name for removeFromCart
                type: 'POST',
                data: {
                    product_id: productId,
                    _token: '{{ csrf_token() }}', // CSRF token for security
                },
                success: function(response) {
                    if (response.success) {
                        showSuccessToast(response.message);
                    } else {
                        showErrorToast(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    showErrorToast(error);
                }
            });
        }

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
