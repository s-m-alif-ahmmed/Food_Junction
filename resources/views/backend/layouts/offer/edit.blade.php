@extends('backend.app')

@section('title', 'Offer Edit')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Offer</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('offers.index') }}">Offers</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Offer</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER END --}}

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('offers.update', $data->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="name" class="form-label">Offer Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="Offer name" id="name" maxlength="255" value="{{ old('name', $data->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="offer_type" class="form-label">Offer Type:</label>
                            <select class="form-select select2" name="offer_type" id="offer_type" required>
                                <option value="discount" {{ old('offer_type', $data->offer_type) == 'discount' ? 'selected' : '' }}>Discount</option>
                                <option value="free_delivery" {{ old('offer_type', $data->offer_type) == 'free_delivery' ? 'selected' : '' }}>Free Delivery</option>
                                <option value="free_product" {{ old('offer_type', $data->offer_type) == 'free_product' ? 'selected' : '' }}>Free Product (Gift)</option>
                            </select>
                            @error('offer_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" id="discount_type_group">
                            <label for="discount_type" class="form-label">Discount Type:</label>
                            <select class="form-select select2" name="discount_type" id="discount_type">
                                <option value="fixed" {{ old('discount_type', $data->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed Amount</option>
                                <option value="percent" {{ old('discount_type', $data->discount_type) == 'percent' ? 'selected' : '' }}>Percentage</option>
                            </select>
                            @error('discount_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group" id="discount_value_group">
                            <label for="discount_value" class="form-label">Discount Value:</label>
                            <input type="number" step="0.01" class="form-control @error('discount_value') is-invalid @enderror"
                                name="discount_value" placeholder="Discount value" id="discount_value" value="{{ old('discount_value', $data->discount_value) }}">
                            @error('discount_value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @php
                            $freeProductReward = $data->rewards->where('reward_type', 'free_product')->first();
                            $rewardProductId = $freeProductReward ? $freeProductReward->product_id : '';
                            $rewardQuantity = $freeProductReward ? $freeProductReward->quantity : 1;
                        @endphp
                        <div class="row" id="free_product_group" style="display: none;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reward_product_id" class="form-label">Gift Product:</label>
                                    <select class="form-select select2" name="reward_product_id" id="reward_product_id">
                                        <option value="">Select Gift Product</option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" {{ old('reward_product_id', $rewardProductId) == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('reward_product_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="reward_quantity" class="form-label">Gift Quantity:</label>
                                    <input type="number" class="form-control @error('reward_quantity') is-invalid @enderror"
                                        name="reward_quantity" placeholder="Quantity" id="reward_quantity" value="{{ old('reward_quantity', $rewardQuantity) }}">
                                    @error('reward_quantity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="applies_to" class="form-label">Applies To:</label>
                            <select class="form-select select2" name="applies_to" id="applies_to" required>
                                <option value="cart" {{ old('applies_to', $data->applies_to) == 'cart' ? 'selected' : '' }}>Entire Cart</option>
                                <option value="product" {{ old('applies_to', $data->applies_to) == 'product' ? 'selected' : '' }}>Specific Products</option>
                                <option value="variant" {{ old('applies_to', $data->applies_to) == 'variant' ? 'selected' : '' }}>Specific Variants</option>
                            </select>
                            @error('applies_to')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @php
                            $selectedProductIds = $data->conditions->where('condition_type', 'product_id')->pluck('value')->toArray();
                            $selectedVariantIds = $data->conditions->where('condition_type', 'variant_id')->pluck('value')->toArray();
                            
                            $firstVariant = null;
                            $selectedProductIdForVariant = '';
                            if (!empty($selectedVariantIds)) {
                                $firstVariant = \App\Models\ProductVariant::find($selectedVariantIds[0]);
                                $selectedProductIdForVariant = $firstVariant ? $firstVariant->product_id : '';
                            }

                            $cartCondition = $data->conditions->where('condition_type', 'cart_total')->first();
                            $minCartTotal = $cartCondition ? $cartCondition->value : '';

                            $qtyCondition = $data->conditions->where('condition_type', 'min_quantity')->first();
                            $weightCondition = $data->conditions->where('condition_type', 'min_weight')->first();
                            $activeCondition = $qtyCondition ?? $weightCondition;
                            $condType = $qtyCondition ? 'quantity' : ($weightCondition ? 'weight' : '');
                            $condOperator = $activeCondition ? $activeCondition->operator : '>=';
                            $condValue = $activeCondition ? $activeCondition->value : '';
                        @endphp
                        <div class="form-group" id="min_cart_total_group" style="display: none;">
                            <label for="min_cart_total" class="form-label">Minimum Cart Total (Optional):</label>
                            <input type="number" step="0.01" class="form-control @error('min_cart_total') is-invalid @enderror"
                                name="min_cart_total" placeholder="Minimum Cart Total" id="min_cart_total" value="{{ old('min_cart_total', $minCartTotal) }}">
                            @error('min_cart_total')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group" id="product_ids_group" style="display: none;">
                            <label for="product_ids" class="form-label">Select Products:</label>
                            <select class="form-select select2" name="product_ids[]" id="product_ids" multiple>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" {{ (is_array(old('product_ids', $selectedProductIds)) && in_array($product->id, old('product_ids', $selectedProductIds))) ? 'selected' : '' }}>{{ $product->name }}</option>
                                @endforeach
                            </select>
                            @error('product_ids')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div id="variant_selection_group" style="display: none;">
                            <div class="form-group">
                                <label for="select_product" class="form-label">Select Product:</label>
                                <select class="form-select select2" id="select_product">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $selectedProductIdForVariant == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="variant_ids" class="form-label">Select Variants:</label>
                                <select class="form-select select2" name="variant_ids[]" id="variant_ids" multiple>
                                    @if($data->applies_to == 'variant')
                                        @foreach(\App\Models\ProductVariant::with('product')->whereIn('id', $selectedVariantIds)->get() as $variant)
                                            <option value="{{ $variant->id }}" selected>{{ $variant->product->name }} - {{ $variant->quantity }} {{ $variant->unit }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('variant_ids')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div id="condition_details_group" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="condition_type" class="form-label">Condition Based On:</label>
                                        <select class="form-select select2" name="condition_type" id="condition_type">
                                            <option value="">No Condition</option>
                                            <option value="quantity" {{ old('condition_type', $condType) == 'quantity' ? 'selected' : '' }}>Quantity</option>
                                            <option value="weight" {{ old('condition_type', $condType) == 'weight' ? 'selected' : '' }}>Weight</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="operator" class="form-label">Operator:</label>
                                        <select class="form-select select2" name="operator" id="operator">
                                            <option value="=" {{ old('operator', $condOperator) == '=' ? 'selected' : '' }}>Equal</option>
                                            <option value=">=" {{ old('operator', $condOperator) == '>=' ? 'selected' : '' }}>Greater than or Equal</option>
                                            <option value="<=" {{ old('operator', $condOperator) == '<=' ? 'selected' : '' }}>Less than or Equal</option>
                                            <option value=">" {{ old('operator', $condOperator) == '>' ? 'selected' : '' }}>Greater than</option>
                                            <option value="<" {{ old('operator', $condOperator) == '<' ? 'selected' : '' }}>Less than</option>
                                            <option value="between" {{ old('operator', $condOperator) == 'between' ? 'selected' : '' }}>Between</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="condition_value" class="form-label">Value:</label>
                                        <input type="number" step="0.01" class="form-control" name="condition_value" id="condition_value" value="{{ old('condition_value', $condValue) }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="location_scope" class="form-label">Location Scope:</label>
                            <select class="form-select select2" name="location_scope" id="location_scope" required>
                                <option value="all" {{ old('location_scope', $data->location_scope) == 'all' ? 'selected' : '' }}>All Locations</option>
                                @foreach($deliveryZones as $zone)
                                    <option value="{{ $zone->slug }}" {{ old('location_scope', $data->location_scope) == $zone->slug ? 'selected' : '' }}>{{ $zone->name }}</option>
                                @endforeach
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
                                        name="start_date" id="start_date" value="{{ old('start_date', $data->start_date ? $data->start_date->format('Y-m-d') : '') }}">
                                    @error('start_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date" class="form-label">End Date:</label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                        name="end_date" id="end_date" value="{{ old('end_date', $data->end_date ? $data->end_date->format('Y-m-d') : '') }}">
                                    @error('end_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="priority" class="form-label">Priority (Higher number = Higher Priority):</label>
                            <input type="number" class="form-control @error('priority') is-invalid @enderror"
                                name="priority" placeholder="Priority" id="priority" value="{{ old('priority', $data->priority) }}">
                            @error('priority')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="is_active" value="1" {{ old('is_active', $data->is_active) ? 'checked' : '' }}>
                                <span class="custom-control-label">Is Active</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="coupon_enabled" value="1" {{ old('coupon_enabled', $data->coupon_enabled) ? 'checked' : '' }}>
                                <span class="custom-control-label">Requires Coupon</span>
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="summernote" class="form-label">Description (Optional):</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="summernote" name="description">{{ old('description', $data->description) }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Update</button>
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
                $('#free_product_group').hide();
            } else if (offerType === 'free_product') {
                $('#discount_type_group').hide();
                $('#discount_value_group').hide();
                $('#free_product_group').show();
            } else {
                $('#discount_type_group').show();
                $('#discount_value_group').show();
                $('#free_product_group').hide();
            }

            let appliesTo = $('#applies_to').val();
            $('#min_cart_total_group').hide();
            $('#product_ids_group').hide();
            $('#variant_selection_group').hide();
            $('#condition_details_group').hide();

            if (appliesTo === 'product') {
                $('#product_ids_group').show();
                $('#condition_details_group').show();
            } else if (appliesTo === 'variant') {
                $('#variant_selection_group').show();
                $('#condition_details_group').show();
            } else {
                $('#min_cart_total_group').show();
            }
        }

        $('#offer_type, #applies_to').on('change', toggleFields);

        $('#select_product').on('change', function() {
            let productId = $(this).val();
            if (productId) {
                $.ajax({
                    url: "{{ route('get.variants', ':id') }}".replace(':id', productId),
                    type: "GET",
                    success: function(data) {
                        $('#variant_ids').empty();
                        $.each(data, function(key, variant) {
                            $('#variant_ids').append('<option value="' + variant.id + '">' + variant.product.name + ' - ' + variant.quantity + ' ' + variant.unit + '</option>');
                        });
                        $('#variant_ids').trigger('change');
                    }
                });
            }
        });

        toggleFields(); // Initial call
    });
</script>
@endpush
