@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="title" content="{{ $product->meta_title }}">
    <meta name="description" content="{{ $product->meta_description }}">
    <meta name="keywords" content="{{ $product->meta_keywords }}">
@endsection

@section('title')
    {{ $product->name }} | Food Junction
@endsection

@section('content')

    @include('frontend.includes.top-nav-button')

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="img-box">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/roshmonjuri-500x500.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-12">
                    <div class="mt-2">
                        <h2>{{ $product->name }}</h2>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div>
                                {{-- Calculate the average rating --}}
                                @php
                                    $averageRating = $product_reviews->avg('rating') ?? 0; // Average of 'rating' field
                                    $ratingsCount = $product_reviews->count(); // Total number of reviews
                                @endphp

                                {{-- Display filled stars based on average rating --}}
                                @for ($i = 0; $i < floor($averageRating); $i++)
                                    <i class="fa-solid fa-star star-yellow"></i>
                                @endfor

                                {{-- Display half star if needed --}}
                                @if ($averageRating - floor($averageRating) >= 0.5)
                                    <i class="fa-solid fa-star-half-alt star-yellow"></i>
                                @endif

                                {{-- Display remaining empty stars --}}
                                @for ($i = ceil($averageRating); $i < 5; $i++)
                                    <i class="fa-solid fa-star star-non-yellow"></i>
                                @endfor
                            </div>
                            <div class="ps-2">
                                <span class="fs-12">
                                    ({{ $ratingsCount }} ratings)
                                </span>
                            </div>
                        </div>


                        <div class="">
                            @if (Auth::check())
                                <button class="bookmark-btn bg-white border-0" type="button" onclick="toggleBookmark({{ $product->id }}, this)">
                                    <i class="fa-solid fa-heart bg-white fs-22 wishlist-icon" style="color: {{ $product->wishlistByUsers->contains(auth()->id()) ? 'red' : '#bdbdbd' }};"></i>
                                </button>
                            @else
                                <button class="bookmark-btn bg-white border-0" type="button" onclick="toggleBookmark({{ $product->id }}, this)">
                                    <i class="fa-solid fa-heart bg-white fs-22" style="color: #bdbdbd;"></i>
                                </button>
                            @endif

                        </div>
                    </div>
                    <div class="sweet-price">
                        <div id="price-variant-display" class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                @php
                                    $firstVariant = $product->variants->first();
                                    $price = $firstVariant ? $firstVariant->price : 0;
                                    $discount = $firstVariant ? $firstVariant->sale_price : null;
                                    $quantity = $firstVariant ? $firstVariant->quantity : '';
                                    $unit = $firstVariant ? ($firstVariant->unit_type ?? $firstVariant->unit) : '';
                                    $unitText = match($unit) {
                                        'gm' => 'গ্রাম',
                                        'pc' => 'পিস',
                                        default => ucfirst($unit),
                                    };
                                @endphp
                                <p class="price mb-0 fs-24 fw-bold">{{ $discount ?? $price }} টাকা</p>
                                @if($discount)
                                    <span class="discount-price">&nbsp;(<del>{{ $price }} টাকা</del>)</span>
                                @endif
                            </div>
                            @if($quantity)
                                <p class="variant-quantity mb-0 fw-bold fs-18 text-muted">{{ $quantity }} {{ $unitText }}</p>
                            @endif
                        </div>
                    </div>
                    <form id="add-to-cart-form" action="{{ route('new.cart') }}" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="product_id" value="{{ $product->id }}" />

                        @if(Auth::check())
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        @else
                            <input type="hidden" name="user_id" value="" />
                        @endif

                        @if($product->type != 'pcs' && $product->variants && count($product->variants) > 0)
                            <div class="sweet-weight my-3">
                                <div class="d-flex align-items-center">
                                    <div class="pe-3">
                                        <span class="unit-label">{{ ($product->variants->first() && in_array($product->variants->first()->unit_type ?? $product->variants->first()->unit, ['pc', 'pcs'])) ? 'পিস:' : ($product->type == 'gram' ? 'ওজন:' : ucfirst($product->type) . ':') }}</span>
                                    </div>
                                    <div class="pe-3">
                                        <select name="variant_id" id="variant_select" class="form-select" style="width: 150px;">
                                            @foreach($product->variants as $index => $variant)
                                                @php
                                                    $unit = $variant->unit_type ?? $variant->unit;

                                                    $unitText = match($unit) {
                                                        'gm' => 'গ্রাম',
                                                        'pc' => 'পিস',
                                                        default => ucfirst($unit),
                                                    };
                                                @endphp

                                                <option value="{{ $variant->id }}"
                                                        data-price="{{ $variant->price }}"
                                                        data-discount="{{ $variant->sale_price }}"
                                                        data-unit="{{ $unit }}"
                                                        data-quantity="{{ $variant->quantity }}"
                                                        data-unit-text="{{ $unitText }}"
                                                        {{ $index == 0 ? 'selected' : '' }}>
                                                    {{ $variant->quantity }} {{ $unitText }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="product-detail-quantity py-2">
                            <div class="quantity">
                                <button type="button" class="minus" aria-label="Decrease">&minus;</button>
                                <input type="number" class="input-box" name="quantity" value="1" min="1" max="100">
                                <button type="button" class="plus" aria-label="Increase">&plus;</button>
                            </div>
                        </div>

                        <div class="mt-4 d-flex flex-column flex-md-row">
{{--                            <button class="btn cart-btn m-1" type="submit" > <i class="fa-solid fa-shopping-cart"></i> Add to Cart</button>--}}
                            <button class="btn buy-now-btn m-1" type="button"> <i class="fa-solid fa-bolt"></i> Order Now</button>
                        </div>

                    </form>
                </div>
            </div>
            <div class="row py-3">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="styled-heading">Description</h2>
                        <div class="text-underline"></div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-3">
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row pb-3">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="styled-heading">Reviews</h2>
                        <div class="text-underline"></div>
                    </div>
                </div>
                <div class="col-12 review-box">
                    <form action="{{ route('sweet.review.store') }}" class="" method="POST">
                        @csrf
                        @method('POST')

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        @if(Auth::check())
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        @else
                        <input type="hidden" name="user_id" value="">
                        @endif

                        <div class="row py-1">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="d-flex">
                                    <div class="rating">
                                        <input type="radio" id="star5" name="rating" value="5" />
                                        <label for="star5" title="5 stars"></label>

                                        <input type="radio" id="star4" name="rating" value="4" />
                                        <label for="star4" title="4 stars"></label>

                                        <input type="radio" id="star3" name="rating" value="3" />
                                        <label for="star3" title="3 stars"></label>

                                        <input type="radio" id="star2" name="rating" value="2" />
                                        <label for="star2" title="2 stars"></label>

                                        <input type="radio" id="star1" name="rating" value="1" />
                                        <label for="star1" title="1 star"></label>
                                    </div>
                                </div>
                                @error('rating')
                                <div class="error-message">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row py-1">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="name" class="pb-1">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" aria-label="Enter name" required>
                                @error('name')
                                <div class="error-message">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="email" class="pb-1">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter name" aria-label="Enter name" required>
                                @error('email')
                                <div class="error-message">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row py-1">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="review" class="pb-1">Review</label>
                                <textarea name="review" class="form-control" id="review" cols="30" rows="3" placeholder="Write review here" required></textarea>
                                @error('review')
                                <div class="error-message">
                                    <span>{{ $message }}</span>
                                </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-end">
                                <input type="submit" class="btn review-btn">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            @if($product_reviews->isNotEmpty())
                <div class="row reviews">
                    @foreach($product_reviews as $review)
                        <div class="col-md-6">
                            <div class="d-flex align-items-center p-3 rounded">
                                <div class="avatar-img-box me-3">
                                    <img src="{{ asset($review->user->avatar ?? 'frontend/images/default/default-avatar-profile.jpg') }}" alt="Avatar">
                                </div>
                                <div class="review-info">
                                    <p class="reviewer-name fw-bold mb-1">{{ $review->name }}</p>
                                    <div class="d-flex align-items-center">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fa-solid fa-star star-yellow"></i>
                                        @endfor
                                        @for ($i = $review->rating; $i < 5; $i++)
                                            <i class="fa-solid fa-star star-non-yellow"></i>
                                        @endfor
                                    </div>
                                    <span class="review-date text-muted">{{ \Carbon\Carbon::parse($review->created_at)->format('M j, Y') }}</span>
                                </div>
                            </div>
                            <div class="px-4">
                                <p>
                                    {{ $review->review }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            @else
            @endif

        </div>
    </section>

@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            // Handle variant selection change
            $('#variant_select').change(function() {
                let selected = $(this).find(':selected');
                let price = selected.data('price');
                let discount = selected.data('discount');
                let unit = selected.data('unit');
                let quantity = selected.data('quantity');
                let unitText = selected.data('unit-text');

                let priceHtml = `
                    <div class="d-flex align-items-center">
                        <p class="price mb-0 fs-24 fw-bold">${discount || price} টাকা</p>
                        ${discount ? `<span class="discount-price">&nbsp;(<del>${price} টাকা</del>)</span>` : ''}
                    </div>
                    ${quantity ? `<p class="variant-quantity mb-0 fw-bold fs-18 text-muted">${quantity} ${unitText}</p>` : ''}
                `;

                $('#price-variant-display').html(priceHtml);

                // Update label dynamically
                let label = (unit === 'pc' || unit === 'pcs') ? 'পিস:' : (("{{ $product->type }}" === 'gram') ? 'ওজন:' : "{{ ucfirst($product->type) }}:");
                $('.unit-label').text(label);
            });

            // Handle the form submission
            $('#add-to-cart-form').on('submit', function (e) {
                e.preventDefault(); // Prevent the default form submission
                submitCartForm($(this));
            });

            // Handle "Order Now" button click
            $('.buy-now-btn').on('click', function () {
                submitCartForm($('#add-to-cart-form'), true);
            });

            function submitCartForm(form, redirect = false) {
                // Get the form data
                let formData = form.serialize();

                // Send the AJAX request
                $.ajax({
                    url: form.attr('action'), // Form action URL
                    method: form.attr('method'), // Form method (POST)
                    data: formData, // Serialized form data
                    success: function (response) {
                        if (response.success) {
                            if (redirect) {
                                window.location.href = "{{ route('checkout') }}";
                            } else {
                                showSuccessToast(response['t-success'] || 'Item successfully added to cart!');
                            }
                        } else {
                            showErrorToast(response.error || response['t-error'] || 'Something went wrong.');
                        }
                    },
                    error: function (xhr) {
                        let message = 'An error occurred. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            message = xhr.responseJSON.error;
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            message = xhr.responseJSON.message;
                        }
                        showErrorToast(message);
                    }
                });
            }
        });
    </script>

    <script>
        (function () {
            const quantityContainer = document.querySelector(".quantity");
            if (!quantityContainer) return;
            const minusBtn = quantityContainer.querySelector(".minus");
            const plusBtn = quantityContainer.querySelector(".plus");
            const inputBox = quantityContainer.querySelector(".input-box");

            updateButtonStates();

            quantityContainer.addEventListener("click", handleButtonClick);
            inputBox.addEventListener("input", handleQuantityChange);

            function updateButtonStates() {
                const value = parseInt(inputBox.value);
                minusBtn.disabled = value <= 1;
                plusBtn.disabled = value >= parseInt(inputBox.max);
            }

            function handleButtonClick(event) {
                if (event.target.classList.contains("minus")) {
                    decreaseValue();
                } else if (event.target.classList.contains("plus")) {
                    increaseValue();
                }
            }

            function decreaseValue() {
                let value = parseInt(inputBox.value);
                value = isNaN(value) ? 1 : Math.max(value - 1, 1);
                inputBox.value = value;
                updateButtonStates();
                handleQuantityChange();
            }

            function increaseValue() {
                let value = parseInt(inputBox.value);
                value = isNaN(value) ? 1 : Math.min(value + 1, parseInt(inputBox.max));
                inputBox.value = value;
                updateButtonStates();
                handleQuantityChange();
            }

            function handleQuantityChange() {
                let value = parseInt(inputBox.value);
                value = isNaN(value) ? 1 : value;

                if (value > 100) {
                    inputBox.value = 1;  // Reset to 1 if the value exceeds 100
                }
            }

        })();
    </script>

    <script>
        function toggleBookmark(id, button) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            if (!csrfToken) {
                console.error('CSRF token meta tag is missing from the document.');
                showErrorToast('An error occurred. CSRF token is missing.');
                return;
            }

            fetch(`/wishlist/add/${id}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({}),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const icon = button.querySelector('.wishlist-icon');
                        if (data.is_wishlist) {
                            icon.style.color = 'red';
                        } else {
                            icon.style.color = '#bdbdbd';
                        }
                        showSuccessToast(data.message);
                    } else {
                        showErrorToast('Unexpected error: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorToast('You must be logged in to wishlist a product.');
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

    <script>
        $(document).on('click', '.wishlist-btn', function() {
            var productId = $(this).data('product-id');
            var $icon = $(this).find('i');

            // Check if product is already in wishlist
            if ($icon.css('color') == 'rgb(189, 189, 189)') { // Grey heart means not in wishlist
                // Add to wishlist
                $.ajax({
                    url: '/wishlist/add',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 'added') {
                            $icon.css('color', 'red');
                        } else if (response.status == 'exists') {
                            alert('Product is already in your wishlist!');
                        }
                    }
                });
            } else {
                // Remove from wishlist
                $.ajax({
                    url: '/wishlist/remove',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status == 'removed') {
                            $icon.css('color', '#bdbdbd');
                        }
                    }
                });
            }
        });

    </script>

@endpush
