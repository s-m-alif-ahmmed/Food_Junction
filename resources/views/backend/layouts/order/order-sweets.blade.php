@extends('backend.app')

@section('title', 'Order')

@section('content')

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
                        <label for="page_title" class="form-label">Whatsapp Number:</label>
                        <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->whatsapp_number ?? '' }}" disabled readonly>
                    </div>

                    <div class="form-group">
                        <label for="page_title" class="form-label">Address:</label>
                        <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->address ?? '' }}" disabled readonly>
                    </div>

                    <div class="form-group">
                        <label for="summernote" class="form-label">Note:</label>
                        <textarea class="form-control @error('page_content') is-invalid @enderror" name="page_content" disabled readonly>{{ $data->note ?? '' }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="page_title" class="form-label">Status:</label>
                        <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->address ?? '' }}" disabled readonly>
                    </div>

                    <div class="form-group">
                        <label for="page_title" class="form-label">Action:</label>
                        <a class="btn btn-success" href="{{ route('orders.sweets', $data->id) }}">Product Details</a>
                        <a class="btn btn-primary" href="{{ route('orders.invoice', $data->id) }}">Invoice</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
