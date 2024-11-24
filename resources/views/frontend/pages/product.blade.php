@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Sweets | Food Junction
@endsection

@section('content')

    <section class="sweet-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold fs-32">Our Special Sweets</p>
                </div>
                <div class="col-md-8 mx-auto">
                    <p class="sweet-list-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad architecto commodi consequuntur rem sint tenetur.  consectetur adipisicing elit. Obcaecati, tenetur.</p>
                </div>
                <div class="row py-3">
                    <div class="col-md-4 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset('/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body border-0 text-center mb-3 h-100">
                                <h5 class="card-title">Sweet Name</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet.</p>
                                <a href="{{ route('sweets.detail') }}" class="order-now-btn fw-bold">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset('/frontend/images/section/home/Malaichop-500x500.jpg') }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body border-0 text-center mb-3 h-100">
                                <h5 class="card-title">Sweet Name</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet.</p>
                                <a href="{{ route('sweets.detail') }}" class="order-now-btn fw-bold">Read More</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset('/frontend/images/section/home/roshmonjuri-500x500.jpg') }}" class="card-img-top" alt="...">
                            </div>
                            <div class="card-body border-0 text-center mb-3 h-100">
                                <h5 class="card-title">Sweet Name</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content. Lorem ipsum dolor sit amet.</p>
                                <a href="{{ route('sweets.detail') }}" class="order-now-btn fw-bold">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
