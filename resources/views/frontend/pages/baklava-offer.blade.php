@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="{{ $data->offer_headline ?? '২০ পিস টার্কিশ বাকলাভার সাথে হাফকেজি পাবনার পেরা সন্দেশ ফ্রী!' }} {{ $data->offer_subtext ?? 'প্রিমিয়াম টার্কিশ ডেজার্ট এখন আপনার ঘরে।' }}">
    <meta name="keywords" content="Baklava Offer, Turkish Baklava, Pera Sandesh, Food Junction, Sweets Dhaka, Special Offer">
    <meta property="og:title" content="{{ $data->hero_title ?? 'Baklava Special Offer' }} | Food Junction">
    <meta property="og:description" content="{{ $data->offer_headline ?? '২০ পিস বাকলাভার সাথে হাফকেজি পাবনার পেরা সন্দেশ ফ্রী!' }}">
    <meta property="og:image" content="{{ !empty($data->hero_image) ? asset($data->hero_image) : asset('frontend/images/landing/baklava/hero_tray.png') }}">
@endsection

@section('title')
    {{ $data->hero_title ?? 'Baklava Special Offer' }} | Food Junction
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
                <div>
                    <span class="offer-tag-pill">
                        <i class="fa-solid fa-fire text-danger"></i> {{ $data->badge_text ?? '★ স্পেশাল ধামাকা অফার — সীমিত সময়ের জন্য ★' }}
                    </span>
                </div>

                <!-- Main Hook Title -->
                <h1 class="hero-main-title">
                    {{ $data->hero_title ?? 'তুরস্কের খাঁটি বাকলাভার সাথে পাচ্ছেন' }} <span class="fj-highlight-text">{{ $data->offer_headline ?? 'হাফকেজি পাবনার পেরা সন্দেশ ফ্রী!' }}</span>
                </h1>

                <p class="landing-section-subtitle">
                    {{ $data->offer_subtext ?? 'তুরস্কের অথেন্টিক এবং গ্রাম বাংলার ঐতিহ্যবাহী ১০০% খাঁটি স্বাদ — সবচেয়ে নরম ও মুচমুচে স্বাদে সেরা' }}
                </p>

                <!-- 3-Column Trust Guarantee Grid -->
                @php
                    $trustBadges = !empty($data->trust_badges) ? $data->trust_badges : \App\Models\BaklavaOffer::getDefaultTrustBadges();
                @endphp
                <div class="hero-trust-grid">
                    @foreach($trustBadges as $badge)
                        <div class="hero-trust-item">
                            <div class="hero-trust-icon"><i class="{{ $getIconClass($badge['icon'] ?? '', 'fa-solid fa-shield-halved') }}"></i></div>
                            <div class="hero-trust-text">{{ $badge['title'] ?? '' }}<br><small class="text-muted fw-normal">{{ $badge['subtitle'] ?? '' }}</small></div>
                        </div>
                    @endforeach
                </div>

                <!-- Hero Platter Photo -->
                <img src="{{ !empty($data->hero_image) ? asset($data->hero_image) : asset('frontend/images/landing/baklava/hero_tray.png') }}"
                     alt="Turkish Baklava and Pabna Pera Sandesh on Brass Tray"
                     class="hero-tray-img"
                     loading="eager" />

                <!-- Pricing Display -->
                <div class="hero-price-container">
                    <span class="hero-price-current">৳{{ $data->offer_price ?? 1350 }}</span>
                    <span class="hero-price-old">
                        ৳{{ $data->regular_price ?? 1850 }}
                        <svg class="strike-svg" viewBox="0 0 100 60" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M1,46 C24,32 44,36 64,25 C76,18 88,15 99,10" fill="none" stroke="#DC2626" stroke-width="3" vector-effect="non-scaling-stroke" stroke-linecap="round" />
                            <path d="M4,13 C26,26 48,31 70,39 C81,43 91,46 98,52" fill="none" stroke="#DC2626" stroke-width="2" stroke-opacity="0.7" vector-effect="non-scaling-stroke" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="save-badge">{{ $data->save_amount ?? '৫০০ টাকা ছাড়' }}</span>
                </div>

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
            <section class="bm-narrow-con my-4 text-center">
                <div class="micro-trust-banner">
                    <i class="fa-solid fa-truck-fast"></i> {{ $data->hero_video_banner ?? 'ক্যাশ অন ডেলিভারি · সারা দেশে দ্রুত হোম ডেলিভারি' }}
                </div>

                <h2 class="landing-section-title mt-2">
                    {{ $data->hero_video_title ?? 'ভিডিওতে দেখে নিন আমাদের খাঁটি বাকলাভা তৈরির রূপ' }}
                </h2>
                <p class="landing-section-subtitle">
                    {{ $data->hero_video_subtitle ?? '৬০ সেকেন্ডে দেখে নিন কীভাবে দেশি গাওয়া ঘি ও প্রিমিয়াম পেস্তা-কাজু দিয়ে তৈরি হয় আমাদের প্রতিটি বাকলাভা' }}
                </p>

                <!-- Video Showcase Box -->
                @if(!empty($data->video_url))
                <div class="video-showcase-box">
                    <video controls preload="metadata" playsinline class="landing-video-player" poster="{{ !empty($data->hero_image) ? asset($data->hero_image) : asset('frontend/images/landing/baklava/hero_tray.png') }}">
                        <source src="{{ $data->video_url }}" type="video/mp4" />
                        আপনার ব্রাউজারে ভিডিওটি প্লে হচ্ছে না।
                    </video>
                </div>
                @endif

                <!-- Problem Agitation Cards ("আপনার কি মিষ্টি কিনতে এই সমস্যাগুলো হয়?") -->
                <div class="mt-5">
                    <h3 class="landing-section-title fs-22 mb-1">{{ $data->problem_title ?? 'আপনার কি মিষ্টি কিনতে এই সমস্যাগুলো হয়?' }}</h3>
                    <p class="landing-section-subtitle mb-3">{{ $data->problem_subtitle ?? 'কেন সাধারণ মিষ্টি নয়, এখনই সঠিক সিদ্ধান্ত নেবেন' }}</p>

                    @php
                        $problemCards = !empty($data->problem_cards) ? $data->problem_cards : \App\Models\BaklavaOffer::getDefaultProblemCards();
                    @endphp
                    <div class="problem-cards-grid">
                        @foreach($problemCards as $pCard)
                            <div class="problem-card">
                                <div class="problem-icon-wrap"><i class="{{ $getIconClass($pCard['icon'] ?? '', 'fa-solid fa-triangle-exclamation') }}"></i></div>
                                <h4 class="problem-card-title">{{ $pCard['title'] ?? '' }}</h4>
                                <p class="problem-card-desc">{{ $pCard['desc'] ?? '' }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="my-3">
                        <a href="#comparison-section" class="landing-cta-btn">
                            <i class="fa-solid fa-arrow-down"></i> সমাধান দেখুন &bull; এখনই অফারটি নিন
                        </a>
                    </div>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 3. COMPARISON MATRIX SECTION (Ordinary vs FJ)
                 ══════════════════════════════════════════════════ -->
            <section id="comparison-section" class="bm-narrow-con my-5">
                <span class="d-block text-center offer-tag-pill">{{ $data->comparison_badge ?? 'পার্থক্য নিজেই যাচাই করুন' }}</span>
                <h2 class="landing-section-title">{{ $data->comparison_title ?? 'সাধারণ মিষ্টি বা বাকলাভা কেন সমাধান নয়?' }}</h2>
                <p class="landing-section-subtitle">{{ $data->comparison_subtitle ?? 'Food Junction এর প্রিমিয়াম প্যাকেজ কেন অন্যদের চেয়ে সম্পূর্ণ আলাদা ও অনন্য' }}</p>

                <div class="comparison-section-box">
                    <div class="comparison-header-row">
                        <div class="comp-col-header bad">
                            <i class="fa-solid fa-circle-xmark text-danger"></i> {{ $data->comparison_bad_header ?? 'সাধারণ রেগুলার মিষ্টি' }}
                        </div>
                        <div class="comp-col-header good">
                            <i class="fa-solid fa-circle-check text-success"></i> {{ $data->comparison_good_header ?? 'Food Junction বাকলাভা' }}
                        </div>
                    </div>

                    @php
                        $comparisonRows = !empty($data->comparison_rows) ? $data->comparison_rows : \App\Models\BaklavaOffer::getDefaultComparisonRows();
                    @endphp
                    @foreach($comparisonRows as $cRow)
                        <div class="comparison-body-row">
                            <div class="comp-cell bad">
                                <span class="comp-feature-label">{{ $cRow['label'] ?? '' }}</span>
                                <div><span class="comp-icon-cross">✕</span> {{ $cRow['bad'] ?? '' }}</div>
                            </div>
                            <div class="comp-cell good">
                                <span class="comp-feature-label">{{ $cRow['label'] ?? '' }}</span>
                                <div><span class="comp-icon-check">✓</span> {{ $cRow['good'] ?? '' }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-gift"></i> অফারটি লুফে নিন
                    </a>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 4. 3-STEP EXPERIENCE & FEATURE SHOWCASE
                 ══════════════════════════════════════════════════ -->
            <section class="bm-narrow-con my-5 text-center">
                <span class="offer-tag-pill">{{ $data->step_badge ?? '100% AUTHENTIC QUALITY' }}</span>
                <h2 class="landing-section-title">{{ $data->step_section_title ?? '৩০ সেকেন্ডে মুগ্ধ হবেন সেরা স্বাদে' }}</h2>
                <p class="landing-section-subtitle">{{ $data->step_section_subtitle ?? 'খাঁটি স্বাদ ও রাজকীয় আভিজাত্য — প্রতিটি কামড়ে তুর্কি ঐতিহ্যের অনন্য অনুভূতি' }}</p>

                <!-- Quick Feature Pills -->
                @php
                    $featurePills = !empty($data->feature_pills) ? $data->feature_pills : \App\Models\BaklavaOffer::getDefaultFeaturePills();
                @endphp
                <div class="quick-feature-pills-wrap">
                    @foreach($featurePills as $pill)
                        <div class="feature-pill-item"><i class="fa-solid fa-check"></i> {{ $pill }}</div>
                    @endforeach
                </div>

                <!-- 3-Step Numbered Cards -->
                @php
                    $processSteps = !empty($data->process_steps) ? $data->process_steps : \App\Models\BaklavaOffer::getDefaultProcessSteps();
                @endphp
                <div class="steps-grid-3">
                    @foreach($processSteps as $st)
                        <div class="step-card-item">
                            <div class="step-number-badge">{{ $st['num'] ?? '০১' }}</div>
                            <h3 class="step-card-title"><i class="{{ $getIconClass($st['icon'] ?? '', 'fa-solid fa-wand-magic-sparkles text-warning') }}"></i> {{ $st['title'] ?? '' }}</h3>
                            <p class="step-card-desc">{{ $st['desc'] ?? '' }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Collage Presentation Visual -->
                <div class="landing-collage-box">
                    <img src="{{ !empty($data->collage_image) ? asset($data->collage_image) : asset('frontend/images/landing/baklava/collage_box.jpg') }}"
                         alt="Royal Turkish dessert and pera sandesh gift box"
                         class="landing-collage-img"
                         loading="lazy" />
                </div>

                <!-- Ingredients Scroll Gallery -->
                <div class="my-4">
                    <h3 class="landing-section-title fs-22 mb-1">{{ $data->ingredient_title ?? '১০০% খাঁটি ও সেরা উপাদানসমূহ' }}</h3>
                    <p class="landing-section-subtitle mb-2">{{ $data->ingredient_subtitle ?? 'আমাদের প্রতিটি মিষ্টি প্রস্তুত হয় প্রাকৃতিক ও হাইজেনিক উপাদান দিয়ে' }}</p>

                    @php
                        $ingredients = !empty($data->ingredients) ? $data->ingredients : [
                            ['name' => 'দেশী গাওয়া ঘি', 'image' => 'frontend/images/landing/baklava/ing_ghee.jpg'],
                            ['name' => 'প্রিমিয়াম পেস্তা', 'image' => 'frontend/images/landing/baklava/ing_pista.jpg'],
                            ['name' => 'জাম্বু কাজু', 'image' => 'frontend/images/landing/baklava/ing_kaju.jpg'],
                            ['name' => 'প্রাকৃতিক মধু', 'image' => 'frontend/images/landing/baklava/ing_honey.jpg'],
                            ['name' => 'প্রিমিয়াম ফ্লাওয়ার', 'image' => 'frontend/images/landing/baklava/ing_flour.jpg'],
                        ];
                    @endphp

                    <div class="ingredients-scroll-container">
                        @foreach($ingredients as $ing)
                            <div class="ingredient-card">
                                <img src="{{ asset($ing['image']) }}" alt="{{ $ing['name'] }}" class="ingredient-img" loading="lazy">
                                <div class="ingredient-caption">{{ $ing['name'] }}</div>
                            </div>
                        @endforeach
                    </div>

                    <div class="scroll-hint-bar">
                        <i class="fa-solid fa-chevron-left"></i>
                        <span>সাইডে স্ক্রল করে উপাদানগুলো দেখুন</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>

                <!-- Checklist Highlight Bar -->
                @php
                    $checklistItems = !empty($data->checklist_items) ? $data->checklist_items : \App\Models\BaklavaOffer::getDefaultChecklistItems();
                @endphp
                <div class="checklist-pills-bar">
                    @foreach($checklistItems as $chk)
                        <div class="checklist-pill-item"><i class="fa-solid fa-circle-check"></i> <span>{{ $chk }}</span></div>
                    @endforeach
                </div>

                <div class="my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> এখনই অর্ডার করুন
                    </a>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 5. DUAL BENEFIT + RATING STATS + REVIEWS + TIMER
                 ══════════════════════════════════════════════════ -->
            <section class="bm-narrow-con my-5 text-center">
                <!-- Dual Benefit Box (Baklava vs Pera Sandesh) -->
                <h2 class="landing-section-title">{{ $data->benefit_section_title ?? 'স্বাদ ও সন্তুষ্টির অনন্য অভিজ্ঞতা' }}</h2>
                <p class="landing-section-subtitle">{{ $data->benefit_section_subtitle ?? 'দুটি অনন্য ঐতিহ্যের রাজকীয় স্বাদ একসাথে উপভোগ করুন' }}</p>

                <div class="dual-benefit-grid">
                    <div class="dual-benefit-card">
                        <div class="dual-benefit-header">
                            <span class="fs-22">👑</span>
                            <h4>{{ $data->dual_benefit_1_title ?? 'টার্কিশ বাকলাভা' }}</h4>
                        </div>
                        <div class="benefit-item-row neg">
                            <i class="fa-solid fa-xmark text-danger"></i> <span>{{ $data->dual_benefit_1_neg ?? 'সাধারণ মিষ্টির মতো অতিরিক্ত কড়া বা ভারী লাগে না' }}</span>
                        </div>
                        <div class="benefit-item-row pos">
                            <i class="fa-solid fa-check text-success"></i> <span>{{ $data->dual_benefit_1_pos ?? 'পেস্তা-কাজুর মুচমুচে ক্রাঞ্চ ও খাঁটি ঘৃত সুবাসে ভরপুর' }}</span>
                        </div>
                    </div>

                    <div class="dual-benefit-card">
                        <div class="dual-benefit-header">
                            <span class="fs-22">🍯</span>
                            <h4>{{ $data->dual_benefit_2_title ?? 'পাবনার পেরা সন্দেশ' }}</h4>
                        </div>
                        <div class="benefit-item-row neg">
                            <i class="fa-solid fa-xmark text-danger"></i> <span>{{ $data->dual_benefit_2_neg ?? 'বাজারে পাউডার দুধের কৃত্রিম ক্ষীর নয়' }}</span>
                        </div>
                        <div class="benefit-item-row pos">
                            <i class="fa-solid fa-check text-success"></i> <span>{{ $data->dual_benefit_2_pos ?? 'খাঁটি তরল দুধ ঘণ্টার পর ঘণ্টা জ্বাল দিয়ে তৈরি শতাব্দী প্রাচীন ঐতিহ্য' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Trust Stats Widget (bedamanush dark style) -->
                <div class="custom-review-widget">
                    <div class="review-summary-card">
                        <div class="summary-top">
                            <div class="rating-big-box">
                                <div class="big-rating">{{ $data->rating_score ?? '৪.৯' }}</div>
                                <div class="stars-gold">★★★★★</div>
                                <div class="total-reviews">{{ $data->total_reviews_count ?? '৫,২৩০+ রিভিউ' }}</div>
                            </div>
                            @php
                                $breakdown = !empty($data->rating_breakdown) ? $data->rating_breakdown : \App\Models\BaklavaOffer::getDefaultRatingBreakdown();
                            @endphp
                            <div class="progress-bars-container">
                                @foreach($breakdown as $bRow)
                                    <div class="bar-row">
                                        <span class="star-num">{{ $bRow['star'] ?? 5 }}</span>
                                        <span class="star-icon">★</span>
                                        <div class="bar-bg"><div class="bar-fill" style="width: {{ $bRow['percent'] ?? 0 }}%;"></div></div>
                                        <span class="bar-percent">{{ $bRow['percent'] ?? 0 }}%</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="summary-divider"></div>
                        <div class="delivery-text">
                            <i class="fa-solid fa-box-open text-warning me-1"></i> {{ $data->delivered_orders_text ?? 'সারা বাংলাদেশে ৬,০০০+ সফল ডেলিভার্ড অর্ডার' }}
                        </div>
                    </div>

                    <!-- Verified Customer Testimonial Cards -->
                    @php
                        $testimonials = !empty($data->testimonials) ? $data->testimonials : \App\Models\BaklavaOffer::getDefaultTestimonials();
                    @endphp
                    @foreach($testimonials as $t)
                        <div class="single-review-card">
                            <div class="user-avatar-circle">{{ $t['avatar_letter'] ?? 'ক' }}</div>
                            <div class="review-content">
                                <div class="user-header">
                                    <span class="user-name">{{ $t['name'] ?? '' }}</span>
                                    @if(!empty($t['location']))
                                        <span class="user-location">· {{ $t['location'] }}</span>
                                    @endif
                                    <span class="verified-badge"><i class="fa-solid fa-circle-check"></i> ভেরিফায়েড ক্রেতা</span>
                                </div>
                                <div class="user-stars">{{ $t['stars'] ?? '★★★★★' }}</div>
                                <p class="review-text">“{{ $t['text'] ?? '' }}”</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Customer Real Screenshot Reviews -->
                @php
                    $reviews = $data->reviews ?? [];
                    if (empty($reviews)) {
                        for ($i = 1; $i <= 15; $i++) {
                            $reviews[] = "frontend/images/landing/baklava/review_{$i}.jpg";
                        }
                    }
                @endphp

                <div class="my-4">
                    <span class="offer-tag-pill">গ্রাহক সন্তুষ্টি আমাদের অহংকার</span>
                    <h3 class="landing-section-title fs-22 mb-1">{{ $data->reviews_title ?? 'বাস্তব গ্রাহকদের পাঠানো রিভিউসমূহ' }}</h3>
                    <p class="landing-section-subtitle mb-2">{{ $data->reviews_subtitle ?? 'ছবিতে ট্যাপ করে বড় করে দেখুন' }}</p>

                    <div class="reviews-scroll-container">
                        @foreach($reviews as $revIdx => $revPath)
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
                        <span>{{ count($reviews) }}টি স্ক্রিনশট — সাইডে স্ক্রল করে দেখুন</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>

                <!-- Live Countdown Timer Widget -->
                @php
                    $endTimeIso = !empty($data->countdown_end_time) ? \Carbon\Carbon::parse($data->countdown_end_time)->toIso8601String() : '';

                    // Calculate initial remaining values for server-side render
                    $initTotalSeconds = 0;
                    if (!empty($data->countdown_end_time)) {
                        $targetCarbon = \Carbon\Carbon::parse($data->countdown_end_time);
                        $initTotalSeconds = max(0, now()->diffInSeconds($targetCarbon, false));
                    } else {
                        // Default fallback: 24-hour urgency countdown
                        $initTotalSeconds = 86400;
                    }

                    $calcDays = (int)floor($initTotalSeconds / 86400);
                    $calcHours = (int)floor(($initTotalSeconds % 86400) / 3600);
                    $calcMinutes = (int)floor(($initTotalSeconds % 3600) / 60);
                    $calcSeconds = (int)($initTotalSeconds % 60);
                @endphp
                <div class="custom-timer-widget"
                     data-end-time="{{ $endTimeIso }}">
                    <div class="timer-badge">
                        <i class="fa-solid fa-stopwatch"></i> {{ $data->timer_badge ?? 'অফার শেষ হতে বাকি' }}
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

                <div class="my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-bolt"></i> অর্ডার কনফার্ম করতে এখানে ক্লিক করুন
                    </a>
                </div>
            </section>

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
                            <img src="{{ !empty($data->hero_image) ? asset($data->hero_image) : asset('frontend/images/landing/baklava/hero_tray.png') }}"
                                 alt="Package Thumbnail"
                                 class="package-thumb-img">
                            <div>
                                <h4 class="fw-bold text-dark mb-1 fs-16">
                                    {{ $data->package_title ?? '২০ পিস টার্কিশ বাকলাভা + হাফকেজি পাবনার পেরা সন্দেশ (ফ্রী)' }}
                                </h4>
                                <p class="text-muted mb-0 fs-13">
                                    {{ $data->package_subtitle ?? 'সম্পূর্ণ প্রিমিয়াম গিফট বক্স প্যাকেজিং সহ' }}
                                </p>
                            </div>
                        </div>

                        <div class="text-end ms-auto">
                            <div class="fs-22 fw-bold" style="color: var(--fj-amber);">
                                ৳ <span id="unit-price-display">{{ $data->offer_price ?? 1350 }}</span>
                            </div>
                            <del class="text-muted fs-13">৳ {{ $data->regular_price ?? 1850 }}</del>
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
                <form id="baklava-direct-order-form" action="{{ route('special-offer.direct-order') }}" method="POST" data-unit-price="{{ $data->offer_price ?? 1350 }}" data-whatsapp="{{ $data->whatsapp_number ?? '8801672756634' }}" data-package-name="{{ $data->package_title ?? '২০ পিস বাকলাভা + হাফকেজি পেরা সন্দেশ ফ্রী' }}" data-default-delivery="{{ $data->inside_dhaka_delivery_fee ?? 80 }}">
                    @csrf
                    <input type="hidden" name="offer_id" value="{{ $data->id ?? '' }}">
                    <input type="hidden" name="offer_slug" value="{{ $data->slug ?? 'baklava-offer' }}">
                    <input type="hidden" name="product_id" value="{{ $data->product_id ?? $baklavaProduct?->id ?? $defaultProduct?->id ?? '' }}">
                    <input type="hidden" name="variant_id" value="{{ $data->variant_id ?? $baklavaProduct?->variants?->first()?->id ?? $defaultProduct?->variants?->first()?->id ?? '' }}">
                    <input type="hidden" id="form-quantity" name="quantity" value="1">

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

                        <!-- Terms & Conditions Checkbox -->
                        <div class="col-12 mt-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('all_terms') is-invalid @enderror" name="all_terms" id="all_terms" value="yes" checked required>
                                <label for="all_terms" class="form-check-label fw-semibold text-dark fs-13">
                                    আমি সকল শর্তাবলী এবং রিটার্ন পলিসিতে সম্মতি প্রদান করছি <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('all_terms')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Live Order Summary Box -->
                    <div class="order-summary-box">
                        <div class="order-summary-row">
                            <span class="text-muted">প্যাকেজ মূল্য (<span id="summary-qty">১</span> টি):</span>
                            <span class="fw-bold">৳ <span id="summary-subtotal">{{ $data->offer_price ?? 1350 }}</span></span>
                        </div>
                        <div class="order-summary-row">
                            <span class="text-muted">ডেলিভারি চার্জ:</span>
                            <span class="fw-bold">৳ <span id="summary-delivery">{{ $data->inside_dhaka_delivery_fee ?? 80 }}</span></span>
                        </div>
                        <div class="order-summary-total">
                            <span>সর্বমোট পরিশোধযোগ্য:</span>
                            <span>৳ <span id="summary-grand-total">{{ ($data->offer_price ?? 1350) + ($data->inside_dhaka_delivery_fee ?? 80) }}</span></span>
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
                <div class="mt-3 text-center">
                    <p class="text-muted fs-13 mb-1">অথবা সরাসরি হোয়াটসঅ্যাপে অর্ডার করতে চান?</p>
                    <a id="whatsapp-order-link" href="https://wa.me/{{ $data->whatsapp_number ?? '8801672756634' }}?text=Hello%20Food%20Junction,%20I%20want%20to%20order%20the%20Baklava%20Special%20Offer."
                       target="_blank"
                       rel="noopener noreferrer"
                       class="whatsapp-order-btn">
                        <i class="fa-brands fa-whatsapp fs-20"></i> হোয়াটসঅ্যাপে অর্ডার করুন
                    </a>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 7. CONTACT, SOCIALS & FOOTER SECTION
                 ══════════════════════════════════════════════════ -->
            <section class="bm-narrow-con">
                <div class="landing-contact-card">
                    <h3 class="fs-20 fw-bold mb-2">কোনো কিছু জানতে কিংবা সরাসরি অর্ডার করতে যোগাযোগ করুন</h3>
                    <p class="text-muted fs-13 mb-3" style="color: #A89587 !important;">আমরা সপ্তাহে ৭ দিন সকাল ৯টা থেকে রাত ১১টা পর্যন্ত আপনার সেবায় নিয়োজিত</p>

                    <div class="social-contact-btns-wrap">
                        <a href="https://wa.me/{{ $data->whatsapp_number ?? '8801672756634' }}" target="_blank" rel="noopener noreferrer" class="social-contact-pill social-pill-wa">
                            <i class="fa-brands fa-whatsapp fs-18"></i> WhatsApp
                        </a>
                        <a href="tel:{{ $data->phone_number ?? $data->whatsapp_number ?? '8801672756634' }}" class="social-contact-pill social-pill-phone">
                            <i class="fa-solid fa-phone fs-16"></i> Call Now
                        </a>
                        <a href="{{ $data->facebook_url ?? 'https://www.facebook.com' }}" target="_blank" rel="noopener noreferrer" class="social-contact-pill social-pill-fb">
                            <i class="fa-brands fa-facebook-f fs-16"></i> Facebook
                        </a>
                    </div>

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
         8. STICKY BOTTOM FLOATING ORDER BAR (bedamanush style)
         ══════════════════════════════════════════════════ -->
    <div id="stickyBottomBar" class="sticky-bottom-bar">
        <div class="sticky-bar-left">
            <span class="sticky-bar-label">স্পেশাল প্যাকেজ মূল্য</span>
            <span class="sticky-bar-price">৳<span id="sticky-price-display">{{ $data->offer_price ?? 1350 }}</span></span>
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

