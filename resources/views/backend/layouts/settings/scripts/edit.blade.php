@extends('backend.app')

@section('title', 'Script Edit')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Script Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Script</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER END --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('scripts.update', ['id' => $data->id]) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name" class="form-label">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" placeholder="Enter Script Name" id="name" value="{{ old('name', $data->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="place" class="form-label">Place:</label>
                            <select name="place" id="place" class="form-control @error('place') is-invalid @enderror">
                                <option value="header" {{ old('place', $data->place) == 'header' ? 'selected' : '' }}>Header</option>
                                <option value="footer" {{ old('place', $data->place) == 'footer' ? 'selected' : '' }}>Footer</option>
                            </select>
                            @error('place')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="script" class="form-label">Script:</label>
                            <textarea class="form-control @error('script') is-invalid @enderror" placeholder="Paste your script here" name="script" id="script" rows="10">{{ old('script', $data->script) }}</textarea>
                            @error('script')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
                            <a href="{{ route('scripts.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
