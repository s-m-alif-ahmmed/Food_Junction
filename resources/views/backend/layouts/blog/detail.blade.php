@extends('backend.app')

@section('title', 'Product Detail')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Product Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">

                    <div class="form-group">
                        <label for="meta_title" class="form-label">Meta Title:</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                               name="meta_title" placeholder="Meta Title" id="meta_title" value="{{ $data->meta_title ?? ' ' }}" disabled readonly >
                        @error('meta_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_description" class="form-label">Meta Description:</label>
                        <p>{{ $data->meta_description ?? ' ' }}</p>
                        @error('meta_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_keywords" class="form-label">Meta Keywords:</label>
                        <p>{{ $data->meta_keywords ?? ' ' }}</p>
                        @error('meta_keywords')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="product_type" class="form-label">Product Type:</label>
                        <select class="form-select select2" name="product_type" id="product_type" disabled readonly>
                            <option>{{ $data->product_type }}</option>
                        </select>
                        @error('product_type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category_id" class="form-label">Category:</label>
                        <select class="form-select select2" name="category_id" id="category_id" disabled readonly>
                            <option>{{ $data->category->name }}</option>
                        </select>
                        @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name" class="form-label">Product Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" placeholder="sweet name" id="name" maxlength="100" value="{{ $data->name ?? ' ' }}" disabled readonly >
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Product Image(500*500px):</label>
                        <input type="file" class="form-control @error('image') is-invalid @enderror"
                               name="image" placeholder="sweet name" id="image" value="{{ $data->image ?? ' ' }}">
                        @if($data->image)
                        <img class="img-fluid rounded-1 my-1" height="80px" width="80px" src="{{ asset($data->image) }}" alt="{{ $data->name ? $data->image : 'No Image' }}"  disabled readonly>
                        @endif
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price" class="form-label">Price:</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror"
                               name="price" placeholder="sweet price" id="price" value="{{ $data->price ?? ' ' }}" disabled readonly >
                        @error('price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="discount_price" class="form-label">Discount Price (Optional):</label>
                        <input type="text" class="form-control @error('discount_price') is-invalid @enderror"
                               name="discount_price" placeholder="sweet discount price" id="discount_price" value="{{ $data->discount_price ?? ' ' }}" disabled readonly >
                        @error('discount_price')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Description:</label>
                        <p>{!! $data->description ?? ' ' !!}</p>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="{{ route('products.index') }}" class="btn btn-danger me-2">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
