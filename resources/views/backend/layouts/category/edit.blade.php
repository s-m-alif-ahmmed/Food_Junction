@extends('backend.app')

@section('title', 'Category Edit')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Category Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('categories.update', ['id' => $data->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="meta_title" class="form-label">Meta Title:</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                   name="meta_title" placeholder="Meta Title" id="meta_title" value="{{ $data->meta_title ?? ' ' }}">
                            @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description" class="form-label">Meta Description:</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" minlength="160" maxlength="255" placeholder="Enter Meta Description" id="meta_description" name="meta_description">{{ $data->meta_description ?? ' ' }}</textarea>
                            @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords" class="form-label">Meta Keywords:</label>
                            <textarea class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" placeholder="Enter Meta Keywords" name="meta_keywords">{{ $data->meta_keywords ?? ' ' }}</textarea>
                            @error('meta_keywords')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Category Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" placeholder="Enter Category Name" id="name" maxlength="100" value="{{ $data->name ?? ' ' }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('categories.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
