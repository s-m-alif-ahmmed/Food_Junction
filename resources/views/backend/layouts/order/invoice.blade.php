@extends('backend.app')

@section('title', 'Invoice #' . $data->tracking_id)

@push('styles')
<style>
    @media print {
        #invoiceFooter, .page-header, .sidebar, .main-sidebar, .navbar { display: none !important; }
        .card { box-shadow: none !important; border: none !important; }
    }
    .invoice-table th { background-color: #f8f9fa; }
</style>
@endpush

@section('content')
@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<div class="page-header">
    <div>
        <h1 class="page-title">Invoice</h1>
    </div>
    <div class="ms-auto pageheader-btn">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
            <li class="breadcrumb-item"><a href="{{ route('orders.show', $data->id) }}">#{{ $data->tracking_id }}</a></li>
            <li class="breadcrumb-item active">Invoice</li>
        </ol>
    </div>
</div>

<div class="row mt-2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

                {{-- ─── Invoice Header ──────────────────────────────────── --}}
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h3 class="mb-0 fw-bold">INVOICE</h3>
                        <p class="text-muted mb-0">#{{ $data->tracking_id }}</p>
                    </div>
                    <div class="text-end">
                        <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                             alt="Food Junction" style="max-height:55px;">
                        <p class="mb-0 fw-semibold mt-1">Food Junction</p>
                        <small class="text-muted">Uttara, Dhaka</small>
                    </div>
                </div>
                <hr>

                {{-- ─── Invoice Meta ────────────────────────────────────── --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h6 class="text-uppercase text-muted mb-2">Invoice To</h6>
                        <p class="mb-1 fw-semibold">{{ $data->name }}</p>
                        @if($data->email)
                            <p class="mb-1 text-muted small">{{ $data->email }}</p>
                        @endif
                        <p class="mb-1 text-muted small">📞 {{ $data->number }}</p>
                        @if($data->whatsapp_number)
                            <p class="mb-1 text-muted small">💬 {{ $data->whatsapp_number }}</p>
                        @endif
                        <p class="mb-0 text-muted small">📍 {{ $data->address }}</p>
                        @if($data->note)
                            <p class="mb-0 text-muted small mt-1">📝 {{ $data->note }}</p>
                        @endif
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h6 class="text-uppercase text-muted mb-2">Invoice Details</h6>
                        <p class="mb-1"><span class="text-muted">Date:</span>
                            {{ $data->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}
                        </p>
                        <p class="mb-1"><span class="text-muted">Status:</span>
                            <span class="badge
                                @if($data->status === 'pending')  bg-warning text-dark
                                @elseif($data->status === 'complete') bg-success
                                @elseif($data->status === 'return')   bg-secondary
                                @else bg-danger
                                @endif">{{ ucfirst($data->status) }}</span>
                        </p>
                        <p class="mb-1"><span class="text-muted">Delivery Zone:</span>
                            @if($data->delivery_zone)
                                <span class="badge {{ $data->delivery_zone === 'dhaka' ? 'bg-info' : 'bg-secondary' }}">
                                    {{ ucfirst($data->delivery_zone) }}
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </p>
                        @if($data->coupon_code)
                            <p class="mb-1"><span class="text-muted">Coupon:</span>
                                <span class="badge bg-success">{{ $data->coupon_code }}</span>
                            </p>
                        @endif
                    </div>
                </div>

                {{-- ─── Order Items Table ───────────────────────────────── --}}
                <div class="table-responsive">
                    <table class="table table-bordered invoice-table mb-0">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:50px;">#</th>
                                <th>Product</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Qty / Weight</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order_data as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    <strong>{{ $item->product_name }}</strong>
                                    @if($item->discount_amount > 0)
                                        <br>
                                        <small class="text-muted">
                                            Original: Tk {{ number_format($item->original_price, 2) }}
                                            <span class="text-success">(−Tk {{ number_format($item->discount_amount, 2) }})</span>
                                        </small>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge {{ $item->unit_type === 'kg' ? 'bg-primary' : 'bg-info text-dark' }}">
                                        {{ $item->unit_type === 'kg' ? 'Sweet' : 'Product' }}
                                    </span>
                                </td>
                                <td class="text-center">Tk {{ number_format($item->unit_price, 2) }}</td>
                                <td class="text-center">
                                    @if($item->unit_type === 'kg')
                                        {{ $item->unit_value < 1000
                                            ? number_format($item->unit_value) . ' gm'
                                            : number_format($item->unit_value / 1000, 3) . ' kg' }}
                                    @else
                                        {{ $item->quantity }} pcs
                                    @endif
                                </td>
                                <td class="text-end"><strong>Tk {{ number_format($item->total_price, 2) }}</strong></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">No items found.</td>
                            </tr>
                            @endforelse
                        </tbody>

                        {{-- ─── Financial Summary Rows ──────────────────── --}}
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-semibold">Subtotal</td>
                                <td class="text-end">Tk {{ number_format($data->subtotal, 2) }}</td>
                            </tr>

                            @if($data->offer_discount > 0)
                            <tr>
                                <td colspan="5" class="text-end text-success">Offer Discount</td>
                                <td class="text-end text-success">− Tk {{ number_format($data->offer_discount, 2) }}</td>
                            </tr>
                            @endif

                            @if($data->coupon_discount > 0)
                            <tr>
                                <td colspan="5" class="text-end text-success">
                                    Coupon Discount
                                    @if($data->coupon_code)
                                        <span class="badge bg-success ms-1">{{ $data->coupon_code }}</span>
                                    @endif
                                </td>
                                <td class="text-end text-success">− Tk {{ number_format($data->coupon_discount, 2) }}</td>
                            </tr>
                            @endif

                            @if($data->total_discount > 0)
                            <tr class="table-light">
                                <td colspan="5" class="text-end fw-semibold text-success">Total Discount</td>
                                <td class="text-end fw-semibold text-success">− Tk {{ number_format($data->total_discount, 2) }}</td>
                            </tr>
                            @endif

                            <tr>
                                <td colspan="5" class="text-end fw-semibold">Delivery Charge</td>
                                <td class="text-end">
                                    @if($data->is_free_delivery || $data->delivery_fee == 0)
                                        <span class="text-success fw-semibold">Free</span>
                                    @else
                                        Tk {{ number_format($data->delivery_fee, 2) }}
                                    @endif
                                </td>
                            </tr>

                            <tr class="table-primary">
                                <td colspan="5" class="text-end fw-bold fs-15">Grand Total</td>
                                <td class="text-end fw-bold fs-15">Tk {{ number_format($data->final_total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                {{-- ─── Thank You Note ──────────────────────────────────── --}}
                <div class="text-center mt-4 text-muted">
                    <p class="mb-0">Thank you for shopping with <strong>Food Junction</strong>!</p>
                    <small>https://www.foodjunctiondhaka.com</small>
                </div>

            </div>

            {{-- ─── Footer Actions ──────────────────────────────────── --}}
            <div class="card-footer text-end" id="invoiceFooter">
                <a href="{{ route('orders.show', $data->id) }}" class="btn btn-danger me-2">
                    <i class="fe fe-arrow-left me-1"></i> Back
                </a>
                <button type="button" class="btn btn-info" onclick="window.print();">
                    <i class="si si-printer me-1"></i> Print Invoice
                </button>
            </div>

        </div>
    </div>
</div>
@endsection
