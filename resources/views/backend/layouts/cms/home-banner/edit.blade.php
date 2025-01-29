@extends('backend.app')

@section('title', 'Home Banner Image Edit')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Home Banner Image Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Home Banner Image</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('cms.home-banner.update', ['id' => $data->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="image" class="form-label">Home Banner Image:</label>
                            <input type="file" class="form-control dropify @error('image') is-invalid @enderror" name="image" id="image" value="{{ $data->image }}" data-default-file="{{ !empty($data->image) ? asset($data->image) : '' }}">
                            @error('image')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('cms.home-banner.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
