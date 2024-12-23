@extends('backend.app')

@section('title', 'Sweet Edit')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Sweet Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sweet</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 mx-auto">
            <div class="card">
                <div class="card-header py-3 bg-transparent">
                    <h5 class="mb-0">Edit Coupon</h5>
                </div>
                <div class="card-body">
                    <div class="border-0 p-3 ">
                        <form class="g-3" method="post" action="{{ route('coupons.update', ['id' => $data->id]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Code</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="code" placeholder="Enter coupon code" value="{{$data->code}}" type="text" required />
                                </div>
                                @error('code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Name</label>
                                <div class="col-md-9">
                                    <input class="form-control" name="name" placeholder="Enter coupon code name" value="{{$data->name}}" type="text">
                                </div>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Max Uses</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="max_uses" value="{{$data->max_uses}}" placeholder="Max Uses">
                                </div>
                                @error('max_uses')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Max Uses User</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="max_uses_user" value="{{$data->max_uses_user}}" placeholder="Max Uses User">
                                </div>
                                @error('max_uses_user')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label for="type" class="col-md-3 form-label">Type</label>
                                <div class="col-md-9">
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="percent" {{ old('type', $data->type) == 'percent' ? 'selected' : '' }}>Percent</option>
                                        <option value="fixed" {{ old('type', $data->type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                    </select>
                                </div>
                                @error('type')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Discount Amount</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="discount_amount" value="{{$data->discount_amount}}" placeholder="Enter discount amount">
                                </div>
                                @error('discount_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label class="col-md-3 form-label">Minimum Amount</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="min_amount" value="{{$data->min_amount}}" placeholder="Enter minimum amount">
                                </div>
                                @error('min_amount')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label for="status" class="col-md-3 form-label">Coupon Status</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="form-control" required >
                                        <option value="active" {{ old('status', $data->status) == 'active' ? 'selected' : '' }} >Active</option>
                                        <option value="inActive" {{ old('status', $data->status) == 'inactive' ? 'selected' : '' }} >Inactive</option>
                                    </select>
                                </div>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label for="starts_at" class="col-md-3 form-label">Starts At</label>
                                <div class="col-md-9">
                                    <input type="datetime-local" class="form-control" name="starts_at" value="{{$data->starts_at}}" id="starts_at" step="1">
                                </div>
                                @error('starts_at')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row mb-4">
                                <label for="expires_at" class="col-md-3 form-label">Expires At</label>
                                <div class="col-md-9">
                                    <input type="datetime-local" class="form-control" value="{{$data->expires_at}}" name="expires_at" id="expires_at" step="1">
                                </div>
                                @error('expires_at')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-12 text-center">
                                <button class="btn btn-primary px-4" type="submit">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
