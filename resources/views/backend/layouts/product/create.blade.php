@extends('backend.app')

@section('title', 'Product Create')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Product Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER END --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="meta_title" class="form-label">Meta Title (Optional):</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                name="meta_title" placeholder="Meta Title" id="meta_title" value="{{ old('meta_title') }}">
                            @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description" class="form-label">Meta Description (Optional):</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords" class="form-label">Meta Keywords (Optional):</label>
                            <textarea class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords">{{ old('meta_keywords') }}</textarea>
                            @error('meta_keywords')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="product_type" class="form-label">Product Type:</label>
                            <select class="form-select select2" name="product_type" id="product_type">
                                <option value="Sweet">Sweet</option>
                                <option value="Product" selected>Product</option>
                            </select>
                            @error('product_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="category_id" class="form-label">Category:</label>
                            <select class="form-select select2" name="category_id" id="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="offers" class="form-label">Offers (Optional):</label>
                            <select class="form-select select2" name="offers[]" id="offers" multiple>
                                @foreach($offers as $offer)
                                    <option value="{{ $offer->id }}" {{ (is_array(old('offers')) && in_array($offer->id, old('offers'))) ? 'selected' : '' }}>
                                        {{ $offer->name }} ({{ $offer->discount_value }}{{ $offer->discount_type == 'percent' ? '%' : '' }} off)
                                    </option>
                                @endforeach
                            </select>
                            @error('offers')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Product Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" placeholder="Product name" id="name" maxlength="100" value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Product Image(500*500px):</label>
                            <input type="file" class="form-control dropify @error('image') is-invalid @enderror"
                                name="image" placeholder="Product Image" id="image" value="{{ old('image') }}">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="price" class="form-label">Price:</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror"
                                name="price" placeholder="Product price" id="price" value="{{ old('price') }}">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="discount_price" class="form-label">Discount Price (Optional):</label>
                            <input type="text" class="form-control @error('discount_price') is-invalid @enderror"
                                name="discount_price" placeholder="Product discount price" id="discount_price" value="{{ old('discount_price') }}">
                            @error('discount_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="card bg-light my-4 border">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Pricing & Variants</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="pricing_type" class="form-label">Pricing Type:</label>
                                    <select class="form-select" name="pricing_type" id="pricing_type">
                                        <option value="quantity" {{ old('pricing_type') == 'quantity' ? 'selected' : '' }}>Quantity Based</option>
                                        <option value="weight" {{ old('pricing_type') == 'weight' ? 'selected' : '' }}>Weight Based</option>
                                    </select>
                                </div>

                                <div id="variants-container">
                                    <label class="form-label">Pricing Variants:</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th id="unit-label">Unit (Qty/Weight)</th>
                                                <th>Base Price</th>
                                                <th>Discount Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="variants-body">
                                            @if(old('variant_unit'))
                                                @foreach(old('variant_unit') as $index => $unit)
                                                    <tr>
                                                        <td><input type="text" name="variant_unit[]" class="form-control" value="{{ $unit }}" placeholder="e.g. 500g or 1pc"></td>
                                                        <td><input type="number" name="variant_price[]" class="form-control" value="{{ old('variant_price')[$index] }}" placeholder="0.00"></td>
                                                        <td><input type="number" name="variant_discount_price[]" class="form-control" value="{{ old('variant_discount_price')[$index] }}" placeholder="0.00"></td>
                                                        <td><button type="button" class="btn btn-danger remove-row"><i class="fe fe-trash"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td><input type="text" name="variant_unit[]" class="form-control" placeholder="e.g. 500g or 1pc"></td>
                                                    <td><input type="number" name="variant_price[]" class="form-control" placeholder="0.00"></td>
                                                    <td><input type="number" name="variant_discount_price[]" class="form-control" placeholder="0.00"></td>
                                                    <td><button type="button" class="btn btn-danger remove-row"><i class="fe fe-trash"></i></button></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-info btn-sm" id="add-variant"><i class="fe fe-plus"></i> Add Variant</button>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-light my-4 border">
                            <div class="card-header border-bottom">
                                <h4 class="card-title">Location Specific Conditions</h4>
                            </div>
                            <div class="card-body">
                                <div id="conditions-container">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Location Scope</th>
                                                <th>Extra Discount (Val)</th>
                                                <th>Free Delivery</th>
                                                <th>Gift Item</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="conditions-body">
                                            @if(old('loc_scope'))
                                                @foreach(old('loc_scope') as $index => $scope)
                                                    <tr>
                                                        <td>
                                                            <select name="loc_scope[]" class="form-select">
                                                                <option value="all" {{ $scope == 'all' ? 'selected' : '' }}>All</option>
                                                                <option value="dhaka" {{ $scope == 'dhaka' ? 'selected' : '' }}>Dhaka</option>
                                                                <option value="outside" {{ $scope == 'outside' ? 'selected' : '' }}>Outside Dhaka</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="number" name="loc_discount[]" class="form-control" value="{{ old('loc_discount')[$index] }}" placeholder="0.00"></td>
                                                        <td class="text-center"><input type="checkbox" name="loc_free_delivery[]" class="form-check-input" {{ isset(old('loc_free_delivery')[$index]) ? 'checked' : '' }}></td>
                                                        <td><input type="text" name="loc_gift[]" class="form-control" value="{{ old('loc_gift')[$index] }}" placeholder="e.g. Coke 250ml"></td>
                                                        <td><button type="button" class="btn btn-danger remove-row"><i class="fe fe-trash"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>
                                                        <select name="loc_scope[]" class="form-select">
                                                            <option value="all">All</option>
                                                            <option value="dhaka">Dhaka</option>
                                                            <option value="outside">Outside Dhaka</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="number" name="loc_discount[]" class="form-control" placeholder="0.00"></td>
                                                    <td class="text-center"><input type="checkbox" name="loc_free_delivery[]" class="form-check-input"></td>
                                                    <td><input type="text" name="loc_gift[]" class="form-control" placeholder="e.g. Coke 250ml"></td>
                                                    <td><button type="button" class="btn btn-danger remove-row"><i class="fe fe-trash"></i></button></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-info btn-sm" id="add-condition"><i class="fe fe-plus"></i> Add Condition</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="summernote" class="form-label">Description:</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="summernote" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="{{ route('products.index') }}" class="btn btn-danger me-2">Cancel</a>
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
        // Add Variant Row
        $('#add-variant').click(function() {
            let row = `<tr>
                <td><input type="text" name="variant_unit[]" class="form-control" placeholder="e.g. 500g or 1pc"></td>
                <td><input type="number" name="variant_price[]" class="form-control" placeholder="0.00"></td>
                <td><input type="number" name="variant_discount_price[]" class="form-control" placeholder="0.00"></td>
                <td><button type="button" class="btn btn-danger remove-row"><i class="fe fe-trash"></i></button></td>
            </tr>`;
            $('#variants-body').append(row);
        });

        // Add Condition Row
        $('#add-condition').click(function() {
            let row = `<tr>
                <td>
                    <select name="loc_scope[]" class="form-select">
                        <option value="all">All</option>
                        <option value="dhaka">Dhaka</option>
                        <option value="outside">Outside Dhaka</option>
                    </select>
                </td>
                <td><input type="number" name="loc_discount[]" class="form-control" placeholder="0.00"></td>
                <td class="text-center"><input type="checkbox" name="loc_free_delivery[]" class="form-check-input"></td>
                <td><input type="text" name="loc_gift[]" class="form-control" placeholder="e.g. Coke 250ml"></td>
                <td><button type="button" class="btn btn-danger remove-row"><i class="fe fe-trash"></i></button></td>
            </tr>`;
            $('#conditions-body').append(row);
        });

        // Remove Row
        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
        });

        // Dynamic Label Update
        $('#pricing_type').change(function() {
            let type = $(this).val();
            $('#unit-label').text(type === 'weight' ? 'Weight (e.g. 1kg)' : 'Quantity (e.g. 1pc)');
        }).trigger('change');
    });
</script>
@endpush
