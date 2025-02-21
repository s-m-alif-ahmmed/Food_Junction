@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Blog | Food Junction
@endsection

@section('content')

    @include('frontend.includes.top-nav-button')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">Blog</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row pt-3 pb-5">
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/section/home/blog.png') }}" class="card-img-top object-fit-fill" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Card title hsjkdfhds sadjak s asjsajdkajas jdsaskdja </h5>
                            <a href="{{ route('blog.detail') }}" class="order-now-btn w-auto fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/section/home/blog.png') }}" class="card-img-top object-fit-fill" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Card title hsjkdfhds sadjak s asjsajdkajas jdsaskdja </h5>
                            <a href="{{ route('blog.detail') }}" class="order-now-btn w-auto fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/section/home/blog.png') }}" class="card-img-top object-fit-fill" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Card title hsjkdfhds sadjak s asjsajdkajas jdsaskdja </h5>
                            <a href="{{ route('blog.detail') }}" class="order-now-btn w-auto fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/section/home/blog.png') }}" class="card-img-top object-fit-fill" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Card title hsjkdfhds sadjak s asjsajdkajas jdsaskdja </h5>
                            <a href="#" class="order-now-btn w-auto fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/section/home/blog.png') }}" class="card-img-top object-fit-fill" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Card title hsjkdfhds sadjak s asjsajdkajas jdsaskdja </h5>
                            <a href="#" class="order-now-btn w-auto fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/section/home/blog.png') }}" class="card-img-top object-fit-fill" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Card title hsjkdfhds sadjak s asjsajdkajas jdsaskdja </h5>
                            <a href="#" class="order-now-btn w-auto fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/section/home/blog.png') }}" class="card-img-top object-fit-fill" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Card title hsjkdfhds sadjak s asjsajdkajas jdsaskdja </h5>
                            <a href="#" class="order-now-btn w-auto fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
                    <div class="card">
                        <img src="{{ asset('frontend/images/section/home/blog.png') }}" class="card-img-top object-fit-contain" style="height: 200px;" alt="...">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Card title hsjkdfhds sadjak s asjsajdkajas jdsaskdja </h5>
                            <a href="#" class="order-now-btn w-auto fw-bold">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
