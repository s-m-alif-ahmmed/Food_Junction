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
                                    <?php
                                    $price = banglaToEnglish($product->product->price);
                                    $product_type = $product->product->product_type;

                                    if ($product_type == 'Sweet'){
                                        $gm = $price / 1000;
                                        $total = $gm * $product->weight;
                                    }elseif ($product_type == 'Product'){
                                        $total = $price * $product->quantity;
                                    }

                                    ?>
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <p class="font-w600 mb-1">{{ $product->product->name }}</p>
                                    </td>
                                    <td class="text-center">{{ $product->product->price }}Tk (<span><del>{{ $product->product->discount_price }}Tk</del></span>)</td>
                                    <td class="text-end">
                                        @if($product->weight)
                                            {{ $product->weight < 1000 ? englishToBengali($product->weight) . ' গ্রাম' : englishToBengali($product->weight / 1000) . ' কেজি' }}
                                        @elseif($product->quantity)
                                            {{ $product->quantity }} pcs
                                        @endif
                                    </td>
                                    <td class="text-end">{{ englishToBengali($total) ?? '0' }}Tk</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4" class="text-end">Sub Total</td>
                                <td class="text-end">{{ englishToBengali($data->order_total) }} Tk</td>
                            </tr>
                            @if($data->login_discount)
                                <tr>
                                    <td colspan="4" class="text-end">Login Discount</td>
                                    <td class="text-end">- {{ englishToBengali($data->login_discount) }} Tk</td>
                                </tr>
                            @endif
                            <tr>
                                <td colspan="4" class="text-end">Delivery Charge</td>
                                <td class="text-end">{{ englishToBengali( $data->delivery_fee.'Tk' ) }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-end">Total</td>
                                <td class="text-end">{{ englishToBengali($data->estimate_total) }} Tk</td>
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
