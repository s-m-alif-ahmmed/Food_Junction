@extends('backend.app')

@section('title', 'Product Details')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Product Details</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <strong>Product Image:</strong><br>
                            @if($data->image)
                                <img class="img-fluid rounded border mt-2" style="max-height: 200px;" src="{{ asset($data->image) }}" alt="{{ $data->name }}">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </div>
                        <div class="col-md-9">
                            <h2 class="mb-1">{{ $data->name }}</h2>
                            <span class="badge bg-primary mb-3">{{ ucfirst($data->type) }}</span>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Category:</strong><br>
                                    {{ $data->category->name ?? 'N/A' }}
                                </div>
                                <div class="col-md-3">
                                    <strong>Delivery Zones:</strong><br>
                                    @if($data->deliveryZones && $data->deliveryZones->count() > 0)
                                        @foreach($data->deliveryZones as $zone)
                                            <span class="badge bg-info">{{ $zone->name }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No zones set</span>
                                    @endif
                                </div>
                                <div class="col-md-3">
                                    <strong>Base Price:</strong><br>
                                    {{ number_format($data->variants->first()->price ?? 0, 2) }} Tk
                                </div>
                                <div class="col-md-3">
                                    <strong>Discount Price:</strong><br>
                                    {{ ($data->variants->first() && $data->variants->first()->discount_price) ? number_format($data->variants->first()->discount_price, 2) . ' Tk' : 'None' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mb-3">Pricing Variants</h4>
                            @if($data->variants && count($data->variants) > 0)
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Discount Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->variants as $variant)
                                            <tr>
                                                <td>{{ $variant->quantity }} {{ $variant->unit_type }}</td>
                                                <td>{{ number_format($variant->price, 2) }} Tk</td>
                                                <td>{{ $variant->discount_price ? number_format($variant->discount_price, 2) . ' Tk' : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted italic">No variants defined.</p>
                            @endif
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4 class="mb-2">Description:</h4>
                            <div class="p-3 border bg-light">
                                {!! $data->description !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4 class="mb-2">SEO Information:</h4>
                            <ul class="list-unstyled">
                                <li><strong>Meta Title:</strong> {{ $data->meta_title ?? 'N/A' }}</li>
                                <li><strong>Meta Description:</strong> {{ $data->meta_description ?? 'N/A' }}</li>
                                <li><strong>Meta Keywords:</strong> {{ $data->meta_keywords ?? 'N/A' }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="form-group mt-5">
                        <a href="{{ route('products.edit', ['id' => $data->id]) }}" class="btn btn-warning">Edit Product</a>
                        <a href="{{ route('products.index') }}" class="btn btn-danger me-2">Back to List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
