@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Videos | Food Junction
@endsection

@section('content')

    @include('frontend.includes.top-nav-button')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">Videos</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row pt-3 pb-5">
                @foreach($videos as $video)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-4 video">
                        {!! $video->link !!}
                    </div>
                @endforeach

                <div class="">
                    {{ $videos->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

@endsection
