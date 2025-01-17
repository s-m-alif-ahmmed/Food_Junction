@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Cart | Food Junction
@endsection

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
            <form action="">
                <div class="row">
                    @if(Auth::check())
                        @if($carts->isNotEmpty())

                            <div class="col-md-8 py-2">
                                <div class="card p-3">
                                    @foreach($carts as $cart)
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

                                            $price = banglaToEnglish($cart->product->price);
                                            $gm = $price / 1000;
                                            $total = $gm * $cart->weight;
                                            ?>
                                        <div class="row border-bottom py-2">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-3">
                                                <a href="{{ route('product.detail', $cart->product->product_slug ) }}">
                                                    <div class="cart-img">
                                                        <img src="{{ asset($cart->product->image ?? '/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-7">
                                                <div>
                                                    <div>
                                                        <a href="{{ route('product.detail', $cart->product->product_slug ) }}" class="sweet-name">
                                                            {{ $cart->product->name ?? 'Product Name' }}
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <span class="cart-weight">
                                                            @if($cart->product->product_type == 'Sweet')
                                                                {{ $cart->weight < 1000 ? englishToBengali($cart->weight) . ' গ্রাম' : englishToBengali($cart->weight / 1000) . ' কেজি' }}
                                                            @elseif($cart->product->product_type == 'Product')
                                                                {{ $cart->quantity }} pcs
                                                            @endif
                                                        </span>
                                                        <p class="cart-price">{{ $cart->product->price ?? '0' }}Tk
                                                            @if($cart->product->discount_price)
                                                                <span class="discount-price">(<del>{{ $cart->product->discount_price }}Tk</del>)</span>
                                                            @endif
                                                        </p>
                                                        <span class="single-cart-total-price">
                                                            Total: {{ englishToBengali($total) ?? '0' }}Tk
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                                <button class="btn" onclick="removeFromCart('{{ $cart->product->id }}')">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                            @php
                                // Number conversion functions remain the same as in previous response

                                // Initialize totals and other values
                                $subtotal = 0.0;
                                $totalWeight = 0;
                                $discount = 0.0;
                                $deliveryFee = 60; // default delivery fee

                                // Calculate subtotal and total weight from cart items
                                foreach ($carts as $cart) {
                                    // Convert price to float for calculation (handling both current and old price)
                                    $productPrice = (float)banglaToEnglish($cart->product->price ?? 0); // Ensure the price is numeric
                                    $weight = (int)$cart->weight;

                                    $gm = $productPrice / 1000;
                                    $price = $gm * $weight;

                                    // Add the current product price to the subtotal
                                    $subtotal += $price;

                                    // Ensure weight is treated as an integer (convert weight to grams)
                                    $totalWeight += $weight; // Casting to integer to avoid decimal points

                                }

                                // Apply 5% discount if the user is logged in
                                if (\Illuminate\Support\Facades\Auth::check()) {
                                    $discount = $subtotal * 0.05;
                                    $discount = round($discount);
                                }

                                // Check if delivery is free (if total weight >= 2000g)
                                if ($totalWeight >= 2000) {
                                    $deliveryFee = 0; // Free delivery if weight is 2000g or more
                                }

                                // Calculate total after discount and delivery fee
                                $discountTotal = $subtotal - $discount;
                                $total = $discountTotal + $deliveryFee;

                                // Convert numbers to Bengali
                                $subtotalInBengali = englishToBengali(number_format($subtotal, 2));
                                $discountInBengali = englishToBengali(number_format($discount, 2));
                                $deliveryFeeInBengali = ($deliveryFee == 0) ? 'Free' : englishToBengali(number_format($deliveryFee, 2).'Tk');
                                $totalInBengali = englishToBengali(number_format($total, 2));

                            @endphp

                            <div class="col-md-4 py-2">
                                <div class="card p-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="fsw-bold fs-20">Order Summery</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <p>Subtotal</p>
                                            <p class="fsw-semibold">{{ $subtotalInBengali }}Tk</p>
                                        </div>
                                        @if($discount > 0)
                                            <div class="col-md-12 d-flex justify-content-between">
                                                <p>Login Discount</p>
                                                <p class="fsw-semibold">-{{ $discountInBengali }}Tk</p>
                                            </div>
                                        @endif
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <p>Delivery Fee</p>
                                            <p class="fsw-semibold">{{ $deliveryFeeInBengali }}</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <p class="fsw-semibold">Total</p>
                                            <p class="fsw-semibold">{{ $totalInBengali }}Tk</p>
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
                    @else
                        <?php
                            // Retrieve the cart items from the session (for guest users) or database (for logged-in users)
                            $carts = session()->get('carts', []);
                        ?>
                        @if(count($carts) > 0)

                            <div class="col-md-8 py-2">
                                <div class="card p-3">

                                    @foreach($carts as $cart)
                                        <div class="row border-bottom py-2">
                                            <div class="col-lg-2 col-md-3 col-sm-3 col-3">
                                                <a href="{{ route('product.detail', $cart['product']['product_slug'] ) }}">
                                                    <div class="cart-img">
                                                        <!-- Display product image -->
                                                        <img src="{{ asset($cart['product']['image'] ?? '/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                                    </div>
                                                </a>
                                            </div>
                                            <div class="col-lg-8 col-md-7 col-sm-7 col-7">
                                                <div>
                                                    <div>
                                                        <a href="{{ route('product.detail', $cart['product']['product_slug'] ) }}" class="sweet-name">
                                                            <!-- Display product name -->
                                                            {{ $cart['product']['name'] ?? 'Product Name' }}
                                                        </a>
                                                    </div>
                                                    <div>
                                                    <span class="cart-weight">
                                                        @if($cart['product']['product_type'] == 'Sweet')
                                                        <!-- Display product weight (convert to grams or kg as needed) -->
                                                        {{ $cart['weight'] < 1000 ? $cart['weight'] . ' গ্রাম' : ($cart['weight'] / 1000) . ' কেজি' }}
                                                        @elseif($cart['product']['product_type'] == 'Product')
                                                            {{ $cart['quantity'] }} pcs
                                                        @endif
                                                    </span>
                                                        <p class="cart-price">
                                                            <!-- Display product price -->
                                                            {{ $cart['product']['price'] ?? '0' }} Tk

                                                            <!-- If there is a discount, show it -->
                                                            @if($cart['product']['discount_price'])
                                                                <span class="discount-price">
                                                                (<del>{{ $cart['product']['discount_price'] }} Tk</del>)
                                                            </span>
                                                            @endif
                                                        </p>
                                                        <span class="single-cart-total-price">
                                                            @php

                                                                if (!function_exists('englishToBengali')) {
                                                                    function englishToBengali($englishString) {
                                                                        $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                                                                        $bengaliNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];

                                                                        // Replace each English number with the corresponding Bengali number
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


                                                                // Convert the price from Bengali to English
                                                                $price = banglaToEnglish($cart['product']['price']);
                                                                $price = (float)$price;  // Convert the price to a float for calculation
                                                                $product_type = $cart['product']['product_type'];

                                                                if ($product_type == 'Sweet'){
                                                                    // Convert the weight to float
                                                                    $weight = (float)$cart['weight'];

                                                                    // Calculate the total price based on the weight
                                                                    $totalPrice = $price > 0 && $weight > 0 ? ($price / 1000) * $weight : 0;
                                                                } elseif ($product_type == 'Product'){
                                                                    // Convert the weight to float
                                                                    $quantity = (float)$cart['quantity'];

                                                                    // Calculate the total price based on the weight
                                                                    $totalPrice = $price > 0 && $quantity > 0 ? ($price * $quantity) : 0;
                                                                }

                                                                // Convert the total price to Bengali numerals
                                                                $totalPriceInBengali = englishToBengali(number_format($totalPrice, 2)); // Format with 2 decimal points
                                                            @endphp

                                                            Total: {{ $totalPriceInBengali }} Tk
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                                <!-- Delete button to remove product from cart -->
                                                <button class="btn" onclick="removeFromCart('{{ $cart['product_id'] }}')">
                                                    <i class="fa-solid fa-trash text-danger"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>

                                <?php
                                // Initialize variables for calculations
                                $subtotal = 0;
                                $totalDiscount = 0;
                                $deliveryFee = 60;  // Default delivery fee
                                $totalWeight = 0;    // Initialize total weight

                                // Retrieve the cart items from the session (for guest users) or database (for logged-in users)
                                $carts = session()->get('carts', []);

                                // Loop through the cart items to calculate subtotal, discount, and total weight
                                foreach ($carts as $cart) {
                                    // Convert price to float (as in the original code)
                                    $price = banglaToEnglish($cart['product']['price']);
                                    $price = (float)$price;

                                    // Convert weight to float (as in the original code)
                                    $weight = (float)$cart['weight'];

                                    // Calculate the total price for the current product
                                    $productTotalPrice = $price > 0 && $weight > 0 ? ($price / 1000) * $weight : 0;

                                    // Add the product total price to the subtotal
                                    $subtotal += $productTotalPrice;

                                    // Add the weight to the total weight
                                    $totalWeight += $weight; // Add weight in grams
                                }

                                // If the total weight exceeds 2000 grams, set delivery fee to 0 (free delivery)
                                if ($totalWeight > 2000) {
                                    $deliveryFee = 0;
                                }

                                // Calculate the final total
                                $totalPrice = $subtotal + $deliveryFee;

                                // Convert the total values to Bengali numerals for display
                                $subtotalInBengali = englishToBengali(number_format($subtotal, 2));  // Format with 2 decimal points
                                $totalDiscountInBengali = englishToBengali(number_format($totalDiscount, 2));  // Format with 2 decimal points
                                $totalPriceInBengali = englishToBengali(number_format($totalPrice, 2));  // Format with 2 decimal points
                                ?>

                            <div class="col-md-4 py-2">
                                <div class="card p-3">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <p class="fsw-bold fs-20">Order Summery</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <p>Subtotal</p>
                                            <p class="fsw-semibold">{{ $subtotalInBengali }}Tk</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <p>Delivery Fee</p>
                                            <p class="fsw-semibold">{{ $deliveryFee == 0 ? 'Free' : englishToBengali(number_format($deliveryFee, 2).'Tk') }}</p>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-between">
                                            <p class="fsw-semibold">Total</p>
                                            <p class="fsw-semibold">{{ $totalPriceInBengali }}Tk</p>
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
                                    <a href="{{ route('products') }}" class="btn review-btn">Return to sweets</a>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </form>
        </div>

    </section>

@endsection

@push('scripts')
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
