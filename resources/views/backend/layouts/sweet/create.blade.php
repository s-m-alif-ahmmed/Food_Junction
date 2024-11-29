@extends('backend.app')

@section('title', 'Sweet Create')

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
    {{-- PAGE-HEADER END --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('sweets.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="meta_title" class="form-label">Meta Title:</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                name="meta_title" placeholder="Meta Title" id="meta_title" value="{{ old('meta_title') }}">
                            @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description" class="form-label">Meta Description:</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" minlength="160" maxlength="255" id="meta_description" name="meta_description">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords" class="form-label">Meta Keywords:</label>
                            <textarea class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords">{{ old('meta_keywords') }}</textarea>
                            @error('meta_keywords')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Sweet Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="sweet name" id="name" maxlength="100" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Sweet Image(500*500px):</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror"
                                name="image" placeholder="sweet name" id="image" value="{{ old('image') }}">
                            @error('image')
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
                            <a href="{{ route('sweets.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
