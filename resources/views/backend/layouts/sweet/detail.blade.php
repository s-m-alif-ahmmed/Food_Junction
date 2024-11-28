@extends('backend.app')

@section('title', 'Sweet Detail')

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
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">

                    <div class="form-group">
                        <label for="name" class="form-label">Sweet Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" placeholder="sweet name" id="name" maxlength="100" value="{{ $data->name ?? ' ' }}" disabled readonly >
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Sweet Image(500*500px):</label>
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
                        <label for="short_description" class="form-label">Short Description:</label>
                        <p>{{ $data->short_description ?? ' ' }}</p>
                        @error('short_description')
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
                        <a href="{{ route('sweets.index') }}" class="btn btn-danger me-2">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
