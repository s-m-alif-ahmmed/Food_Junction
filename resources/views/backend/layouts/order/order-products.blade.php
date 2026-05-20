@extends('backend.app')

@section('title', 'Order')

@php
    if (!function_exists('englishToBengali')) {
        function englishToBengali($englishString) {
            $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $bengaliNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            return strtr($englishString, array_combine($englishNumbers, $bengaliNumbers));
        }
    }

    if (!function_exists('banglaToEnglish')) {
        function banglaToEnglish($bengaliString) {
            $englishNumbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
            $bengaliNumbers = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
            return strtr($bengaliString, array_combine($bengaliNumbers, $englishNumbers));
        }
    }
@endphp

@section('content')

    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Order Product's List -> #{{ $data->tracking_id }}</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
                <li class="breadcrumb-item"><a href="{{ route('orders.show', $data->id) }}">Order</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Product's</li>
            </ol>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card box-shadow-0">
                <div class="card-body">

                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover mb-0 text-nowrap border-bottom">
                            <thead>
                                <tr>
                                    <th class="text-center">SL</th>
                                    <th>Product Name</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-end">Weight/Quantity</th>
                                    <th class="text-end">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach($order_data as $product)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="font-w600 mb-1">{{ $product->product_name }}</p>
                                    </td>
                                    <td class="text-center">
                                        {{ englishToBengali(floatval($product->unit_price)) }} Tk
                                        @if($product->discount_amount > 0)
                                            (<span><del>{{ englishToBengali(floatval($product->original_price)) }} Tk</del></span>)
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @if(($product->unit_type === 'gram' || $product->unit_type === 'kg') && $product->unit_value)
                                            @php
                                                $total_weight = $product->unit_value * $product->quantity;
                                            @endphp
                                            {{ $total_weight < 1000 ? englishToBengali($total_weight) . ' গ্রাম' : englishToBengali($total_weight / 1000) . ' কেজি' }}
                                        @else
                                            {{ englishToBengali($product->quantity) }} pcs
                                        @endif
                                    </td>
                                    <td class="text-end">{{ englishToBengali(floatval($product->total_price)) }} Tk</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-end">Sub Total</td>
                                <td class="text-end">{{ englishToBengali(floatval($data->subtotal)) }} Tk</td>
                            </tr>
                            @if($data->offer_discount > 0)
                                <tr>
                                    <td colspan="4" class="text-end">Offer Discount</td>
                                    <td class="text-end">- {{ englishToBengali(floatval($data->offer_discount)) }} Tk</td>
                                </tr>
                            @endif
                            @if($data->coupon_discount > 0)
                                <tr>
                                    <td colspan="4" class="text-end">
                                        Coupon Discount
                                        @if($data->coupon_code)
                                            ({{ $data->coupon_code }})
                                        @endif
                                    </td>
                                    <td class="text-end">- {{ englishToBengali(floatval($data->coupon_discount)) }} Tk</td>
                                </tr>
                            @endif
                            @if($data->total_discount > 0 && !($data->offer_discount > 0 || $data->coupon_discount > 0))
                                <tr>
                                    <td colspan="4" class="text-end">Discount</td>
                                    <td class="text-end">- {{ englishToBengali(floatval($data->total_discount)) }} Tk</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="4" class="text-end">Delivery Charge</td>
                                <td class="text-end">
                                    @if($data->is_free_delivery || $data->delivery_fee == 0)
                                        Free
                                    @else
                                        {{ englishToBengali(floatval($data->delivery_fee)) }} Tk
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end">Total</td>
                                <td class="text-end">{{ englishToBengali(floatval($data->final_total)) }} Tk</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="page_title" class="form-label">Action:</label>
                        <a href="{{ route('orders.show', $data->id) }}" class="btn btn-danger me-2">Back</a>
                        <a class="btn btn-primary" href="{{ route('orders.invoice', $data->id) }}">Invoice</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
