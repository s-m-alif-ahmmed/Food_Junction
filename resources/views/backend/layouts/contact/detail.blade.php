@extends('backend.app')

@section('title', 'Contact Message')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Contact Message</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('contact.index') }}">Contact</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact Message</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER END --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">

                    <div class="form-group">
                        <label for="page_title" class="form-label">Name:</label>
                        <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->name ?? '' }}" disabled readonly>
                    </div>

                    <div class="form-group">
                        <label for="page_title" class="form-label">Email:</label>
                        <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->email ?? '' }}" disabled readonly>
                    </div>

                    <div class="form-group">
                        <label for="page_title" class="form-label">Phone Number:</label>
                        <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->number ?? '' }}" disabled readonly>
                    </div>

                    <div class="form-group">
                        <label for="page_title" class="form-label">Subject:</label>
                        <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->subject ?? '' }}" disabled readonly>
                    </div>

                    <div class="form-group">
                        <label for="summernote" class="form-label">Message:</label>
                        <textarea class="form-control @error('page_content') is-invalid @enderror" name="page_content" disabled readonly>{{ $data->message ?? '' }}</textarea>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
