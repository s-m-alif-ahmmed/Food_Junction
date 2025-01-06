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

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="w-100">
                        <img class="img-fluid w-100" src="{{ asset('/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 my-auto text-justify">
                    <p class="fs-32 fsw-bold">Food Junction Story</p>
                    <p class="fs-16">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto, commodi cumque dignissimos facere molestias
                        nobis sed velit voluptas! Assumenda at, dolor ipsam laborum libero numquam officia? Ab accusantium
                        dolor ea enim eos eum fugiat ipsa laudantium maxime mollitia neque nesciunt nisi officia omnis,
                        pariatur quidem recusandae rem sapiente soluta tempore velit veritatis voluptas. Amet animi asperiores
                        commodi corporis cumque earum enim et hic illum ipsam modi necessitatibus nisi obcaecati perspiciatis,
                        porro provident, reiciendis repellat sapiente sunt vero. Architecto consectetur cum debitis, dolorum et
                        fuga illo iusto laborum laudantium minus mollitia perferendis provident quae quia ratione repudiandae
                        saepe tempore veritatis voluptates.
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
