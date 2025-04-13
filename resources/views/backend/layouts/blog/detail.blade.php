@extends('backend.app')

@section('title', 'Blog Detail')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Blog Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog</li>
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
                        <label for="title" class="form-label">Blog Title:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" placeholder="Blog title" id="title" maxlength="255" value="{{ $data->title ?? ' ' }}" disabled readonly >
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image" class="form-label">Blog Image(500*500px):</label>
                        <input type="file" class="form-control dropify @error('image') is-invalid @enderror"
                               name="image" placeholder="sweet name" id="image" value="{{ $data->image ?? ' ' }}" data-default-file="{{ isset($data->image) ? asset($data->image) : '' }}">
                        @if($data->image)
                        @endif
                        @error('image')
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
                        <a href="{{ route('blogs.index') }}" class="btn btn-danger me-2">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
