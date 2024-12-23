@extends('backend.app')

@section('title', 'Faq Detail')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Faq</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Faq</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">

                    <div class="form-group">
                        <label for="question" class="form-label">Question:</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                               name="question" placeholder="Enter Faq Question" id="question" value="{{ $data->question ?? ' ' }}" disabled readonly >
                        @error('question')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="answer" class="form-label">Answer:</label>
                        <textarea class="form-control" name="answer" id="answer" cols="30" rows="3" placeholder="Enter Faq Answer" readonly disabled>{{ $data->answer ?? '' }}</textarea>
                        @error('answer')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="{{ route('faqs.index') }}" class="btn btn-danger me-2">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
