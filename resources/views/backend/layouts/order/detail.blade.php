@extends('backend.app')

@section('title', 'Order #' . $data->tracking_id)

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Order Detail</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">#{{ $data->tracking_id }}</li>
            </ol>
        </div>
    </div>

    <div class="row">
        {{-- ─── LEFT: Customer + Delivery Info ─────────────────────────── --}}
        <div class="col-lg-8">

            {{-- Customer Info --}}
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Customer Information</h5>
                    <span class="badge
                        @if($data->status === 'pending')  bg-warning text-dark
                        @elseif($data->status === 'complete') bg-success
                        @elseif($data->status === 'return')   bg-secondary
                        @else bg-danger
                        @endif fs-12">
                        {{ ucfirst($data->status) }}
                    </span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small">Full Name</label>
                            <input type="text" class="form-control" value="{{ $data->name ?? '—' }}" disabled readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">Email</label>
                            <input type="text" class="form-control" value="{{ $data->email ?? '—' }}" disabled readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">Phone Number</label>
                            <input type="text" class="form-control" value="{{ $data->number ?? '—' }}" disabled readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small">WhatsApp Number</label>
                            <input type="text" class="form-control" value="{{ $data->whatsapp_number ?? '—' }}" disabled readonly>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label text-muted small">Delivery Address</label>
                            <textarea class="form-control" rows="2" disabled readonly>{{ $data->address ?? '—' }}</textarea>
                        </div>
                        @if($data->note)
                        <div class="col-md-12">
                            <label class="form-label text-muted small">Note</label>
                            <textarea class="form-control" rows="2" disabled readonly>{{ $data->note }}</textarea>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Order Items --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Order Items</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Unit Price</th>
                                    <th>Qty / Weight</th>
                                    <th>Line Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data->items as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>
                                        <strong>{{ $item->product_name }}</strong>
                                        @if($item->discount_amount > 0)
                                            <br><small class="text-muted">Original: Tk {{ number_format($item->original_price, 2) }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            {{ ucfirst($item->unit_type ?? 'pcs') }}
                                        </span>
                                    </td>
                                    <td>Tk {{ number_format($item->unit_price, 2) }}</td>
                                    <td>
                                        @if($item->unit_value && $item->unit_type)
                                            {{ $item->quantity }} x {{ floatval($item->unit_value) }} {{ ucfirst($item->unit_type) }}
                                        @else
                                            {{ $item->quantity }} {{ ucfirst($item->unit_type ?? 'pcs') }}
                                        @endif
                                    </td>
                                    <td><strong>Tk {{ number_format($item->total_price, 2) }}</strong></td>
                                </tr>
                                @empty
                                <tr><td colspan="6" class="text-center text-muted py-3">No items found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── RIGHT: Order Summary + Status ─────────────────────────── --}}
        <div class="col-lg-4">

            {{-- Order Meta --}}
            <div class="card mb-3">
                <div class="card-header"><h5 class="mb-0">Order Info</h5></div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="text-muted">Tracking ID</td>
                            <td><code>{{ $data->tracking_id }}</code></td>
                        </tr>
                        <tr>
                            <td class="text-muted">Placed At</td>
                            <td>{{ $data->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Delivery Zone</td>
                            <td>
                                @if($data->delivery_zone)
                                    <span class="badge {{ $data->delivery_zone === 'dhaka' ? 'bg-info' : 'bg-secondary' }}">
                                        {{ ucfirst($data->delivery_zone) }}
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                        @if($data->user)
                        <tr>
                            <td class="text-muted">Account</td>
                            <td>{{ $data->user->name }} ({{ $data->user->email }})</td>
                        </tr>
                        @else
                        <tr>
                            <td class="text-muted">Account</td>
                            <td><span class="badge bg-light text-dark">Guest</span></td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div>

            {{-- Financial Summary --}}
            <div class="card mb-3">
                <div class="card-header"><h5 class="mb-0">Financial Summary</h5></div>
                <div class="card-body">
                    <table class="table table-sm table-borderless mb-0">
                        <tr>
                            <td class="text-muted">Subtotal</td>
                            <td class="text-end">Tk {{ number_format($data->subtotal, 2) }}</td>
                        </tr>
                        @if($data->offer_discount > 0)
                        <tr>
                            <td class="text-muted">Offer Discount</td>
                            <td class="text-end text-success">− Tk {{ number_format($data->offer_discount, 2) }}</td>
                        </tr>
                        @endif
                        @if($data->coupon_discount > 0)
                        <tr>
                            <td class="text-muted">
                                Coupon
                                @if($data->coupon_code)
                                    <span class="badge bg-success ms-1">{{ $data->coupon_code }}</span>
                                @endif
                            </td>
                            <td class="text-end text-success">− Tk {{ number_format($data->coupon_discount, 2) }}</td>
                        </tr>
                        @endif
                        @if($data->total_discount > 0)
                        <tr class="border-top">
                            <td class="text-muted fw-semibold">Total Discount</td>
                            <td class="text-end text-success fw-semibold">− Tk {{ number_format($data->total_discount, 2) }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="text-muted">Delivery Fee</td>
                            <td class="text-end">
                                @if($data->is_free_delivery || $data->delivery_fee == 0)
                                    <span class="text-success">Free</span>
                                @else
                                    Tk {{ number_format($data->delivery_fee, 2) }}
                                @endif
                            </td>
                        </tr>
                        <tr class="border-top">
                            <td class="fw-bold fs-15">Grand Total</td>
                            <td class="text-end fw-bold fs-15 text-primary">Tk {{ number_format($data->final_total, 2) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            {{-- Change Status --}}
            <div class="card mb-3">
                <div class="card-header"><h5 class="mb-0">Update Status</h5></div>
                <div class="card-body">
                    <select name="status"
                            data-id="{{ $data->id }}"
                            data-previous-status="{{ $data->status }}"
                            onchange="showStatusChangeAlert({{ $data->id }}, this.value)"
                            class="form-select">
                        <option value="pending"  {{ $data->status === 'pending'  ? 'selected' : '' }}>Pending</option>
                        <option value="complete" {{ $data->status === 'complete' ? 'selected' : '' }}>Complete</option>
                        <option value="return"   {{ $data->status === 'return'   ? 'selected' : '' }}>Return</option>
                        <option value="canceled" {{ $data->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
                    </select>
                </div>
            </div>

            {{-- Actions --}}
            <div class="d-flex gap-2">
                <a href="{{ route('orders.sweets', $data->id) }}" class="btn btn-success flex-fill">
                    <i class="fe fe-package me-1"></i> Products
                </a>
                <a href="{{ route('orders.invoice', $data->id) }}" class="btn btn-primary flex-fill">
                    <i class="fe fe-file-text me-1"></i> Invoice
                </a>
                <a href="{{ route('orders.index') }}" class="btn btn-danger flex-fill">
                    <i class="fe fe-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function showStatusChangeAlert(id, newStatus) {
        event.preventDefault();
        Swal.fire({
            title: 'Change Status?',
            text: 'Update order to: ' + newStatus,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes, update',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                statusChange(id, newStatus);
            } else {
                const sel = document.querySelector(`[name="status"][data-id="${id}"]`);
                if (sel) sel.value = sel.dataset.previousStatus;
            }
        });
    }

    function statusChange(id, status) {
        let url = '{{ route('orders.status', ':id') }}'.replace(':id', id);
        $.ajax({
            type: 'POST',
            url: url,
            data: { status: status, _token: '{{ csrf_token() }}' },
            success: function (resp) {
                resp.success ? toastr.success(resp.message) : toastr.error(resp.message);
                if (resp.success) {
                    // Update badge
                    const badgeMap = { pending: 'bg-warning text-dark', complete: 'bg-success', return: 'bg-secondary', canceled: 'bg-danger' };
                    const badge = document.querySelector('.card-header .badge');
                    if (badge) {
                        badge.className = 'badge fs-12 ' + (badgeMap[status] ?? 'bg-secondary');
                        badge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
                    }
                }
            },
            error: function () { toastr.error('An error occurred while updating the status.'); }
        });
    }
</script>
@endpush
