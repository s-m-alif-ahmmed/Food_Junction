@extends('backend.app')

@section('title', 'Edit Special Offer Page')

@push('styles')
<style>
    .cms-tab-nav {
        border-bottom: 2px solid #dee2e6;
        gap: 6px;
        background: transparent;
    }
    .cms-tab-nav .nav-item {
        margin-bottom: -2px;
    }
    .cms-tab-nav .nav-link,
    .cms-tab-nav .nav-link:visited {
        font-weight: 600;
        font-size: 0.95rem;
        color: #334155 !important;
        background-color: #f1f5f9 !important;
        padding: 12px 22px;
        border-radius: 8px 8px 0 0 !important;
        border: 1px solid #cbd5e1 !important;
        border-bottom: 2px solid #dee2e6 !important;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
    }
    .cms-tab-nav .nav-link:hover,
    .cms-tab-nav .nav-link:focus,
    .cms-tab-nav .nav-item .nav-link:hover,
    .cms-tab-nav .nav-item .nav-link:focus {
        color: #0d6efd !important;
        background-color: #e0e7ff !important;
        border-color: #93c5fd #93c5fd transparent !important;
        border-bottom: 2px solid transparent !important;
    }
    .cms-tab-nav .nav-link.active,
    .cms-tab-nav .nav-link.active:hover,
    .cms-tab-nav .nav-link.active:focus,
    .cms-tab-nav .nav-item .nav-link.active,
    .cms-tab-nav .nav-item .nav-link.active:hover {
        color: #0d6efd !important;
        background-color: #ffffff !important;
        border-color: #dee2e6 #dee2e6 #ffffff !important;
        border-top: 3px solid #0d6efd !important;
        border-bottom: 2px solid #ffffff !important;
        box-shadow: 0 -3px 8px rgba(0, 0, 0, 0.05);
    }
    .cms-tab-nav .nav-link i {
        margin-right: 8px;
        font-size: 1.05rem;
        color: #64748b;
        transition: color 0.2s ease;
    }
    .cms-tab-nav .nav-link:hover i {
        color: #0d6efd !important;
    }
    .cms-tab-nav .nav-link.active i {
        color: #0d6efd !important;
    }
    .section-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2b3445;
        margin-bottom: 1.25rem;
        padding-bottom: 0.6rem;
        border-bottom: 2px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .review-thumb-card {
        position: relative;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        transition: transform 0.2s ease;
    }
    .review-thumb-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 14px rgba(0,0,0,0.1);
    }
    .review-thumb-img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        display: block;
    }
    .review-delete-btn {
        position: absolute;
        top: 6px;
        right: 6px;
        background: rgba(220, 53, 69, 0.9);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 13px;
        transition: background 0.2s;
    }
    .review-delete-btn:hover {
        background: #dc3545;
    }
    .ingredient-edit-box, .trust-badge-edit-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 14px;
        margin-bottom: 12px;
    }
    .ingredient-edit-box .dropify-wrapper {
        border-radius: 6px;
        background-color: #fff;
    }
    .ingredient-edit-box .dropify-wrapper .dropify-message p {
        font-size: 12px;
        line-height: 1.3;
    }
    @media (min-width: 992px) {
        .col-lg-2-4 {
            flex: 0 0 auto;
            width: 20%;
        }
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
            <h1 class="page-title">Edit Special Offer: {{ $data->name ?? $data->hero_title }}</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Shop Management</a></li>
                <li class="breadcrumb-item"><a href="{{ route('special-offers.index') }}">Special Offer Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
        <div class="ms-auto pageheader-btn d-flex gap-2">
            <button type="button" onclick="copyLandingLink('{{ $publicUrl }}')" class="btn btn-outline-warning">
                <i class="fe fe-copy me-1"></i> Copy URL
            </button>
            <a href="{{ $publicUrl }}" target="_blank" class="btn btn-outline-success">
                <i class="fe fe-external-link me-1"></i> Preview Live Page
            </a>
            <a href="{{ route('special-offers.index') }}" class="btn btn-outline-secondary">
                <i class="fe fe-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
    {{-- PAGE-HEADER --}}

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <ul class="nav nav-tabs cms-tab-nav" id="baklavaTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="hero-tab" data-bs-toggle="tab" data-bs-target="#hero-pane" type="button" role="tab">
                                <i class="fa fa-home"></i> 1. Hero & Offer
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="showcase-tab" data-bs-toggle="tab" data-bs-target="#showcase-pane" type="button" role="tab">
                                <i class="fa fa-lemon-o"></i> 2. Showcase & Ingredients
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-pane" type="button" role="tab">
                                <i class="fa fa-comments"></i> 3. Reviews & Badges
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="story-tab" data-bs-toggle="tab" data-bs-target="#story-pane" type="button" role="tab">
                                <i class="fa fa-book"></i> 4. Story & Guarantees
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order-pane" type="button" role="tab">
                                <i class="fa fa-shopping-cart"></i> 5. Order & Product Link
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('special-offers.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="tab-content" id="baklavaTabContent">

                            <!-- ==========================================
                                 1. HERO & OFFER TAB
                                 ========================================== -->
                            <div class="tab-pane fade show active" id="hero-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-star text-warning"></i> General Identity, Hero Section & Pricing
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Offer Page Name (Internal Title): <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                id="offer_name" name="name" value="{{ old('name', $data->name ?? $data->hero_title) }}"
                                                placeholder="e.g. Baklava Special Dhamaaka Offer" required>
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">URL Slug (e.g. yoursite.com/special-offer/<b>slug</b>):</label>
                                            <div class="input-group">
                                                <span class="input-group-text text-muted">/special-offer/</span>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                                    id="offer_slug" name="slug" value="{{ old('slug', $data->slug) }}"
                                                    placeholder="baklava-offer">
                                            </div>
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Top Badge Text:</label>
                                            <input type="text" class="form-control @error('badge_text') is-invalid @enderror"
                                                name="badge_text" value="{{ old('badge_text', $data->badge_text) }}"
                                                placeholder="e.g. ★ স্পেশাল ধামাকা অফার — সীমিত সময়ের জন্য ★">
                                            @error('badge_text')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Hero English Title (H1):</label>
                                            <input type="text" class="form-control @error('hero_title') is-invalid @enderror"
                                                name="hero_title" value="{{ old('hero_title', $data->hero_title) }}"
                                                placeholder="e.g. Premium Turkish Dessert, now at your home.">
                                            @error('hero_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Main Offer Headline (Bangla):</label>
                                            <input type="text" class="form-control @error('offer_headline') is-invalid @enderror"
                                                name="offer_headline" value="{{ old('offer_headline', $data->offer_headline) }}"
                                                placeholder="e.g. ২০ পিস বাকলাভার সাথে হাফকেজি পাবনার পেরা সন্দেশ ফ্রী!">
                                            @error('offer_headline')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Offer Subtext:</label>
                                            <input type="text" class="form-control @error('offer_subtext') is-invalid @enderror"
                                                name="offer_subtext" value="{{ old('offer_subtext', $data->offer_subtext) }}"
                                                placeholder="e.g. তুরস্কের অথেন্টিক এবং গ্রাম বাংলার ঐতিহ্যবাহী স্বাদ এখন একসাথে">
                                            @error('offer_subtext')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Regular Price (৳): <span class="text-danger">*</span></label>
                                                    <input type="number" step="any" class="form-control @error('regular_price') is-invalid @enderror"
                                                        name="regular_price" value="{{ old('regular_price', $data->regular_price) }}" required>
                                                    @error('regular_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Offer Price (৳): <span class="text-danger">*</span></label>
                                                    <input type="number" step="any" class="form-control @error('offer_price') is-invalid @enderror"
                                                        name="offer_price" value="{{ old('offer_price', $data->offer_price) }}" required>
                                                    @error('offer_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Save Amount Badge:</label>
                                                    <input type="text" class="form-control @error('save_amount') is-invalid @enderror"
                                                        name="save_amount" value="{{ old('save_amount', $data->save_amount) }}"
                                                        placeholder="e.g. ৫০০ টাকা ছাড়">
                                                    @error('save_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Promo Video Direct URL:</label>
                                            <input type="text" class="form-control @error('video_url') is-invalid @enderror"
                                                name="video_url" value="{{ old('video_url', $data->video_url) }}"
                                                placeholder="https://...">
                                            @error('video_url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Or Upload Video File (Max 50MB):</label>
                                            <input type="file" class="dropify @error('video_file') is-invalid @enderror"
                                                name="video_file" id="video_file" accept="video/mp4,video/quicktime,video/ogg"
                                                data-height="120">
                                            @error('video_file')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Hero Platter / Tray Image:</label>
                                            <input type="file" class="dropify @error('hero_image') is-invalid @enderror"
                                                name="hero_image" id="hero_image"
                                                data-height="200"
                                                data-default-file="{{ !empty($data->hero_image) ? asset($data->hero_image) : asset('frontend/images/landing/baklava/hero_tray.png') }}">
                                            @error('hero_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <small class="text-muted">Recommended: High quality transparent platter photo or box product photo.</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ==========================================
                                 2. SHOWCASE & INGREDIENTS TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="showcase-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-image text-primary"></i> Showcase Photo & 5 Natural Ingredients
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Showcase / Gift Box Image:</label>
                                            <input type="file" class="dropify @error('collage_image') is-invalid @enderror"
                                                name="collage_image" id="collage_image"
                                                data-height="200"
                                                data-default-file="{{ !empty($data->collage_image) ? asset($data->collage_image) : asset('frontend/images/landing/baklava/collage_box.jpg') }}">
                                            @error('collage_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Ingredients Section Title:</label>
                                            <input type="text" class="form-control" name="ingredient_title"
                                                value="{{ old('ingredient_title', $data->ingredient_title) }}" placeholder="INGREDIENTS">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Ingredients Section Subtitle:</label>
                                            <input type="text" class="form-control" name="ingredient_subtitle"
                                                value="{{ old('ingredient_subtitle', $data->ingredient_subtitle) }}"
                                                placeholder="আমাদের প্রতিটি বাকলাভা প্রস্তুত হয় সেরা ও প্রাকৃতিক উপাদান দিয়ে">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3 text-dark">5 Premium Ingredients:</h6>
                                <div class="row">
                                    @php
                                        $ingredients = $data->ingredients ?? \App\Models\BaklavaOffer::getDefaultIngredients();
                                    @endphp

                                    @foreach($ingredients as $idx => $ing)
                                        <div class="col-md-4 col-lg-2-4 mb-3">
                                            <div class="ingredient-edit-box">
                                                <div class="form-group mb-2">
                                                    <label class="form-label small fw-bold">Item #{{ $idx + 1 }} Photo:</label>
                                                    <input type="file" class="dropify"
                                                        name="ingredient_images[{{ $idx }}]"
                                                        accept="image/*"
                                                        data-height="110"
                                                        data-default-file="{{ !empty($ing['image']) ? asset($ing['image']) : '' }}">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label small fw-bold">Item #{{ $idx + 1 }} Name:</label>
                                                    <input type="text" class="form-control form-control-sm text-center"
                                                        name="ingredient_names[{{ $idx }}]"
                                                        value="{{ $ing['name'] ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- ==========================================
                                 3. REVIEWS & BADGES TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="reviews-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-comments text-success"></i> Customer Reviews & Trust Badges
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Reviews Section Title:</label>
                                            <input type="text" class="form-control" name="reviews_title"
                                                value="{{ old('reviews_title', $data->reviews_title) }}"
                                                placeholder="Trusted by 5000+ Happy Customers">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Reviews Section Subtitle:</label>
                                            <input type="text" class="form-control" name="reviews_subtitle"
                                                value="{{ old('reviews_subtitle', $data->reviews_subtitle) }}"
                                                placeholder="আমাদের নিয়মিত গ্রাহকদের পাঠানো বাস্তব রিভিউ স্ক্রিনশটসমূহ">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4 p-3 bg-light border">
                                    <label class="form-label fw-bold">
                                        <i class="fa fa-cloud-upload me-1 text-primary"></i> Upload New Customer Review Screenshots (Multiple):
                                    </label>
                                    <input type="file" class="dropify" name="new_review_images[]" multiple accept="image/*" data-height="120">
                                    <small class="text-muted">You can select multiple JPEG/PNG/WebP review screenshots to add to the gallery.</small>
                                </div>

                                <h6 class="fw-bold mb-3 text-dark">
                                    Current Review Screenshots ({{ count($data->reviews ?? []) }} items):
                                </h6>

                                <div class="row g-3 mb-4" id="reviews-grid">
                                    @forelse($data->reviews ?? [] as $revIndex => $revPath)
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2" id="review-card-{{ $revIndex }}">
                                            <div class="review-thumb-card">
                                                <img src="{{ asset($revPath) }}" alt="Review #{{ $revIndex + 1 }}" class="review-thumb-img">
                                                <button type="button" class="review-delete-btn" title="Delete this review"
                                                    onclick="confirmDeleteReview({{ $revIndex }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                                <div class="p-1 text-center small text-muted">
                                                    Review #{{ $revIndex + 1 }}
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <div class="col-12 text-center text-muted py-3">
                                            No review screenshots found. Upload above to add.
                                        </div>
                                    @endforelse
                                </div>

                                <hr class="my-4">

                                <div class="section-card-title">
                                    <i class="fa fa-shield text-info"></i> 4 Trust Badges
                                </div>

                                <div class="row">
                                    @php
                                        $trustBadges = $data->trust_badges ?? \App\Models\BaklavaOffer::getDefaultTrustBadges();
                                    @endphp

                                    @foreach($trustBadges as $bIdx => $badge)
                                        <div class="col-md-6 mb-3">
                                            <div class="trust-badge-edit-box">
                                                <h6 class="fw-bold text-dark mb-2">Badge #{{ $bIdx + 1 }}</h6>
                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Title:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="trust_badge_titles[{{ $bIdx }}]"
                                                            value="{{ $badge['title'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Subtitle (Bangla):</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="trust_badge_subtitles[{{ $bIdx }}]"
                                                            value="{{ $badge['subtitle'] ?? '' }}">
                                                    </div>
                                                    <div class="col-12 mt-2">
                                                        <label class="form-label small">FontAwesome Icon Class:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="trust_badge_icons[{{ $bIdx }}]"
                                                            value="{{ $badge['icon'] ?? 'fa-check' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- ==========================================
                                 4. STORY & GUARANTEES TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="story-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-heart text-danger"></i> Why We Made This Story & Delivery Guarantees
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Story Section Title:</label>
                                            <input type="text" class="form-control" name="why_title"
                                                value="{{ old('why_title', $data->why_title) }}" placeholder="Why We Made This?">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Story Section Subtitle:</label>
                                            <input type="text" class="form-control" name="why_subtitle"
                                                value="{{ old('why_subtitle', $data->why_subtitle) }}"
                                                placeholder="Food Junction এ আমরা বিশ্বাস করি প্রতিটি মিষ্টির সাথে জড়িয়ে থাকে ভালোবাসার গল্প">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Story Content Heading:</label>
                                            <input type="text" class="form-control" name="why_heading"
                                                value="{{ old('why_heading', $data->why_heading) }}"
                                                placeholder="Delivery All Over Bangladesh">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Story Description Paragraph 1 (English):</label>
                                            <textarea class="form-control" name="why_desc_1" rows="3">{{ old('why_desc_1', $data->why_desc_1) }}</textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Story Description Paragraph 2 (Bangla):</label>
                                            <textarea class="form-control" name="why_desc_2" rows="3">{{ old('why_desc_2', $data->why_desc_2) }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Story Platter Photo:</label>
                                            <input type="file" class="dropify @error('why_image') is-invalid @enderror"
                                                name="why_image" id="why_image"
                                                data-height="200"
                                                data-default-file="{{ !empty($data->why_image) ? asset($data->why_image) : asset('frontend/images/landing/baklava/why_platter.jpg') }}">
                                            @error('why_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="p-3 bg-light border mt-3">
                                            <h6 class="fw-bold mb-2">Delivery Guarantees (2 Columns):</h6>
                                            <div class="row g-2">
                                                <div class="col-12 mb-2">
                                                    <label class="form-label small fw-bold">Guarantee 1 Title:</label>
                                                    <input type="text" class="form-control form-control-sm" name="guarantee_1_title"
                                                        value="{{ old('guarantee_1_title', $data->guarantee_1_title) }}">
                                                </div>
                                                <div class="col-12 mb-3">
                                                    <label class="form-label small fw-bold">Guarantee 1 Subtext:</label>
                                                    <input type="text" class="form-control form-control-sm" name="guarantee_1_text"
                                                        value="{{ old('guarantee_1_text', $data->guarantee_1_text) }}">
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <label class="form-label small fw-bold">Guarantee 2 Title:</label>
                                                    <input type="text" class="form-control form-control-sm" name="guarantee_2_title"
                                                        value="{{ old('guarantee_2_title', $data->guarantee_2_title) }}">
                                                </div>
                                                <div class="col-12 mb-0">
                                                    <label class="form-label small fw-bold">Guarantee 2 Subtext:</label>
                                                    <input type="text" class="form-control form-control-sm" name="guarantee_2_text"
                                                        value="{{ old('guarantee_2_text', $data->guarantee_2_text) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ==========================================
                                 5. ORDER & DELIVERY TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="order-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-truck text-success"></i> Fast Order Checkout & Linked Product Setup
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Link to Shop Product (For Cart / Order checkout):</label>
                                            <select class="form-control form-select select2" name="product_id" id="product_id" onchange="loadProductVariants(this)">
                                                <option value="">-- Select Product (Optional) --</option>
                                                @foreach($products as $prod)
                                                    <option value="{{ $prod->id }}" {{ old('product_id', $data->product_id) == $prod->id ? 'selected' : '' }} data-variants='@json($prod->variants)'>
                                                        {{ $prod->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Product Variant:</label>
                                            <select class="form-control form-select" name="variant_id" id="variant_id">
                                                <option value="">-- Default / First Variant --</option>
                                                @if($data->product && $data->product->variants)
                                                    @foreach($data->product->variants as $v)
                                                        <option value="{{ $v->id }}" {{ old('variant_id', $data->variant_id) == $v->id ? 'selected' : '' }}>
                                                            {{ $v->name ?? 'Variant #' . $v->id }} (৳{{ $v->price ?? $v->sale_price }})
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Package Name / Title in Order Box:</label>
                                            <input type="text" class="form-control" name="package_title"
                                                value="{{ old('package_title', $data->package_title) }}"
                                                placeholder="২০ পিস টার্কিশ বাকলাভা + হাফকেজি পাবনার পেরা সন্দেশ (ফ্রী)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Package Subtitle / Note:</label>
                                            <input type="text" class="form-control" name="package_subtitle"
                                                value="{{ old('package_subtitle', $data->package_subtitle) }}"
                                                placeholder="সম্পূর্ণ প্রিমিয়াম গিফট বক্স প্যাকেজিং সহ">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Inside Dhaka Delivery Fee (৳): <span class="text-danger">*</span></label>
                                            <input type="number" step="any" class="form-control @error('inside_dhaka_delivery_fee') is-invalid @enderror"
                                                name="inside_dhaka_delivery_fee"
                                                value="{{ old('inside_dhaka_delivery_fee', $data->inside_dhaka_delivery_fee) }}" required>
                                            @error('inside_dhaka_delivery_fee')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Outside Dhaka Delivery Fee (৳): <span class="text-danger">*</span></label>
                                            <input type="number" step="any" class="form-control @error('outside_dhaka_delivery_fee') is-invalid @enderror"
                                                name="outside_dhaka_delivery_fee"
                                                value="{{ old('outside_dhaka_delivery_fee', $data->outside_dhaka_delivery_fee) }}" required>
                                            @error('outside_dhaka_delivery_fee')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">WhatsApp Support Number:</label>
                                            <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror"
                                                name="whatsapp_number"
                                                value="{{ old('whatsapp_number', $data->whatsapp_number) }}"
                                                placeholder="8801672756634">
                                            @error('whatsapp_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Page Status:</label>
                                            <select class="form-control form-select" name="status">
                                                <option value="active" {{ old('status', $data->status) == 'active' ? 'selected' : '' }}>Active (Publicly Visible)</option>
                                                <option value="inactive" {{ old('status', $data->status) == 'inactive' ? 'selected' : '' }}>Inactive / Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="mt-4 pt-3 border-top d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                                <i class="fe fe-save me-1"></i> Save Changes
                            </button>
                            <a href="{{ $publicUrl }}" target="_blank" class="btn btn-outline-success px-3 py-2">
                                <i class="fe fe-external-link me-1"></i> Preview Page
                            </a>
                            <a href="{{ route('special-offers.index') }}" class="btn btn-outline-secondary px-3 py-2">
                                <i class="fe fe-arrow-left me-1"></i> Back to List
                            </a>
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
        $('.dropify').dropify();
    });

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

    function loadProductVariants(select) {
        let selectedOption = select.options[select.selectedIndex];
        let variantsData = selectedOption.getAttribute('data-variants');
        let variantSelect = $('#variant_id');
        variantSelect.empty();
        variantSelect.append('<option value="">-- Default / First Variant --</option>');

        if (variantsData) {
            let variants = JSON.parse(variantsData);
            variants.forEach(function(v) {
                variantSelect.append(`<option value="${v.id}">${v.name || 'Variant #' + v.id} (৳${v.price || v.sale_price})</option>`);
            });
        }
    }

    function confirmDeleteReview(index) {
        Swal.fire({
            title: 'Delete Review Screenshot?',
            text: "Are you sure you want to remove this review screenshot?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                let deleteUrl = "{{ route('special-offers.delete-review', ['id' => $data->id, 'index' => '__INDEX__']) }}".replace('__INDEX__', index);

                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#review-card-' + index).fadeOut(300, function() {
                                $(this).remove();
                            });
                            toastr.success(response.message || 'Review screenshot deleted.');
                        } else {
                            toastr.error(response.message || 'Failed to delete review.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('Error occurred while deleting review.');
                    }
                });
            }
        });
    }
</script>
@endpush
