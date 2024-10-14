@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Food Junction
@endsection

@section('content')

    <section class="hero-section py-5">
        <div class="container">

            <div class="row">
                <div class="col-md-6 d-flex align-items-center order-1">
                    <div class="hero-left">
                        <div class="hero-header-div">
                            <p class="hero-header">Sweet Taste Better When You Eat It With Your Family</p>
                        </div>
                        <p class="hero-text">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore ducimus eaque fuga ipsam
                            laboriosam modi odio quo.
                        </p>
                        <div class="order-now-btn-div">
                            <a class="fw-bold order-now-btn fs-20" href="">
                                Order Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-2 px-0">
                    <img class="img-fluid w-100 object-fit-cover" src="{{ asset('/frontend/images/section/home/image-2.png') }}" alt="">
                </div>
            </div>

            <div class="row py-5">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold fs-32">Our Special Sweets</p>
                </div>
                <div class="col-md-8 mx-auto">
                    <p class="sweet-list-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto commodi consequuntur rem sint tenetur.  consectetur adipisicing elit. Obcaecati, tenetur.</p>
                </div>
                <div class="row py-3">
                    <div class="col-md-4 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <img src="{{ asset('/frontend/images/section/home/image-2.png') }}" class="card-img-top" alt="...">
                            <div class="card-body border-0 text-center mb-3 h-100">
                                <h5 class="card-title">Sweet Name</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet.</p>
                                <a href="#" class="order-now-btn fw-bold">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <img src="{{ asset('/frontend/images/section/home/image-2.png') }}" class="card-img-top" alt="...">
                            <div class="card-body border-0 text-center mb-3 h-100">
                                <h5 class="card-title">Sweet Name</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet.</p>
                                <a href="#" class="order-now-btn fw-bold">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <img src="{{ asset('/frontend/images/section/home/image-2.png') }}" class="card-img-top" alt="...">
                            <div class="card-body border-0 text-center mb-3 h-100">
                                <h5 class="card-title">Sweet Name</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet.</p>
                                <a href="#" class="order-now-btn fw-bold">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row py-5">
                <div class="col-md-6 order-3 px-0">
                    <div class="">
                        <img class="img-fluid w-100 object-fit-cover" src="{{ asset('/frontend/images/section/home/image-2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center order-4">
                    <div class="px-3 row-three-div">
                        <p class="fw-bold fs-32 text-uppercase">
                            An Outstanding master of italian cusine
                        </p>
                        <p class="fs-18 py-3 text-lg-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aspernatur dignissimos fuga fugiat quas! Ad asperiores consequuntur cupiditate ducimus est, nam.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam aspernatur distinctio ipsum laudantium necessitatibus porro saepe tenetur veniam voluptatum.
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        </p>
                        <div class="row-three-btn">
                            <a class="order-now-btn fw-bold fs-22" href="">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <div class="row-fou-div">
                        <p class="fw-bold fs-28">Our Special Sweet</p>
                        <p class="fw-normal text-justify">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, animi aspernatur atque beatae!Ab, animi aspernatur atque beatae itaque nesciunt!
                        </p>
                        <a class="view-all-btn fw-bold fs-22" href="">View All</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row m-3">
                        <section class="center slider">
                            <div>
                                <div class="card border-0 custom-shadow">
                                    <div class="" style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset('/frontend/images/section/home/image-2.png') }}" class="card-img-top img-fluid w-100" alt="..." >
                                    </div>
                                    <div class="card-body border-0 text-center h-100 pb-0">
                                        <h5 class="card-title p-0 m-0">Sweet Name</h5>
                                        <p class="card-text p-0 mb-2">Some quick example text to</p>
                                        <div class="d-flex justify-content-between">
                                            <p class="fw-bold fs-16">$10.00</p>
                                            <a href="#" class="fs-16 p-0 m-0 fw-semibold text-decoration-none" style="color: #EE3441;">Read More <i class="fa-solid fa-arrow-right-long"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="card border-0 custom-shadow">
                                    <div class="" style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset('/frontend/images/section/home/image-2.png') }}" class="card-img-top img-fluid w-100" alt="..." >
                                    </div>
                                    <div class="card-body border-0 text-center h-100 pb-0">
                                        <h5 class="card-title p-0 m-0">Sweet Name</h5>
                                        <p class="card-text p-0 mb-2">Some quick example text to</p>
                                        <div class="d-flex justify-content-between">
                                            <p class="fw-bold fs-16">$10.00</p>
                                            <a href="#" class="fs-16 p-0 m-0 fw-semibold text-decoration-none" style="color: #EE3441;">Read More <i class="fa-solid fa-arrow-right-long"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="card border-0 custom-shadow">
                                    <div class="" style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset('/frontend/images/section/home/image-2.png') }}" class="card-img-top img-fluid w-100" alt="..." >
                                    </div>
                                    <div class="card-body border-0 text-center h-100 pb-0">
                                        <h5 class="card-title p-0 m-0">Sweet Name</h5>
                                        <p class="card-text p-0 mb-2">Some quick example text to</p>
                                        <div class="d-flex justify-content-between">
                                            <p class="fw-bold fs-16">$10.00</p>
                                            <a href="#" class="fs-16 p-0 m-0 fw-semibold text-decoration-none" style="color: #EE3441;">Read More <i class="fa-solid fa-arrow-right-long"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="card border-0 custom-shadow">
                                    <div class="" style="height: 200px; overflow: hidden;">
                                        <img src="{{ asset('/frontend/images/section/home/image-2.png') }}" class="card-img-top img-fluid w-100" alt="..." >
                                    </div>
                                    <div class="card-body border-0 text-center h-100 pb-0">
                                        <h5 class="card-title p-0 m-0">Sweet Name</h5>
                                        <p class="card-text p-0 mb-2">Some quick example text to</p>
                                        <div class="d-flex justify-content-between">
                                            <p class="fw-bold fs-16">$10.00</p>
                                            <a href="#" class="fs-16 p-0 m-0 fw-semibold text-decoration-none" style="color: #EE3441;">Read More <i class="fa-solid fa-arrow-right-long"></i> </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </section>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-6 px-0">
                    <img class="object-fit-cover img-fluid w-100" src="{{ asset('/frontend/images/section/home/image-1.png') }}" alt="..." >
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="row overflow-hidden">
                        <section class="testimonial slider">
                            <div>
                                <p class="pb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aspernatur atque autem blanditiis
                                    delectus distinctio doloremque dolorum ea expedita id, illum in incidunt inventore
                                    ipsam laborum nihil quidem similique voluptatibus? Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Consectetur eveniet?
                                </p>
                                <p class="fw-bold p-0 m-0 fs-18">Md. Muktadim Sijan</p>
                                <p class="p-0 m-0">Lorem ipsum dolor.</p>
                            </div>
                            <div>
                                <p class="pb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aspernatur atque autem blanditiis
                                    delectus distinctio doloremque dolorum ea expedita id, illum in incidunt inventore
                                    ipsam laborum nihil quidem similique voluptatibus? Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Consectetur eveniet?
                                </p>
                                <p class="fw-bold p-0 m-0 fs-18">Md. Muktadim Sijan</p>
                                <p class="p-0 m-0">Lorem ipsum dolor.</p>
                            </div>
                            <div>
                                <p class="pb-2">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad aspernatur atque autem blanditiis
                                    delectus distinctio doloremque dolorum ea expedita id, illum in incidunt inventore
                                    ipsam laborum nihil quidem similique voluptatibus? Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                    Consectetur eveniet?
                                </p>
                                <p class="fw-bold p-0 m-0 fs-18">Md. Muktadim Sijan</p>
                                <p class="p-0 m-0">Lorem ipsum dolor.</p>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <div class="row pb-5">
                <div class="col-md-6 d-flex align-items-center order-5">
                    <div class="row-six-text px-3">
                        <p class="fw-bold fs-32 py-0 my-0 text-uppercase row-six-text-header">
                            Now you can order on mobile phone
                        </p>
                        <p class="fs-18 py-3 text-justify row-six-text-body">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. consectetur adipisicing elit. Magnam, ratione! Aspernatur dignissimos fuga fugiat quas! Ad asperiores consequuntur cupiditate ducimus est, nam.
                        </p>
                        <div class="row-six-btn">
                            <a class="view-all-btn fw-bold fs-22" href="">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-0 order-6">
                    <div class="">
                        <img class="img-fluid w-100 object-fit-cover" src="{{ asset('/frontend/images/section/home/image-1.png') }}" alt="">
                    </div>
                </div>

            <style type="text/css">

                .slider {
                    width: 100%;
                    margin: 20px auto;
                }

                .slick-slide {
                    margin: 20px;
                }

                .slick-slide card {
                    width: 100%;
                }

                .slick-prev:before,
                .slick-next:before {
                    color: black;
                }

                /*.slick-dots .slick-active button:before {*/
                /*    color: red !important;*/
                /*}*/

                /* Customizing slick dots */
                .slick-dots {
                    text-align: start;
                    margin: 5px 15px;
                    padding: 0;
                    list-style: none;
                }
                @media screen and (min-width: 100px) and (max-width: 768px){
                    .slick-dots {
                        text-align: center;
                        margin: 50px 5px 10px 5px !important;
                        padding: 0;
                        list-style: none;
                    }
                }

                .slick-dots li {
                    display: inline-block;
                    margin: 0 5px;
                }

                .slick-dots li button {
                    font-size: 0;
                    line-height: 0;
                    display: block;
                    width: 6px;
                    height: 6px;
                    padding: 5px;
                    cursor: pointer;
                    color: black;
                    border: none;
                    outline: none;
                    background: transparent;
                    position: relative;
                }

                /* Default round dot */
                .slick-dots li button:before {
                    content: "";
                    display: block;
                    width: 6px;
                    height: 6px;
                    background-color: #6b6b6b; /* Default dot color */
                    border-radius: 50%;
                }

                /* Active dot styled as a dash */
                .slick-dots li.slick-active button:before {
                    content: "";
                    display: block;
                    position: absolute;
                    width: 15px; /* Dash width */
                    height: 5px;  /* Dash height */
                    background-color: red; /* Active dot color */
                    border-radius: 10px; /* Rounded sides for the dash */
                }

                .slick-dots li button:focus {
                    outline: none;
                }

            </style>

        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>

    <script type="text/javascript">
        $(document).on('ready', function() {
            $(".center").slick({
                dots: false,
                infinite: false,
                centerMode: false,
                autoplay: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 768, // Mobile breakpoint
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: true,        // Enable auto slide in mobile view
                            autoplaySpeed: 2000,   // Auto slide every 2 seconds
                            infinite: true,        // Infinite scrolling in mobile view
                            dots: true             // Enable dots in mobile view if needed
                        }
                    }
                ]
            });
            $(".testimonial").slick({
                dots: true,
                infinite: true,
                centerMode: false,
                autoplay: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 768, // Mobile breakpoint
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            autoplay: true,        // Enable auto slide in mobile view
                            autoplaySpeed: 2000,   // Auto slide every 2 seconds
                            infinite: true,        // Infinite scrolling in mobile view
                            dots: true             // Enable dots in mobile view if needed
                        }
                    }
                ]
            });
        });
    </script>

@endsection
