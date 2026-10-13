@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    @if(!empty(trim($data->offer_headline ?? '')) || !empty(trim($data->offer_subtext ?? '')))
        <meta name="description" content="{{ trim(($data->offer_headline ?? '') . ' ' . ($data->offer_subtext ?? '')) }}">
    @endif
    <meta name="keywords" content="Baklava Offer, Turkish Baklava, Pera Sandesh, Food Junction, Sweets Dhaka, Special Offer">
    @if(!empty(trim($data->hero_title ?? '')) || !empty(trim($data->name ?? '')))
        <meta property="og:title" content="{{ $data->hero_title ?? $data->name }} | Food Junction">
    @endif
    @if(!empty(trim($data->offer_headline ?? '')))
        <meta property="og:description" content="{{ $data->offer_headline }}">
    @endif
    @if(!empty($data->hero_image))
        <meta property="og:image" content="{{ asset($data->hero_image) }}">
    @endif
@endsection

@section('title')
    {{ !empty(trim($data->hero_title ?? '')) ? $data->hero_title . ' | Food Junction' : (!empty(trim($data->name ?? '')) ? $data->name . ' | Food Junction' : 'Special Offer | Food Junction') }}
@endsection

@section('content')

    @php
        $getIconClass = function($icon, $default = 'fa-solid fa-shield-halved') {
            if (empty($icon)) return $default;
            $icon = trim($icon);
            if (!preg_match('/\b(fa-solid|fa-brands|fa-regular|fa-duotone|fa-light|fa-thin|fas|fab|far|fal|fat|fad)\b/', $icon)) {
                return 'fa-solid ' . $icon;
            }
            return $icon;
        };

        $toBanglaNum = function($num) {
            $en = ['0','1','2','3','4','5','6','7','8','9'];
            $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
            return str_replace($en, $bn, (string)$num);
        };
    @endphp

    @include('frontend.includes.top-nav-button')

    <div class="baklava-landing-wrapper">
        <div class="baklava-container">

            <!-- ══════════════════════════════════════════════════
                 1. HERO SECTION (Header, Hook, Trust Pills, Price)
                 ══════════════════════════════════════════════════ -->
            <section class="baklava-hero-section">
                <!-- Tagline Badge -->
                @if(!empty(trim($data->badge_text ?? '')))
                <div>
                    <span class="offer-tag-pill">
                        <i class="fa-solid fa-fire text-danger"></i> {{ $data->badge_text }}
                    </span>
                </div>
                @endif

                <!-- Main Hook Title -->
                @if(!empty(trim($data->hero_title ?? '')) || !empty(trim($data->offer_headline ?? '')))
                <h1 class="hero-main-title">
                    @if(!empty(trim($data->hero_title ?? '')))
                        {{ $data->hero_title }}
                    @endif
                    @if(!empty(trim($data->offer_headline ?? '')))
                        <span class="fj-highlight-text">{{ $data->offer_headline }}</span>
                    @endif
                </h1>
                @endif

                @if(!empty(trim($data->offer_subtext ?? '')))
                <p class="landing-section-subtitle">
                    {{ $data->offer_subtext }}
                </p>
                @endif

                <!-- 3-Column Trust Guarantee Grid -->
                @if(!empty($data->trust_badges) && is_array($data->trust_badges) && count($data->trust_badges) > 0)
                <div class="hero-trust-grid">
                    @foreach($data->trust_badges as $badge)
                        @if(!empty(trim($badge['title'] ?? '')) || !empty(trim($badge['subtitle'] ?? '')))
                        <div class="hero-trust-item">
                            <div class="hero-trust-icon"><i class="{{ $getIconClass($badge['icon'] ?? '', 'fa-solid fa-shield-halved') }}"></i></div>
                            <div class="hero-trust-text">
                                {{ $badge['title'] ?? '' }}
                                @if(!empty(trim($badge['subtitle'] ?? '')))
                                    <br><small class="text-muted fw-normal">{{ $badge['subtitle'] }}</small>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                @endif

                <!-- Hero Platter Photo -->
                @if(!empty($data->hero_image))
                <img src="{{ asset($data->hero_image) }}"
                     alt="{{ $data->hero_title ?? $data->name ?? 'Offer Image' }}"
                     class="hero-tray-img"
                     loading="eager" />
                @endif

                <!-- Pricing Display -->
                @if(!empty($data->offer_price) || !empty($data->regular_price))
                <div class="hero-price-container">
                    @if(!empty($data->offer_price))
                        <span class="hero-price-current">৳{{ $data->offer_price }}</span>
                    @endif
                    @if(!empty($data->regular_price))
                        <span class="hero-price-old">
                            ৳{{ $data->regular_price }}
                            <svg class="strike-svg" viewBox="0 0 100 60" preserveAspectRatio="none" aria-hidden="true">
                                <path d="M1,46 C24,32 44,36 64,25 C76,18 88,15 99,10" fill="none" stroke="#DC2626" stroke-width="3" vector-effect="non-scaling-stroke" stroke-linecap="round" />
                                <path d="M4,13 C26,26 48,31 70,39 C81,43 91,46 98,52" fill="none" stroke="#DC2626" stroke-width="2" stroke-opacity="0.7" vector-effect="non-scaling-stroke" stroke-linecap="round" />
                            </svg>
                        </span>
                    @endif
                    @if(!empty(trim($data->save_amount ?? '')))
                        <span class="save-badge">{{ $data->save_amount }}</span>
                    @endif
                </div>
                @endif

                <!-- Primary Action Button -->
                <div class="my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> ORDER NOW — এখনই অর্ডার করুন
                    </a>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 2. VIDEO DEMO & PROBLEM AGITATION SECTION
                 ══════════════════════════════════════════════════ -->
            @php
                $hasVideo = !empty(trim($data->video_url ?? ''));
                $hasVideoHeader = !empty(trim($data->hero_video_banner ?? '')) || !empty(trim($data->hero_video_title ?? '')) || !empty(trim($data->hero_video_subtitle ?? ''));
                $hasProblemCards = !empty($data->problem_cards) && is_array($data->problem_cards) && count($data->problem_cards) > 0;
                $hasProblem = !empty(trim($data->problem_title ?? '')) || $hasProblemCards;
            @endphp

            @if($hasVideo || $hasVideoHeader || $hasProblem)
            <section class="bm-narrow-con my-4 text-center">
                @if(!empty(trim($data->hero_video_banner ?? '')))
                <div class="micro-trust-banner">
                    <i class="fa-solid fa-truck-fast"></i> {{ $data->hero_video_banner }}
                </div>
                @endif

                @if(!empty(trim($data->hero_video_title ?? '')))
                <h2 class="landing-section-title mt-2">
                    {{ $data->hero_video_title }}
                </h2>
                @endif

                @if(!empty(trim($data->hero_video_subtitle ?? '')))
                <p class="landing-section-subtitle">
                    {{ $data->hero_video_subtitle }}
                </p>
                @endif

                <!-- Video Showcase Box -->
                @if($hasVideo)
                <div class="video-showcase-box">
                    <video controls preload="metadata" playsinline class="landing-video-player" @if(!empty($data->hero_image)) poster="{{ asset($data->hero_image) }}" @endif>
                        <source src="{{ $data->video_url }}" type="video/mp4" />
                        আপনার ব্রাউজারে ভিডিওটি প্লে হচ্ছে না।
                    </video>
                </div>
                @endif

                <!-- Problem Agitation Cards -->
                @if($hasProblem)
                <div class="mt-5">
                    @if(!empty(trim($data->problem_title ?? '')))
                        <h3 class="landing-section-title fs-22 mb-1">{{ $data->problem_title }}</h3>
                    @endif
                    @if(!empty(trim($data->problem_subtitle ?? '')))
                        <p class="landing-section-subtitle mb-3">{{ $data->problem_subtitle }}</p>
                    @endif

                    @if($hasProblemCards)
                    <div class="problem-cards-grid">
                        @foreach($data->problem_cards as $pCard)
                            @if(!empty(trim($pCard['title'] ?? '')) || !empty(trim($pCard['desc'] ?? '')))
                            <div class="problem-card">
                                <div class="problem-icon-wrap"><i class="{{ $getIconClass($pCard['icon'] ?? '', 'fa-solid fa-triangle-exclamation') }}"></i></div>
                                @if(!empty(trim($pCard['title'] ?? '')))
                                    <h4 class="problem-card-title">{{ $pCard['title'] }}</h4>
                                @endif
                                @if(!empty(trim($pCard['desc'] ?? '')))
                                    <p class="problem-card-desc">{{ $pCard['desc'] }}</p>
                                @endif
                            </div>
                            @endif
                        @endforeach
                    </div>
                    @endif

                    <div class="my-3">
                        <a href="#comparison-section" class="landing-cta-btn">
                            <i class="fa-solid fa-arrow-down"></i> সমাধান দেখুন &bull; এখনই অফারটি নিন
                        </a>
                    </div>
                </div>
                @endif
            </section>
            @endif

            <!-- ══════════════════════════════════════════════════
                 3. COMPARISON MATRIX SECTION (Ordinary vs FJ)
                 ══════════════════════════════════════════════════ -->
            @php
                $hasComparisonRows = !empty($data->comparison_rows) && is_array($data->comparison_rows) && count($data->comparison_rows) > 0;
                $hasComparison = !empty(trim($data->comparison_title ?? '')) || $hasComparisonRows;
            @endphp

            @if($hasComparison)
            <section id="comparison-section" class="bm-narrow-con my-5">
                @if(!empty(trim($data->comparison_badge ?? '')))
                    <span class="d-block text-center offer-tag-pill">{{ $data->comparison_badge }}</span>
                @endif
                @if(!empty(trim($data->comparison_title ?? '')))
                    <h2 class="landing-section-title">{{ $data->comparison_title }}</h2>
                @endif
                @if(!empty(trim($data->comparison_subtitle ?? '')))
                    <p class="landing-section-subtitle">{{ $data->comparison_subtitle }}</p>
                @endif

                @if($hasComparisonRows)
                <div class="comparison-section-box">
                    @if(!empty(trim($data->comparison_bad_header ?? '')) || !empty(trim($data->comparison_good_header ?? '')))
                    <div class="comparison-header-row">
                        @if(!empty(trim($data->comparison_bad_header ?? '')))
                        <div class="comp-col-header bad">
                            <i class="fa-solid fa-circle-xmark text-danger"></i> {{ $data->comparison_bad_header }}
                        </div>
                        @endif
                        @if(!empty(trim($data->comparison_good_header ?? '')))
                        <div class="comp-col-header good">
                            <i class="fa-solid fa-circle-check text-success"></i> {{ $data->comparison_good_header }}
                        </div>
                        @endif
                    </div>
                    @endif

                    @foreach($data->comparison_rows as $cRow)
                        @if(!empty(trim($cRow['bad'] ?? '')) || !empty(trim($cRow['good'] ?? '')) || !empty(trim($cRow['label'] ?? '')))
                        <div class="comparison-body-row">
                            <div class="comp-cell bad">
                                @if(!empty(trim($cRow['label'] ?? '')))
                                    <span class="comp-feature-label">{{ $cRow['label'] }}</span>
                                @endif
                                @if(!empty(trim($cRow['bad'] ?? '')))
                                    <div><span class="comp-icon-cross">✕</span> {{ $cRow['bad'] }}</div>
                                @endif
                            </div>
                            <div class="comp-cell good">
                                @if(!empty(trim($cRow['label'] ?? '')))
                                    <span class="comp-feature-label">{{ $cRow['label'] }}</span>
                                @endif
                                @if(!empty(trim($cRow['good'] ?? '')))
                                    <div><span class="comp-icon-check">✓</span> {{ $cRow['good'] }}</div>
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                @endif

                <div class="text-center my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-gift"></i> অফারটি লুফে নিন
                    </a>
                </div>
            </section>
            @endif

            <!-- ══════════════════════════════════════════════════
                 4. 3-STEP EXPERIENCE & FEATURE SHOWCASE
                 ══════════════════════════════════════════════════ -->
            @php
                $hasFeaturePills = !empty($data->feature_pills) && is_array($data->feature_pills) && count(array_filter($data->feature_pills)) > 0;
                $hasProcessSteps = !empty($data->process_steps) && is_array($data->process_steps) && count($data->process_steps) > 0;
                $hasStepsHeader = !empty(trim($data->step_badge ?? '')) || !empty(trim($data->step_section_title ?? '')) || !empty(trim($data->step_section_subtitle ?? ''));

                $rawCollageImages = [];
                if (!empty($data->collage_images) && is_array($data->collage_images)) {
                    $rawCollageImages = array_values(array_filter($data->collage_images));
                } elseif (!empty($data->collage_image)) {
                    $rawCollageImages = [$data->collage_image];
                }
                $collageCount = count($rawCollageImages);

                $hasIngredients = !empty($data->ingredients) && is_array($data->ingredients) && count($data->ingredients) > 0;
                $hasChecklist = !empty($data->checklist_items) && is_array($data->checklist_items) && count(array_filter($data->checklist_items)) > 0;

                $hasSection4 = $hasStepsHeader || $hasFeaturePills || $hasProcessSteps || ($collageCount > 0) || $hasIngredients || $hasChecklist;
            @endphp

            @if($hasSection4)
            <section class="bm-narrow-con my-5 text-center">
                @if(!empty(trim($data->step_badge ?? '')))
                    <span class="offer-tag-pill">{{ $data->step_badge }}</span>
                @endif
                @if(!empty(trim($data->step_section_title ?? '')))
                    <h2 class="landing-section-title">{{ $data->step_section_title }}</h2>
                @endif
                @if(!empty(trim($data->step_section_subtitle ?? '')))
                    <p class="landing-section-subtitle">{{ $data->step_section_subtitle }}</p>
                @endif

                <!-- Quick Feature Pills -->
                @if($hasFeaturePills)
                <div class="quick-feature-pills-wrap">
                    @foreach($data->feature_pills as $pill)
                        @if(!empty(trim($pill ?? '')))
                            <div class="feature-pill-item"><i class="fa-solid fa-check"></i> {{ $pill }}</div>
                        @endif
                    @endforeach
                </div>
                @endif

                <!-- 3-Step Numbered Cards -->
                @if($hasProcessSteps)
                @php
                    $validProcessSteps = array_values(array_filter($data->process_steps ?? [], function($st) {
                        return !empty(trim($st['title'] ?? '')) || !empty(trim($st['desc'] ?? ''));
                    }));
                    $stepCount = count($validProcessSteps);
                @endphp
                @if($stepCount > 0)
                <div class="steps-grid-3"
                     @if($stepCount === 1) style="display: flex; justify-content: center;"
                     @elseif($stepCount === 2) style="display: flex; justify-content: center; flex-wrap: wrap;"
                     @endif>
                    @foreach($validProcessSteps as $stIdx => $st)
                        <div class="step-card-item"
                             @if($stepCount === 1) style="max-width: 480px; width: 100%;"
                             @elseif($stepCount === 2) style="flex: 1 1 320px; max-width: 410px; width: 100%;"
                             @endif>
                            <div class="step-number-badge">{{ $st['num'] ?? sprintf('%02d', $stIdx + 1) }}</div>
                            @if(!empty(trim($st['title'] ?? '')))
                                <h3 class="step-card-title"><i class="{{ $getIconClass($st['icon'] ?? '', 'fa-solid fa-wand-magic-sparkles text-warning') }}"></i> {{ $st['title'] }}</h3>
                            @endif
                            @if(!empty(trim($st['desc'] ?? '')))
                                <p class="step-card-desc">{{ $st['desc'] }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
                @endif
                @endif

                <!-- Collage Presentation Visual -->
                @if($collageCount > 0)
                <div class="landing-collage-box collage-count-{{ min($collageCount, 6) }}">
                    @if($collageCount === 1)
                        <a href="javascript:void(0)" class="landing-collage-single" onclick="openReviewModal('{{ asset($rawCollageImages[0]) }}')" title="ট্যাপ করে বড় করে দেখুন">
                            <img src="{{ asset($rawCollageImages[0]) }}"
                                 alt="{{ $data->name ?? 'Product Showcase' }}"
                                 class="landing-collage-img"
                                 loading="lazy" />
                            <span class="collage-zoom-hint"><i class="fa-solid fa-magnifying-glass-plus"></i> বড় করে দেখুন</span>
                        </a>
                    @else
                        <div class="landing-collage-grid collage-grid-{{ min($collageCount, 6) }}">
                            @foreach($rawCollageImages as $cIdx => $cImg)
                                <a href="javascript:void(0)"
                                   class="landing-collage-item collage-item-{{ $cIdx + 1 }}"
                                   onclick="openReviewModal('{{ asset($cImg) }}')"
                                   title="ট্যাপ করে বড় করে দেখুন">
                                    <img src="{{ asset($cImg) }}"
                                         alt="{{ $data->name ?? 'Showcase' }} - Photo {{ $cIdx + 1 }}"
                                         class="landing-collage-img"
                                         loading="lazy" />
                                    <span class="collage-item-overlay">
                                        <i class="fa-solid fa-magnifying-glass-plus"></i>
                                    </span>
                                </a>
                            @endforeach
                        </div>
                        <div class="landing-collage-footer-hint">
                            <i class="fa-solid fa-expand"></i> প্রতিটি ছবিতে ট্যাপ করে ফুল স্ক্রিনে স্পষ্ট করে দেখুন
                        </div>
                    @endif
                </div>
                @endif

                <!-- Ingredients Scroll Gallery -->
                @if($hasIngredients)
                <div class="my-4">
                    @if(!empty(trim($data->ingredient_title ?? '')))
                        <h3 class="landing-section-title fs-22 mb-1">{{ $data->ingredient_title }}</h3>
                    @endif
                    @if(!empty(trim($data->ingredient_subtitle ?? '')))
                        <p class="landing-section-subtitle mb-2">{{ $data->ingredient_subtitle }}</p>
                    @endif

                    <div class="ingredients-scroll-container">
                        @foreach($data->ingredients as $ing)
                            @if(!empty(trim($ing['name'] ?? '')) || !empty($ing['image']))
                            <div class="ingredient-card">
                                @if(!empty($ing['image']))
                                    <img src="{{ asset($ing['image']) }}" alt="{{ $ing['name'] ?? '' }}" class="ingredient-img" loading="lazy">
                                @endif
                                @if(!empty(trim($ing['name'] ?? '')))
                                    <div class="ingredient-caption">{{ $ing['name'] }}</div>
                                @endif
                            </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="scroll-hint-bar">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span>সাইডে স্ক্রল করে উপাদানগুলো দেখুন</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
                @endif

                <!-- Checklist Highlight Bar -->
                @if($hasChecklist)
                <div class="checklist-pills-bar">
                    @foreach($data->checklist_items as $chk)
                        @if(!empty(trim($chk ?? '')))
                            <div class="checklist-pill-item"><i class="fa-solid fa-circle-check"></i> <span>{{ $chk }}</span></div>
                        @endif
                    @endforeach
                </div>
                @endif

                <div class="my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> এখনই অর্ডার করুন
                    </a>
                </div>
            </section>
            @endif

            <!-- ══════════════════════════════════════════════════
                 5. DUAL BENEFIT + RATING STATS + REVIEWS + TIMER
                 ══════════════════════════════════════════════════ -->
            @php
                $hasBenefit1 = !empty(trim($data->dual_benefit_1_title ?? '')) || !empty(trim($data->dual_benefit_1_neg ?? '')) || !empty(trim($data->dual_benefit_1_pos ?? ''));
                $hasBenefit2 = !empty(trim($data->dual_benefit_2_title ?? '')) || !empty(trim($data->dual_benefit_2_neg ?? '')) || !empty(trim($data->dual_benefit_2_pos ?? ''));
                $hasDualBenefits = $hasBenefit1 || $hasBenefit2;

                $hasRatingStats = !empty(trim($data->rating_score ?? '')) || !empty(trim($data->total_reviews_count ?? '')) || (!empty($data->rating_breakdown) && is_array($data->rating_breakdown) && count($data->rating_breakdown) > 0) || !empty(trim($data->delivered_orders_text ?? ''));
                $hasTestimonials = !empty($data->testimonials) && is_array($data->testimonials) && count($data->testimonials) > 0;

                $reviewsList = !empty($data->reviews) && is_array($data->reviews) ? array_values(array_filter($data->reviews)) : [];
                $hasReviews = count($reviewsList) > 0;

                $hasTimer = false;
                $initTotalSeconds = 0;
                $endTimeIso = '';
                $calcDays = 0; $calcHours = 0; $calcMinutes = 0; $calcSeconds = 0;
                if (!empty($data->countdown_end_time)) {
                    $targetCarbon = \Carbon\Carbon::parse($data->countdown_end_time);
                    $initTotalSeconds = max(0, now()->diffInSeconds($targetCarbon, false));
                    if ($initTotalSeconds > 0) {
                        $hasTimer = true;
                        $endTimeIso = $targetCarbon->toIso8601String();
                        $calcDays = (int)floor($initTotalSeconds / 86400);
                        $calcHours = (int)floor(($initTotalSeconds % 86400) / 3600);
                        $calcMinutes = (int)floor(($initTotalSeconds % 3600) / 60);
                        $calcSeconds = (int)($initTotalSeconds % 60);
                    }
                }

                $hasSection5 = $hasDualBenefits || $hasRatingStats || $hasTestimonials || $hasReviews || $hasTimer;
            @endphp

            @if($hasSection5)
            <section class="bm-narrow-con my-5 text-center">
                <!-- Dual Benefit Box -->
                @if($hasDualBenefits)
                    @php
                        $isSingleBenefit = !($hasBenefit1 && $hasBenefit2);
                    @endphp
                    @if(!empty(trim($data->benefit_section_title ?? '')))
                        <h2 class="landing-section-title">{{ $data->benefit_section_title }}</h2>
                    @endif
                    @if(!empty(trim($data->benefit_section_subtitle ?? '')))
                        <p class="landing-section-subtitle">{{ $data->benefit_section_subtitle }}</p>
                    @endif

                    <div class="dual-benefit-grid" @if($isSingleBenefit) style="display: flex; justify-content: center;" @endif>
                        @if($hasBenefit1)
                        <div class="dual-benefit-card" @if($isSingleBenefit) style="max-width: 520px; width: 100%;" @endif>
                            @if(!empty(trim($data->dual_benefit_1_title ?? '')))
                            <div class="dual-benefit-header">
                                <span class="fs-22">👑</span>
                                <h4>{{ $data->dual_benefit_1_title }}</h4>
                            </div>
                            @endif
                            @if(!empty(trim($data->dual_benefit_1_neg ?? '')))
                            <div class="benefit-item-row neg">
                                <i class="fa-solid fa-xmark text-danger"></i> <span>{{ $data->dual_benefit_1_neg }}</span>
                            </div>
                            @endif
                            @if(!empty(trim($data->dual_benefit_1_pos ?? '')))
                            <div class="benefit-item-row pos">
                                <i class="fa-solid fa-check text-success"></i> <span>{{ $data->dual_benefit_1_pos }}</span>
                            </div>
                            @endif
                        </div>
                        @endif

                        @if($hasBenefit2)
                        <div class="dual-benefit-card" @if($isSingleBenefit) style="max-width: 520px; width: 100%;" @endif>
                            @if(!empty(trim($data->dual_benefit_2_title ?? '')))
                            <div class="dual-benefit-header">
                                <span class="fs-22">🍯</span>
                                <h4>{{ $data->dual_benefit_2_title }}</h4>
                            </div>
                            @endif
                            @if(!empty(trim($data->dual_benefit_2_neg ?? '')))
                            <div class="benefit-item-row neg">
                                <i class="fa-solid fa-xmark text-danger"></i> <span>{{ $data->dual_benefit_2_neg }}</span>
                            </div>
                            @endif
                            @if(!empty(trim($data->dual_benefit_2_pos ?? '')))
                            <div class="benefit-item-row pos">
                                <i class="fa-solid fa-check text-success"></i> <span>{{ $data->dual_benefit_2_pos }}</span>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>
                @endif

                <!-- Customer Trust Stats Widget -->
                @if($hasRatingStats || $hasTestimonials)
                <div class="custom-review-widget">
                    @if($hasRatingStats)
                    <div class="review-summary-card">
                        <div class="summary-top">
                            @if(!empty(trim($data->rating_score ?? '')) || !empty(trim($data->total_reviews_count ?? '')))
                            <div class="rating-big-box">
                                @if(!empty(trim($data->rating_score ?? '')))
                                    <div class="big-rating">{{ $data->rating_score }}</div>
                                    <div class="stars-gold">★★★★★</div>
                                @endif
                                @if(!empty(trim($data->total_reviews_count ?? '')))
                                    <div class="total-reviews">{{ $data->total_reviews_count }}</div>
                                @endif
                            </div>
                            @endif

                            @if(!empty($data->rating_breakdown) && is_array($data->rating_breakdown) && count($data->rating_breakdown) > 0)
                            <div class="progress-bars-container">
                                @foreach($data->rating_breakdown as $bRow)
                                    <div class="bar-row">
                                        <span class="star-num">{{ $bRow['star'] ?? 5 }}</span>
                                        <span class="star-icon">★</span>
                                        <div class="bar-bg"><div class="bar-fill" style="width: {{ $bRow['percent'] ?? 0 }}%;"></div></div>
                                        <span class="bar-percent">{{ $bRow['percent'] ?? 0 }}%</span>
                                    </div>
                                @endforeach
                            </div>
                            @endif
                        </div>

                        @if(!empty(trim($data->delivered_orders_text ?? '')))
                        <div class="summary-divider"></div>
                        <div class="delivery-text">
                            <i class="fa-solid fa-box-open text-warning me-1"></i> {{ $data->delivered_orders_text }}
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Verified Customer Testimonial Cards -->
                    @if($hasTestimonials)
                        @foreach($data->testimonials as $t)
                            @if(!empty(trim($t['text'] ?? '')) || !empty(trim($t['name'] ?? '')))
                            <div class="single-review-card">
                                <div class="user-avatar-circle">{{ $t['avatar_letter'] ?? (!empty(trim($t['name'] ?? '')) ? mb_substr(trim($t['name']), 0, 1) : '✓') }}</div>
                                <div class="review-content">
                                    <div class="user-header">
                                        @if(!empty(trim($t['name'] ?? '')))
                                            <span class="user-name">{{ $t['name'] }}</span>
                                        @endif
                                        @if(!empty(trim($t['location'] ?? '')))
                                            <span class="user-location">· {{ $t['location'] }}</span>
                                        @endif
                                        <span class="verified-badge"><i class="fa-solid fa-circle-check"></i> ভেরিফায়েড ক্রেতা</span>
                                    </div>
                                    @if(!empty($t['stars']))
                                        <div class="user-stars">{{ is_numeric($t['stars']) ? str_repeat('★', (int)$t['stars']) : $t['stars'] }}</div>
                                    @endif
                                    @if(!empty(trim($t['text'] ?? '')))
                                        <p class="review-text">“{{ $t['text'] }}”</p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    @endif
                </div>
                @endif

                <!-- Customer Real Screenshot Reviews -->
                @if($hasReviews)
                <div class="my-4">
                    <span class="offer-tag-pill">গ্রাহক সন্তুষ্টি আমাদের অহংকার</span>
                    @if(!empty(trim($data->reviews_title ?? '')))
                        <h3 class="landing-section-title fs-22 mb-1">{{ $data->reviews_title }}</h3>
                    @endif
                    @if(!empty(trim($data->reviews_subtitle ?? '')))
                        <p class="landing-section-subtitle mb-2">{{ $data->reviews_subtitle }}</p>
                    @endif

                    <div class="reviews-scroll-container">
                        @foreach($reviewsList as $revIdx => $revPath)
                            <a href="javascript:void(0)" class="review-screenshot-card" onclick="openReviewModal('{{ asset($revPath) }}')">
                                <img src="{{ asset($revPath) }}"
                                     alt="Customer review screenshot {{ $revIdx + 1 }}"
                                     class="review-screenshot-img"
                                     loading="lazy">
                            </a>
                        @endforeach
                    </div>

                    <div class="scroll-hint-bar">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span>{{ count($reviewsList) }}টি স্ক্রিনশট — সাইডে স্ক্রল করে দেখুন</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
                @endif

                <!-- Live Countdown Timer Widget -->
                @if($hasTimer)
                <div class="custom-timer-widget" data-end-time="{{ $endTimeIso }}">
                    <div class="timer-badge">
                        <i class="fa-solid fa-stopwatch"></i> {{ !empty(trim($data->timer_badge ?? '')) ? $data->timer_badge : 'অফার শেষ হতে বাকি' }}
                    </div>
                    <div class="timer-countdown">
                        <div class="time-box" id="timer-days-box" style="{{ $calcDays > 0 ? '' : 'display: none;' }}">
                            <span class="time-number" id="timer-days">{{ $toBanglaNum(sprintf('%02d', $calcDays)) }}</span>
                            <span class="time-label">দিন</span>
                        </div>
                        <span class="colon" id="timer-colon-day" style="{{ $calcDays > 0 ? '' : 'display: none;' }}">:</span>
                        <div class="time-box">
                            <span class="time-number" id="timer-hours">{{ $toBanglaNum(sprintf('%02d', $calcHours)) }}</span>
                            <span class="time-label">ঘণ্টা</span>
                        </div>
                        <span class="colon">:</span>
                        <div class="time-box">
                            <span class="time-number" id="timer-minutes">{{ $toBanglaNum(sprintf('%02d', $calcMinutes)) }}</span>
                            <span class="time-label">মিনিট</span>
                        </div>
                        <span class="colon">:</span>
                        <div class="time-box">
                            <span class="time-number" id="timer-seconds">{{ $toBanglaNum(sprintf('%02d', $calcSeconds)) }}</span>
                            <span class="time-label">সেকেন্ড</span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-bolt"></i> অর্ডার কনফার্ম করতে এখানে ক্লিক করুন
                    </a>
                </div>
            </section>
            @endif

            <!-- ══════════════════════════════════════════════════
                 6. FAST DIRECT CHECKOUT / ORDER FORM SECTION
                 ══════════════════════════════════════════════════ -->
            <section id="order-section" class="bm-form-con landing-order-section">
                <div class="landing-order-header">
                    <span class="order-header-badge"><i class="fa-solid fa-cart-shopping"></i> অর্ডার ফর্ম</span>
                    <h2 class="landing-section-title fs-26 mb-1">অর্ডারটি কনফার্ম করতে নিচের তথ্যগুলো দিন</h2>
                    <p class="landing-section-subtitle mb-0">ক্যাশ অন ডেলিভারিতে পণ্য হাতে পেয়ে মূল্য পরিশোধ করতে পারবেন</p>
                </div>

                <!-- Package Selection Card -->
                <div class="package-select-box">
                    <span class="package-popular-ribbon"><i class="fa-solid fa-star"></i> BEST VALUE</span>
                    
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="package-media-flex">
                            @php
                                $pkgImg = !empty($data->hero_image) ? $data->hero_image : ($baklavaProduct?->image_url ?? $defaultProduct?->image_url ?? null);
                            @endphp
                            @if(!empty($pkgImg))
                            <img src="{{ asset($pkgImg) }}"
                                 alt="{{ $data->package_title ?? $data->name ?? 'Package Thumbnail' }}"
                                 class="package-thumb-img">
                            @endif
                            <div>
                                @if(!empty(trim($data->package_title ?? '')))
                                    <h4 class="fw-bold text-dark mb-1 fs-16">
                                        {{ $data->package_title }}
                                    </h4>
                                @elseif(!empty(trim($data->name ?? '')))
                                    <h4 class="fw-bold text-dark mb-1 fs-16">
                                        {{ $data->name }}
                                    </h4>
                                @endif

                                @if(!empty(trim($data->package_subtitle ?? '')))
                                    <p class="text-muted mb-0 fs-13">
                                        {{ $data->package_subtitle }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="text-end ms-auto">
                            @if(!empty($data->offer_price))
                            <div class="fs-22 fw-bold" style="color: var(--fj-amber);">
                                ৳ <span id="unit-price-display">{{ $data->offer_price }}</span>
                            </div>
                            @endif
                            @if(!empty($data->regular_price))
                            <del class="text-muted fs-13">৳ {{ $data->regular_price }}</del>
                            @endif
                        </div>
                    </div>

                    <!-- Quantity Control Row -->
                    <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top">
                        <span class="fw-bold text-dark fs-14">প্যাকেজ সংখ্যা (Quantity):</span>
                        <div class="d-flex align-items-center">
                            <button type="button" class="qty-control-btn" onclick="changeOrderQty(-1)">&minus;</button>
                            <input type="number" id="order-qty" name="quantity" class="qty-input-field" value="1" min="1" max="50" readonly>
                            <button type="button" class="qty-control-btn" onclick="changeOrderQty(1)">&plus;</button>
                        </div>
                    </div>
                </div>

                <!-- Order Form -->
                <form id="baklava-direct-order-form" action="{{ route('special-offer.direct-order') }}" method="POST" data-unit-price="{{ $data->offer_price ?? 0 }}" data-whatsapp="{{ $data->whatsapp_number ?? '' }}" data-package-name="{{ $data->package_title ?? $data->name ?? 'Special Offer' }}" data-default-delivery="{{ $data->inside_dhaka_delivery_fee ?? 80 }}">
                    @csrf
                    <input type="hidden" name="offer_id" value="{{ $data->id ?? '' }}">
                    <input type="hidden" name="offer_slug" value="{{ $data->slug ?? 'baklava-offer' }}">
                    <input type="hidden" name="product_id" value="{{ $data->product_id ?? $baklavaProduct?->id ?? $defaultProduct?->id ?? '' }}">
                    <input type="hidden" name="variant_id" value="{{ $data->variant_id ?? $baklavaProduct?->variants?->first()?->id ?? $defaultProduct?->variants?->first()?->id ?? '' }}">
                    <input type="hidden" id="form-quantity" name="quantity" value="1">
                    <input type="hidden" name="all_terms" id="all_terms" value="yes">

                    <div class="row g-3">
                        <!-- Name (Mandatory) -->
                        <div class="col-md-6 form-floating-custom">
                            <label for="name" class="form-label fw-bold fs-14">আপনার পূর্ণ নাম <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                   placeholder="নাম লিখুন" value="{{ Auth::check() ? Auth::user()->name : old('name') }}" required>
                            @error('name')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Number (Mandatory) -->
                        <div class="col-md-6 form-floating-custom">
                            <label for="number" class="form-label fw-bold fs-14">ফোন নাম্বার (১১ ডিজিট) <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('number') is-invalid @enderror" name="number" id="number"
                                   placeholder="017XXXXXXXX" pattern="[0-9]{11}" maxlength="11"
                                   value="{{ Auth::check() ? Auth::user()->phone : old('number') }}" required>
                            @error('number')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Full Delivery Address (Mandatory) -->
                        <div class="col-12 form-floating-custom">
                            <label for="address" class="form-label fw-bold fs-14">সম্পূর্ণ ঠিকানা (বাসা নং, রোড, থানা, জেলা) <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                      placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন" cols="30" rows="3" required>{{ Auth::check() ? Auth::user()->address : old('address') }}</textarea>
                            @error('address')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Delivery Zone (Mandatory) -->
                        <div class="col-12 form-floating-custom">
                            <label for="delivery_zone" class="form-label fw-bold fs-14">ডেলিভারি এরিয়া নির্বাচন করুন <span class="text-danger">*</span></label>
                            <select class="form-select @error('delivery_zone') is-invalid @enderror" id="delivery_zone" name="delivery_zone" onchange="calculateOrderTotal()" required>
                                <option value="inside_dhaka" data-fee="{{ $data->inside_dhaka_delivery_fee ?? 80 }}" selected>
                                    ঢাকার ভেতরে হোম ডেলিভারি — ৳ {{ $data->inside_dhaka_delivery_fee ?? 80 }}
                                </option>
                                <option value="outside_dhaka" data-fee="{{ $data->outside_dhaka_delivery_fee ?? 150 }}">
                                    ঢাকার বাইরে সারা বাংলাদেশ হোম ডেলিভারি — ৳ {{ $data->outside_dhaka_delivery_fee ?? 150 }}
                                </option>
                            </select>
                            @error('delivery_zone')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Special Note (Optional) -->
                        <div class="col-12 form-floating-custom">
                            <label for="note" class="form-label fw-bold fs-14">বিশেষ কোনো নোট <span class="text-muted fw-normal">(ঐচ্ছিক)</span></label>
                            <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note"
                                      placeholder="যেমন: বিকেলে ডেলিভারি দিলে ভালো হয়" cols="30" rows="2">{{ old('note') }}</textarea>
                            @error('note')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Live Order Summary Box -->
                    <div class="order-summary-box">
                        <div class="order-summary-row">
                            <span class="text-muted">প্যাকেজ মূল্য (<span id="summary-qty">১</span> টি):</span>
                            <span class="fw-bold">৳ <span id="summary-subtotal">{{ $data->offer_price ?? 0 }}</span></span>
                        </div>
                        <div class="order-summary-row">
                            <span class="text-muted">ডেলিভারি চার্জ:</span>
                            <span class="fw-bold">৳ <span id="summary-delivery">{{ $data->inside_dhaka_delivery_fee ?? 80 }}</span></span>
                        </div>
                        <div class="order-summary-total">
                            <span>সর্বমোট পরিশোধযোগ্য:</span>
                            <span>৳ <span id="summary-grand-total">{{ ($data->offer_price ?? 0) + ($data->inside_dhaka_delivery_fee ?? 80) }}</span></span>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4 text-center">
                        <button type="submit" id="submit-order-btn" class="landing-cta-btn w-100 py-3 fs-18">
                            <i class="fa-solid fa-circle-check me-1"></i> Place Order — অর্ডার কনফার্ম করুন (ক্যাশ অন ডেলিভারি)
                        </button>
                    </div>
                </form>

                <!-- WhatsApp Direct Order Option -->
                @if(!empty(trim($data->whatsapp_number ?? '')))
                <div class="mt-3 text-center">
                    <p class="text-muted fs-13 mb-1">অথবা সরাসরি হোয়াটসঅ্যাপে অর্ডার করতে চান?</p>
                    <a id="whatsapp-order-link" href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $data->whatsapp_number) }}?text={{ urlencode('Hello Food Junction, I want to order ' . ($data->package_title ?? $data->name ?? 'Special Offer')) }}"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="whatsapp-order-btn">
                        <i class="fa-brands fa-whatsapp fs-20"></i> হোয়াটসঅ্যাপে অর্ডার করুন
                    </a>
                </div>
                @endif
            </section>

            <!-- ══════════════════════════════════════════════════
                 7. CONTACT, SOCIALS & FOOTER SECTION
                 ══════════════════════════════════════════════════ -->
            <section class="bm-narrow-con">
                <div class="landing-contact-card">
                    <h3 class="fs-20 fw-bold mb-2">কোনো কিছু জানতে কিংবা সরাসরি অর্ডার করতে যোগাযোগ করুন</h3>
                    <p class="text-muted fs-13 mb-3" style="color: #A89587 !important;">আমরা সপ্তাহে ৭ দিন সকাল ৯টা থেকে রাত ১১টা পর্যন্ত আপনার সেবায় নিয়োজিত</p>

                    @php
                        $contactPhone = !empty(trim($data->phone_number ?? '')) ? $data->phone_number : (!empty(trim($data->whatsapp_number ?? '')) ? $data->whatsapp_number : null);
                        $hasContactPills = !empty(trim($data->whatsapp_number ?? '')) || !empty($contactPhone) || !empty(trim($data->facebook_url ?? ''));
                    @endphp

                    @if($hasContactPills)
                    <div class="social-contact-btns-wrap">
                        @if(!empty(trim($data->whatsapp_number ?? '')))
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $data->whatsapp_number) }}" target="_blank" rel="noopener noreferrer" class="social-contact-pill social-pill-wa">
                            <i class="fa-brands fa-whatsapp fs-18"></i> WhatsApp
                        </a>
                        @endif
                        @if(!empty($contactPhone))
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}" class="social-contact-pill social-pill-phone">
                            <i class="fa-solid fa-phone fs-16"></i> Call Now
                        </a>
                        @endif
                        @if(!empty(trim($data->facebook_url ?? '')))
                        <a href="{{ $data->facebook_url }}" target="_blank" rel="noopener noreferrer" class="social-contact-pill social-pill-fb">
                            <i class="fa-brands fa-facebook-f fs-16"></i> Facebook
                        </a>
                        @endif
                    </div>
                    @endif

                    <div class="summary-divider" style="background-color: rgba(255,255,255,0.1); margin: 18px 0 12px;"></div>

                    <div class="fs-12 text-muted" style="color: #8C7564 !important;">
                        © {{ date('Y') }} All Rights Reserved | <strong>Food Junction</strong>
                    </div>

                    <div class="landing-legal-links">
                        <a href="{{ url('/') }}">Home</a>
                        <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
                        <a href="{{ url('/terms-and-conditions') }}">Terms and Conditions</a>
                        <a href="{{ url('/return-refund-policy') }}">Return & Refund Policy</a>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <!-- ══════════════════════════════════════════════════
         8. STICKY BOTTOM FLOATING ORDER BAR
         ══════════════════════════════════════════════════ -->
    <div id="stickyBottomBar" class="sticky-bottom-bar">
        <div class="sticky-bar-left">
            <span class="sticky-bar-label">স্পেশাল প্যাকেজ মূল্য</span>
            <span class="sticky-bar-price">৳<span id="sticky-price-display">{{ $data->offer_price ?? 0 }}</span></span>
        </div>
        <a href="#order-section" class="sticky-buy-btn">
            <i class="fa-solid fa-cart-shopping"></i> এখনই কিনুন
        </a>
    </div>

    <!-- Review Image Zoom Modal -->
    <div class="modal fade" id="reviewZoomModal" tabindex="-1" aria-labelledby="reviewZoomModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-body text-center p-0 position-relative">
                    <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close" style="z-index: 10; background-color: rgba(0,0,0,0.6); padding: 10px; border-radius: 50%;"></button>
                    <img id="modalReviewImg" src="" alt="Customer Review Zoom" class="review-modal-img shadow-lg">
                </div>
            </div>
        </div>
    </div>

@endsection
