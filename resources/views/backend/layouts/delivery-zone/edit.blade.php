@extends('backend.app')

@section('title', 'Edit Delivery Zone')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit Delivery Zone</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('delivery-zones.index') }}">Delivery Zones</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER END --}}

    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title">Edit: {{ $data->name }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('delivery-zones.update', $data->id) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Zone Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                id="name" name="name" placeholder="e.g. Inside Dhaka"
                                value="{{ old('name', $data->name) }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="delivery_charge" class="form-label">Delivery Charge (৳): <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" min="0" class="form-control @error('delivery_charge') is-invalid @enderror"
                                id="delivery_charge" name="delivery_charge" placeholder="0.00"
                                value="{{ old('delivery_charge', $data->delivery_charge) }}">
                            @error('delivery_charge')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="status" class="form-label">Status: <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status">
                                <option value="active" {{ old('status', $data->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $data->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fe fe-save me-1"></i> Update Zone
                            </button>
                            <a href="{{ route('delivery-zones.index') }}" class="btn btn-danger ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
