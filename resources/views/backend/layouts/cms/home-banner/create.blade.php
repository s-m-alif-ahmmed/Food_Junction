@extends('backend.app')

@section('title', 'Home Banner Create')

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
    {{-- PAGE-HEADER END --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('cms.home-banner.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="image" class="form-label">Home Banner Image:</label>
                            <input type="file" class="form-control dropify @error('image') is-invalid @enderror" name="image" id="image" value="{{ old('image') }}">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="offer_ids" class="form-label">Link to Offer (Optional):</label>
                            <select name="offer_ids[]" id="offer_ids" class="form-control form-select select2" multiple>
                                @foreach($offers as $offer)
                                    <option value="{{ $offer->id }}" {{ (is_array(old('offer_ids')) && in_array($offer->id, old('offer_ids'))) ? 'selected' : '' }}>
                                        {{ $offer->name }} ({{ $offer->offer_type }})
                                    </option>
                                @endforeach
                            </select>
                            @error('offer_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <small class="text-muted">Users will be redirected to this offer's product page when clicking the banner.</small>
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
