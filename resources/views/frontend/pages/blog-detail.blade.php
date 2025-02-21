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
                        <img class="img-fluid rounded-2" src="{{ asset('frontend/images/section/home/blog.png') }}" alt="">
                    </div>
                    <div>
                        <p class="p-2">Published At: 20 Jan, 2025</p>
                    </div>
                    <div class="">
                        <h1>Blog sdjhfkjsdhfds dkshfjd shdsh fjkhs dfjkd shfjkh dsfj kds</h1>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti reprehenderit, ullam? At consequuntur
                            debitis distinctio dolor esse necessitatibus nihil nisi provident sequi sint. Atque, doloribus earum ex
                            perspiciatis praesentium quisquam ratione unde. Atque aut consectetur eius laudantium minus porro quas quidem
                            recusandae repellat sit. Aliquid aperiam dicta ea eaque et exercitationem illo iusto laboriosam laudantium
                            maiores maxime minus molestiae necessitatibus non officia omnis pariatur perferendis quae, quidem rem repellendus
                            reprehenderit sapiente similique sit tempora tenetur unde velit veniam voluptates voluptatum. Accusantium animi,
                            dolorem doloribus explicabo fugiat in iusto libero pariatur qui quis sint, tempore veniam? Adipisci harum mollitia rerum sed.
                        </p>
                    </div>
                    <div class="text-center">
                        <h2 class="styled-heading">Comments</h2>
                        <div class="text-underline"></div>
                    </div>
                    <div class="">
                        <div class="">
                            <div class="d-flex mb-2">
                                <div class="me-2">
                                    <img class="rounded-circle" style="height: 50px;" src="{{ asset('frontend/images/default/profile-avatar.png') }}" alt="">
                                </div>
                                <div class="">
                                    <p class="m-0">Name</p>
                                    <p class="m-0">20 Jan, 2025</p>
                                </div>
                            </div>
                            <div class="">
                                <p>
                                    djshfjkdshdshf sdfdsbsdj hdsdsjkfhskdj hfkdshfkjdshfjkdshfjkdsh jdshf
                                </p>
                            </div>
                            <div class="">
                                <form action="">
                                    <textarea class="rounded-2" style="border: 1px solid #7d7e7e;" name="" id="" cols="30" rows="3"></textarea>
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
                        <div class="d-flex mb-2">
                            <div class="me-2">
                                <img class="rounded-circle object-fit-cover" style="height: 75px; width: 75px;" src="{{ asset('frontend/images/section/home/blog.png') }}" alt="">
                            </div>
                            <div class="">
                                <p class="m-0">Name hdsjkhsfhsd hsdhfkdsfkjdshf dsshskdh dshf</p>
                                <p class="m-0">20 Jan, 2025</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
