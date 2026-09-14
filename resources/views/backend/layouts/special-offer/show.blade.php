@extends('backend.app')

@section('title', 'Special Offer Details')

@push('styles')
<style>
    .offer-preview-card {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }
    .info-label {
        font-weight: 700;
        color: #475569;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 4px;
    }
    .info-value {
        font-size: 1.05rem;
        color: #1e293b;
        font-weight: 600;
    }
    .section-title-divider {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        border-bottom: 2px solid #f1f5f9;
        padding-bottom: 8px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>
@endpush

@section('content')
    @php
        $publicUrl = url('special-offer/' . ($data->slug ?? 'baklava-offer'));
    @endphp

    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">{{ $data->name ?? $data->hero_title }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Shop Management</a></li>
                <li class="breadcrumb-item"><a href="{{ route('special-offers.index') }}">Special Offer Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </div>
        <div class="ms-auto pageheader-btn d-flex gap-2">
            <button type="button" onclick="copyLandingLink('{{ $publicUrl }}')" class="btn btn-warning text-dark">
                <i class="fe fe-copy me-1"></i> Copy Public URL
            </button>
            <a href="{{ $publicUrl }}" target="_blank" class="btn btn-success">
                <i class="fe fe-external-link me-1"></i> Open Live Landing Page
            </a>
            <a href="{{ route('special-offers.edit', $data->id) }}" class="btn btn-primary">
                <i class="fe fe-edit me-1"></i> Edit Offer
            </a>
            <a href="{{ route('special-offers.index') }}" class="btn btn-outline-secondary">
                <i class="fe fe-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row">
        <!-- Main Details -->
        <div class="col-lg-8">
            <!-- Hero & Pricing Overview -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title fw-bold mb-0">Offer Details & Copywriting</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <div class="info-label">Offer Headline (Bangla)</div>
                            <div class="info-value text-danger fs-18">{{ $data->offer_headline ?? '--' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Offer Subtext</div>
                            <div class="info-value">{{ $data->offer_subtext ?? '--' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Hero Title (English)</div>
                            <div class="info-value">{{ $data->hero_title ?? '--' }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">Top Badge Text</div>
                            <div class="info-value"><span class="badge bg-warning text-dark">{{ $data->badge_text ?? '--' }}</span></div>
                        </div>
                    </div>

                    <div class="section-title-divider mt-4">
                        <i class="fa fa-lemon-o text-primary"></i> 5 Ingredients
                    </div>
                    <div class="row g-2 mb-3">
                        @foreach($data->ingredients ?? [] as $ing)
                            <div class="col-auto">
                                <div class="d-flex align-items-center gap-2 p-2 bg-light border rounded">
                                    <img src="{{ asset($ing['image'] ?? 'frontend/images/landing/baklava/ing_ghee.jpg') }}" style="width: 32px; height: 32px; object-fit: cover; border-radius: 50%;">
                                    <span class="fw-semibold fs-13">{{ $ing['name'] ?? '' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="section-title-divider mt-4">
                        <i class="fa fa-shield text-info"></i> Trust Badges
                    </div>
                    <div class="row g-2 mb-3">
                        @foreach($data->trust_badges ?? [] as $badge)
                            <div class="col-md-6">
                                <div class="p-2 bg-light border rounded d-flex align-items-center gap-2">
                                    <i class="fa {{ $badge['icon'] ?? 'fa-check' }} text-primary fs-18"></i>
                                    <div>
                                        <div class="fw-bold fs-13">{{ $badge['title'] ?? '' }}</div>
                                        <small class="text-muted">{{ $badge['subtitle'] ?? '' }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="section-title-divider mt-4">
                        <i class="fa fa-book text-danger"></i> Story & Guarantees
                    </div>
                    <p class="text-secondary mb-2">{{ $data->why_desc_1 ?? '' }}</p>
                    <p class="text-secondary mb-3">{{ $data->why_desc_2 ?? '' }}</p>

                    <div class="section-title-divider mt-4">
                        <i class="fa fa-comments text-success"></i> Customer Review Screenshots ({{ count($data->reviews ?? []) }} items)
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($data->reviews ?? [] as $r)
                            <a href="{{ asset($r) }}" target="_blank">
                                <img src="{{ asset($r) }}" style="width: 70px; height: 110px; object-fit: cover; border-radius: 6px; border: 1px solid #dee2e6;">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side Widgets -->
        <div class="col-lg-4">
            <!-- Pricing & Status Widget -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title fw-bold mb-0">Pricing & Status</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-muted">Offer Price</span>
                        <span class="fw-bold fs-20 text-danger">৳ {{ number_format($data->offer_price, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-muted">Regular Price</span>
                        <span class="fw-bold text-muted text-decoration-line-through">৳ {{ number_format($data->regular_price, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-muted">Save Amount</span>
                        <span class="badge bg-success">{{ $data->save_amount ?? 'Discount' }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-muted">Inside Dhaka Delivery</span>
                        <span class="fw-semibold">৳ {{ number_format($data->inside_dhaka_delivery_fee, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-muted">Outside Dhaka Delivery</span>
                        <span class="fw-semibold">৳ {{ number_format($data->outside_dhaka_delivery_fee, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <span class="text-muted">WhatsApp Support</span>
                        <span class="fw-semibold text-primary"><i class="fa fa-whatsapp me-1"></i>+{{ $data->whatsapp_number }}</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2">
                        <span class="text-muted">Status</span>
                        <span class="badge {{ $data->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($data->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Linked Product Card -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title fw-bold mb-0">Linked Shop Product</h5>
                </div>
                <div class="card-body">
                    @if($data->product)
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ !empty($data->product->image) ? asset($data->product->image) : asset('frontend/images/default/food_junction.png') }}"
                                style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0;">
                            <div>
                                <h6 class="fw-bold mb-1">{{ $data->product->name }}</h6>
                                <p class="text-muted mb-0 small">{{ $data->product->category->name ?? 'Category' }}</p>
                                @if($data->variant)
                                    <span class="badge bg-info text-white">Variant: {{ $data->variant->name }}</span>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="text-muted text-center py-3">
                            <i class="fe fe-alert-circle me-1"></i> No specific product linked. Default fallback is applied.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Hero Image Preview -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title fw-bold mb-0">Hero Platter Image</h5>
                </div>
                <div class="card-body text-center p-3">
                    <img src="{{ !empty($data->hero_image) ? asset($data->hero_image) : asset('frontend/images/landing/baklava/hero_tray.png') }}"
                        class="img-fluid rounded border shadow-sm" style="max-height: 220px; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function copyLandingLink(url) {
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(url).then(function() {
                toastr.success('Landing page URL copied to clipboard: ' + url);
            });
        } else {
            let textArea = document.createElement("textarea");
            textArea.value = url;
            textArea.style.position = "fixed";
            textArea.style.left = "-999999px";
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            toastr.success('Landing page URL copied to clipboard: ' + url);
        }
    }
</script>
@endpush
