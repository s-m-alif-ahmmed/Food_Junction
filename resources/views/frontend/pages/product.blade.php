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
                    <p class="text-uppercase fw-bold fs-32">স্বাদে ভরপুর ৩টি বিখ্যাত মিষ্টি</p>
                </div>
                <div class="col-md-8 mx-auto">
                    <p class="sweet-list-text">

                        🎉 হাঁড়ি ভাঙা মিষ্টি
                        ঐতিহ্যবাহী স্বাদের খাঁটি অনন্য মিষ্টি, যা দেশজুড়ে খ্যাতি পেয়েছে তার অসাধারণ স্বাদের জন্য।
                        <br>
                        🎉 মালাইচপ
                        সম্পূর্ণ সুগার ফ্রি, স্বাস্থ্য সচেতনদের জন্য আদর্শ এবং ডায়াবেটিস রোগীদের উপযোগী।
                        <br>
                        🎉 রসমঞ্জরী
                        খাঁটি উপকরণ এবং নিখুঁত যত্নে তৈরি, যা স্বাদে আপনাকে হারিয়ে নিয়ে যাবে।
                        <br>
                        এই তিনটি মিষ্টি নিয়ে আসুন, উপভোগ করুন ঐতিহ্যের স্বাদ!
                    </p>
                </div>
                <div class="row py-3">
                    @foreach($products as $product)
                    <div class="col-md-4 special-sweet-card">
                        <div class="card border-0 custom-shadow">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name ?? 'No Product' }}">
                            </div>
                            <div class="card-body border-0 text-center mb-3 h-100">
                                <h5 class="card-title fsw-bold">{{ $product->name }}</h5>
                                <p class="card-text">{{ $product->short_description }}</p>
                                <a href="{{ route('sweets.detail', $product->product_slug) }}" class="order-now-btn fw-bold">Shop Now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
