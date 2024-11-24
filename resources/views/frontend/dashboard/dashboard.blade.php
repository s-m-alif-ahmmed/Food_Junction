@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    User Dashboard
@endsection

@section('content')

    <section class="user-dashboard-page">
        <div class="container-fluid">
            <div class="row background-gradient">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold text-white mt-3 mb-0 fs-32">My Profile</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23ffffff'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-white">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">My Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" id="profileTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-black active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-black" id="order-history-tab" data-bs-toggle="tab" data-bs-target="#order-history" type="button" role="tab" aria-controls="order-history" aria-selected="false">Order History</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-black" id="wishlist-tab" data-bs-toggle="tab" data-bs-target="#wishlist" type="button" role="tab" aria-controls="wishlist" aria-selected="false">My Wishlist</button>
                        </li>
                    </ul>

                    <div class="tab-content p-3 border border-top-0" id="profileTabContent">
                        <!-- Profile Tab -->
                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            <form action="#" method="POST" class="row">
                                @csrf

                                <p class="fs-20 fsw-bold text-red">Edit Your Profile</p>

                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Name</label>
                                    <input type="password" class="form-control" id="inputPassword4">
                                    <p class="error-message">Error</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4">
                                    <p class="error-message">Error</p>
                                </div>

                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="inputCity">
                                    <p class="error-message">Error</p>
                                </div>

                                <p class="fs-20 fsw-bold text-red pt-3">Change Password</p>

                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">Current Password</label>
                                    <input type="text" class="form-control" id="inputCity">
                                    <p class="error-message">Error</p>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">New Password</label>
                                    <input type="text" class="form-control" id="inputCity">
                                    <p class="error-message">Error</p>
                                </div>
                                <div class="col-md-12">
                                    <label for="inputCity" class="form-label">Confirm Password</label>
                                    <input type="text" class="form-control" id="inputCity">
                                    <p class="error-message">Error</p>
                                </div>

                                <div class="col-md-12 py-3 text-center">
                                    <button type="submit" class="btn background-gradient border-0 text-white fsw-bold">Save Changes</button>
                                </div>
                            </form>
                        </div>
                        <!-- Order History Tab -->
                        <div class="tab-pane fade" id="order-history" role="tabpanel" aria-labelledby="order-history-tab">
                            <p class="fs-20 fsw-bold">Order History</p>
                            <p>No orders found.</p>
                        </div>
                        <!-- Wishlist Tab -->
                        <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-tab">
                            <p class="fs-20 fsw-bold">My Wishlist</p>
                            <p>Your wishlist is empty.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection

@push('styles')
    <style>

    </style>
@endpush

@push('scripts')
    <script>

    </script>
@endpush
