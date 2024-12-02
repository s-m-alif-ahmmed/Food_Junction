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
                            <p class="hero-header">ফুড জাংশন - মিষ্টির মোড়কে সততার প্রতিশ্রুতি</p>
                        </div>
                        <p class="hero-text">
                            ফুড জাংশন আপনাদের জন্য নিয়ে এসেছে বাংলাদেশের ঐতিহ্যবাহী মিষ্টির স্বাদ। গাইবান্ধার বিখ্যাত রসমঞ্জরী, হাঁড়ি ভাঙা, এবং সুস্বাদু মালাইচপ (সুগার ফ্রি)-এর মাধ্যমে আমরা নিশ্চিত করি গুণগত মান ও স্বাদ। প্রতিটি মিষ্টির পেছনে রয়েছে আমাদের সততার গল্প এবং দেশজ ঐতিহ্যের ছোঁয়া।
                        </p>
                        <div class="order-now-btn-div">
                            <a class="fw-bold order-now-btn fs-20" href="{{ route('sweets') }}">
                                Order Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-2 px-0">
                    <img class="img-fluid w-100 object-fit-cover" src="{{ asset('/frontend/images/section/home/Gaibandha-Poster-1-500x500.jpg') }}" alt="">
                </div>
            </div>

            <div class="row py-5">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold fs-32">ঐতিহ্যের আসল স্বাদ</p>
                </div>
                <div class="col-md-8 mx-auto">
                    <p class="sweet-list-text">
                        ফুড জাংশন" নিয়ে এসেছে ঐতিহ্যের আসল স্বাদ। গাইবান্ধার বিখ্যাত রসমঞ্জরী, সুস্বাদু হাঁড়ি ভাঙা, এবং স্বাস্থ্যকর মালাইচপ (সুগার ফ্রি) মিষ্টির প্রতিটি টুকরোয় খুঁজে পাবেন বাংলাদেশের মিষ্টি ঐতিহ্যের বিশেষ স্বাদ। খাঁটি উপাদান আর নিখুঁত যত্নে তৈরি এই মিষ্টিগুলো শুধুই খাবার নয়; এটি ঐতিহ্যের গল্প ও সততার প্রতিফলন।
                    </p>
                </div>
                <div class="row py-3">
                    @foreach($products as $product)
                    <div class="col-md-4 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-0 text-center mb-3 h-100">
                                <h5 class="fsw-bold">{{ $product->name }}</h5>
                                <p class="">{{ $product->short_description }}</p>
                                <a href="{{ route('sweets.detail', $product->product_slug) }}" class="order-now-btn fw-bold">Read More</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="row py-5">
                <div class="col-md-6 order-3 px-0">
                    <div class="">
                        <img class="img-fluid w-100 object-fit-cover" src="{{ asset('/frontend/images/section/home/roshmonjuri-Poster-1-500x500.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center order-4">
                    <div class="px-3 row-three-div">
                        <p class="fw-bold fs-32 text-uppercase">
                            স্বাস্থ্যসচেতনদের জন্য মিষ্টতা
                        </p>
                        <p class="fs-18 py-3 text-lg-justify">
                            ফুড জাংশনের বিখ্যাত রসমঞ্জরী, হাঁড়ি ভাঙা, এবং মালাইচপ (সুগার ফ্রি) মিষ্টি নিয়ে গ্রাহকরা দারুণ প্রশংসা করেছেন। রসমঞ্জরীকে কেউ বলেছেন "স্বাদে অতুলনীয়", হাঁড়ি ভাঙাকে উল্লেখ করেছেন "ঐতিহ্যের মিষ্টি", আর মালাইচপ সম্পর্কে বলেছেন "স্বাস্থ্যসচেতন মিষ্টির আদর্শ উদাহরণ"। এই মিষ্টিগুলোর স্বাদ, গুণগত মান, আর সততার কারণে ফুড জাংশন দ্রুতই দেশের মিষ্টি প্রেমীদের কাছে প্রিয় হয়ে উঠেছে। আপনার প্রিয়জনের মুখে হাসি ফোটাতে আজই অর্ডার করুন!
                        </p>
                        <div class="row-three-btn">
                            <a class="order-now-btn fw-bold fs-22" href="{{ route('sweets') }}">Order Now</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 d-flex align-items-center">
                    <div class="row-fou-div">
                        <p class="fw-bold fs-28">আমাদের বিশেষ মিষ্টি</p>
                        <p class="fw-normal text-justify">
                            ফুড জাংশনের স্পেশালিটি হলো গাইবান্ধার ঐতিহ্যবাহী স্বাদকে সবার কাছে পৌঁছে দেওয়া। খাঁটি উপাদানে তৈরি রসমঞ্জরী, হাঁড়ি ভাঙা, ও মালাইচপ (সুগার ফ্রি) মিষ্টি আমাদের সততা ও মানের প্রতীক। এটি শুধু মিষ্টি নয়, ঐতিহ্যের গল্প।
                        </p>
                        <a class="view-all-btn fw-bold fs-22" href="{{ route('sweets') }}">View All</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row m-3">
                        <section class="center slider">
                            @foreach($products as $product)
                                <div>
                                    <div class="card border-0 custom-shadow">
                                        <div class="home--sweet-card">
                                            <img src="{{ asset('/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top img-fluid" alt="..." >
                                        </div>
                                        <div class="card-body border-0 text-center h-100 pb-0">
                                            <h6 class="card-title p-0 m-0 fsw-bold">{{ $product->name }}</h6>
                                            <div class="justify-content-center sweet-card-bottom my-2">
                                                <a href="{{ route('sweets.detail', $product->product_slug) }}" class="fs-16 fw-semibold text-decoration-none" style="color: #EE3441;">Read More <i class="fa-solid fa-arrow-right-long"></i> </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </section>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-6 px-0">
                    <img class="object-fit-cover img-fluid w-100" src="{{ asset('/frontend/images/section/home/Food-Junction-Thumbnail-500x500.jpg') }}" alt="..." >
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
                            আপনার পছন্দের মিষ্টি, এক ক্লিকেই আপনার দুয়ারে
                        </p>
                        <p class="fs-18 py-3 text-justify row-six-text-body">
                            বাংলাদেশের অন্যতম সেরা মিষ্টির অনলাইন প্ল্যাটফর্ম, যেখানে দেশের ঐতিহ্যবাহী এবং প্রিমিয়াম মানের মিষ্টি সহজেই পাওয়া যায়। খাঁটি উপাদান এবং সততার প্রতিশ্রুতি দিয়ে তৈরি প্রতিটি মিষ্টি গ্রাহকদের সন্তুষ্টি নিশ্চিত করে। দেশের যেকোনো প্রান্ত থেকে আপনার প্রিয় মিষ্টি অর্ডার করুন এবং উপভোগ করুন অনন্য স্বাদ। "আমাদেরটা" শুধু মিষ্টি নয়, এটি মিষ্টি খাওয়ার অভিজ্ঞতাকে বিশেষ করে তোলে।
                        </p>
                        <div class="row-six-btn">
                            <a class="view-all-btn fw-bold fs-22" href="">View All</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-0 order-6">
                    <div class="">
                        <img class="img-fluid w-100 object-fit-cover" src="{{ asset('/frontend/images/section/home/Gaibandhar-mishti-dhakay-Poster-500x750.jpg') }}" alt="">
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
                        breakpoint: 992, // Mobile breakpoint
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            autoplay: true,        // Enable auto slide in mobile view
                            autoplaySpeed: 2000,   // Auto slide every 2 seconds
                            infinite: true,        // Infinite scrolling in mobile view
                            dots: true             // Enable dots in mobile view if needed
                        }
                    },
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
