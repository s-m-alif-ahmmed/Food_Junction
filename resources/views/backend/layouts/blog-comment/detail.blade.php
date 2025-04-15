@extends('backend.app')

@section('title', 'Blog Comment Detail')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Blog Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Blog Comment</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">

                    <div class="form-group">
                        <label for="title" class="form-label">Comment At:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Blog title" id="title" maxlength="255" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d M, Y H:i A') }}" disabled readonly >
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    @if($data->user_id)
                        <div class="form-group">
                            <label for="title" class="form-label">Comment By:</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror"
                                   name="title" placeholder="Blog title" id="title" maxlength="255" value="{{ $data->user->email ?? ' ' }}" disabled readonly >
                            @error('title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="title" class="form-label">Blog Title:</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               name="title" placeholder="Blog title" id="title" maxlength="255" value="{{ $data->blog->title ?? ' ' }}" disabled readonly >
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description" class="form-label">Comment:</label>
                        <p>{!! $data->comment ?? ' ' !!}</p>
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
