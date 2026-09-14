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

@push('styles')
<style>
    /* ==========================================================================
       Baklava Offer Landing Page Styles - Food Junction Brand
       ========================================================================== */
    :root {
        --fj-gold: #FD9325;
        --fj-red: #FF2D20;
        --fj-gradient: linear-gradient(135deg, #FD9325 0%, #EE3441 100%);
        --fj-gradient-hover: linear-gradient(135deg, #EE3441 0%, #FD9325 100%);
        --fj-dark: #2B1810;
        --fj-brown: #3B2415;
        --fj-warm-brown: #5D4230;
        --fj-cream: #FAF5EC;
        --fj-card-bg: rgba(255, 250, 240, 0.85);
        --fj-border: #E8DCBF;
        --fj-accent-red: #D32F2F;
    }

    .baklava-landing-wrapper {
        background-color: #FBF8F2;
        background-image: url('{{ asset("frontend/images/landing/baklava/bg_texture.webp") }}');
        background-repeat: repeat;
        color: var(--fj-brown);
        font-family: 'Nirmala UI', 'Hind Siliguri', 'Segoe UI', sans-serif;
        line-height: 1.6;
        padding-bottom: 60px;
    }

    /* Container constraint */
    .baklava-container {
        max-width: 1080px;
        margin: 0 auto;
        padding: 0 16px;
    }

    /* Common Section Headings */
    .landing-section-title {
        font-family: 'Georgia', 'Nirmala UI', serif;
        font-weight: 800;
        font-size: clamp(22px, 4.5vw, 36px);
        color: var(--fj-dark);
        line-height: 1.3;
        margin-bottom: 12px;
        text-align: center;
    }

    .landing-section-subtitle {
        font-size: clamp(13px, 2.8vw, 16px);
        color: var(--fj-warm-brown);
        text-align: center;
        margin-bottom: 24px;
        font-style: italic;
    }

    /* Pulse CTA Button */
    .landing-cta-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: var(--fj-gradient);
        color: #ffffff !important;
        font-weight: 700;
        font-size: clamp(15px, 3.5vw, 18px);
        letter-spacing: 0.05em;
        padding: 14px 42px;
        border-radius: 50px;
        text-decoration: none;
        box-shadow: 0 8px 24px rgba(238, 52, 65, 0.35);
        transition: all 0.35s ease;
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .landing-cta-btn:hover {
        background: var(--fj-gradient-hover);
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 12px 30px rgba(238, 52, 65, 0.45);
        color: #ffffff !important;
    }

    .landing-cta-btn::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -60%;
        width: 40px;
        height: 200%;
        background: rgba(255, 255, 255, 0.3);
        transform: rotate(30deg);
        animation: ctaShine 3.5s infinite linear;
    }

    @keyframes ctaShine {
        0% { left: -60%; }
        25% { left: 130%; }
        100% { left: 130%; }
    }

    /* Badge Pills */
    .offer-tag-pill {
        display: inline-block;
        background: rgba(253, 147, 37, 0.15);
        border: 1px solid rgba(253, 147, 37, 0.4);
        color: #C2410C;
        font-weight: 700;
        font-size: 13px;
        padding: 6px 18px;
        border-radius: 30px;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 12px;
    }

    /* Hero Section */
    .baklava-hero-section {
        padding: 30px 0 20px;
        text-align: center;
    }

    .hero-main-title {
        font-family: 'Georgia', 'Times New Roman', serif;
        font-weight: 800;
        font-size: clamp(24px, 5.5vw, 44px);
        color: var(--fj-dark);
        line-height: 1.25;
        margin: 10px auto 16px;
        max-width: 820px;
    }

    .hero-offer-headline {
        font-family: 'Georgia', 'Nirmala UI', serif;
        font-weight: 800;
        font-size: clamp(20px, 4.8vw, 36px);
        color: var(--fj-accent-red);
        background: linear-gradient(135deg, #B91C1C, #EA580C);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.35;
        margin: 18px auto 8px;
        max-width: 720px;
    }

    .hero-tray-img {
        width: 100%;
        max-width: 840px;
        height: auto;
        display: block;
        margin: 16px auto;
        filter: drop-shadow(0 12px 28px rgba(59, 36, 21, 0.18));
        transition: transform 0.4s ease;
    }

    .hero-tray-img:hover {
        transform: scale(1.015);
    }

    /* Price Tag Display */
    .hero-price-container {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 12px;
        margin: 20px 0 22px;
        font-family: 'Georgia', 'Nirmala UI', serif;
    }

    .hero-price-current {
        font-size: clamp(28px, 6.5vw, 42px);
        font-weight: 800;
        color: #C2410C;
    }

    .hero-price-old {
        position: relative;
        font-size: clamp(20px, 4.5vw, 28px);
        color: #8A6854;
        font-weight: 600;
        padding: 0 10px;
    }

    .strike-svg {
        position: absolute;
        left: -10%;
        top: -20%;
        width: 120%;
        height: 140%;
        pointer-events: none;
    }

    .hero-price-unit {
        font-size: clamp(20px, 4.5vw, 26px);
        color: var(--fj-dark);
        font-weight: 700;
    }

    .save-badge {
        background: #16A34A;
        color: #ffffff;
        font-size: 13px;
        font-weight: 700;
        padding: 4px 12px;
        border-radius: 20px;
        margin-left: 6px;
    }

    /* Video Section */
    .landing-video-card {
        background: #18110D;
        border-radius: 16px;
        overflow: hidden;
        border: 2px solid rgba(253, 147, 37, 0.35);
        box-shadow: 0 16px 36px rgba(43, 24, 16, 0.25);
        margin: 35px auto 25px;
        max-width: 780px;
        position: relative;
    }

    .landing-video-player {
        width: 100%;
        aspect-ratio: 1 / 1;
        max-height: 540px;
        object-fit: cover;
        display: block;
    }

    /* Collage Presentation Section */
    .landing-collage-box {
        margin: 40px auto 25px;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 32px rgba(59, 36, 21, 0.15);
        border: 1px solid var(--fj-border);
        background: #ffffff;
    }

    .landing-collage-img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Ingredients Horizontal Scroll */
    .ingredients-scroll-container {
        display: flex;
        gap: 16px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        padding: 10px 4px 20px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: var(--fj-gold) #EADFCB;
    }

    .ingredients-scroll-container::-webkit-scrollbar {
        height: 6px;
    }
    .ingredients-scroll-container::-webkit-scrollbar-thumb {
        background: var(--fj-gold);
        border-radius: 10px;
    }
    .ingredients-scroll-container::-webkit-scrollbar-track {
        background: #EADFCB;
        border-radius: 10px;
    }

    .ingredient-card {
        flex: 0 0 clamp(230px, 60vw, 320px);
        scroll-snap-align: center;
        background: #ffffff;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 6px 18px rgba(59, 36, 21, 0.08);
        border: 1px solid var(--fj-border);
        position: relative;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .ingredient-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(59, 36, 21, 0.14);
    }

    .ingredient-img {
        width: 100%;
        aspect-ratio: 16/10;
        object-fit: cover;
        display: block;
    }

    .ingredient-caption {
        position: absolute;
        left: 0;
        bottom: 0;
        right: 0;
        background: linear-gradient(to top, rgba(43, 24, 16, 0.9) 0%, rgba(43, 24, 16, 0.4) 70%, transparent 100%);
        color: #ffffff;
        padding: 16px 14px 10px;
        font-family: 'Georgia', 'Nirmala UI', serif;
        font-size: clamp(16px, 3.2vw, 20px);
        font-weight: 700;
        text-align: center;
    }

    .scroll-hint-bar {
        font-size: 12px;
        color: var(--fj-warm-brown);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        margin-top: 6px;
        font-weight: 600;
    }

    /* Trust Badges Grid */
    .trust-badges-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 14px;
        margin: 30px 0 20px;
    }

    .trust-badge-item {
        background: var(--fj-card-bg);
        backdrop-filter: blur(8px);
        border: 1px solid var(--fj-border);
        border-radius: 12px;
        padding: 16px 14px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: all 0.3s ease;
    }

    .trust-badge-item:hover {
        transform: translateY(-2px);
        border-color: var(--fj-gold);
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(253, 147, 37, 0.12);
    }

    .trust-icon-box {
        width: 42px;
        height: 42px;
        min-width: 42px;
        border-radius: 50%;
        background: var(--fj-gradient);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        box-shadow: 0 4px 10px rgba(238, 52, 65, 0.25);
    }

    .trust-badge-text {
        font-size: clamp(12.5px, 2.6vw, 14px);
        font-weight: 700;
        color: var(--fj-dark);
        line-height: 1.35;
    }

    /* Reviews Horizontal Scroll */
    .reviews-scroll-container {
        display: flex;
        gap: 14px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        padding: 10px 4px 20px;
        -webkit-overflow-scrolling: touch;
        scrollbar-width: thin;
        scrollbar-color: var(--fj-gold) #EADFCB;
    }

    .review-screenshot-card {
        flex: 0 0 clamp(150px, 28vw, 195px);
        scroll-snap-align: start;
        background: #ffffff;
        border-radius: 12px;
        padding: 6px;
        box-shadow: 0 4px 14px rgba(59, 36, 21, 0.08);
        border: 1px solid var(--fj-border);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        text-decoration: none;
    }

    .review-screenshot-card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 24px rgba(253, 147, 37, 0.2);
    }

    .review-screenshot-img {
        width: 100%;
        aspect-ratio: 9/16;
        object-fit: cover;
        object-position: top;
        border-radius: 8px;
        display: block;
    }

    /* Why Section Split Box */
    .why-story-box {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(59, 36, 21, 0.1);
        border: 1px solid var(--fj-border);
        display: grid;
        grid-template-columns: 1fr 1fr;
        align-items: center;
        margin: 30px 0;
    }

    @media (max-width: 768px) {
        .why-story-box {
            grid-template-columns: 1fr;
        }
    }

    .why-story-img {
        width: 100%;
        height: 100%;
        min-height: 280px;
        object-fit: cover;
        display: block;
    }

    .why-story-content {
        padding: clamp(24px, 5vw, 42px);
        text-align: left;
    }

    .why-story-icon {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: var(--fj-gradient);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-bottom: 16px;
        box-shadow: 0 6px 14px rgba(238, 52, 65, 0.3);
    }

    .why-story-title {
        font-family: 'Georgia', 'Nirmala UI', serif;
        font-size: clamp(18px, 3.8vw, 24px);
        font-weight: 800;
        color: var(--fj-dark);
        margin-bottom: 12px;
    }

    .why-story-line {
        width: 44px;
        height: 3px;
        background: var(--fj-gold);
        border-radius: 4px;
        margin-bottom: 14px;
    }

    .why-story-desc {
        font-size: clamp(13px, 2.5vw, 15px);
        color: var(--fj-warm-brown);
        line-height: 1.7;
    }

    /* Feature 2-Column Banner */
    .delivery-guarantee-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
        margin: 24px 0 35px;
    }

    @media (max-width: 576px) {
        .delivery-guarantee-grid {
            grid-template-columns: 1fr;
        }
    }

    .guarantee-card {
        background: var(--fj-card-bg);
        border: 1px solid var(--fj-border);
        border-radius: 12px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 14px;
        text-align: left;
    }

    /* Fast Direct Order Form Section */
    .landing-order-section {
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 16px 40px rgba(59, 36, 21, 0.12);
        border: 2px solid var(--fj-border);
        padding: clamp(24px, 5vw, 44px);
        margin: 40px 0 20px;
        position: relative;
    }

    .landing-order-header {
        text-align: center;
        margin-bottom: 30px;
        position: relative;
    }

    .order-header-badge {
        display: inline-block;
        background: var(--fj-gradient);
        color: #ffffff;
        font-weight: 700;
        font-size: 13px;
        padding: 6px 20px;
        border-radius: 30px;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .package-select-box {
        background: rgba(253, 147, 37, 0.08);
        border: 2px solid var(--fj-gold);
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 24px;
        position: relative;
    }

    .package-popular-ribbon {
        position: absolute;
        top: -12px;
        right: 18px;
        background: var(--fj-accent-red);
        color: #ffffff;
        font-size: 11px;
        font-weight: 800;
        padding: 3px 12px;
        border-radius: 12px;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .qty-control-btn {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background: var(--fj-gradient);
        color: #ffffff;
        border: none;
        font-size: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.2s;
    }

    .qty-control-btn:hover {
        transform: scale(1.08);
    }

    .qty-input-field {
        width: 55px;
        text-align: center;
        font-size: 18px;
        font-weight: 700;
        border: 1px solid var(--fj-border);
        border-radius: 8px;
        margin: 0 6px;
    }

    .order-summary-box {
        background: #FFFDF9;
        border: 1px dashed var(--fj-gold);
        border-radius: 12px;
        padding: 16px 20px;
        margin: 20px 0;
    }

    .order-summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 15px;
    }

    .order-summary-total {
        display: flex;
        justify-content: space-between;
        padding-top: 10px;
        border-top: 1px solid var(--fj-border);
        font-size: 19px;
        font-weight: 800;
        color: var(--fj-accent-red);
    }

    .form-floating-custom .form-control,
    .form-floating-custom .form-select {
        border: 1.5px solid var(--fj-border);
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 15px;
    }

    .form-floating-custom .form-control:focus,
    .form-floating-custom .form-select:focus {
        border-color: var(--fj-gold);
        box-shadow: 0 0 0 4px rgba(253, 147, 37, 0.15);
    }

    /* WhatsApp Order Button */
    .whatsapp-order-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: #25D366;
        color: #ffffff !important;
        font-weight: 700;
        font-size: 16px;
        padding: 12px 28px;
        border-radius: 50px;
        text-decoration: none;
        width: 100%;
        margin-top: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(37, 211, 102, 0.3);
    }

    .whatsapp-order-btn:hover {
        background: #20BA5A;
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(37, 211, 102, 0.4);
    }

    /* Modal for Review Zoom */
    .review-modal-img {
        max-width: 100%;
        max-height: 85vh;
        object-fit: contain;
        border-radius: 10px;
    }
