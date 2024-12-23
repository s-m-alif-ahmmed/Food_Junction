@extends('backend.app')

@section('title', 'Sweet Detail')

@section('content')
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Sweet Form</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sweet</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}


    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Created At</label>
                        <div class="col-md-9">
                            <input class="form-control" name="created_at" value="{{ $data->created_at->format('d M, Y, h:ia') }}" placeholder="" type="text" disabled readonly  />
                        </div>
                        @error('code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Code</label>
                        <div class="col-md-9">
                            <input class="form-control" name="code" value="{{ $data->code }}" placeholder="Enter coupon code" type="text" disabled readonly  />
                        </div>
                        @error('code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Name</label>
                        <div class="col-md-9">
                            <input class="form-control" name="name" value="{{ $data->name }}" placeholder="Enter coupon code name" type="text" disabled readonly >
                        </div>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Max Uses</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="max_uses" value="{{ $data->max_uses }}" placeholder="Max Uses" disabled readonly >
                        </div>
                        @error('max_uses')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Max Uses User</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="max_uses_user" value="{{ $data->max_uses_user }}" placeholder="Max Uses User" disabled readonly >
                        </div>
                        @error('max_uses_user')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label for="type" class="col-md-3 form-label">Type</label>
                        <div class="col-md-9">
                            <select name="type" id="type" class="form-control" disabled readonly  >
                                <option value="percent" {{ old('type', $data->type) == 'percent' ? 'selected' : '' }}>Percent</option>
                                <option value="fixed" {{ old('type', $data->type) == 'fixed' ? 'selected' : '' }}>Fixed</option>
                            </select>
                        </div>
                        @error('type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Discount Amount</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="discount_amount" value="{{ $data->discount_amount }}" placeholder="Enter discount amount" disabled readonly />
                        </div>
                        @error('discount_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Minimum Amount</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="min_amount" value="{{ $data->min_amount }}" placeholder="Enter minimum amount"  disabled readonly />
                        </div>
                        @error('min_amount')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label for="status" class="col-md-3 form-label">Coupon Status</label>
                        <div class="col-md-9">
                            <select name="status" id="status" class="form-control" disabled readonly >
                                <option value="active" {{ old('status', $data->status) == 'active' ? 'selected' : '' }} >Active</option>
                                <option value="inActive" {{ old('status', $data->status) == 'inactive' ? 'selected' : '' }} >Inactive</option>
                            </select>
                        </div>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label for="starts_at" class="col-md-3 form-label">Starts At</label>
                        <div class="col-md-9">
                            <input type="datetime-local" class="form-control" name="starts_at" id="starts_at" value="{{ $data->starts_at }}" step="1" disabled readonly >
                        </div>
                        @error('starts_at')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row mb-4">
                        <label for="expires_at" class="col-md-3 form-label">Expires At</label>
                        <div class="col-md-9">
                            <input type="datetime-local" class="form-control" name="expires_at" id="expires_at" value="{{ $data->expires_at }}" step="1" disabled readonly>
                        </div>
                        @error('expires_at')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <a href="{{ route('sweets.index') }}" class="btn btn-danger me-2">Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
