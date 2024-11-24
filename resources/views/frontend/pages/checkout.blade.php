@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Checkout | Food Junction
@endsection

@section('content')

    <section class="checkout-page">
        <div class="container-fluid">
            <div class="row background-gradient">
                <div class="col-md-12 text-center">
                    <p class="text-uppercase fw-bold text-white mt-3 mb-0 fs-32">Checkout</p>
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%23ffffff'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center bg-transparent">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none text-white">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cart') }}" class="text-decoration-none text-white">Cart</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row bg-black text-center">
                <p class="fs-20 text-white mb-1">Order Only For Dhaka</p>
            </div>
        </div>
        <div class="container my-4">
            <form action="">
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-12 py-2">
                        <div class="card p-3">
                            <div class="">
                                <p class="fs-24 fsw-semibold">Billing Details</p>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Name</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Email <span>(Optional)</span></label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input placeholder">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input placeholder">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Address</label>
                                <textarea class="form-control" name="" id="formGroupExampleInput2" placeholder="Another input placeholder" cols="30" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Note</label>
                                <textarea class="form-control" name="" id="formGroupExampleInput" placeholder="Another input placeholder" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 col-sm-12 col-12 py-2">
                        <div class="card p-3 mb-2">
                            <div class="row py-2">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <a href="">
                                        <div class="cart-img">
                                            <img src="{{ asset('/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-7 checkout-cart-sweets">
                                    <div>
                                        <div>
                                            <a href="" class="sweet-name">
                                                Sweet Name Sweet Name
                                            </a>
                                        </div>
                                        <div>
                                            <span class="cart-wight">1kg</span>
                                            <p class="cart-price">730Tk <span class="discount-price">(<del>950Tk</del>)</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                    <button class="btn">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <a href="">
                                        <div class="cart-img">
                                            <img src="{{ asset('/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-7 checkout-cart-sweets">
                                    <div>
                                        <div>
                                            <a href="" class="sweet-name">
                                                Sweet Name Sweet Name
                                            </a>
                                        </div>
                                        <div>
                                            <span class="cart-wight">1kg</span>
                                            <p class="cart-price">730Tk <span class="discount-price">(<del>950Tk</del>)</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                    <button class="btn">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <a href="">
                                        <div class="cart-img">
                                            <img src="{{ asset('/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-7 checkout-cart-sweets">
                                    <div>
                                        <div>
                                            <a href="" class="sweet-name">
                                                Sweet Name Sweet Name
                                            </a>
                                        </div>
                                        <div>
                                            <span class="cart-wight">1kg</span>
                                            <p class="cart-price">730Tk <span class="discount-price">(<del>950Tk</del>)</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                    <button class="btn">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-3">
                                    <a href="">
                                        <div class="cart-img">
                                            <img src="{{ asset('/frontend/images/section/home/Malaichop-500x500.jpg') }}" alt="" />
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-8 col-md-7 col-sm-7 col-7 checkout-cart-sweets">
                                    <div>
                                        <div>
                                            <a href="" class="sweet-name">
                                                Sweet Name Sweet Name
                                            </a>
                                        </div>
                                        <div>
                                            <span class="cart-wight">1kg</span>
                                            <p class="cart-price">730Tk <span class="discount-price">(<del>950Tk</del>)</span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-2 col-sm-2 col-2 d-flex align-items-center justify-content-end">
                                    <button class="btn">
                                        <i class="fa-solid fa-trash text-danger"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-md-12">
                                    <p class="fsw-bold fs-20">Order Summery</p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Subtotal</p>
                                    <p class="fsw-semibold">1440Tk</p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Login Discount</p>
                                    <p class="fsw-semibold">-140Tk</p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Delivery Fee</p>
                                    <p class="fsw-semibold">100Tk</p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control coupon-input" placeholder="Add Promo Code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                        <span class="input-group-text bg-danger text-white coupon-btn" id="basic-addon2">Apply</span>
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p>Coupon Discount</p>
                                    <p class="fsw-semibold">-140Tk</p>
                                </div>
                                <div class="col-md-12 d-flex justify-content-between">
                                    <p class="fsw-semibold">Total</p>
                                    <p class="fsw-semibold">-140Tk</p>
                                </div>
                                <div class="col-md-12">
                                    <a href="{{ route('confirm.order') }}" class="btn background-gradient text-white border-0 w-100 fs-18 fsw-semibold">Place Order <i class="fa-solid fa-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </section>

@endsection
