@extends('backend.app')

@section('title', 'Offer Create')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Offer Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Offer</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER END --}}

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('offers.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label">Offer Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="Offer name" id="name" maxlength="255" value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="offer_type" class="form-label">Offer Type:</label>
                            <select class="form-select select2" name="offer_type" id="offer_type" required>
                                <option value="discount" {{ old('offer_type') == 'discount' ? 'selected' : '' }}>Discount</option>
                                <option value="free_delivery" {{ old('offer_type') == 'free_delivery' ? 'selected' : '' }}>Free Delivery</option>
                            </select>
                            @error('offer_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" id="discount_type_group">
                            <label for="discount_type" class="form-label">Discount Type:</label>
                            <select class="form-select select2" name="discount_type" id="discount_type">
                                <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>Percentage</option>
                            </select>
                            @error('discount_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" id="discount_value_group">
                            <label for="discount_value" class="form-label">Discount Value:</label>
                            <input type="number" step="0.01" class="form-control @error('discount_value') is-invalid @enderror"
                                name="discount_value" placeholder="Discount value" id="discount_value" value="{{ old('discount_value') }}">
                            @error('discount_value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="applies_to" class="form-label">Applies To:</label>
                            <select class="form-select select2" name="applies_to" id="applies_to" required>
                                <option value="cart" {{ old('applies_to') == 'cart' ? 'selected' : '' }}>Entire Cart</option>
                                <option value="product" {{ old('applies_to') == 'product' ? 'selected' : '' }}>Specific Products</option>
                            </select>
                            @error('applies_to')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" id="product_ids_group" style="display: none;">
                            <label for="product_ids" class="form-label">Select Products:</label>
                            <select class="form-select select2" name="product_ids[]" id="product_ids" multiple>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ (is_array(old('product_ids')) && in_array($product->id, old('product_ids'))) ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location_scope" class="form-label">Location Scope:</label>
                            <select class="form-select select2" name="location_scope" id="location_scope" required>
                                <option value="all" {{ old('location_scope') == 'all' ? 'selected' : '' }}>All Locations</option>
                                <option value="dhaka" {{ old('location_scope') == 'dhaka' ? 'selected' : '' }}>Inside Dhaka</option>
                                <option value="outside" {{ old('location_scope') == 'outside' ? 'selected' : '' }}>Outside Dhaka</option>
                            </select>
                            @error('location_scope')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date" class="form-label">Start Date:</label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                        name="start_date" id="start_date" value="{{ old('start_date') }}">
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date:</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        name="end_date" id="end_date" value="{{ old('end_date') }}">
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="priority" class="form-label">Priority (Higher number = Higher Priority):</label>
                            <input type="number" class="form-control @error('priority') is-invalid @enderror"
                                name="priority" placeholder="Priority" id="priority" value="{{ old('priority', 0) }}">
                            @error('priority')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_active" value="1" {{ old('is_active') ? 'checked' : '' }}>
                                <span class="custom-control-label">Is Active</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="coupon_enabled" value="1" {{ old('coupon_enabled') ? 'checked' : '' }}>
                                <span class="custom-control-label">Requires Coupon</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="summernote" class="form-label">Description (Optional):</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="summernote" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('offers.index') }}" class="btn btn-danger me-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        function toggleFields() {
            let offerType = $('#offer_type').val();
            if (offerType === 'free_delivery') {
                $('#discount_type_group').hide();
                $('#discount_value_group').hide();
            } else {
                $('#discount_type_group').show();
                $('#discount_value_group').show();
            }

            let appliesTo = $('#applies_to').val();
            if (appliesTo === 'product') {
                $('#product_ids_group').show();
            } else {
                $('#product_ids_group').hide();
            }
        }

        $('#offer_type, #applies_to').on('change', toggleFields);
        toggleFields(); // Initial call
    });
</script>
@endpush
