@extends('backend.app')

@section('title', 'Orders List')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Orders</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Orders</li>
            </ol>
        </div>
    </div>

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Time</th>
                                    <th>Tracking ID</th>
                                    <th>Customer</th>
                                    <th>Phone</th>
                                    <th>Zone</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        if (!$.fn.DataTable.isDataTable('#datatable')) {
            let dTable = $('#datatable').DataTable({
                order: [],
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, 'All']],
                processing: true,
                responsive: true,
                serverSide: true,
                language: {
                    processing: `<div class="text-center"><div class="spinner-border text-primary" style="width:3rem;height:3rem;" role="status"><span class="visually-hidden">Loading...</span></div></div>`
                },
                pagingType: 'full_numbers',
                dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                ajax: {
                    url: '{{ route('orders.index') }}',
                    type: 'GET',
                },
                columns: [
                    { data: 'DT_RowIndex',    name: 'DT_RowIndex',   orderable: false, searchable: false },
                    { data: 'created_at',     name: 'created_at' },
                    { data: 'tracking_id',    name: 'tracking_id' },
                    { data: 'name',           name: 'name' },
                    { data: 'number',         name: 'number' },
                    { data: 'delivery_zone',  name: 'delivery_zone',  orderable: false },
                    { data: 'final_total',    name: 'final_total' },
                    { data: 'status',         name: 'status',         orderable: false, searchable: false },
                    { data: 'action',         name: 'action',         orderable: false, searchable: false },
                ],
            });
        }
    });

    // ── Status Change Confirmation ────────────────────────────────────────
    function showStatusChangeAlert(id, newStatus) {
        event.preventDefault();
        Swal.fire({
            title: 'Change Order Status?',
            text: 'Update this order to: ' + newStatus,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Yes, update',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                statusChange(id, newStatus);
            } else {
                // Revert the select back to its previous value
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
                $('#datatable').DataTable().ajax.reload(null, false);
                resp.success ? toastr.success(resp.message) : toastr.error(resp.message);
            },
            error: function () {
                toastr.error('An error occurred while updating the status.');
            }
        });
    }

    // ── Delete Confirmation ───────────────────────────────────────────────
    function showDeleteConfirm(id) {
        event.preventDefault();
        Swal.fire({
            title: 'Delete this order?',
            text: 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete!',
        }).then((result) => {
            if (result.isConfirmed) deleteItem(id);
        });
    }

    function deleteItem(id) {
        let url = '{{ route('orders.destroy', ':id') }}'.replace(':id', id);
        $.ajax({
            type: 'DELETE',
            url: url,
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            success: function (resp) {
                $('#datatable').DataTable().ajax.reload(null, false);
                resp.success ? toastr.success(resp.message) : toastr.error(resp.message);
            },
            error: function () {
                toastr.error('An error occurred. Please try again.');
            }
        });
    }
</script>
@endpush
