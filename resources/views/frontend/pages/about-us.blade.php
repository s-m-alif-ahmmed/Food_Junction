@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    About | Food Junction
@endsection

@section('content')

    @include('frontend.includes.top-nav-button')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">About Us</p>
                </div>
            </div>
        </div>

        <div class="container my-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="w-100 rounded-3 overflow-hidden shadow">
                        <img class="img-fluid w-100" src="{{ asset('/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="Food Junction">
                    </div>
                </div>
                <div class="col-md-6 my-auto text-justify ps-md-5 mt-4 mt-md-0">
                    <p class="fs-40 fsw-bold color-gradient">Food Junction Story</p>
                    <p class="fs-18 text-muted line-height-1-8">
                        Welcome to Food Junction, where passion meets flavor. Our journey started with a simple idea: to bring the authentic taste of premium sweets and traditional delicacies to your doorstep. We believe that food is not just about sustenance; it's about creating memories and celebrating life's special moments.
                    </p>
                    <p class="fs-18 text-muted line-height-1-8">
                        From our kitchen to your table, every item is crafted with love, using only the finest ingredients. Whether you're craving traditional Bangladeshi sweets or modern snacks, Food Junction is your ultimate destination for quality and taste.
                    </p>
                </div>
            </div>
        </div>

        {{-- Mission & Vision Section --}}
        <div class="container-fluid bg-light py-5 my-5">
            <div class="container">
                <div class="row text-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="card h-100 border-0 shadow-sm p-4 rounded-4">
                            <div class="mb-3">
                                <i class="fa-solid fa-bullseye fs-48 text-danger"></i>
                            </div>
                            <h3 class="fsw-bold mb-3">Our Mission</h3>
                            <p class="text-muted">To provide our customers with the highest quality food products that combine traditional recipes with modern hygiene standards, ensuring every bite is a delight.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-0 shadow-sm p-4 rounded-4">
                            <div class="mb-3">
                                <i class="fa-solid fa-eye fs-48 text-danger"></i>
                            </div>
                            <h3 class="fsw-bold mb-3">Our Vision</h3>
                            <p class="text-muted">To become the most trusted and loved food brand in Dhaka, recognized for our commitment to quality, authenticity, and exceptional customer service.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Why Choose Us Section --}}
        <div class="container my-5 pb-5">
            <div class="text-center mb-5">
                <h2 class="fs-40 fsw-bold">Why Choose <span class="color-gradient">Food Junction</span>?</h2>
                <div class="mx-auto bg-danger" style="height: 3px; width: 60px;"></div>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="text-center p-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-utensils fs-32 text-danger"></i>
                        </div>
                        <h5 class="fsw-bold">Premium Quality</h5>
                        <p class="text-muted small">We use only the freshest and best ingredients in all our recipes.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center p-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-truck-fast fs-32 text-danger"></i>
                        </div>
                        <h5 class="fsw-bold">Fast Delivery</h5>
                        <p class="text-muted small">Quick and reliable delivery service across Dhaka city.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center p-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-shield-halved fs-32 text-danger"></i>
                        </div>
                        <h5 class="fsw-bold">Hygienic Process</h5>
                        <p class="text-muted small">Strict hygiene standards maintained from preparation to packaging.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="text-center p-3">
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 80px; height: 80px;">
                            <i class="fa-solid fa-headset fs-32 text-danger"></i>
                        </div>
                        <h5 class="fsw-bold">24/7 Support</h5>
                        <p class="text-muted small">Dedicated support team to assist you with your orders anytime.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
