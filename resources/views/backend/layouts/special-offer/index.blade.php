@extends('backend.app')

@section('title', 'Special Offer Pages')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Special Offer Landing Pages</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Special Offer Pages</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                 <div class="card-header border-bottom"
                    style="margin-bottom: 0; display: flex; justify-content: space-between;">
                    <h3 class="card-title">Special Offer Products & Landing Pages</h3>
                    <a href="{{ route('special-offers.create') }}" class="btn btn-primary">Create Offer Page</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-nowrap border-bottom w-100" id="datatable">
                            <thead>
                                <tr>
                                    <th class="wd-5p border-bottom-0">#</th>
                                    <th class="wd-10p border-bottom-0">Image</th>
                                    <th class="wd-25p border-bottom-0">Offer Name & URL</th>
                                    <th class="wd-20p border-bottom-0">Linked Product</th>
                                    <th class="wd-15p border-bottom-0">Pricing</th>
                                    <th class="wd-10p border-bottom-0 text-center">Status</th>
                                    <th class="wd-15p border-bottom-0 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- Dynamic DataTables Rows --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                }
            });

            if (!$.fn.DataTable.isDataTable('#datatable')) {
                let dTable = $('#datatable').DataTable({
                    order: [],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "All"]
                    ],
                    processing: true,
                    responsive: true,
                    serverSide: true,
                    language: {
                        processing: `<div class="text-center py-3">
                            <div class="spinner-border text-primary" style="width: 2.5rem; height: 2.5rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>`
                    },
                    dom: "<'row justify-content-between table-topbar'<'col-md-2 col-sm-4 px-0'l><'col-md-2 col-sm-4 px-0'f>>tipr",
                    ajax: {
                        url: "{{ route('special-offers.index') }}",
                        type: "GET",
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                        { data: 'image', name: 'image', orderable: false, searchable: false },
                        { data: 'name_info', name: 'name', orderable: true, searchable: true },
                        { data: 'linked_product', name: 'linked_product', orderable: false, searchable: false },
                        { data: 'pricing', name: 'offer_price', orderable: true, searchable: true },
                        { data: 'status', name: 'status', orderable: false, searchable: false, className: 'text-center' },
                        { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' },
                    ],
                });
            }
        });

        // Copy landing page link to clipboard
        function copyLandingLink(url) {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(url).then(function() {
                    toastr.success('Landing page link copied to clipboard: ' + url);
                }, function(err) {
                    fallbackCopyText(url);
                });
            } else {
                fallbackCopyText(url);
            }
        }

        function fallbackCopyText(text) {
            let textArea = document.createElement("textarea");
            textArea.value = text;
            textArea.style.position = "fixed";
            textArea.style.left = "-999999px";
            textArea.style.top = "-999999px";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            try {
                document.execCommand('copy');
                toastr.success('Landing page link copied to clipboard: ' + text);
            } catch (err) {
                toastr.error('Failed to copy link.');
            }
            document.body.removeChild(textArea);
        }

        // Status Change Confirm Alert
        function showStatusChangeAlert(id) {
            event.preventDefault();

            Swal.fire({
                title: 'Change Status?',
                text: 'Are you sure you want to toggle the status for this offer page?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    statusChange(id);
                }
            });
        }

        // Status Change Ajax
        function statusChange(id) {
            let url = '{{ route('special-offers.status', ':id') }}';
            $.ajax({
                type: "GET",
                url: url.replace(':id', id),
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload(null, false);
                    if (resp.success === true) {
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message || 'Status update failed.');
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred while updating status.');
                }
            });
        }

        // Delete Confirmation
        function showDeleteConfirm(id) {
            event.preventDefault();
            Swal.fire({
                title: 'Delete Special Offer Page?',
                text: 'Are you sure? This offer page and its landing URL will be permanently removed.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteItem(id);
                }
            });
        }

        // Delete Item Ajax
        function deleteItem(id) {
            let url = '{{ route('special-offers.destroy', ':id') }}';
            let csrfToken = '{{ csrf_token() }}';
            $.ajax({
                type: "DELETE",
                url: url.replace(':id', id),
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(resp) {
                    $('#datatable').DataTable().ajax.reload(null, false);
                    if (resp['t-success']) {
                        toastr.success(resp.message);
                    } else {
                        toastr.error(resp.message || 'Delete failed.');
                    }
                },
                error: function(error) {
                    toastr.error('An error occurred while deleting.');
                }
            });
        }
    </script>
@endpush
