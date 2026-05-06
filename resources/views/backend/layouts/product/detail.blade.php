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
                            <span class="badge bg-primary mb-3">{{ $data->product_type }}</span>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Category:</strong><br>
                                    {{ $data->category->name ?? 'N/A' }}
                                </div>
                                <div class="col-md-4">
                                    <strong>Base Price:</strong><br>
                                    {{ number_format($data->price, 2) }} Tk
                                </div>
                                <div class="col-md-4">
                                    <strong>Discount Price:</strong><br>
                                    {{ $data->discount_price ? number_format($data->discount_price, 2) . ' Tk' : 'None' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-6 border-end">
                            <h4 class="mb-3">Pricing & Variants ({{ ucfirst($data->pricing_type) }} Based)</h4>
                            @if($data->pricing_variants && count($data->pricing_variants) > 0)
                                <table class="table table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>Unit</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data->pricing_variants as $variant)
                                            <tr>
                                                <td>{{ $variant['unit'] }}</td>
                                                <td>{{ number_format($variant['price'], 2) }} Tk</td>
                                                <td>{{ $variant['discount_price'] ? number_format($variant['discount_price'], 2) . ' Tk' : '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted italic">No variants defined.</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3">Location Specific Conditions</h4>
                            @if($data->location_conditions && count($data->location_conditions) > 0)
                                <div class="list-group">
                                    @foreach($data->location_conditions as $cond)
                                        <div class="list-group-item">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1 text-primary">{{ ucfirst($cond['scope']) }}</h5>
                                                @if($cond['free_delivery'])
                                                    <span class="badge bg-success">Free Delivery</span>
                                                @endif
                                            </div>
                                            <p class="mb-1">
                                                @if($cond['discount'])
                                                    <strong>Discount:</strong> {{ $cond['discount'] }} Tk<br>
                                                @endif
                                                @if($cond['gift'])
                                                    <strong>Gift:</strong> {{ $cond['gift'] }}
                                                @endif
                                            </p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted italic">No location conditions defined.</p>
                            @endif
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4 class="mb-3">Associated Global Offers</h4>
                            @forelse($data->offers as $offer)
                                <span class="badge bg-green-light text-green p-2 m-1">
                                    {{ $offer->name }} ({{ $offer->discount_value }}{{ $offer->discount_type == 'percent' ? '%' : '' }} off)
                                </span>
                            @empty
                                <span class="text-muted italic">No global offers associated.</span>
                            @endforelse
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <h4 class="mb-2">Description:</h4>
                            <div class="p-3 border rounded bg-light">
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
