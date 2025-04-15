@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Blog Detail | Food Junction
@endsection

@section('content')

    @include('frontend.includes.top-nav-button')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">Blog Detail</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row pt-3 pb-5">
                <div class="col-md-9">
                    <div class="">
                        <img class="img-fluid rounded-2 w-100" src="{{ asset($blog->image ?? 'frontend/images/section/home/blog.png') }}" alt="">
                    </div>
                    <div>
                        <p class="p-2">Published At: {{ $blog->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="">
                        <h1>{{ $blog->title }}</h1>
                        <p>
                            {!! $blog->description !!}
                        </p>
                    </div>
                    <div class="text-center">
                        <h2 class="styled-heading">Comments ({{ $blog_comments->count() }})</h2>
                        <div class="text-underline"></div>
                    </div>
                    <div class="">
                        <div class="">
                            @foreach($blog_comments->take(20) as $comment)
                                <div class="d-flex mb-2">
                                    <div class="me-2">
                                        <img class="rounded-circle" style="height: 50px;" src="{{ asset($comment->user->avatar ?? 'frontend/images/default/profile-avatar.png') }}" alt="">
                                    </div>
                                    <div class="">
                                        <p class="m-0">{{ $comment->user->name ?? 'Anonymous' }}</p>
                                        <p class="m-0">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="">
                                    <p>
                                        {!! $comment->comment !!}
                                    </p>
                                </div>
                            @endforeach

                            <div class="">
                                <form action="{{ route('comment.store', ['blogId' => $blog->id]) }}" method="POST">
                                    @csrf

                                    <textarea class="rounded-2" style="border: 1px solid #7d7e7e;" name="comment" id="" cols="30" rows="3"></textarea>
                                    <button type="submit" class="btn review-btn float-end">Send</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 border rounded-2 h-100">
                    <div class="">
                        <p class="fs-32 fw-semibold">Latest Blog</p>
                    </div>
                    <div class="">
                        @foreach($latest_blogs->take(5) as $data)
                            <div class="d-flex mb-2">
                                <div class="me-2">
                                    <a class="nav-link" href="{{ route('blog.detail', $data->slug) }}">
                                        <img class="rounded-circle object-fit-cover" style="height: 75px; width: 75px;" src="{{ asset($data->image ?? 'frontend/images/section/home/blog.png') }}" alt="">
                                    </a>
                                </div>
                                <div class="">
                                    <p class="m-0">
                                        <a class="nav-link" href="{{ route('blog.detail', $data->slug) }}">
                                            {{ $data->title }}
                                        </a>
                                    </p>
                                    <p class="m-0">{{ $data->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
