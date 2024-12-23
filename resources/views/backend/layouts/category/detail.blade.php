@extends('backend.app')

@section('title', 'Category Detail')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Category</h1>
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
                        <textarea class="form-control" name="" id="" cols="30" rows="3" readonly disabled>{{ $data->meta_description ?? '' }}</textarea>
                        @error('meta_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="meta_keywords" class="form-label">Meta Keywords:</label>
                        <textarea class="form-control" name="" id="" cols="30" rows="3" readonly disabled>{{ $data->meta_keywords ?? '' }}</textarea>
                        @error('meta_keywords')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name" class="form-label">Category Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" placeholder="Enter Category Name" id="name" maxlength="100" value="{{ $data->name ?? ' ' }}" disabled readonly >
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="{{ route('categories.index') }}" class="btn btn-danger me-2">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
