@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="{{ $offer->description ?? 'Special Offer Products' }}">
    <meta name="keywords" content="Food Junction, Offers, {{ $offer->name }}">
@endsection

@section('title')
    {{ $offer->name }} | Food Junction
@endsection

@section('content')

    @include('frontend.includes.top-nav-button')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">{{ $offer->name }}</p>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="row pt-3 pb-5">
                @forelse($products as $product)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-6 special-sweet-card mb-4">
                        <div class="card border-0 custom-shadow h-100">
                            <div class="sweet-image">
                                <img src="{{ asset($product->image ?? '/frontend/images/section/home/harivanga-mishti-500x500.jpg') }}" class="card-img-top" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body border-0 mb-3 d-flex flex-column">
                                <h5 class="fsw-bold">{{ $product->name }}</h5>
                                @php
                                    $minVariant = $product->variants
                                         ->where('status', 'Active')
                                         ->sortBy(function($variant) {
                                             return $variant->sale_price ?? $variant->price;
                                         })
                                         ->first();

                                     $price = $minVariant?->price ?? 0;
                                     $discount = $minVariant?->sale_price;
                                     $quantity = $minVariant?->quantity;
                                     $unit = $minVariant?->unit;
                                     $variantType = $minVariant?->variant_type;
                                @endphp
                                <div class="d-flex justify-content-between">
                                    <p class="fsw-semibold">
                                        {{ number_format($discount ?? $price, 0) }} টাকা
                                        @if($discount)
                                            (
                                            <span class="text-danger">
                                                <del>{{ number_format($price, 0) }} টাকা</del>
                                            </span>
                                            )
                                        @endif
                                    </p>

                                    <p class="fsw-semibold me-1">
                                        {{ $quantity }} {{ $unit }}
                                        ({{ strtoupper($variantType) }})
                                    </p>
                                </div>
                                <a href="{{ route('product.detail', $product->product_slug) }}" class="order-now-btn w-auto fw-bold">Order Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <h4 class="text-muted">No products found for this offer.</h4>
                        <a href="{{ route('home') }}" class="btn background-gradient text-white mt-3">Back to Home</a>
                    </div>
                @endforelse

                <div class="col-12 mt-4 d-flex justify-content-center">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Handle variant selection change
        $('.variant-select').change(function() {
            let selected = $(this).find(':selected');
            let price = selected.data('price');
            let discount = selected.data('discount');
            let unit = selected.val() || '';
            let productId = $(this).data('product-id');

            let priceHtml = '';
            if (discount) {
                priceHtml = `${unit} - ${discount} টাকা ( <span class="text-danger"><del>${price} টাকা</del></span> )`;
            } else {
                priceHtml = `${unit} - ${price} টাকা`;
            }
            $(`.sweet-price-${productId}`).html(priceHtml);
        });

        // Handle the form submission
        $('.add-to-cart-form').on('submit', function (e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: formData,
                success: function (response) {
                    if (response.success) {
                        showSuccessToast(response['t-success'] || 'Item successfully added to cart!');
                        // Optional: trigger mini-cart update if there's an event
                    } else {
                        showErrorToast(response['t-error'] || 'Something went wrong. Please try again.');
                    }
                },
                error: function (xhr) {
                    showErrorToast('An error occurred while adding the item to the cart.');
                }
            });
        });
    });
</script>
@endpush
