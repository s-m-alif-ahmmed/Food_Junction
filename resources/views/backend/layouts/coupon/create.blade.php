@extends('backend.app')

@section('title', 'Coupon Create')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Coupon Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Coupon</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER END --}}


    <!-- Create Category Form-->
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Add New Coupon </h5>
                </div>
                <div class="card-body">
                    <div class="border-0 p-3 ">
                        <form class="g-3" method="post" action="{{route('coupons.store')}}">
                            @csrf
                            @method('post')

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Code</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="code" placeholder="Enter coupon code" type="text" required />
                                </div>
                                @error('code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="name" placeholder="Enter coupon code name" type="text">
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Max Uses</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="max_uses" placeholder="Max Uses">
                                </div>
                                @error('max_uses')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Max Uses User</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="max_uses_user" placeholder="Max Uses User">
                                </div>
                                @error('max_uses_user')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label for="type" class="col-md-3 form-label">Type</label>
                                <div class="col-md-9">
                                    <select name="type" id="type" class="form-control" required >
                                        <option value="percent">Percent</option>
                                        <option value="fixed">Fixed</option>
                                    </select>
                                </div>
                                @error('type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Discount Amount</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="discount_amount" placeholder="Enter discount amount" required/>
                                </div>
                                @error('discount_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Minimum Amount</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="min_amount" placeholder="Enter minimum amount" required/>
                                </div>
                                @error('min_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label for="status" class="col-md-3 form-label">Coupon Status</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="form-control" required >
                                        <option value="active">Active</option>
                                        <option value="inActive">Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label for="starts_at" class="col-md-3 form-label">Starts At</label>
                                <div class="col-md-9">
                                    <input type="datetime-local" class="form-control" name="starts_at" id="starts_at" step="1">
                                </div>
                                @error('starts_at')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label for="expires_at" class="col-md-3 form-label">Expires At</label>
                                <div class="col-md-9">
                                    <input type="datetime-local" class="form-control" name="expires_at" id="expires_at" step="1">
                                </div>
                                @error('expires_at')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary px-4" type="submit">Create</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
