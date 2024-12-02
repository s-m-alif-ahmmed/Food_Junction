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


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('coupons.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="code" class="form-label">Code:</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror"
                                name="code" placeholder="Enter Code" id="code" value="{{ old('code') }}">
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Coupon Name:</label>
                            <textarea class="form-control @error('name') is-invalid @enderror" id="name" name="name">{{ old('name') }}</textarea>
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="max_uses" class="form-label">Max Uses:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="max_uses" placeholder="Max uses" id="max_uses" value="{{ old('max_uses') }}">
                            @error('max_uses')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="max_uses_user" class="form-label">Max User Uses:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="max_uses_user" placeholder="Max User Uses" id="max_uses_user" value="{{ old('max_uses_user') }}">
                            @error('max_uses_user')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="type" class="form-label">Coupon Image(500*500px):</label>
                            <input type="text" class="form-control @error('image') is-invalid @enderror"
                                name="type" placeholder="sweet name" id="type" value="{{ old('image') }}">
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Price:</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                name="price" placeholder="sweet price" id="price" value="{{ old('price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="discount_price" class="form-label">Discount Price (Optional):</label>
                            <input type="text" class="form-control @error('discount_price') is-invalid @enderror"
                                name="discount_price" placeholder="sweet discount price" id="discount_price" value="{{ old('discount_price') }}">
                            @error('discount_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="short_description" class="form-label">Short Description:</label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" maxlength="130" id="short_description" name="short_description">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="summernote" class="form-label">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="summernote" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('coupons.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