</style>
@endpush

@section('content')

    @include('frontend.includes.top-nav-button')

    <div class="baklava-landing-wrapper">
        <div class="baklava-container">

            <!-- ══════════════════════════════════════════════════
                 1. HERO SECTION
                 ══════════════════════════════════════════════════ -->
            <section class="baklava-hero-section">
                <span class="offer-tag-pill">{{ $data->badge_text ?? '★ স্পেশাল ধামাকা অফার — সীমিত সময়ের জন্য ★' }}</span>

                <h1 class="hero-main-title">
                    {{ $data->hero_title ?? 'Premium Turkish Dessert, now at your home.' }}
                </h1>

                <!-- Hero Platter Photo -->
                <img src="{{ !empty($data->hero_image) ? asset($data->hero_image) : asset('frontend/images/landing/baklava/hero_tray.png') }}"
                     alt="Turkish Baklava and Pabna Pera Sandesh on Brass Tray"
                     class="hero-tray-img"
                     loading="eager" />

                <!-- Bengali Main Offer Headline -->
                <h2 class="hero-offer-headline">
                    {{ $data->offer_headline ?? '২০ পিস বাকলাভার সাথে হাফকেজি পাবনার পেরা সন্দেশ ফ্রী!' }}
                </h2>

                <p class="landing-section-subtitle">
                    {{ $data->offer_subtext ?? 'তুরস্কের অথেন্টিক এবং গ্রাম বাংলার ঐতিহ্যবাহী স্বাদ এখন একসাথে' }}
                </p>

                <!-- Pricing Display -->
                <div class="hero-price-container">
                    <span class="hero-price-current">{{ $data->offer_price ?? 1350 }}</span>
                    <span class="hero-price-old">
                        {{ $data->regular_price ?? 1850 }}
                        <svg class="strike-svg" viewBox="0 0 100 60" preserveAspectRatio="none" aria-hidden="true">
                            <path d="M1,46 C24,32 44,36 64,25 C76,18 88,15 99,10" fill="none" stroke="#C2410C" stroke-width="3" vector-effect="non-scaling-stroke" stroke-linecap="round" />
                            <path d="M4,13 C26,26 48,31 70,39 C81,43 91,46 98,52" fill="none" stroke="#C2410C" stroke-width="2" stroke-opacity="0.7" vector-effect="non-scaling-stroke" stroke-linecap="round" />
                        </svg>
                    </span>
                    <span class="hero-price-unit">টাকা</span>
                    <span class="save-badge">{{ $data->save_amount ?? '৫০০ টাকা ছাড়' }}</span>
                </div>

                <!-- Primary Action Button -->
                <div class="my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> ORDER NOW — অর্ডার করুন
                    </a>
                </div>

                <!-- Video Player Card -->
                @if(!empty($data->video_url))
                <div class="landing-video-card">
                    <video controls preload="metadata" playsinline class="landing-video-player" poster="{{ !empty($data->hero_image) ? asset($data->hero_image) : asset('frontend/images/landing/baklava/hero_tray.png') }}">
                        <source src="{{ $data->video_url }}" type="video/mp4" />
                        আপনার ব্রাউজারে ভিডিওটি প্লে হচ্ছে না।
                    </video>
                </div>
                @endif

                <div class="mt-4 mb-2 text-center">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-bolt"></i> এখনই অর্ডার করতে ক্লিক করুন
                    </a>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 2. COLLAGE / PRESENTATION SECTION
                 ══════════════════════════════════════════════════ -->
            <section class="my-4">
                <div class="landing-collage-box">
                    <img src="{{ !empty($data->collage_image) ? asset($data->collage_image) : asset('frontend/images/landing/baklava/collage_box.jpg') }}"
                         alt="Royal Turkish dessert and pera sandesh gift box"
                         class="landing-collage-img"
                         loading="lazy" />
                </div>
                <div class="text-center my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-gift"></i> অফারটি লুফে নিন
                    </a>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 3. INGREDIENTS SECTION
                 ══════════════════════════════════════════════════ -->
            <section class="my-5 text-center">
                <span class="offer-tag-pill">১০০% খাঁটি ও স্বাস্থ্যসম্মত</span>
                <h2 class="landing-section-title">{{ $data->ingredient_title ?? 'INGREDIENTS' }}</h2>
                <p class="landing-section-subtitle">{{ $data->ingredient_subtitle ?? 'আমাদের প্রতিটি বাকলাভা প্রস্তুত হয় সেরা ও প্রাকৃতিক উপাদান দিয়ে' }}</p>

                @php
                    $ingredients = $data->ingredients ?? [
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
                    <span>সাইডে স্ক্রল করুন</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 4. TRUST BADGES
                 ══════════════════════════════════════════════════ -->
            @php
                $trustBadges = $data->trust_badges ?? [
                    ['title' => 'Handmade in Bangladesh', 'subtitle' => 'সম্পূর্ণ হাতে তৈরি ফ্রেশ', 'icon' => 'fa-hands-holding'],
                    ['title' => 'Premium Gift Packaging', 'subtitle' => 'আকর্ষণীয় গিফট বক্স ফ্রি', 'icon' => 'fa-gift'],
                    ['title' => 'Carefully Finished by Hand', 'subtitle' => 'নিখুঁত ও হাইজেনিক ফিনিশ', 'icon' => 'fa-medal'],
                    ['title' => 'Nationwide Delivery', 'subtitle' => 'সারাদেশে হোম ডেলিভারি', 'icon' => 'fa-truck-fast'],
                ];
            @endphp

            <section class="trust-badges-grid">
                @foreach($trustBadges as $badge)
                    <div class="trust-badge-item">
                        <div class="trust-icon-box"><i class="fa-solid {{ $badge['icon'] ?? 'fa-check' }}"></i></div>
                        <div class="trust-badge-text">{{ $badge['title'] ?? '' }}<br><small class="text-muted fw-normal">{{ $badge['subtitle'] ?? '' }}</small></div>
                    </div>
                @endforeach
            </section>

            <!-- ══════════════════════════════════════════════════
                 5. REVIEWS SECTION
                 ══════════════════════════════════════════════════ -->
            @php
                $reviews = $data->reviews ?? [];
                if (empty($reviews)) {
                    for ($i = 1; $i <= 15; $i++) {
                        $reviews[] = "frontend/images/landing/baklava/review_{$i}.jpg";
                    }
                }
            @endphp

            <section class="my-5 text-center">
                <span class="offer-tag-pill">গ্রাহক সন্তুষ্টি আমাদের অহংকার</span>
                <h2 class="landing-section-title">{{ $data->reviews_title ?? 'Trusted by 5000+ Happy Customers' }}</h2>
                <p class="landing-section-subtitle">{{ $data->reviews_subtitle ?? 'আমাদের নিয়মিত গ্রাহকদের পাঠানো বাস্তব রিভিউ স্ক্রিনশটসমূহ' }}</p>

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
                    <span>{{ count($reviews) }}টি রিভিউ — সাইডে স্ক্রল করে দেখুন ও ট্যাপ করে বড় করুন</span>
                    <i class="fa-solid fa-chevron-right"></i>
                </div>

                <div class="my-4">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> ORDER NOW — অর্ডার করুন
                    </a>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 6. WHY WE MADE THIS STORY SECTION
                 ══════════════════════════════════════════════════ -->
            <section class="my-5">
                <h2 class="landing-section-title">{{ $data->why_title ?? 'Why We Made This?' }}</h2>
                <p class="landing-section-subtitle">{{ $data->why_subtitle ?? 'Food Junction এ আমরা বিশ্বাস করি প্রতিটি মিষ্টির সাথে জড়িয়ে থাকে ভালোবাসার গল্প' }}</p>

                <div class="why-story-box">
                    <img src="{{ !empty($data->why_image) ? asset($data->why_image) : asset('frontend/images/landing/baklava/why_platter.jpg') }}"
                         alt="Royal Turkish dessert platter"
                         class="why-story-img"
                         loading="lazy">
                    <div class="why-story-content">
                        <div class="why-story-icon"><i class="fa-solid fa-truck-fast"></i></div>
                        <h3 class="why-story-title">{{ $data->why_heading ?? 'Delivery All Over Bangladesh' }}</h3>
                        <div class="why-story-line"></div>
                        <p class="why-story-desc">
                            {{ $data->why_desc_1 ?? 'From Dhaka to every district — each box is packed fresh, sealed by hand and couriered straight to your door.' }}
                        </p>
                        <p class="why-story-desc mt-2">
                            {{ $data->why_desc_2 ?? 'তুর্কি ঐতিহ্যবাহী মুচমুচে পেস্তা-কাজু সমৃদ্ধ বাকলাভা এবং গ্রাম বাংলার শতাব্দীর সেরা খাঁটি পাবনার পেরা সন্দেশ—দুটি অনন্য স্বাদের মেলবন্ধন ঘটাতে আমাদের এই বিশেষ প্যাকেজটি তৈরি করা হয়েছে।' }}
                        </p>
                    </div>
                </div>

                <div class="delivery-guarantee-grid">
                    <div class="guarantee-card">
                        <div class="trust-icon-box"><i class="fa-solid fa-hand-holding-dollar"></i></div>
                        <div>
                            <div class="fw-bold text-dark">{{ $data->guarantee_1_title ?? 'Cash On Delivery Available' }}</div>
                            <small class="text-muted">{{ $data->guarantee_1_text ?? 'পণ্য হাতে পেয়ে চেক করে মূল্য পরিশোধ করুন' }}</small>
                        </div>
                    </div>
                    <div class="guarantee-card">
                        <div class="trust-icon-box"><i class="fa-solid fa-box-open"></i></div>
                        <div>
                            <div class="fw-bold text-dark">{{ $data->guarantee_2_title ?? '100% Secure Packaging' }}</div>
                            <small class="text-muted">{{ $data->guarantee_2_text ?? 'নিরাপদ ও স্বাস্থ্যসম্মত ভ্যাকুয়াম সিল প্যাকেজিং' }}</small>
                        </div>
                    </div>
                </div>

                <div class="text-center my-3">
                    <a href="#order-section" class="landing-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> ORDER NOW — অর্ডার করুন
                    </a>
                </div>
            </section>

            <!-- ══════════════════════════════════════════════════
                 7. FAST DIRECT ORDER / CHECKOUT FORM SECTION
                 ══════════════════════════════════════════════════ -->
            <section id="order-section" class="landing-order-section">
                <div class="landing-order-header">
                    <span class="order-header-badge"><i class="fa-solid fa-fire"></i> সীমিত সময়ের ধামাকা অফার</span>
                    <h2 class="landing-section-title">অর্ডার করতে নিচের ফর্মটি পূরণ করুন</h2>
                    <p class="landing-section-subtitle mb-0">অর্ডার কনফার্ম করতে আপনার নাম, মোবাইল নম্বর এবং সম্পূর্ণ ঠিকানা দিন</p>
                </div>

                <!-- Package Selection Card -->
                <div class="package-select-box">
                    <span class="package-popular-ribbon"><i class="fa-solid fa-star"></i> BEST VALUE</span>
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">
                                <i class="fa-solid fa-check-circle text-success me-1"></i> {{ $data->package_title ?? '২০ পিস টার্কিশ বাকলাভা + হাফকেজি পাবনার পেরা সন্দেশ (ফ্রী)' }}
                            </h4>
                            <p class="text-muted mb-0 fs-14">
                                {{ $data->package_subtitle ?? 'সম্পূর্ণ প্রিমিয়াম গিফট বক্স প্যাকেজিং সহ' }}
                            </p>
                        </div>
                        <div class="text-end">
                            <div class="fs-22 fw-bold" style="color: var(--fj-accent-red);">
                                ৳ <span id="unit-price-display">{{ $data->offer_price ?? 1350 }}</span>
                            </div>
                            <del class="text-muted fs-14">৳ {{ $data->regular_price ?? 1850 }}</del>
                        </div>
                    </div>

                    <!-- Quantity Control -->
                    <div class="d-flex align-items-center justify-content-between mt-3 pt-3 border-top">
                        <span class="fw-bold text-dark">প্যাকেজ সংখ্যা (Quantity):</span>
                        <div class="d-flex align-items-center">
                            <button type="button" class="qty-control-btn" onclick="changeOrderQty(-1)">&minus;</button>
                            <input type="number" id="order-qty" name="quantity" class="qty-input-field" value="1" min="1" max="50" readonly>
                            <button type="button" class="qty-control-btn" onclick="changeOrderQty(1)">&plus;</button>
                        </div>
                    </div>
                </div>

                <!-- Order Form -->
                <form id="baklava-direct-order-form" action="{{ route('special-offer.direct-order') }}" method="POST">
                    @csrf
                    <input type="hidden" name="offer_id" value="{{ $data->id ?? '' }}">
                    <input type="hidden" name="offer_slug" value="{{ $data->slug ?? 'baklava-offer' }}">
                    <input type="hidden" name="product_id" value="{{ $data->product_id ?? $baklavaProduct?->id ?? $defaultProduct?->id ?? '' }}">
                    <input type="hidden" name="variant_id" value="{{ $data->variant_id ?? $baklavaProduct?->variants?->first()?->id ?? $defaultProduct?->variants?->first()?->id ?? '' }}">
                    <input type="hidden" id="form-quantity" name="quantity" value="1">

                    <div class="row g-3">
                        <!-- Name (Mandatory) -->
                        <div class="col-md-6 form-floating-custom">
                            <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                   placeholder="Enter full name here" value="{{ Auth::check() ? Auth::user()->name : old('name') }}" required>
                            @error('name')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email (Optional) -->
                        <div class="col-md-6 form-floating-custom">
                            <label for="email" class="form-label fw-bold">Email <span>(Optional)</span></label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                   placeholder="Enter email address here" value="{{ Auth::check() ? Auth::user()->email : old('email') }}">
                            @error('email')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone Number (Mandatory) -->
                        <div class="col-md-6 form-floating-custom">
                            <label for="number" class="form-label fw-bold">Phone Number <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('number') is-invalid @enderror" name="number" id="number"
                                   placeholder="Enter phone number here (11 digits)" pattern="[0-9]{11}" maxlength="11"
                                   value="{{ Auth::check() ? Auth::user()->phone : old('number') }}" required>
                            @error('number')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Whatsapp Number (Optional) -->
                        <div class="col-md-6 form-floating-custom">
                            <label for="whatsapp_number" class="form-label fw-bold">Whatsapp Number <span>(Optional)</span></label>
                            <input type="tel" class="form-control @error('whatsapp_number') is-invalid @enderror" name="whatsapp_number" id="whatsapp_number"
                                   placeholder="Enter whatsapp number here" value="{{ old('whatsapp_number') }}">
                            @error('whatsapp_number')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address (Mandatory) -->
                        <div class="col-12 form-floating-custom">
                            <label for="address" class="form-label fw-bold">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address"
                                      placeholder="Enter full Address here (House, Road, Area, District)" cols="30" rows="3" required>{{ Auth::check() ? Auth::user()->address : old('address') }}</textarea>
                            @error('address')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Delivery Zone (Mandatory) -->
                        <div class="col-md-12 form-floating-custom">
                            <label for="delivery_zone" class="form-label fw-bold">Delivery Zone <span class="text-danger">*</span></label>
                            <select class="form-select @error('delivery_zone') is-invalid @enderror" id="delivery_zone" name="delivery_zone" onchange="calculateOrderTotal()" required>
                                <option value="inside_dhaka" data-fee="{{ $data->inside_dhaka_delivery_fee ?? 80 }}" selected>
                                    Inside Dhaka (ঢাকার ভেতরে হোম ডেলিভারি) — ৳ {{ $data->inside_dhaka_delivery_fee ?? 80 }}
                                </option>
                                <option value="outside_dhaka" data-fee="{{ $data->outside_dhaka_delivery_fee ?? 150 }}">
                                    Outside Dhaka (ঢাকার বাইরে সারা বাংলাদেশ) — ৳ {{ $data->outside_dhaka_delivery_fee ?? 150 }}
                                </option>
                            </select>
                            @error('delivery_zone')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Note (Optional) -->
                        <div class="col-12 form-floating-custom">
                            <label for="note" class="form-label fw-bold">Note <span>(Optional)</span></label>
                            <textarea class="form-control @error('note') is-invalid @enderror" name="note" id="note"
                                      placeholder="Enter note here (e.g. deliver after 5 PM)" cols="30" rows="2">{{ old('note') }}</textarea>
                            @error('note')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Accept all Terms and Conditions (Mandatory) -->
                        <div class="col-12 mt-2">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input @error('all_terms') is-invalid @enderror" name="all_terms" id="all_terms" value="yes" checked required>
                                <label for="all_terms" class="form-check-label fw-semibold text-dark">
                                    Accept all Terms and Conditions <span class="text-danger">*</span>
                                </label>
                            </div>
                            @error('all_terms')
                                <p class="text-sm text-danger mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Live Order Summary -->
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
                    <p class="text-muted fs-14 mb-1">অথবা সরাসরি হোয়াটসঅ্যাপে অর্ডার করতে চান?</p>
                    <a id="whatsapp-order-link" href="https://wa.me/{{ $data->whatsapp_number ?? '8801672756634' }}?text=Hello%20Food%20Junction,%20I%20want%20to%20order%20the%20Baklava%20Special%20Offer."
                       target="_blank"
                       rel="noopener noreferrer"
                       class="whatsapp-order-btn">
                        <i class="fa-brands fa-whatsapp fs-20"></i> হোয়াটসঅ্যাপে অর্ডার করুন
                    </a>
                </div>
            </section>

        </div>
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

@push('scripts')
<script>
    const UNIT_PRICE = {{ $data->offer_price ?? 1350 }};
    const WHATSAPP_NUM = "{{ $data->whatsapp_number ?? '8801672756634' }}";
    const PACKAGE_NAME = "{{ addslashes($data->package_title ?? '২০ পিস বাকলাভা + হাফকেজি পেরা সন্দেশ ফ্রী') }}";
    const ENGLISH_TO_BANGLA = {'0':'০','1':'১','2':'২','3':'৩','4':'৪','5':'৫','6':'৬','7':'৭','8':'৮','9':'৯'};

    function toBanglaNum(num) {
        return num.toString().replace(/\d/g, d => ENGLISH_TO_BANGLA[d] || d);
    }

    function changeOrderQty(delta) {
        let input = document.getElementById('order-qty');
        let currentVal = parseInt(input.value) || 1;
        let newVal = Math.max(1, Math.min(50, currentVal + delta));
        input.value = newVal;
        document.getElementById('form-quantity').value = newVal;
        calculateOrderTotal();
    }

    function calculateOrderTotal() {
        let qty = parseInt(document.getElementById('order-qty').value) || 1;
        let zoneSelect = document.getElementById('delivery_zone');
        let deliveryFee = parseInt(zoneSelect.options[zoneSelect.selectedIndex].getAttribute('data-fee')) || {{ $data->inside_dhaka_delivery_fee ?? 80 }};

        let subtotal = UNIT_PRICE * qty;
        let grandTotal = subtotal + deliveryFee;

        document.getElementById('summary-qty').innerText = toBanglaNum(qty);
        document.getElementById('summary-subtotal').innerText = toBanglaNum(subtotal);
        document.getElementById('summary-delivery').innerText = toBanglaNum(deliveryFee);
        document.getElementById('summary-grand-total').innerText = toBanglaNum(grandTotal);

        // Update WhatsApp Link
        let waText = encodeURIComponent(`হ্যালো Food Junction, আমি ${qty}টি বাকলাভা অফার প্যাকেজ (${PACKAGE_NAME} - মোট ৳${grandTotal}) অর্ডার করতে চাই।`);
        document.getElementById('whatsapp-order-link').href = `https://wa.me/${WHATSAPP_NUM}?text=${waText}`;
    }

    function openReviewModal(imgSrc) {
        document.getElementById('modalReviewImg').src = imgSrc;
        let reviewModal = new bootstrap.Modal(document.getElementById('reviewZoomModal'));
        reviewModal.show();
    }

    // Direct Form Handling with Real Functional Order Creation
    $(document).ready(function () {
        calculateOrderTotal();

        $('#baklava-direct-order-form').on('submit', function (e) {
            e.preventDefault();

            let form = $(this);
            let name = $('#name').val().trim();
            let phone = $('#number').val().trim();
            let address = $('#address').val().trim();
            let deliveryZone = $('#delivery_zone').val();
            let terms = $('#all_terms').is(':checked');

            if (!name) {
                showErrorToast('Please enter your full name (আপনার নাম লিখুন)।');
                $('#name').focus();
                return;
            }

            if (!phone) {
                showErrorToast('Please enter your phone number (মোবাইল নম্বর লিখুন)।');
                $('#number').focus();
                return;
            }

            if (!/^\d{11}$/.test(phone)) {
                showErrorToast('The phone number must be exactly 11 digits (১১ ডিজিটের ফোন নম্বর দিন, যেমন: 017XXXXXXXX)।');
                $('#number').focus();
                return;
            }

            if (!address) {
                showErrorToast('Please enter your delivery address (সম্পূর্ণ ডেলিভারি ঠিকানা লিখুন)।');
                $('#address').focus();
                return;
            }

            if (!deliveryZone) {
                showErrorToast('Please select your delivery zone (ডেলিভারি এরিয়া নির্বাচন করুন)।');
                $('#delivery_zone').focus();
                return;
            }

            if (!terms) {
                showErrorToast('Please accept the Terms and Conditions (শর্তাবলীতে সম্মতি দিন)।');
                $('#all_terms').focus();
                return;
            }

            let submitBtn = $('#submit-order-btn');
            submitBtn.prop('disabled', true).html('<i class="fa-solid fa-spinner fa-spin me-2"></i> Placing Order... / অর্ডার প্রসেস হচ্ছে...');

            $.ajax({
                url: form.attr('action'),
                method: "POST",
                data: form.serialize(),
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        showSuccessToast(res.message || 'Order placed successfully! Redirecting...');
                        setTimeout(function () {
                            window.location.href = res.redirect_url || "{{ route('order.confirm') }}";
                        }, 500);
                    } else {
                        submitBtn.prop('disabled', false).html('<i class="fa-solid fa-circle-check me-1"></i> Place Order — অর্ডার কনফার্ম করুন (ক্যাশ অন ডেলিভারি)');
                        showErrorToast(res.message || 'Failed to place order. Please try again.');
                    }
                },
                error: function (xhr) {
                    submitBtn.prop('disabled', false).html('<i class="fa-solid fa-circle-check me-1"></i> Place Order — অর্ডার কনফার্ম করুন (ক্যাশ অন ডেলিভারি)');
                    let errMsg = 'Failed to place order. Please check all required fields.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errMsg = xhr.responseJSON.message;
                    }
                    showErrorToast(errMsg);
                }
            });
        });
    });

    @if (session('t-success'))
        showSuccessToast("{{ session('t-success') }}");
    @endif

    @if (session('t-error'))
        showErrorToast("{{ session('t-error') }}");
    @endif
</script>
@endpush
