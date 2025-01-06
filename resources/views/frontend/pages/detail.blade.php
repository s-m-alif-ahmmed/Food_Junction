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
{{--                        <div class="col-12 more-img-main-box">--}}
{{--                            <div class="more-img-box">--}}
{{--                                <img src="{{ asset('/frontend/images/section/home/image-4.jpg') }}" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="more-img-box">--}}
{{--                                <img src="{{ asset('/frontend/images/section/home/image-11.jpg') }}" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="more-img-box">--}}
{{--                                <img src="{{ asset('/frontend/images/section/home/image-6.jpg') }}" alt="">--}}
{{--                            </div>--}}
{{--                            <div class="more-img-box">--}}
{{--                                <img src="{{ asset('/frontend/images/section/home/image-8.jpg') }}" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-md-8 col-sm-12 col-12">
                    <div class="mt-2">
                        <h2>{{ $product->name }}</h2>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <div class="">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <div class="ps-2">
                            <span class="fs-12">
                                (312 ratings)
                            </span>
                            </div>
                        </div>
                        <div class="">
{{--                            <button class="wishlist-btn" data-product-id="{{ $product->id }}">--}}
{{--                                @if(Auth::check() && Auth::user()->wishlist->contains('product_id', $product->id))--}}
                                    <i class="fa-solid fa-heart fs-22" style="color: red;"></i>
{{--                                @else--}}
{{--                                    <i class="fa-solid fa-heart fs-22" style="color: #bdbdbd;"></i>--}}
{{--                                @endif--}}
{{--                            </button>--}}
                        </div>
                    </div>
                    <div class="sweet-price">
                        <div class="d-flex">
                            <p class="price">{{ $product->price }} Tk</p>
                            <span class="discount-price">&nbsp;(<del>{{ $product->discount_price }} Tk</del>)</span>
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

                        <div class="sweet-weight">
                            <div class="d-flex">
                                <div class="pe-3">
                                    <span>
                                        ওজন:
                                    </span>
                                </div>
                                <div class="pe-3">
                                    <select name="weight" id="" class="" style="width: 150px;">
                                        <option value="500" selected>৫০০ গ্রাম</option>
                                        <option value="1000">১ কেজি</option>
                                        <option value="1500">১.৫ কেজি</option>
                                        <option value="2000">২ কেজি</option>
                                        <option value="2500">২.৫ কেজি</option>
                                        <option value="3000">৩ কেজি</option>
                                        <option value="4000">৪ কেজি</option>
                                        <option value="5000">৫ কেজি</option>
                                        <option value="6000">৬ কেজি</option>
                                        <option value="7000">৭ কেজি</option>
                                        <option value="8000">৮ কেজি</option>
                                        <option value="9000">৯ কেজি</option>
                                        <option value="10000">১০ কেজি</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        @if(Auth::check())
                            <div class="offer my-3 p-3 rounded shadow-sm bg-light text-center">
                                <span class="">
                                    <i class="fa-solid fa-tag me-2 text-warning"></i>Hurrah
                                    you earn <strong>5% discount!</strong>
                                </span>
                            </div>
                        @else
                            <div class="offer my-3 p-3 rounded shadow-sm bg-light text-center">
                                <span class="">
                                    <i class="fa-solid fa-tag me-2 text-warning"></i>
                                    <a href="{{ route('login') }}" class="fw-bold text-decoration-underline">Login</a>
                                    and get <strong>5% discount!</strong>
                                </span>
                            </div>
                        @endif
                        <div class="offer my-3 p-3 rounded shadow-sm bg-light text-center">
                            <span class="">
                                <i class="fa-solid fa-tag me-2 text-warning"></i>
                                If you order <strong>2kg</strong> then <strong>delivery free</strong>!
                            </span>
                        </div>
                        <div class="mt-4">
                            <button class="btn cart-btn m-1" style="background-color: var(--yellow);" type="submit" > <i class="fa-solid fa-shopping-cart"></i> Add to Cart</button>
{{--                            <button class="btn cart-btn m-1" style="background-color: var(--red);"> <i class="fa-solid fa-money-check-dollar"></i> Purchase Now</button>--}}
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
                                    <img src="{{ asset($review->user->avatar ?? 'frontend/images/section/home/image-2.png') }}" alt="Avatar">
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
        document.getElementById('add-to-cart-form').addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            const form = this;
            const formData = new FormData(form);
            const product_id = formData.get('product_id');
            const weight = formData.get('weight');
            const user_id = formData.get('user_id');
            const csrfToken = document.querySelector('input[name="_token"]').value;

            // Send the form data to the server
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id,
                    weight,
                    user_id,
                }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccessToast(data.message);
                    } else {
                        showErrorToast(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

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
