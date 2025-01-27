@extends('backend.app')

@section('title', 'Order')

@push('styles')
    <style>
        @media print {
            #invoiceFooter {
                visibility: hidden;
            }
        }
    </style>
@endpush

@section('content')
    @php
        $systemSetting = App\Models\SystemSetting::first();
    @endphp

    <!-- ROW-1 OPEN -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-start">
                            <h3 class="card-title mb-0">#INVOICE-{{ $data->tracking_id }}</h3>
                        </div>
                        <div class="float-end">
                            <h3 class="card-title">Date & Time: {{ $data->created_at->setTimezone('Asia/Dhaka')->format('M d, Y, h:ia') ?? '' }}</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12 mb-3">
                            <p class="h3">Invoice Form: Food Junction</p>
                            <img src="{{ asset($systemSetting->logo ?? 'frontend/images/default/food_junction.png') }}"
                                 class="header-brand-img desktop-logo" alt="logo">
                            <p class="pt-2">Uttara, Dhaka</p>
                            <p class="">https://www.foodjunctiondhaka.com</p>
                        </div>
                        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">
                            <p class="h3">Invoice To:</p>
                            <address>
                                {{ $data->address }}
                            </address>
                        </div>
                    </div>
                    <div class="table-responsive push">
                        <table class="table table-bordered table-hover mb-0 text-nowrap border-bottom">
                            <thead>
                            <tr>
                                <th class="text-center">SL</th>
                                <th>Product Name</th>
                                <th class="text-center">Price</th>
                                <th class="text-end">Weight</th>
                                <th class="text-end">Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_data as $product)
                                    <?php
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
                                    <td class="text-center">{{ $product->product->price }} (<span><del>{{ $product->product->discount_price }}Tk</del></span>)</td>
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
                </div>
                <div class="card-footer text-end" id="invoiceFooter">
                    <a href="{{ route('orders.show', $data->id) }}" class="btn btn-danger me-2">Back</a>
                    <button type="button" class="btn btn-info mb-1" onclick="javascript:window.print();"><i class="si si-printer"></i> Print Invoice</button>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- ROW-1 CLOSED -->

@endsection

@push('scripts')
    <script>

    </script>
@endpush
