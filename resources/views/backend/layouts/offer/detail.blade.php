@extends('backend.app')

@section('title', 'Offer Detail')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Offer Details</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Offers</a></li>
                <li class="breadcrumb-item active" aria-current="page">Offer Detail</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">

                    <div class="form-group">
                        <label class="form-label">Offer Name:</label>
                        <p class="form-control" readonly>{{ $data->name ?? ' ' }}</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Offer Type:</label>
                        <p class="form-control" readonly>{{ ucfirst(str_replace('_', ' ', $data->offer_type)) ?? ' ' }}</p>
                    </div>

                    @if($data->offer_type == 'discount')
                        <div class="form-group">
                            <label class="form-label">Discount Type:</label>
                            <p class="form-control" readonly>{{ ucfirst($data->discount_type) ?? ' ' }}</p>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Discount Value:</label>
                            <p class="form-control" readonly>{{ $data->discount_value ?? ' ' }}</p>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">Applies To:</label>
                        <p class="form-control" readonly>{{ ucfirst($data->applies_to) ?? ' ' }}</p>
                    </div>

                    @if($data->applies_to == 'product')
                        <div class="form-group">
                            <label class="form-label">Products Included:</label>
                            <ul class="list-group">
                                @forelse($data->products as $product)
                                    <li class="list-group-item">{{ $product->name }}</li>
                                @empty
                                    <li class="list-group-item text-muted">No products mapped</li>
                                @endforelse
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">Location Scope:</label>
                        <p class="form-control" readonly>{{ ucfirst($data->location_scope) ?? ' ' }}</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Start Date:</label>
                                <p class="form-control" readonly>{{ $data->start_date ? $data->start_date->format('Y-m-d') : 'No Start Date' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">End Date:</label>
                                <p class="form-control" readonly>{{ $data->end_date ? $data->end_date->format('Y-m-d') : 'No End Date' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Priority:</label>
                        <p class="form-control" readonly>{{ $data->priority ?? '0' }}</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status:</label>
                        <p class="form-control" readonly>{{ $data->is_active ? 'Active' : 'Inactive' }}</p>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Requires Coupon:</label>
                        <p class="form-control" readonly>{{ $data->coupon_enabled ? 'Yes' : 'No' }}</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description:</label>
                        <div class="border p-3 rounded">
                            {!! $data->description ?? 'No description provided.' !!}
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <a href="{{ route('offers.index') }}" class="btn btn-danger me-2">Back to List</a>
                        <a href="{{ route('offers.edit', $data->id) }}" class="btn btn-primary">Edit Offer</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
