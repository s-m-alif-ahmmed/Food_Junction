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
                                <label for="name" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                       placeholder="Enter full name here" value="{{ old('name') }}" required >
                                @error('name')
                                <p class="text-sm text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span>(Optional)</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="email" id="email"
                                       placeholder="Enter email address here" value="{{ old('email') }}" required >
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">Phone Number<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="number"
                                       placeholder="Enter phone number here" value="{{ old('number') }}" required >
                            </div>
                            <div class="mb-3">
                                <label for="whatsapp_number" class="form-label">Whatsapp Number(Optional)</label>
                                <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" name="whatsapp_number" id="whatsapp_number"
                                       placeholder="Enter whatsapp number here" value="{{ old('whatsapp_number') }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address<span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                          placeholder="Enter full Address here" cols="30" rows="3" required >{{ old('address') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="note" class="form-label">Note(Optional)</label>
                                <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note" placeholder="Enter note here" cols="30" rows="3">{{ old('note') }}</textarea>
                            </div>
                            <div class="d-flex mb-3">
                                <label for="all_terms" class="form-label me-2">
                                    <input type="checkbox" class="" name="all_terms" id="all_terms" value="yes" required >
                                    Accept all Terms and Conditions
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 py-2">
                        <div class="card p-3 mb-2">
                            @foreach($cart->items as $item)

                            <div class="row py-2">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <a href="{{ route('product.detail', $item->product->product_slug ?? '') }}">
                                        <div class="cart-img">
                                            <img src="{{ asset($item->product->image ?? '/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-7 checkout-cart-sweets">
                                    <div>
                                        <div>
                                            <a href="{{ route('product.detail', $item->product->product_slug ?? '') }}" class="sweet-name">
                                                {{ $item->product->name ?? 'Product Name' }}
                                            </a>
                                        </div>
                                        <div>
                                            <span class="cart-weight">
                                                @if($item->variant_quantity && $item->unit)
                                                    {{ englishToBengali($item->quantity) }} x {{ englishToBengali(number_format($item->variant_quantity, 0)) }} {{ $item->unit }}
                                                @elseif($item->variant_name)
                                                    {{ englishToBengali($item->quantity) }} x {{ $item->variant_name }}
                                                @else
                                                    {{ englishToBengali($item->quantity) }} {{ ucfirst($item->unit ?? 'pcs') }}
                                                @endif
                                            </span>
                                            <p class="cart-price">
                                                {{ englishToBengali(number_format($item->unit_price, 0)) ?? '0' }} টাকা
                                                @if($item->variant && $item->variant->sale_price)
                                                    <span class="discount-price">(<del>{{ englishToBengali(number_format($item->variant->price, 0)) }} টাকা</del>)</span>
                                                @elseif($item->product && $item->product->discount_price)
                                                    <span class="discount-price">(<del>{{ englishToBengali(number_format($item->product->price, 0)) }} টাকা</del>)</span>
                                                @endif
                                            </p>
                                            <span class="single-cart-total-price">
                                                Subtotal: {{ englishToBengali(number_format($item->total, 0)) ?? '0' }} টাকা
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                        <div class="card p-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="fsw-bold fs-20">Order Summary</p>
                                </div>

                                {{-- Delivery Zone Selector --}}
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fsw-semibold">Delivery Zone <span class="text-danger">*</span></label>
                                    <select id="delivery-zone-select" class="form-select"
                                            onchange="setDeliveryZone(this.value)" required >
                                        <option value="" disabled {{ !$cart->delivery_zone ? 'selected' : '' }}>-- Select Zone --</option>
                                        @foreach($deliveryZones as $zone)
                                            <option value="{{ $zone->slug }}" {{ $cart->delivery_zone === $zone->slug ? 'selected' : '' }}>{{ $zone->name }}</option>
                                        @endforeach
                                    </select>
                                    @php
                                        $currentZone = $deliveryZones->where('slug', $cart->delivery_zone)->first();
                                    @endphp
                                    @if($currentZone)
                                        <small class="text-success mt-1 d-block">&#10003; {{ $currentZone->name }} &mdash; Delivery Fee: {{ englishToBengali(number_format($currentZone->delivery_charge, 0)) }} টাকা</small>
                                    @else
                                        <small class="text-muted mt-1 d-block">Please select your delivery zone to see the correct delivery fee.</small>
                                    @endif
                                </div>

                                {{-- Subtotal --}}
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Subtotal</p>
                                    <p class="fsw-semibold" data-subtotal>{{ englishToBengali(number_format($cart->subtotal, 2)) }} টাকা</p>
                                </div>

                                {{-- Offer Discount (login discount + general offers) --}}
                                @if($cart->offer_discount > 0)
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <p>Offer Discount</p>
                                        <p class="fsw-semibold">-{{ englishToBengali(number_format($cart->offer_discount, 2)) }} টাকা</p>
                                    </div>
                                @endif

                                {{-- Coupon Discount --}}
                                @if($cart->coupon_discount > 0)
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <p>Coupon Discount</p>
                                        <p class="fsw-semibold text-success">-{{ englishToBengali(number_format($cart->coupon_discount, 2)) }} টাকা</p>
                                    </div>
                                @endif

                                {{-- Delivery Fee --}}
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Delivery Fee</p>
                                    <p class="fsw-semibold" data-delivery-fee>{{ $cart->delivery_fee <= 0 ? 'Free' : englishToBengali(number_format($cart->delivery_fee, 2)).' টাকা' }}</p>
                                </div>

                                {{-- Coupon badge if applied --}}
                                @if($cart->coupon_code)
                                    <div class="col-md-12 d-flex justify-content-between">
                                        <p>Coupon <span class="badge bg-success">{{ $cart->coupon_code }}</span></p>
                                        <p class="text-success fsw-semibold">Applied ✓</p>
                                    </div>
                                @endif

                                {{-- Total --}}
                                <div class="col-md-12 d-flex justify-content-between" data-total-row>
                                    <p class="fsw-semibold">Total</p>
                                    <p class="fsw-semibold" id="grand-total">{{ englishToBengali(number_format($cart->total, 2)) }} টাকা</p>
                                </div>

                                {{-- Coupon Input Section --}}
                                @if(!$cart->coupon_code)
                                    <div class="col-md-12" id="apply-coupon-section">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control coupon-input" id="coupon-input" name="coupon" placeholder="Add Promo Code">
                                            <button type="button" class="input-group-text bg-danger text-white coupon-btn"
                                                    onclick="applyCoupon()">Apply</button>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-md-12" id="remove-coupon-section">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="coupon" value="{{ $cart->coupon_code }}" readonly>
                                            <button type="button" class="input-group-text bg-dark text-white remove-coupon-btn"
                                                    onclick="removeCoupon()">Remove</button>
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    @if($cart->items->count() > 0)
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
        function setDeliveryZone(zone) {
            if (!zone) return;

            const select = document.getElementById('delivery-zone-select');
            if (select) select.disabled = true;

            $.ajax({
                url: "{{ route('cart.delivery.zone') }}",
                method: 'POST',
                data: {
                    zone: zone,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'json',
                success: function (data) {
                    if (data.success) {
                        // Update delivery fee display
                        const feeEl = $('[data-delivery-fee]');
                        if (data.is_free) {
                            feeEl.text('Free');
                        } else {
                            feeEl.text(englishToBengali(parseFloat(data.delivery_fee).toFixed(2)) + ' টাকা');
                        }

                        // Update offer discount row
                        if (data.offer_discount > 0) {
                            $('[data-offer-discount]').text('-' + englishToBengali(parseFloat(data.offer_discount).toFixed(2)) + ' টাকা').closest('[data-offer-row]').show();
                        }

                        // Update grand total
                        $('#grand-total').text(englishToBengali(parseFloat(data.total).toFixed(2)) + ' টাকা');

                        // Update zone hint text
                        const hint = document.querySelector('#delivery-zone-select + small');
                        if (hint) {
                            if (zone === 'outside_dhaka') {
                                hint.className = 'text-muted mt-1 d-block';
                                hint.textContent = '⚠️ Outside Dhaka delivery fee: 120.00. Some offers may not apply.';
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
                error: function () {
                    showErrorToast('Failed to update delivery zone. Please try again.');
                },
                complete: function () {
                    if (select) select.disabled = false;
                }
            });
        }

        function applyCoupon() {
            const couponCode = $('#coupon-input').val().trim();

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
                        // Success toast will be shown after reload from session
                        window.location.reload();
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
                        // Success toast will be shown after reload from session
                        window.location.reload();
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


{{--    <script>--}}
{{--        function removeFromCart(productId) {--}}
{{--            $.ajax({--}}
{{--                url: '{{ route('remove.cart') }}', // Use the correct route name for removeFromCart--}}
{{--                type: 'POST',--}}
{{--                data: {--}}
{{--                    product_id: productId,--}}
{{--                    _token: '{{ csrf_token() }}', // CSRF token for security--}}
{{--                },--}}
{{--                success: function(response) {--}}
{{--                    if (response.success) {--}}
{{--                        showSuccessToast(response.message);--}}
{{--                        // Refresh the page after a short delay to show the toast message--}}
{{--                        setTimeout(function() {--}}
{{--                            window.location.reload();--}}
{{--                        }, 1000);--}}
{{--                    } else {--}}
{{--                        showErrorToast(response.message);--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function(xhr, status, error) {--}}
{{--                    showErrorToast(error);--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}

{{--    </script>--}}

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
