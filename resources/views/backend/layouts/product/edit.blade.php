@extends('backend.app')

@section('title', 'Product Edit')

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
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">
                    <form method="post" action="{{ route('products.update', ['id' => $data->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="form-group">
                            <label for="meta_title" class="form-label">Meta Title (Optional):</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                   name="meta_title" placeholder="Meta Title" id="meta_title" value="{{ $data->meta_title ?? '' }}">
                            @error('meta_title')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description" class="form-label">Meta Description (Optional):</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description">{{ $data->meta_description ?? '' }}</textarea>
                            @error('meta_description')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords" class="form-label">Meta Keywords (Optional):</label>
                            <textarea class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords">{{ $data->meta_keywords ?? '' }}</textarea>
                            @error('meta_keywords')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="category_id" class="form-label">Category:</label>
                            <select class="form-select select2" name="category_id" id="category_id">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $data->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="delivery_zone_ids" class="form-label">Delivery Zones:</label>
                            <select class="form-control select2" name="delivery_zone_ids[]" id="delivery_zone_ids" multiple>
                                @foreach($deliveryZones as $zone)
                                    <option value="{{ $zone->id }}"
                                        {{ (collect(old('delivery_zone_ids', $data->deliveryZones->pluck('id')->toArray()))->contains($zone->id)) ? 'selected' : '' }}>
                                        {{ $zone->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('delivery_zone_ids')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="name" class="form-label">Product Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   name="name" placeholder="sweet name" id="name" maxlength="100" value="{{ $data->name ?? ' ' }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image" class="form-label">Product Image(500*500px):</label>
                            <input type="file" class="form-control dropify @error('image') is-invalid @enderror"
                                   name="image" placeholder="sweet name" id="image" value="{{ $data->image ?? ' ' }}">
                            @if($data->image)
                            <img class="img-fluid rounded-1 my-1" height="80px" width="80px" src="{{ asset($data->image) }}" alt="{{ $data->name ? $data->image : 'No Image' }}">
                            @endif
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
                                        <option value="quantity" {{ $data->pricing_type == 'quantity' ? 'selected' : '' }}>Quantity Based</option>
                                        <option value="weight" {{ $data->pricing_type == 'weight' ? 'selected' : '' }}>Weight Based</option>
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
                                            @if($data->variants && count($data->variants) > 0)
                                                @foreach($data->variants as $index => $variant)
                                                    <tr>
                                                        <td><input type="number" name="variant_quantity[]" class="form-control" value="{{ $variant->quantity }}" placeholder="e.g. 500"></td>
                                                        <td>
                                                            <select name="variant_unit_type[]" class="form-select">
                                                                <option value="gm" {{ $variant->unit == 'gm' ? 'selected' : '' }}>Gram (gm)</option>
                                                                <option value="pc" {{ $variant->unit == 'pc' ? 'selected' : '' }}>Piece (pc)</option>
                                                            </select>
                                                        </td>
                                                        <td><input type="number" name="variant_price[]" class="form-control" value="{{ $variant->price }}" placeholder="0.00"></td>
                                                        <td><input type="number" name="variant_discount_price[]" class="form-control" value="{{ $variant->sale_price }}" placeholder="0.00"></td>
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
                            <textarea class="form-control @error('description') is-invalid @enderror" id="summernote" name="description">{{ $data->description ?? ' ' }}</textarea>
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
