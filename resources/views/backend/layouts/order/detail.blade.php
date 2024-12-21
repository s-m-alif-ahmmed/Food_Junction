@extends('backend.app')

@section('title', 'Order')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Order</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER END --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Order Time:</label>
                            <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') ?? '' }}" disabled readonly>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Tracking ID:</label>
                            <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->tracking_id }}" disabled readonly>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Status:</label>
                            <select name="status" onchange="showStatusChangeAlert({{ $data->id }}, this.value)" class="form-control">
                                <option value="Pending" {{ $data->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Complete" {{ $data->status == 'complete' ? 'selected' : '' }}>Complete</option>
                                <option value="Return" {{ $data->status == 'return' ? 'selected' : '' }}>Return</option>
                                <option value="Canceled" {{ $data->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                            </select>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Name:</label>
                            <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->name ?? '' }}" disabled readonly>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Email:</label>
                            <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->email ?? '' }}" disabled readonly>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->number ?? '' }}" disabled readonly>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Whatsapp Number:</label>
                            <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->whatsapp_number ?? '' }}" disabled readonly>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Address:</label>
                            <textarea class="form-control @error('page_content') is-invalid @enderror" name="page_content" disabled readonly>{{ $data->address ?? '' }}</textarea>
                        </div>

                        <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                            <label for="summernote" class="form-label">Note:</label>
                            <textarea class="form-control @error('page_content') is-invalid @enderror" name="page_content" disabled readonly>{{ $data->note ?? '' }}</textarea>
                        </div>

                        @if($data->delivery_fee >= 0)
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                <label for="page_title" class="form-label">Delivery Charge:</label>
                                <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->delivery_fee ?? '' }}" disabled readonly>
                            </div>
                        @endif

                        @if($data->login_discount)
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                <label for="page_title" class="form-label">login discount:</label>
                                <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->login_discount ?? '' }}" disabled readonly>
                            </div>
                        @endif

                        @if($data->estimate_total)
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                <label for="page_title" class="form-label">Total:</label>
                                <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->estimate_total ?? '' }}" disabled readonly>
                            </div>
                        @endif

                        @if($data->order_total)
                            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                                <label for="page_title" class="form-label">Sub Total:</label>
                                <input type="text" class="form-control @error('page_title') is-invalid @enderror" name="page_title" placeholder="title" id="title" value="{{ $data->order_total ?? '' }}" disabled readonly>
                            </div>
                        @endif

                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                            <label for="page_title" class="form-label">Action:</label>
                            <a class="btn btn-success" href="{{ route('orders.sweets', $data->id) }}">Sweet Details</a>
                            <a class="btn btn-primary" href="{{ route('orders.invoice', $data->id) }}">Invoice</a>
                            <a href="{{ route('orders.index') }}" class="btn btn-danger me-2">Back</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        // Status Change Confirm Alert
        function showStatusChangeAlert(id, newStatus) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to update the status?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id, newStatus);
                } else {
                    // If canceled, reset the select field to its previous value
                    let currentStatus = document.querySelector(`[name="status"][data-id="${id}"]`).dataset.previousStatus;
                    document.querySelector(`[name="status"][data-id="${id}"]`).value = currentStatus;
                }
            });
        }

        // Status Change
        function statusChange(id, status) {
            let url = '{{ route('orders.status', ':id') }}';
            url = url.replace(':id', id);

            $.ajax({
                type: "POST",
                url: url,
                data: {
                    status: status,
                    _token: '{{ csrf_token() }}',  // CSRF token for security
                },
                success: function(resp) {
                    console.log(resp);
                    // Reload DataTable (if necessary)
                    $('#datatable').DataTable().ajax.reload();

                    if (resp.success === true) {
                        // Show success toast message
                        toastr.success(resp.message);
                    } else if (resp.errors) {
                        toastr.error(resp.errors[0]);
                    } else {
                        toastr.error(resp.message);
                    }
                },
                error: function(error) {
                    toastr.error("An error occurred while changing the status.");
                }
            });
        }
    </script>
@endpush
