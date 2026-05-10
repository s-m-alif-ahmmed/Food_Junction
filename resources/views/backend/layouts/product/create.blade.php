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
                                                <th id="unit-label">Quantity</th>
                                                <th>Unit Type</th>
                                                <th>Base Price</th>
                                                <th>Discount Price</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="variants-body">
                                            @if(old('variant_quantity'))
                                                @foreach(old('variant_quantity') as $index => $qty)
                                                    <tr>
                                                        <td><input type="number" name="variant_quantity[]" class="form-control" value="{{ $qty }}" placeholder="e.g. 500"></td>
                                                        <td>
                                                            <select name="variant_unit_type[]" class="form-select">
                                                                <option value="gm" {{ (old('variant_unit_type')[$index] ?? '') == 'gm' ? 'selected' : '' }}>Gram (gm)</option>
                                                                <option value="pc" {{ (old('variant_unit_type')[$index] ?? '') == 'pc' ? 'selected' : '' }}>Piece (pc)</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="number" name="variant_price[]" class="form-control" value="{{ old('variant_price')[$index] }}" placeholder="0.00"></td>
                                                        <td><input type="number" name="variant_discount_price[]" class="form-control" value="{{ old('variant_discount_price')[$index] }}" placeholder="0.00"></td>
                                                        <td><button type="button" class="btn btn-danger remove-row"><i class="fe fe-trash"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td><input type="number" name="variant_quantity[]" class="form-control" placeholder="e.g. 500"></td>
                                                    <td>
                                                        <select name="variant_unit_type[]" class="form-select">
                                                            <option value="gm">Gram (gm)</option>
                                                            <option value="pc">Piece (pc)</option>
                                                        </select>
                                                    </td>
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
                <td><input type="number" name="variant_quantity[]" class="form-control" placeholder="e.g. 500"></td>
                <td>
                    <select name="variant_unit_type[]" class="form-select">
                        <option value="gm">Gram (gm)</option>
                        <option value="pc">Piece (pc)</option>
                    </select>
                </td>
                <td><input type="number" name="variant_price[]" class="form-control" placeholder="0.00"></td>
                <td><input type="number" name="variant_discount_price[]" class="form-control" placeholder="0.00"></td>
                <td><button type="button" class="btn btn-danger remove-row"><i class="fe fe-trash"></i></button></td>
            </tr>`;
            $('#variants-body').append(row);
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
