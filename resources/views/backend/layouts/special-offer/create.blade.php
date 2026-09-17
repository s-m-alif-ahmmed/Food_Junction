@extends('backend.app')

@section('title', 'Create Special Offer Page')

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
        padding: 12px 18px;
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
    .ingredient-edit-box, .trust-badge-edit-box, .problem-card-edit-box, .comparison-edit-box, .step-edit-box, .testi-edit-box {
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
    {{-- PAGE-HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">Create Special Offer Landing Page</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Shop Management</a></li>
                <li class="breadcrumb-item"><a href="{{ route('special-offers.index') }}">Special Offer Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </div>
        <div class="ms-auto pageheader-btn">
            <a href="{{ route('special-offers.index') }}" class="btn btn-outline-secondary">
                <i class="fe fe-arrow-left me-1"></i> Back to List
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
                                <i class="fa fa-home"></i> 1. Hero & Pricing
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="problem-tab" data-bs-toggle="tab" data-bs-target="#problem-pane" type="button" role="tab">
                                <i class="fa fa-exclamation-triangle"></i> 2. Video & Problems
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="comparison-tab" data-bs-toggle="tab" data-bs-target="#comparison-pane" type="button" role="tab">
                                <i class="fa fa-columns"></i> 3. Comparison Matrix
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="steps-tab" data-bs-toggle="tab" data-bs-target="#steps-pane" type="button" role="tab">
                                <i class="fa fa-list-ol"></i> 4. 3-Step & Ingredients
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-pane" type="button" role="tab">
                                <i class="fa fa-star"></i> 5. Benefits, Reviews & Timer
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="order-tab" data-bs-toggle="tab" data-bs-target="#order-pane" type="button" role="tab">
                                <i class="fa fa-shopping-cart"></i> 6. Product Link & Delivery
                            </button>
                        </li>
                    </ul>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('special-offers.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="tab-content" id="baklavaTabContent">

                            <!-- ==========================================
                                 1. HERO & PRICING TAB
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
                                                id="offer_name" name="name" value="{{ old('name', 'Baklava Special Offer') }}"
                                                placeholder="e.g. Royal Turkish Baklava & Sandesh Combo" required onkeyup="autoGenerateSlug(this.value)">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">URL Slug (e.g. yoursite.com/special-offer/<b>slug</b>):</label>
                                            <div class="input-group">
                                                <span class="input-group-text text-muted">/special-offer/</span>
                                                <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                                    id="offer_slug" name="slug" value="{{ old('slug', 'baklava-offer') }}"
                                                    placeholder="baklava-offer">
                                            </div>
                                            @error('slug')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Top Badge Text:</label>
                                            <input type="text" class="form-control @error('badge_text') is-invalid @enderror"
                                                name="badge_text" value="{{ old('badge_text', '★ স্পেশাল ধামাকা অফার — সীমিত সময়ের জন্য ★') }}"
                                                placeholder="e.g. ★ স্পেশাল ধামাকা অফার — সীমিত সময়ের জন্য ★">
                                            @error('badge_text')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Hero English Title (H1 / Meta):</label>
                                            <input type="text" class="form-control @error('hero_title') is-invalid @enderror"
                                                name="hero_title" value="{{ old('hero_title', 'Premium Turkish Dessert, now at your home.') }}"
                                                placeholder="e.g. Premium Turkish Dessert, now at your home.">
                                            @error('hero_title')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Main Offer Headline (Bangla Highlight):</label>
                                            <input type="text" class="form-control @error('offer_headline') is-invalid @enderror"
                                                name="offer_headline" value="{{ old('offer_headline', '২০ পিস বাকলাভার সাথে হাফকেজি পাবনার পেরা সন্দেশ ফ্রী!') }}"
                                                placeholder="e.g. ২০ পিস বাকলাভার সাথে হাফকেজি পাবনার পেরা সন্দেশ ফ্রী!">
                                            @error('offer_headline')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Offer Subtext (Bangla):</label>
                                            <input type="text" class="form-control @error('offer_subtext') is-invalid @enderror"
                                                name="offer_subtext" value="{{ old('offer_subtext', 'তুরস্কের অথেন্টিক এবং গ্রাম বাংলার ঐতিহ্যবাহী ১০০% খাঁটি স্বাদ — সবচেয়ে নরম ও মুচমুচে স্বাদে সেরা') }}"
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
                                                        name="regular_price" value="{{ old('regular_price', 1850) }}" required>
                                                    @error('regular_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Offer Price (৳): <span class="text-danger">*</span></label>
                                                    <input type="number" step="any" class="form-control @error('offer_price') is-invalid @enderror"
                                                        name="offer_price" value="{{ old('offer_price', 1350) }}" required>
                                                    @error('offer_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group mb-3">
                                                    <label class="form-label fw-bold">Save Amount Badge:</label>
                                                    <input type="text" class="form-control @error('save_amount') is-invalid @enderror"
                                                        name="save_amount" value="{{ old('save_amount', '৫০০ টাকা ছাড়') }}"
                                                        placeholder="e.g. ৫০০ টাকা ছাড়">
                                                    @error('save_amount')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Hero Platter / Tray Image:</label>
                                            <input type="file" class="dropify @error('hero_image') is-invalid @enderror"
                                                name="hero_image" id="hero_image"
                                                data-height="210"
                                                data-default-file="{{ asset('frontend/images/landing/baklava/hero_tray.png') }}">
                                            @error('hero_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            <small class="text-muted">High quality platter/box photo displayed in the Hero banner and sticky bar.</small>
                                        </div>

                                        <div class="section-card-title mt-4">
                                            <i class="fa fa-shield text-success"></i> 3 Hero Trust Badges (Under Header)
                                        </div>

                                        @foreach($defaultTrustBadges as $bIdx => $badge)
                                            <div class="trust-badge-edit-box">
                                                <h6 class="fw-bold text-dark mb-2">Badge #{{ $bIdx + 1 }}</h6>
                                                <div class="row g-2">
                                                    <div class="col-md-5">
                                                        <label class="form-label small">Title:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="trust_badge_titles[{{ $bIdx }}]"
                                                            value="{{ $badge['title'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label small">Subtitle:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="trust_badge_subtitles[{{ $bIdx }}]"
                                                            value="{{ $badge['subtitle'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label small">Icon Class:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="trust_badge_icons[{{ $bIdx }}]"
                                                            value="{{ $badge['icon'] ?? 'fa-shield-halved' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- ==========================================
                                 2. VIDEO & PROBLEMS TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="problem-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-video-camera text-danger"></i> Video Showcase & Problem Agitation
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Promo Video Direct MP4 URL:</label>
                                            <input type="text" class="form-control @error('video_url') is-invalid @enderror"
                                                name="video_url" value="{{ old('video_url', 'https://a.dropoverapp.com/cloud/download/575a33ff-da66-46f2-8e71-dd19d025fbb2/5857a7ac-694d-4690-9bf5-fb320cb99295') }}"
                                                placeholder="https://...">
                                            @error('video_url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Or Upload Promo Video File (Max 50MB):</label>
                                            <input type="file" class="dropify @error('video_file') is-invalid @enderror"
                                                name="video_file" id="video_file" accept="video/mp4,video/quicktime,video/ogg"
                                                data-height="110">
                                            @error('video_file')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="section-card-title">
                                    <i class="fa fa-question-circle text-warning"></i> Problem Agitation Section ("আপনার কি মিষ্টি কিনতে এই সমস্যাগুলো হয়?")
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Section Title:</label>
                                            <input type="text" class="form-control" name="problem_title"
                                                value="{{ old('problem_title', 'আপনার কি মিষ্টি কিনতে এই সমস্যাগুলো হয়?') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Section Subtitle:</label>
                                            <input type="text" class="form-control" name="problem_subtitle"
                                                value="{{ old('problem_subtitle', 'কেন সাধারণ মিষ্টি নয়, এখনই সঠিক সিদ্ধান্ত নেবেন') }}">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3 text-dark">3 Problem Agitation Cards:</h6>
                                <div class="row">
                                    @foreach($defaultProblemCards as $pIdx => $pCard)
                                        <div class="col-md-4 mb-3">
                                            <div class="problem-card-edit-box">
                                                <h6 class="fw-bold text-danger mb-2">Problem Card #{{ $pIdx + 1 }}</h6>
                                                <div class="form-group mb-2">
                                                    <label class="form-label small fw-bold">Card Title:</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="problem_card_titles[{{ $pIdx }}]"
                                                        value="{{ $pCard['title'] ?? '' }}">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="form-label small fw-bold">Card Description:</label>
                                                    <textarea class="form-control form-control-sm" rows="2"
                                                        name="problem_card_descs[{{ $pIdx }}]">{{ $pCard['desc'] ?? '' }}</textarea>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label small fw-bold">FontAwesome Icon Class:</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="problem_card_icons[{{ $pIdx }}]"
                                                        value="{{ $pCard['icon'] ?? 'fa-triangle-exclamation' }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- ==========================================
                                 3. COMPARISON MATRIX TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="comparison-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-balance-scale text-primary"></i> Comparison Matrix (Ordinary vs Food Junction)
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Comparison Section Title:</label>
                                            <input type="text" class="form-control" name="comparison_title"
                                                value="{{ old('comparison_title', 'সাধারণ মিষ্টি বা বাকলাভা কেন সমাধান নয়?') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Comparison Section Subtitle:</label>
                                            <input type="text" class="form-control" name="comparison_subtitle"
                                                value="{{ old('comparison_subtitle', 'Food Junction এর প্রিমিয়াম প্যাকেজ কেন অন্যদের চেয়ে সম্পূর্ণ আলাদা ও অনন্য') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold text-danger">Ordinary / Competitor Column Header:</label>
                                            <input type="text" class="form-control" name="comparison_bad_header"
                                                value="{{ old('comparison_bad_header', 'সাধারণ রেগুলার মিষ্টি') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold text-success">Food Junction Column Header:</label>
                                            <input type="text" class="form-control" name="comparison_good_header"
                                                value="{{ old('comparison_good_header', 'Food Junction বাকলাভা') }}">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3 text-dark">Comparison Rows:</h6>
                                <div class="row">
                                    @foreach($defaultComparisonRows as $cIdx => $cRow)
                                        <div class="col-md-6 mb-3">
                                            <div class="comparison-edit-box">
                                                <div class="form-group mb-2">
                                                    <label class="form-label small fw-bold">Row #{{ $cIdx + 1 }} Feature / Criteria Label:</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="comp_row_labels[{{ $cIdx }}]"
                                                        value="{{ $cRow['label'] ?? '' }}">
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-md-6">
                                                        <label class="form-label small text-danger fw-semibold">Ordinary / Bad Point (✕):</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="comp_row_bads[{{ $cIdx }}]"
                                                            value="{{ $cRow['bad'] ?? '' }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small text-success fw-semibold">Food Junction Point (✓):</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="comp_row_goods[{{ $cIdx }}]"
                                                            value="{{ $cRow['good'] ?? '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- ==========================================
                                 4. 3-STEP & INGREDIENTS TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="steps-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-list-ol text-info"></i> 3-Step Experience, Showcase & 5 Ingredients
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">3-Step Section Title:</label>
                                            <input type="text" class="form-control" name="step_section_title"
                                                value="{{ old('step_section_title', '৩০ সেকেন্ডে মুগ্ধ হবেন সেরা স্বাদে') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">3-Step Section Subtitle:</label>
                                            <input type="text" class="form-control" name="step_section_subtitle"
                                                value="{{ old('step_section_subtitle', 'খাঁটি স্বাদ ও রাজকীয় আভিজাত্য — প্রতিটি কামড়ে তুর্কি ঐতিহ্যের অনন্য অনুভূতি') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 bg-light border mb-4">
                                    <label class="form-label fw-bold mb-2">4 Quick Feature Pills (Top Badges):</label>
                                    <div class="row g-2">
                                        @foreach($defaultFeaturePills as $fIdx => $pill)
                                            <div class="col-md-3">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="feature_pills[{{ $fIdx }}]"
                                                    value="{{ $pill }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3 text-dark">3 Numbered Step Cards:</h6>
                                <div class="row mb-4">
                                    @foreach($defaultProcessSteps as $sIdx => $step)
                                        <div class="col-md-4 mb-3">
                                            <div class="step-edit-box">
                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                    <h6 class="fw-bold text-dark mb-0">Step Card #{{ $sIdx + 1 }}</h6>
                                                    <input type="text" style="width: 60px;" class="form-control form-control-sm text-center fw-bold"
                                                        name="step_nums[{{ $sIdx }}]"
                                                        value="{{ $step['num'] ?? '0' . ($sIdx + 1) }}">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="form-label small fw-bold">Step Title:</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="step_titles[{{ $sIdx }}]"
                                                        value="{{ $step['title'] ?? '' }}">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="form-label small fw-bold">Step Description:</label>
                                                    <textarea class="form-control form-control-sm" rows="2"
                                                        name="step_descs[{{ $sIdx }}]">{{ $step['desc'] ?? '' }}</textarea>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label small fw-bold">Icon Class:</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="step_icons[{{ $sIdx }}]"
                                                        value="{{ $step['icon'] ?? 'fa-wand-magic-sparkles' }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <hr class="my-4">

                                <div class="section-card-title">
                                    <i class="fa fa-image text-primary"></i> Showcase Photo & 5 Ingredients
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Showcase / Gift Box Image:</label>
                                            <input type="file" class="dropify @error('collage_image') is-invalid @enderror"
                                                name="collage_image" id="collage_image"
                                                data-height="180"
                                                data-default-file="{{ asset('frontend/images/landing/baklava/collage_box.jpg') }}">
                                            @error('collage_image')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Ingredients Section Title:</label>
                                            <input type="text" class="form-control" name="ingredient_title"
                                                value="{{ old('ingredient_title', '১০০% খাঁটি ও সেরা উপাদানসমূহ') }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Ingredients Section Subtitle:</label>
                                            <input type="text" class="form-control" name="ingredient_subtitle"
                                                value="{{ old('ingredient_subtitle', 'আমাদের প্রতিটি মিষ্টি প্রস্তুত হয় প্রাকৃতিক ও হাইজেনিক উপাদান দিয়ে') }}">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="fw-bold mb-3 text-dark">5 Premium Ingredients:</h6>
                                <div class="row mb-4">
                                    @foreach($defaultIngredients as $idx => $ing)
                                        <div class="col-md-4 col-lg-2-4 mb-3">
                                            <div class="ingredient-edit-box">
                                                <div class="form-group mb-2">
                                                    <label class="form-label small fw-bold">Item #{{ $idx + 1 }} Photo:</label>
                                                    <input type="file" class="dropify"
                                                        name="ingredient_images[{{ $idx }}]"
                                                        accept="image/*"
                                                        data-height="100"
                                                        data-default-file="{{ asset($ing['image']) }}">
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label class="form-label small fw-bold">Item #{{ $idx + 1 }} Name:</label>
                                                    <input type="text" class="form-control form-control-sm text-center"
                                                        name="ingredient_names[{{ $idx }}]"
                                                        value="{{ $ing['name'] }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="p-3 bg-light border rounded">
                                    <label class="form-label fw-bold mb-2">3 Highlight Checklist Items (Under Ingredients):</label>
                                    <div class="row g-2">
                                        @foreach($defaultChecklistItems as $kIdx => $chk)
                                            <div class="col-md-4">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="checklist_items[{{ $kIdx }}]"
                                                    value="{{ $chk }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- ==========================================
                                 5. DUAL BENEFITS, REVIEWS & TIMER TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="reviews-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-star text-warning"></i> Dual Benefits (Baklava vs Pera Sandesh)
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="p-3 bg-light border">
                                            <h6 class="fw-bold text-dark mb-2">Benefit 1: Baklava Card</h6>
                                            <div class="form-group mb-2">
                                                <label class="form-label small fw-bold">Title:</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="dual_benefit_1_title"
                                                    value="{{ old('dual_benefit_1_title', 'টার্কিশ বাকলাভা') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label small text-danger fw-bold">Negative Point (✕):</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="dual_benefit_1_neg"
                                                    value="{{ old('dual_benefit_1_neg', 'সাধারণ মিষ্টির মতো অতিরিক্ত কড়া বা ভারী লাগে না') }}">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label class="form-label small text-success fw-bold">Positive Point (✓):</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="dual_benefit_1_pos"
                                                    value="{{ old('dual_benefit_1_pos', 'পেস্তা-কাজুর মুচমুচে ক্রাঞ্চ ও খাঁটি ঘৃত সুবাসে ভরপুর') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="p-3 bg-light border">
                                            <h6 class="fw-bold text-dark mb-2">Benefit 2: Pera Sandesh Card</h6>
                                            <div class="form-group mb-2">
                                                <label class="form-label small fw-bold">Title:</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="dual_benefit_2_title"
                                                    value="{{ old('dual_benefit_2_title', 'পাবনার পেরা সন্দেশ') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label class="form-label small text-danger fw-bold">Negative Point (✕):</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="dual_benefit_2_neg"
                                                    value="{{ old('dual_benefit_2_neg', 'বাজারে পাউডার দুধের কৃত্রিম ক্ষীর নয়') }}">
                                            </div>
                                            <div class="form-group mb-0">
                                                <label class="form-label small text-success fw-bold">Positive Point (✓):</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="dual_benefit_2_pos"
                                                    value="{{ old('dual_benefit_2_pos', 'খাঁটি তরল দুধ ঘণ্টার পর ঘণ্টা জ্বাল দিয়ে তৈরি শতাব্দী প্রাচীন ঐতিহ্য') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="section-card-title">
                                    <i class="fa fa-bar-chart text-success"></i> Customer Rating Stats & Star Breakdown
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Overall Rating Score:</label>
                                            <input type="text" class="form-control" name="rating_score"
                                                value="{{ old('rating_score', '৪.৯') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Total Reviews Count Text:</label>
                                            <input type="text" class="form-control" name="total_reviews_count"
                                                value="{{ old('total_reviews_count', '৫,২৩০+ রিভিউ') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Delivered Orders Text:</label>
                                            <input type="text" class="form-control" name="delivered_orders_text"
                                                value="{{ old('delivered_orders_text', 'সারা বাংলাদেশে ৬,০০০+ সফল ডেলিভার্ড অর্ডার') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="p-3 bg-light border rounded mb-4">
                                    <label class="form-label fw-bold mb-2">5-Star Rating Breakdown (%)</label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <label class="form-label small">5 Star (%):</label>
                                            <input type="number" class="form-control form-control-sm" name="rating_percents[5]" value="88" min="0" max="100">
                                        </div>
                                        <div class="col">
                                            <label class="form-label small">4 Star (%):</label>
                                            <input type="number" class="form-control form-control-sm" name="rating_percents[4]" value="10" min="0" max="100">
                                        </div>
                                        <div class="col">
                                            <label class="form-label small">3 Star (%):</label>
                                            <input type="number" class="form-control form-control-sm" name="rating_percents[3]" value="2" min="0" max="100">
                                        </div>
                                        <div class="col">
                                            <label class="form-label small">2 Star (%):</label>
                                            <input type="number" class="form-control form-control-sm" name="rating_percents[2]" value="0" min="0" max="100">
                                        </div>
                                        <div class="col">
                                            <label class="form-label small">1 Star (%):</label>
                                            <input type="number" class="form-control form-control-sm" name="rating_percents[1]" value="0" min="0" max="100">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="section-card-title">
                                    <i class="fa fa-commenting text-primary"></i> 3 Verified Customer Testimonials
                                </div>

                                <div class="row mb-4">
                                    @foreach($defaultTestimonials as $tIdx => $testi)
                                        <div class="col-md-4 mb-3">
                                            <div class="testi-edit-box">
                                                <h6 class="fw-bold text-dark mb-2">Testimonial #{{ $tIdx + 1 }}</h6>
                                                <div class="row g-2 mb-2">
                                                    <div class="col-8">
                                                        <label class="form-label small fw-bold">Customer Name:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="testi_names[{{ $tIdx }}]"
                                                            value="{{ $testi['name'] ?? '' }}">
                                                    </div>
                                                    <div class="col-4">
                                                        <label class="form-label small fw-bold">Location:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="testi_locations[{{ $tIdx }}]"
                                                            value="{{ $testi['location'] ?? '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label class="form-label small fw-bold">Review Text:</label>
                                                    <textarea class="form-control form-control-sm" rows="3"
                                                        name="testi_texts[{{ $tIdx }}]">{{ $testi['text'] ?? '' }}</textarea>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="col-6">
                                                        <label class="form-label small">Avatar Letter:</label>
                                                        <input type="text" class="form-control form-control-sm"
                                                            name="testi_letters[{{ $tIdx }}]"
                                                            value="{{ $testi['avatar_letter'] ?? '' }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="form-label small">Stars (1-5):</label>
                                                        <input type="number" class="form-control form-control-sm"
                                                            name="testi_stars[{{ $tIdx }}]"
                                                            value="{{ $testi['stars'] ?? 5 }}" min="1" max="5">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="section-card-title">
                                    <i class="fa fa-clock-o text-danger"></i> Urgency Countdown Timer Settings
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Timer Badge Text:</label>
                                            <input type="text" class="form-control" name="timer_badge"
                                                value="{{ old('timer_badge', 'অফার শেষ হতে বাকি') }}" placeholder="অফার শেষ হতে বাকি">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Offer End Date & Time (Countdown Deadline):</label>
                                            <input type="datetime-local" class="form-control" name="countdown_end_time"
                                                value="{{ old('countdown_end_time') }}">
                                            <small class="text-muted">Countdown automatically calculates remaining time. If remaining time is 24+ hours, days (দিন) will show automatically; if 23h 59m 59s or less, days will be hidden.</small>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-3">

                                <div class="section-card-title">
                                    <i class="fa fa-comments text-primary"></i> Customer Reviews & Screenshot Gallery
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Reviews Title:</label>
                                            <input type="text" class="form-control" name="reviews_title"
                                                value="{{ old('reviews_title', 'বাস্তব গ্রাহকদের পাঠানো রিভিউসমূহ') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Reviews Subtitle:</label>
                                            <input type="text" class="form-control" name="reviews_subtitle"
                                                value="{{ old('reviews_subtitle', 'ছবিতে ট্যাপ করে বড় করে দেখুন') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 p-3 bg-light border">
                                    <label class="form-label fw-bold">
                                        <i class="fa fa-cloud-upload me-1 text-primary"></i> Upload Customer Review Screenshots (Multiple / Optional):
                                    </label>
                                    <input type="file" class="dropify" name="new_review_images[]" multiple accept="image/*" data-height="120">
                                    <small class="text-muted">If left blank, default customer review screenshots will be automatically populated.</small>
                                </div>
                            </div>

                            <!-- ==========================================
                                 6. PRODUCT LINK & DELIVERY TAB
                                 ========================================== -->
                            <div class="tab-pane fade" id="order-pane" role="tabpanel">
                                <div class="section-card-title">
                                    <i class="fa fa-truck text-success"></i> Fast Order Checkout, Linked Product & Social Contacts
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Link to Shop Product (For Cart / Order checkout):</label>
                                            <select class="form-control form-select select2" name="product_id" id="product_id" onchange="loadProductVariants(this)">
                                                <option value="">-- Select Product (Optional) --</option>
                                                @foreach($products as $prod)
                                                    <option value="{{ $prod->id }}" {{ old('product_id') == $prod->id ? 'selected' : '' }} data-variants='@json($prod->variants)'>
                                                        {{ $prod->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Orders placed on this landing page will add this product to the system cart & checkout.</small>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Product Variant:</label>
                                            <select class="form-control form-select" name="variant_id" id="variant_id">
                                                <option value="">-- Default / First Variant --</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Package Name / Title in Order Box:</label>
                                            <input type="text" class="form-control" name="package_title"
                                                value="{{ old('package_title', '২০ পিস টার্কিশ বাকলাভা + হাফকেজি পাবনার পেরা সন্দেশ (ফ্রী)') }}"
                                                placeholder="২০ পিস টার্কিশ বাকলাভা + হাফকেজি পাবনার পেরা সন্দেশ (ফ্রী)">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Package Subtitle / Note:</label>
                                            <input type="text" class="form-control" name="package_subtitle"
                                                value="{{ old('package_subtitle', 'সম্পূর্ণ প্রিমিয়াম গিফট বক্স প্যাকেজিং সহ') }}"
                                                placeholder="সম্পূর্ণ প্রিমিয়াম গিফট বক্স প্যাকেজিং সহ">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Inside Dhaka Delivery Fee (৳): <span class="text-danger">*</span></label>
                                            <input type="number" step="any" class="form-control @error('inside_dhaka_delivery_fee') is-invalid @enderror"
                                                name="inside_dhaka_delivery_fee"
                                                value="{{ old('inside_dhaka_delivery_fee', 80) }}" required>
                                            @error('inside_dhaka_delivery_fee')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Outside Dhaka Delivery Fee (৳): <span class="text-danger">*</span></label>
                                            <input type="number" step="any" class="form-control @error('outside_dhaka_delivery_fee') is-invalid @enderror"
                                                name="outside_dhaka_delivery_fee"
                                                value="{{ old('outside_dhaka_delivery_fee', 150) }}" required>
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
                                                value="{{ old('whatsapp_number', '8801672756634') }}"
                                                placeholder="8801672756634">
                                            @error('whatsapp_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Direct Phone Number (Call):</label>
                                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                                name="phone_number"
                                                value="{{ old('phone_number', '8801672756634') }}"
                                                placeholder="8801672756634">
                                            @error('phone_number')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Facebook Page / Chat URL:</label>
                                            <input type="text" class="form-control @error('facebook_url') is-invalid @enderror"
                                                name="facebook_url"
                                                value="{{ old('facebook_url', 'https://www.facebook.com') }}"
                                                placeholder="https://www.facebook.com">
                                            @error('facebook_url')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label fw-bold">Page Status:</label>
                                            <select class="form-control form-select" name="status">
                                                <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active (Publicly Visible)</option>
                                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive / Draft</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- SUBMIT BUTTON -->
                        <div class="mt-4 pt-3 border-top d-flex align-items-center gap-2">
                            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                                <i class="fe fe-check-circle me-1"></i> Create & Publish Offer Page
                            </button>
                            <a href="{{ route('special-offers.index') }}" class="btn btn-outline-danger px-3 py-2">
                                <i class="fe fe-x me-1"></i> Cancel
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

    function autoGenerateSlug(text) {
        let slug = text.toLowerCase()
            .replace(/[^\w ]+/g, '')
            .replace(/ +/g, '-');
        $('#offer_slug').val(slug);
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
</script>
@endpush
