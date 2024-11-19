@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Food Junction | Sweets
@endsection

@section('content')

    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-12 ">
                            <div class="img-box">
                                <img src="{{ asset('/frontend/images/section/home/image-4.jpg') }}" alt="">
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
                        <h2>Sweet Name</h2>
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
                            <a href="">
                                <i class="fa-solid fa-heart fs-22" style="color: var(--red);"></i>
                            </a>
{{--                            <a href="">--}}
                                {{--                            <i class="fa-solid fa-heart fs-22" style="color: #bdbdbd;"></i>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                    <div class="sweet-price">
                        <div class="d-flex">
                            <p class="price">100.00 Tk</p>
                            <span class="discount-price">&nbsp;(<del>120.00 Tk</del>)</span>
                        </div>
                    </div>
                    <div class="sweet-wight">
                        <div class="d-flex">
                            <div class="pe-3">
                                <span>
                                    Wight:
                                </span>
                            </div>
                            <div class="pe-3">
                                <input type="radio" id="wight1" name="wight" />
                                <label for="wight1">500gm</label>
                            </div>
                            <div class="pe-3">
                                <input type="radio" id="wight2" name="wight" />
                                <label for="wight2">1kg</label>
                            </div>
                            <div class="pe-3">
                                <input type="radio" id="wight3" name="wight" />
                                <label for="wight3">1.5kg</label>
                            </div>
                            <div class="pe-3">
                                <input type="radio" id="wight4" name="wight" />
                                <label for="wight4">2kg</label>
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
                        <a class="btn cart-btn m-1" style="background-color: var(--yellow);" href="#"> <i class="fa-solid fa-shopping-cart"></i> Add to Cart</a>
                        <a class="btn cart-btn m-1" style="background-color: var(--red);" href="#"> <i class="fa-solid fa-money-check-dollar"></i> Purchase Now</a>
                    </div>

                    <style>


                    </style>

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
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Ab accusamus ad aperiam aspernatur atque consequatur corporis cumque
                            ducimus illo impedit laborum magnam sed soluta
                            tenetur vero vitae voluptas,
                            voluptatibus voluptatum!
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Ab accusamus ad aperiam aspernatur atque consequatur corporis cumque
                            ducimus illo impedit laborum magnam sed soluta
                            tenetur vero vitae voluptas,
                            voluptatibus voluptatum!
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Ab accusamus ad aperiam aspernatur atque consequatur corporis cumque
                            ducimus illo impedit laborum magnam sed soluta
                            tenetur vero vitae voluptas,
                            voluptatibus voluptatum!
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Ab accusamus ad aperiam aspernatur atque consequatur corporis cumque
                            ducimus illo impedit laborum magnam sed soluta
                            tenetur vero vitae voluptas,
                            voluptatibus voluptatum!
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
                    <form action="" class="">
                        @csrf
                        @method('POST')

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
                            </div>
                        </div>

                        <div class="row py-1">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="name" class="pb-1">Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="First name" aria-label="First name">
{{--                                <div class="error-message">--}}
{{--                                    <span>Required Field*</span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                <label for="email" class="pb-1">Email</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Last name" aria-label="Last name">
{{--                                <div class="error-message">--}}
{{--                                    <span>Required Field*</span>--}}
{{--                                </div>--}}
                            </div>
                        </div>

                        <div class="row py-1">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="review" class="pb-1">Review</label>
                                <textarea name="review" class="form-control" id="review" cols="30" rows="3"></textarea>
{{--                                <div class="error-message">--}}
{{--                                    <span>Required Field*</span>--}}
{{--                                </div>--}}
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
            <div class="row reviews">
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 shadow-sm rounded">
                        <div class="avatar-img-box me-3">
                            <img src="{{ asset('frontend/images/section/home/image-2.png') }}" alt="Avatar">
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name fw-bold mb-1">John Doe</p>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <span class="review-date text-muted">12 Nov, 2024</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, consectetur dignissimos dolor laborum libero nihil optio possimus quaerat quas, quidem quod recusandae reprehenderit sunt velit voluptatum! Facere numquam possimus saepe.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 shadow-sm rounded">
                        <div class="avatar-img-box me-3">
                            <img src="{{ asset('frontend/images/section/home/image-2.png') }}" alt="Avatar">
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name fw-bold mb-1">John Doe</p>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <span class="review-date text-muted">12 Nov, 2024</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, consectetur dignissimos dolor laborum libero nihil optio possimus quaerat quas, quidem quod recusandae reprehenderit sunt velit voluptatum! Facere numquam possimus saepe.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 shadow-sm rounded">
                        <div class="avatar-img-box me-3">
                            <img src="{{ asset('frontend/images/section/home/image-2.png') }}" alt="Avatar">
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name fw-bold mb-1">John Doe</p>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <span class="review-date text-muted">12 Nov, 2024</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, consectetur dignissimos dolor laborum libero nihil optio possimus quaerat quas, quidem quod recusandae reprehenderit sunt velit voluptatum! Facere numquam possimus saepe.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 shadow-sm rounded">
                        <div class="avatar-img-box me-3">
                            <img src="{{ asset('frontend/images/section/home/image-2.png') }}" alt="Avatar">
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name fw-bold mb-1">John Doe</p>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <span class="review-date text-muted">12 Nov, 2024</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, consectetur dignissimos dolor laborum libero nihil optio possimus quaerat quas, quidem quod recusandae reprehenderit sunt velit voluptatum! Facere numquam possimus saepe.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 shadow-sm rounded">
                        <div class="avatar-img-box me-3">
                            <img src="{{ asset('frontend/images/section/home/image-2.png') }}" alt="Avatar">
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name fw-bold mb-1">John Doe</p>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <span class="review-date text-muted">12 Nov, 2024</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, consectetur dignissimos dolor laborum libero nihil optio possimus quaerat quas, quidem quod recusandae reprehenderit sunt velit voluptatum! Facere numquam possimus saepe.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 shadow-sm rounded">
                        <div class="avatar-img-box me-3">
                            <img src="{{ asset('frontend/images/section/home/image-2.png') }}" alt="Avatar">
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name fw-bold mb-1">John Doe</p>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <span class="review-date text-muted">12 Nov, 2024</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, consectetur dignissimos dolor laborum libero nihil optio possimus quaerat quas, quidem quod recusandae reprehenderit sunt velit voluptatum! Facere numquam possimus saepe.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 shadow-sm rounded">
                        <div class="avatar-img-box me-3">
                            <img src="{{ asset('frontend/images/section/home/image-2.png') }}" alt="Avatar">
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name fw-bold mb-1">John Doe</p>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <span class="review-date text-muted">12 Nov, 2024</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, consectetur dignissimos dolor laborum libero nihil optio possimus quaerat quas, quidem quod recusandae reprehenderit sunt velit voluptatum! Facere numquam possimus saepe.
                        </p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center p-3 shadow-sm rounded">
                        <div class="avatar-img-box me-3">
                            <img src="{{ asset('frontend/images/section/home/image-2.png') }}" alt="Avatar">
                        </div>
                        <div class="review-info">
                            <p class="reviewer-name fw-bold mb-1">John Doe</p>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-yellow"></i>
                                <i class="fa-solid fa-star star-non-yellow"></i>
                            </div>
                            <span class="review-date text-muted">12 Nov, 2024</span>
                        </div>
                    </div>
                    <div class="px-4">
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur, consectetur dignissimos dolor laborum libero nihil optio possimus quaerat quas, quidem quod recusandae reprehenderit sunt velit voluptatum! Facere numquam possimus saepe.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
