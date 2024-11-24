@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Confirm Order | Food Junction
@endsection

@section('content')

    <section class="checkout-page">
        <div class="container-fluid">
            <div class="row background-gradient">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold text-white mt-3 mb-0 fs-32">Confirm Order</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23ffffff'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-white">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Confirm Order</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container my-4">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card p-3">
                        <p class="fs-32 fw-bold text-center">Thank You!</p>
                        <p class="px-lg-5 px-md-5 px-sm-2 px-2 fs-16 fw-semibold text-center">
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, assumenda illo quaerat sapiente temporibus voluptate. ovident quae totam.
                        </p>
                        <p class="px-lg-5 px-md-5 px-sm-2 px-2 fs-18 fw-semibold text-center">
                            Your Order ID: <span class="text-danger">"hSaD23dFa3sa"</span>. Save this order id for further information.
                        </p>
                        <a class="btn background-gradient w-50 mx-auto text-white border-0" href="{{ route('home') }}">Back To Home</a>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
