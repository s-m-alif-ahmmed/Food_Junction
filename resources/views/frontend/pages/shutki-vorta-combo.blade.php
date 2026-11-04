@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="এক কম্বোতেই ৩ রকমের শুটকি ভর্তা — চিংড়ি, চাপা আর বাঁশপাতা শুটকি ভর্তা একসাথে। গরম ভাতের সাথে আসল দেশি স্বাদের সেরা অভিজ্ঞতা।">
    <meta name="keywords" content="Shutki Vorta Combo, শুটকি ভর্তা কম্বো, চিংড়ি শুটকি, চাপা শুটকি, বাঁশপাতা শুটকি, Food Junction, Deshi Vorta">
    <meta property="og:title" content="এক কম্বোতেই ৩ রকমের শুটকি ভর্তা | Food Junction">
    <meta property="og:description" content="চিংড়ি, চাপা আর বাঁশপাতা শুটকি ভর্তা একসাথে। আজকের বিশেষ অফারে পাচ্ছেন ২০০ টাকা ছাড় ও ফ্রি ডেলিভারি!">
    <meta property="og:image" content="{{ asset('frontend/images/landing/shutki/shutki_combo_hero.webp') }}">
@endsection

@section('title', 'এক কম্বোতেই ৩ রকমের শুটকি ভর্তা | Food Junction')

@push('styles')
<style>
    /* ==========================================================
       FOOD JUNCTION — SHUTKI VORTA COMBO (CLEAN ALL-WHITE THEME)
       Color Palette:
         --fj-gold:    #FD9325
         --fj-amber:   #EA580C
         --fj-red:     #EE3441 / #FF2D20
         --fj-red-dark:#B91C1C
         --fj-text-main: #2B1810
         --fj-text-muted: #6B5344
         --fj-border:  #E5E7EB
       ========================================================== */

    .shutki-landing-wrap {
        background-color: #FFFFFF;
        color: var(--fj-text-main, #2B1810);
        font-family: 'Hind Siliguri', 'Nirmala UI', 'Segoe UI', sans-serif;
        line-height: 1.65;
        padding-bottom: 90px;
        overflow-x: hidden;
    }

    .shutki-container {
        max-width: 1040px;
        margin: 0 auto;
        padding: 0 16px;
    }

    .shutki-narrow-con {
        max-width: 860px;
        margin: 0 auto;
    }

    .shutki-form-con {
        max-width: 760px;
        margin: 0 auto;
    }

    /* Common Headings */
    .shutki-sec-title {
        font-family: 'Hind Siliguri', sans-serif;
        font-weight: 800;
        font-size: clamp(24px, 4.4vw, 36px);
        color: var(--fj-text-main, #2B1810);
        line-height: 1.35;
        margin-bottom: 12px;
        text-align: center;
    }

    .shutki-sec-sub {
        font-size: clamp(14px, 2.6vw, 17px);
        color: var(--fj-text-muted, #6B5344);
        text-align: center;
        margin-bottom: 28px;
        max-width: 680px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.65;
    }

    /* Primary CTA Button (Clean Flat Gradient Style without shadow) */
    .shutki-cta-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: linear-gradient(135deg, #FD9325 0%, #EE3441 100%);
        color: #FFFFFF !important;
        font-size: clamp(18px, 3.5vw, 21px);
        font-weight: 700;
        padding: 15px 38px;
        border-radius: 12px;
        text-decoration: none !important;
        border: none;
        box-shadow: none !important;
        transition: opacity 0.2s ease, transform 0.15s ease;
        cursor: pointer;
    }

    .shutki-cta-btn:hover {
        transform: translateY(-2px);
        box-shadow: none !important;
        opacity: 0.93;
        color: #FFFFFF !important;
    }

    .shutki-cta-btn:active {
        transform: translateY(0);
        box-shadow: none !important;
    }

    /* ══════════════════════════════════════════════════════════
       1. HERO SECTION (Clean White Background)
       ══════════════════════════════════════════════════════════ */
    .shutki-hero-sec {
        background: #FFFFFF;
        color: var(--fj-text-main, #2B1810);
        padding: 40px 16px 52px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .shutki-hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #FFF5ED;
        color: #EA580C;
        border: 1.5px solid #FCD34D;
        font-size: clamp(12.5px, 2.5vw, 14px);
        font-weight: 700;
        padding: 6px 18px;
        border-radius: 999px;
        margin-bottom: 18px;
        letter-spacing: 0.3px;
        box-shadow: 0 2px 8px rgba(253, 147, 37, 0.08);
    }

    .shutki-hero-sec h1 {
        font-size: clamp(28px, 5.2vw, 54px);
        line-height: 1.3;
        font-weight: 800;
        margin: 0 auto 16px;
        color: var(--fj-text-main, #2B1810);
        max-width: 900px;
    }

    .shutki-hl {
        display: inline;
        color: #EA580C;
        background: linear-gradient(100deg, #EA580C 0%, #FD9325 50%, #EE3441 100%);
        background-size: 200% auto;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .shutki-hero-sub {
        font-size: clamp(15px, 2.6vw, 19px);
        line-height: 1.7;
        max-width: 680px;
        margin: 0 auto 28px;
        color: var(--fj-text-muted, #6B5344);
    }

    .shutki-hero-figure {
        margin: 0 auto 26px;
        width: 100%;
        max-width: 440px;
        aspect-ratio: 1 / 1;
        border-radius: 20px;
        overflow: hidden;
        border: 3.5px solid #FD9325;
        background: #FFFFFF;
        box-shadow: 0 16px 38px rgba(43, 24, 16, 0.12), 0 0 0 6px rgba(253, 147, 37, 0.15);
    }

    .shutki-hero-figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.4s ease;
    }

    .shutki-hero-figure:hover img {
        transform: scale(1.03);
    }

    .shutki-chips {
        list-style: none;
        padding: 0;
        margin: 0 auto 30px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        justify-content: center;
        max-width: 720px;
    }

    .shutki-chips li {
        background: #FFFDF9;
        border: 1.5px solid #FCD34D;
        color: #2B1810;
        border-radius: 999px;
        padding: 8px 18px;
        font-size: clamp(13.5px, 2.6vw, 15.5px);
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 2px 10px rgba(43, 24, 16, 0.05);
    }

    /* ══════════════════════════════════════════════════════════
       2. PROBLEM VS SOLUTION (Clean White Background)
       ══════════════════════════════════════════════════════════ */
    .shutki-prob-sol-sec {
        background: #FFFFFF;
        padding: 56px 16px 60px;
    }

    .shutki-prob-sol-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px;
        margin-bottom: 36px;
        text-align: left;
    }

    .shutki-box {
        border-radius: 18px;
        padding: 28px 24px 26px;
        box-shadow: 0 8px 24px rgba(43, 24, 16, 0.06);
    }

    /* Problem Card */
    .shutki-box-prob {
        background: #FFFDFD;
        border: 2.5px solid #FCA5A5;
    }

    .shutki-box-prob h3 {
        font-size: 22px;
        font-weight: 800;
        color: #DC2626;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1.5px dashed #FCA5A5;
        padding-bottom: 12px;
    }

    .shutki-box-prob ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .shutki-box-prob li {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        font-size: 15.5px;
        line-height: 1.6;
        padding: 10px 0;
        color: #4B3325;
    }

    .shutki-box-prob li + li {
        border-top: 1px dashed rgba(220, 38, 38, 0.15);
    }

    .shutki-box-prob li i {
        color: #DC2626;
        font-size: 18px;
        margin-top: 3px;
        flex-shrink: 0;
    }

    /* Solution Card (Clean White with Gold Border & Accents) */
    .shutki-box-sol {
        background: #FFFDF9;
        color: #2B1810;
        border: 2.5px solid #FD9325;
        box-shadow: 0 8px 26px rgba(253, 147, 37, 0.14);
    }

    .shutki-box-sol h3 {
        font-size: 22px;
        font-weight: 800;
        color: #EA580C;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        border-bottom: 1.5px dashed #FCD34D;
        padding-bottom: 12px;
    }

    .shutki-box-sol ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .shutki-box-sol li {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        font-size: 15.5px;
        line-height: 1.6;
        padding: 10px 0;
        color: #2B1810;
    }

    .shutki-box-sol li + li {
        border-top: 1px dashed rgba(253, 147, 37, 0.2);
    }

    .shutki-box-sol li i {
        color: #16A34A;
        font-size: 18px;
        margin-top: 3px;
        flex-shrink: 0;
    }

    /* ══════════════════════════════════════════════════════════
       3. WHAT'S IN THE COMBO (Clean White Background)
       ══════════════════════════════════════════════════════════ */
    .shutki-inside-sec {
        background: #FFFFFF;
        padding: 60px 16px 64px;
        text-align: center;
    }

    .shutki-split-grid {
        display: grid;
        grid-template-columns: minmax(0, 0.9fr) minmax(0, 1.1fr);
        gap: 32px;
        align-items: center;
        margin-bottom: 36px;
        text-align: left;
    }

    .shutki-split-img {
        width: 100%;
        max-width: 440px;
        margin: 0 auto;
        aspect-ratio: 1 / 1;
        border-radius: 20px;
        overflow: hidden;
        border: 3.5px solid #FD9325;
        background: #FFFFFF;
        box-shadow: 0 16px 40px rgba(43, 24, 16, 0.12), 0 0 0 6px rgba(253, 147, 37, 0.15);
    }

    .shutki-split-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .shutki-card-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
    }

    .shutki-item-card {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        background: #FFFDF9;
        border: 1px solid #E5E7EB;
        border-left: 6px solid #FD9325;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 4px 14px rgba(43, 24, 16, 0.05);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .shutki-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(253, 147, 37, 0.15);
    }

    .shutki-item-emoji {
        font-size: 32px;
        line-height: 1;
        flex-shrink: 0;
        background: #FFFFFF;
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        border: 1px solid #E5E7EB;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }

    .shutki-item-card h3 {
        font-size: 19px;
        font-weight: 700;
        color: var(--fj-amber, #EA580C);
        margin: 0 0 5px;
    }

    .shutki-item-card p {
        font-size: 15px;
        line-height: 1.6;
        color: var(--fj-text-main, #2B1810);
        margin: 0;
    }

    /* ══════════════════════════════════════════════════════════
       4. SPECIAL OFFER & COUNTDOWN (Clean White Background)
       ══════════════════════════════════════════════════════════ */
    .shutki-offer-sec {
        background: #FFFFFF;
        color: #2B1810;
        padding: 56px 16px 64px;
        text-align: center;
        position: relative;
    }

    .shutki-offer-box {
        background: #FFFFFF;
        color: #2B1810;
        border-radius: 22px;
        padding: 34px 24px 36px;
        max-width: 600px;
        margin: 0 auto;
        border: 3.5px solid #FD9325;
        box-shadow: 0 16px 40px rgba(253, 147, 37, 0.16), 0 0 0 6px rgba(253, 147, 37, 0.15);
        position: relative;
        z-index: 2;
    }

    .shutki-badge-red {
        display: inline-block;
        background: #EE3441;
        color: #FFFFFF;
        font-size: 14px;
        font-weight: 800;
        padding: 6px 16px;
        border-radius: 999px;
        margin: 0 4px 14px;
        letter-spacing: 0.3px;
    }

    .shutki-badge-gold {
        display: inline-block;
        background: #FD9325;
        color: #FFFFFF;
        font-size: 14px;
        font-weight: 800;
        padding: 6px 16px;
        border-radius: 999px;
        margin: 0 4px 14px;
        letter-spacing: 0.3px;
    }

    .shutki-offer-name {
        font-size: clamp(20px, 3.8vw, 24px);
        font-weight: 800;
        color: #2B1810;
        margin-bottom: 4px;
    }

    .shutki-offer-wt {
        font-size: 16px;
        color: var(--fj-text-muted, #6B5344);
        margin-bottom: 18px;
    }

    .shutki-price-row {
        display: flex;
        justify-content: center;
        align-items: baseline;
        gap: 16px;
        margin-bottom: 22px;
    }

    .shutki-price-old {
        font-size: 24px;
        color: #9CA3AF;
        text-decoration: line-through;
        font-weight: 600;
    }

    .shutki-price-new {
        font-size: clamp(44px, 8.5vw, 62px);
        line-height: 1;
        font-weight: 900;
        color: #EE3441;
        letter-spacing: -1px;
    }

    /* Countdown Timer */
    .shutki-timer-con {
        background: #FFF5F5;
        border: 1.5px solid #FED7D7;
        border-radius: 14px;
        padding: 16px 14px;
        margin-bottom: 26px;
    }

    .shutki-timer-label {
        font-size: 14.5px;
        font-weight: 700;
        color: #DC2626;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
    }

    .shutki-timer-boxes {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .shutki-tbox {
        background: linear-gradient(135deg, #FD9325 0%, #EE3441 100%);
        color: #FFFFFF;
        border-radius: 10px;
        min-width: 62px;
        padding: 8px 6px;
        box-shadow: 0 4px 10px rgba(238, 52, 65, 0.25);
    }

    .shutki-tbox b {
        display: block;
        font-size: 24px;
        line-height: 1.1;
        font-weight: 800;
    }

    .shutki-tbox span {
        font-size: 12px;
        font-weight: 600;
        opacity: 0.95;
    }

    /* ══════════════════════════════════════════════════════════
       5. ORDER / CHECKOUT FORM SECTION (Clean White Background)
       ══════════════════════════════════════════════════════════ */
    .shutki-order-sec {
        background: #FFFFFF;
        padding: 60px 16px 70px;
    }

    .shutki-order-card {
        background: #FFFFFF;
        border-radius: 20px;
        border: 1px solid #E5E7EB;
        box-shadow: 0 10px 32px rgba(43, 24, 16, 0.07);
        padding: 30px 24px;
    }

    .shutki-form-header {
        text-align: center;
        margin-bottom: 24px;
        border-bottom: 1.5px dashed #E5E7EB;
        padding-bottom: 16px;
    }

    .shutki-form-header h3 {
        font-size: 22px;
        font-weight: 800;
        color: var(--fj-text-main, #2B1810);
        margin-bottom: 6px;
    }

    /* Product Quick Selector Box */
    .shutki-pkg-preview {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #FFFDF9;
        border: 1.5px solid #FCD34D;
        border-radius: 14px;
        padding: 14px 16px;
        margin-bottom: 24px;
        gap: 14px;
    }

    .shutki-pkg-thumb {
        width: 58px;
        height: 58px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #FD9325;
        flex-shrink: 0;
    }

    .shutki-pkg-info {
        flex-grow: 1;
        text-align: left;
    }

    .shutki-pkg-title {
        font-weight: 800;
        font-size: 15px;
        color: #2B1810;
        margin-bottom: 2px;
    }

    .shutki-pkg-sub {
        font-size: 13px;
        color: var(--fj-amber, #EA580C);
        font-weight: 700;
    }

    /* Quantity Controller */
    .shutki-qty-wrap {
        display: flex;
        align-items: center;
        background: #FFFFFF;
        border: 1.5px solid #FD9325;
        border-radius: 8px;
        overflow: hidden;
    }

    .shutki-qty-btn {
        background: #FFF5ED;
        border: none;
        width: 32px;
        height: 34px;
        font-size: 18px;
        font-weight: bold;
        color: #2B1810;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }

    .shutki-qty-btn:hover {
        background: #FDE8D4;
    }

    .shutki-qty-input {
        width: 38px;
        height: 34px;
        border: none;
        text-align: center;
        font-size: 15px;
        font-weight: 800;
        color: #2B1810;
        background: transparent;
    }

    /* Form Fields */
    .shutki-form-label {
        font-weight: 700;
        font-size: 14px;
        color: #2B1810;
        margin-bottom: 6px;
        display: block;
        text-align: left;
    }

    .shutki-input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 10px;
        border: 1.5px solid #D1D5DB;
        background: #FFFFFF;
        font-size: 15px;
        color: #2B1810;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }

    .shutki-input:focus {
        border-color: #FD9325;
        outline: none;
        box-shadow: 0 0 0 3px rgba(253, 147, 37, 0.2);
    }

    /* Delivery Zone Radio Cards */
    .shutki-zone-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
        margin-top: 6px;
    }

    .shutki-zone-card {
        border: 2px solid #E5E7EB;
        border-radius: 12px;
        padding: 12px 14px;
        cursor: pointer;
        background: #FFFFFF;
        transition: all 0.2s ease;
        display: block;
        text-align: left;
        position: relative;
    }

    .shutki-zone-radio {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .shutki-zone-card:hover {
        border-color: #FD9325;
        background: #FFFDF9;
    }

    .shutki-zone-radio:checked + .shutki-zone-card {
        border-color: #FD9325;
        background: #FFF5ED;
        box-shadow: 0 4px 14px rgba(253, 147, 37, 0.18);
    }

    .shutki-zone-title {
        font-weight: 800;
        font-size: 14px;
        color: #2B1810;
        display: block;
    }

    .shutki-zone-fee {
        font-size: 13.5px;
        font-weight: 700;
        color: #EA580C;
    }

    /* Summary Table */
    .shutki-summary-box {
        background: #F9FAFB;
        border: 1.5px solid #E5E7EB;
        border-radius: 12px;
        padding: 16px;
        margin: 22px 0;
    }

    .shutki-summary-row {
        display: flex;
        justify-content: space-between;
        font-size: 14.5px;
        padding: 6px 0;
        color: #4B5563;
    }

    .shutki-summary-total {
        display: flex;
        justify-content: space-between;
        font-size: 18px;
        font-weight: 800;
        color: #1F2937;
        padding-top: 10px;
        margin-top: 8px;
        border-top: 2px dashed #E5E7EB;
    }

    /* Trust Guarantee Banner */
    .shutki-trust-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-top: 20px;
        padding-top: 16px;
        border-top: 1px dashed #E5E7EB;
    }

    .shutki-trust-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12.5px;
        color: #4B5563;
        font-weight: 600;
        background: #F3F4F6;
        padding: 6px 12px;
        border-radius: 999px;
    }

    /* ══════════════════════════════════════════════════════════
       6. FAQ ACCORDION (Clean White Background)
       ══════════════════════════════════════════════════════════ */
    .shutki-faq-sec {
        background: #FFFFFF;
        padding: 60px 16px 64px;
        text-align: center;
    }

    .shutki-faq-list {
        max-width: 760px;
        margin: 0 auto 34px;
        text-align: left;
    }

    .shutki-faq-item {
        background: #FFFDF9;
        border: 1px solid #E5E7EB;
        border-radius: 12px;
        margin-bottom: 14px;
        overflow: hidden;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .shutki-faq-item[open] {
        border-color: #FD9325;
        box-shadow: 0 4px 14px rgba(253, 147, 37, 0.1);
    }

    .shutki-faq-summary {
        font-size: 17px;
        font-weight: 700;
        color: #2B1810;
        padding: 16px 20px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
        user-select: none;
    }

    .shutki-faq-summary::-webkit-details-marker {
        display: none;
    }

    .shutki-faq-summary::after {
        content: "\f078";
        font-family: "Font Awesome 6 Free", FontAwesome, sans-serif;
        font-weight: 900;
        font-size: 14px;
        color: #FD9325;
        transition: transform 0.25s ease;
    }

    .shutki-faq-item[open] .shutki-faq-summary::after {
        transform: rotate(180deg);
    }

    .shutki-faq-content {
        padding: 0 20px 16px;
        font-size: 15px;
        line-height: 1.65;
        color: #4B3325;
        border-top: 1px dashed #E5E7EB;
        margin-top: -4px;
        padding-top: 12px;
    }

    /* ══════════════════════════════════════════════════════════
       7. CONTACT / URGENT SUPPORT (Clean White Background)
       ══════════════════════════════════════════════════════════ */
    .shutki-contact-sec {
        background: #FFFFFF;
        padding: 50px 16px 60px;
    }

    .shutki-contact-card {
        background: #FFFFFF;
        border: 1px solid #E5E7EB;
        border-radius: 20px;
        padding: 34px 22px;
        text-align: center;
        max-width: 640px;
        margin: 0 auto;
        box-shadow: 0 8px 24px rgba(43, 24, 16, 0.06);
    }

    .shutki-contact-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #FFF5ED 0%, #FEE5CC 100%);
        color: #FD9325;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 26px;
        margin: 0 auto 16px;
        border: 2px solid #FCD34D;
    }

    .shutki-contact-card h2 {
        font-size: clamp(20px, 3.8vw, 25px);
        font-weight: 800;
        color: #2B1810;
        margin-bottom: 6px;
    }

    .shutki-contact-num {
        display: inline-block;
        font-size: clamp(24px, 4.5vw, 32px);
        font-weight: 800;
        color: #EE3441;
        text-decoration: none;
        margin: 10px 0 20px;
        letter-spacing: 0.5px;
        transition: transform 0.2s;
    }

    .shutki-contact-num:hover {
        transform: scale(1.05);
        color: #B91C1C;
    }

    .shutki-contact-btns {
        display: flex;
        gap: 14px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .shutki-btn-call {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #EE3441;
        color: #FFFFFF !important;
        font-weight: 700;
        font-size: 16px;
        padding: 12px 28px;
        border-radius: 10px;
        text-decoration: none;
        box-shadow: none !important;
        transition: transform 0.2s, background 0.2s, opacity 0.2s;
    }

    .shutki-btn-call:hover {
        background: #B91C1C;
        transform: translateY(-2px);
        box-shadow: none !important;
        opacity: 0.93;
    }

    .shutki-btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #25D366;
        color: #FFFFFF !important;
        font-weight: 700;
        font-size: 16px;
        padding: 12px 28px;
        border-radius: 10px;
        text-decoration: none;
        box-shadow: none !important;
        transition: transform 0.2s, background 0.2s, opacity 0.2s;
    }

    .shutki-btn-wa:hover {
        background: #1EBE5B;
        transform: translateY(-2px);
        box-shadow: none !important;
        opacity: 0.93;
    }

    /* ══════════════════════════════════════════════════════════
       8. STICKY FLOATING BOTTOM ORDER BAR (Identical to Baklava Offer)
       ══════════════════════════════════════════════════════════ */
    .sticky-bottom-bar {
        position: fixed !important;
        bottom: 15px !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        width: calc(100% - 30px) !important;
        max-width: 440px !important;
        background-color: #241812 !important;
        border: 1.5px solid rgba(253, 147, 37, 0.4) !important;
        border-radius: 30px !important;
        padding: 10px 18px !important;
        display: flex !important;
        justify-content: space-between !important;
        align-items: center !important;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.5) !important;
        z-index: 99999 !important;
        box-sizing: border-box !important;
        transition: transform 0.3s ease, opacity 0.3s ease, visibility 0.3s ease !important;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    .sticky-bottom-bar.show-bar,
    .sticky-bottom-bar.visible {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }

    .sticky-bar-left {
        display: flex !important;
        flex-direction: column !important;
        text-align: left !important;
    }

    .sticky-bar-label {
        font-size: 10.5px !important;
        font-weight: 700 !important;
        color: #A89587 !important;
        letter-spacing: 0.5px !important;
        text-transform: uppercase !important;
        margin-bottom: 1px !important;
    }

    .sticky-bar-price {
        font-size: 19px !important;
        font-weight: 800 !important;
        color: var(--fj-gold, #FD9325) !important;
        line-height: 1 !important;
    }

    .sticky-buy-btn {
        background: linear-gradient(135deg, #FD9325 0%, #EE3441 100%) !important;
        color: #ffffff !important;
        font-size: 14.5px !important;
        font-weight: 800 !important;
        padding: 9px 22px !important;
        border-radius: 50px !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        box-shadow: 0 4px 14px rgba(238, 52, 65, 0.35) !important;
        white-space: nowrap !important;
        transition: transform 0.2s ease !important;
    }

    .sticky-buy-btn:hover {
        transform: scale(1.04) !important;
        color: #ffffff !important;
    }

    /* ══════════════════════════════════════════════════════════
       RESPONSIVE BREAKPOINTS
       ══════════════════════════════════════════════════════════ */
    @media (max-width: 768px) {
        .shutki-prob-sol-grid {
            grid-template-columns: 1fr;
            gap: 18px;
        }

        .shutki-split-grid {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .shutki-order-card {
            padding: 22px 16px;
        }

        .shutki-zone-grid {
            grid-template-columns: 1fr;
        }

        .shutki-tbox {
            min-width: 54px;
            padding: 6px 4px;
        }

        .shutki-tbox b {
            font-size: 20px;
        }
    }
</style>
@endpush

@section('content')

    @php
        $toBanglaNum = function($num) {
            $en = ['0','1','2','3','4','5','6','7','8','9'];
            $bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
            return str_replace($en, $bn, (string)$num);
        };

        $regularPrice = 1500;
        $offerPrice   = 1300;
        $packageTitle = '৩ স্বাদের শুটকি ভর্তা কম্বো';
        $packageSub   = 'চ্যাপা, বাশপাতা ও চিংড়ি শুটকি ভর্তা';
        $insideFee    = 0;  // Delivery is free on this combo promo
        $outsideFee   = 0;
        $phoneDisplay = '০১৮৩৭-৩৪৩৮৪৪';
        $phoneRaw     = '01837343844';
        $whatsappRaw  = '8801837343844';
    @endphp

    @include('frontend.includes.top-nav-button')

    <div class="shutki-landing-wrap">

        <!-- ══════════════════════════════════════════════════════════
             1. HERO SECTION (Clean White Background)
             ══════════════════════════════════════════════════════════ -->
        <section class="shutki-hero-sec">
            <div class="shutki-container">
                <!-- Top Trust Badge -->
                <div>
                    <span class="shutki-hero-badge">
                        <i class="fa-solid fa-fire text-danger"></i> স্পেশাল অফার — দেশি স্বাদের অনন্য কম্বো
                    </span>
                </div>

                <!-- Main Hook Title -->
                <h1>
                    এক কম্বোতেই <span class="shutki-hl">৩ রকমের শুটকি ভর্তা</span>
                </h1>

                <!-- Subtitle -->
                <p class="shutki-hero-sub">
                    চিংড়ি, চাপা আর বাঁশপাতা শুটকি ভর্তা একসাথে।<br>
                    গরম ভাতের সাথে একবার খেলেই মনে পড়বে দেশি স্বাদের আসল মজা।
                </p>

                <!-- Hero Platter Image Showcase -->
                <div class="d-flex justify-content-center">
                    <figure class="shutki-hero-figure">
                        <img src="{{ asset('frontend/images/landing/shutki/shutki_combo_hero.webp') }}"
                             alt="৩ স্বাদের শুটকি ভর্তা কম্বো"
                             loading="eager" />
                    </figure>
                </div>

                <!-- 3 Feature Chips -->
                <ul class="shutki-chips">
                    <li><span style="font-size: 18px;">🦐</span> চিংড়ি শুটকি ভর্তা</li>
                    <li><span style="font-size: 18px;">🌶️</span> চাপা শুটকি ভর্তা</li>
                    <li><span style="font-size: 18px;">🐟</span> বাঁশপাতা শুটকি ভর্তা</li>
                </ul>

                <!-- Primary CTA Button -->
                <div>
                    <a href="#order-section" class="shutki-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই
                    </a>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════════════════════
             2. PROBLEM VS SOLUTION SECTION (cb2 Layout)
             ══════════════════════════════════════════════════════════ -->
        <section class="shutki-prob-sol-sec">
            <div class="shutki-container">
                <h2 class="shutki-sec-title">প্রতিবার এক স্বাদের ভর্তা খেয়ে একঘেয়ে লাগছে?</h2>
                <p class="shutki-sec-sub">
                    স্বাদে ভিন্নতা আনুন! এখন আর একঘেয়েমি নয়, এক প্যাকেজেই উপভোগ করুন দেশি আসল ৩ স্বাদের খাঁটি শুটকি ভর্তা।
                </p>

                <div class="shutki-prob-sol-grid">
                    <!-- Problem Box -->
                    <div class="shutki-box shutki-box-prob">
                        <h3>
                            <i class="fa-solid fa-circle-xmark"></i> আপনার সমস্যা
                        </h3>
                        <ul>
                            <li>
                                <i class="fa-solid fa-circle-xmark"></i>
                                <span>বারবার এক স্বাদের ভর্তা খেয়ে একঘেয়ে লাগে</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-xmark"></i>
                                <span>আলাদা আলাদা জার কিনতে খরচ ও ঝামেলা বেশি</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-xmark"></i>
                                <span>পরিবারের সবার পছন্দ এক রকম নয়</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-xmark"></i>
                                <span>নতুন স্বাদ ট্রাই করতে গেলে পুরো জার কেনার ঝুঁকি</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Solution Box -->
                    <div class="shutki-box shutki-box-sol">
                        <h3>
                            <i class="fa-solid fa-circle-check"></i> সমাধান
                        </h3>
                        <ul>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span>এক কম্বোতেই ৩ রকমের স্বাদ, প্রতিদিন নতুন অভিজ্ঞতা</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span>আলাদা কেনার চেয়ে কম্বোতে সাশ্রয়ী দাম</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span>পরিবারের সবাই যার যার পছন্দ বেছে নিতে পারবে</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-circle-check"></i>
                                <span>এক কম্বোতেই ৩ স্বাদ ট্রাই করার সুযোগ</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="text-center">
                    <a href="#order-section" class="shutki-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই
                    </a>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════════════════════
             3. WHAT'S IN THE COMBO SECTION (cb3 Split Layout)
             ══════════════════════════════════════════════════════════ -->
        <section class="shutki-inside-sec">
            <div class="shutki-container">
                <h2 class="shutki-sec-title">কম্বোতে কী কী পাচ্ছেন?</h2>
                <p class="shutki-sec-sub">
                    এক কম্বোতেই ৩ রকমের দেশি স্বাদ, প্রতিটাই শুটকি প্রেমীদের জন্য আলাদা অভিজ্ঞতা।
                </p>

                <div class="shutki-split-grid">
                    <!-- Left: Product Photo -->
                    <div class="shutki-split-img">
                        <img src="{{ asset('frontend/images/landing/shutki/shutki_combo_detail.webp') }}"
                             alt="৩ স্বাদের শুটকি ভর্তা কম্বো প্যাকেজ"
                             loading="lazy" />
                    </div>

                    <!-- Right: 3 Food Feature Cards -->
                    <div class="shutki-card-list">
                        <!-- Card 1 -->
                        <div class="shutki-item-card">
                            <span class="shutki-item-emoji">🦐</span>
                            <div>
                                <h3>চিংড়ি শুটকি ভর্তা</h3>
                                <p>চিংড়ি শুটকির স্বতন্ত্র স্বাদ ও মসলার সুন্দর সমন্বয়, গরম ভাতের সাথে পরিচিত দেশি স্বাদ।</p>
                            </div>
                        </div>

                        <!-- Card 2 -->
                        <div class="shutki-item-card">
                            <span class="shutki-item-emoji">🌶️</span>
                            <div>
                                <h3>চাপা শুটকি ভর্তা</h3>
                                <p>চাপা শুটকির আলাদা ঘ্রাণ ও ঝাল-মশলাদার ফ্লেভার, ভাতের সাথে ঝটপট মজার সাইড ডিশ।</p>
                            </div>
                        </div>

                        <!-- Card 3 -->
                        <div class="shutki-item-card">
                            <span class="shutki-item-emoji">🐟</span>
                            <div>
                                <h3>বাঁশপাতা শুটকি ভর্তা</h3>
                                <p>বাঁশপাতা শুটকির বৈশিষ্ট্যপূর্ণ স্বাদ, শুটকি প্রেমীদের জন্য নতুন অভিজ্ঞতা।</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="text-center">
                    <a href="#order-section" class="shutki-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই
                    </a>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════════════════════
             4. SPECIAL OFFER & COUNTDOWN TIMER (cb5 Layout)
             ══════════════════════════════════════════════════════════ -->
        <section class="shutki-offer-sec">
            <div class="shutki-container">
                <h2 class="shutki-sec-title mb-4">আজকের বিশেষ অফার</h2>

                <div class="shutki-offer-box">
                    <!-- Badges -->
                    <div>
                        <span class="shutki-badge-red">২০০ টাকা ছাড়</span>
                        <span class="shutki-badge-gold"><i class="fa-solid fa-truck-fast me-1"></i> ডেলিভারি ফ্রি</span>
                    </div>

                    <!-- Package Info -->
                    <h3 class="shutki-offer-name">{{ $packageTitle }}</h3>
                    <p class="shutki-offer-wt">{{ $packageSub }}</p>

                    <!-- Price Display -->
                    <div class="shutki-price-row">
                        <span class="shutki-price-old">৳{{ $toBanglaNum($regularPrice) }}</span>
                        <span class="shutki-price-new">৳{{ $toBanglaNum($offerPrice) }}</span>
                    </div>

                    <!-- Urgency Countdown Timer -->
                    <div class="shutki-timer-con">
                        <p class="shutki-timer-label">
                            <i class="fa-solid fa-stopwatch"></i> অফার শেষ হতে বাকি
                        </p>
                        <div class="shutki-timer-boxes">
                            <div class="shutki-tbox">
                                <b id="shutki-days">০০</b>
                                <span>দিন</span>
                            </div>
                            <div class="shutki-tbox">
                                <b id="shutki-hours">০০</b>
                                <span>ঘণ্টা</span>
                            </div>
                            <div class="shutki-tbox">
                                <b id="shutki-minutes">০০</b>
                                <span>মিনিট</span>
                            </div>
                            <div class="shutki-tbox">
                                <b id="shutki-seconds">০০</b>
                                <span>সেকেন্ড</span>
                            </div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <div>
                        <a href="#order-section" class="shutki-cta-btn w-100">
                            <i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════════════════════
             5. DIRECT ORDER / CHECKOUT FORM SECTION
             ══════════════════════════════════════════════════════════ -->
        <section id="order-section" class="shutki-order-sec">
            <div id="order"></div> <!-- Anchor compatibility for #order -->
            <div class="shutki-form-con">
                <div class="shutki-order-card">
                    <div class="shutki-form-header">
                        <h3>অর্ডার কনফার্ম করতে নিচের ফর্মটি পূরণ করুন</h3>
                        <p class="text-muted small mb-0">
                            <i class="fa-solid fa-hand-holding-dollar text-success me-1"></i> ক্যাশ অন ডেলিভারিতে অর্ডার করতে আপনার সঠিক তথ্য দিন
                        </p>
                    </div>

                    <!-- Product Item & Quantity Selector -->
                    <div class="shutki-pkg-preview">
                        <img src="{{ asset('frontend/images/landing/shutki/shutki_combo_hero.webp') }}"
                             alt="{{ $packageTitle }}"
                             class="shutki-pkg-thumb">
                        <div class="shutki-pkg-info">
                            <div class="shutki-pkg-title">{{ $packageTitle }}</div>
                            <div class="shutki-pkg-sub">৳ <span id="display-unit-price">{{ $offerPrice }}</span> (ফ্রি ডেলিভারি)</div>
                        </div>
                        <div class="shutki-qty-wrap">
                            <button type="button" class="shutki-qty-btn" onclick="updateShutkiQty(-1)">&minus;</button>
                            <input type="number" id="shutki-qty-input" class="shutki-qty-input" value="1" min="1" max="50" readonly>
                            <button type="button" class="shutki-qty-btn" onclick="updateShutkiQty(1)">&plus;</button>
                        </div>
                    </div>

                    <!-- Order Form -->
                    <form id="shutki-order-form" action="{{ route('special-offer.direct-order') }}" method="POST" data-unit-price="{{ $offerPrice }}" data-delivery-inside="{{ $insideFee }}" data-delivery-outside="{{ $outsideFee }}">
                        @csrf
                        <input type="hidden" name="offer_slug" value="shutki-vorta-combo">
                        <input type="hidden" name="package_name" value="{{ $packageTitle }}">
                        <input type="hidden" id="form-quantity" name="quantity" value="1">
                        <input type="hidden" name="all_terms" value="yes">

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-6">
                                <label for="name" class="shutki-form-label">
                                    আপনার পূর্ণ নাম <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       class="shutki-input @error('name') is-invalid @enderror"
                                       name="name"
                                       id="name"
                                       placeholder="নাম লিখুন"
                                       value="{{ Auth::check() ? Auth::user()->name : old('name') }}"
                                       required>
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <label for="number" class="shutki-form-label">
                                    মোবাইল নম্বর (১১ ডিজিট) <span class="text-danger">*</span>
                                </label>
                                <input type="tel"
                                       class="shutki-input @error('number') is-invalid @enderror"
                                       name="number"
                                       id="number"
                                       placeholder="01XXXXXXXXX"
                                       pattern="[0-9]{11}"
                                       maxlength="11"
                                       value="{{ Auth::check() ? Auth::user()->phone : old('number') }}"
                                       required>
                                @error('number')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Full Address -->
                            <div class="col-12">
                                <label for="address" class="shutki-form-label">
                                    সম্পূর্ণ ঠিকানা (বাসা নং, রোড, থানা, জেলা) <span class="text-danger">*</span>
                                </label>
                                <textarea class="shutki-input @error('address') is-invalid @enderror"
                                          name="address"
                                          id="address"
                                          rows="3"
                                          placeholder="আপনার সম্পূর্ণ ঠিকানা লিখুন"
                                          required>{{ Auth::check() ? Auth::user()->address : old('address') }}</textarea>
                                @error('address')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Delivery Area Options (Both Free on Promo) -->
                            <div class="col-12">
                                <label class="shutki-form-label d-flex justify-content-between align-items-center">
                                    <span><i class="fa-solid fa-truck-fast text-danger me-1"></i> ডেলিভারি এরিয়া নির্বাচন করুন <span class="text-danger">*</span></span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">ডেলিভারি ফ্রি</span>
                                </label>

                                <div class="shutki-zone-grid">
                                    <!-- Inside Dhaka -->
                                    <label>
                                        <input type="radio"
                                               name="delivery_zone"
                                               class="shutki-zone-radio"
                                               value="inside_dhaka"
                                               data-fee="{{ $insideFee }}"
                                               checked
                                               onchange="recalculateShutkiOrder()">
                                        <div class="shutki-zone-card">
                                            <span class="shutki-zone-title"><i class="fa-solid fa-location-dot text-danger me-1"></i> ঢাকার ভেতরে</span>
                                            <span class="shutki-zone-fee">ফ্রি ডেলিভারি (৳ {{ $insideFee }})</span>
                                        </div>
                                    </label>

                                    <!-- Outside Dhaka -->
                                    <label>
                                        <input type="radio"
                                               name="delivery_zone"
                                               class="shutki-zone-radio"
                                               value="outside_dhaka"
                                               data-fee="{{ $outsideFee }}"
                                               onchange="recalculateShutkiOrder()">
                                        <div class="shutki-zone-card">
                                            <span class="shutki-zone-title"><i class="fa-solid fa-map-location-dot text-primary me-1"></i> ঢাকার বাইরে (সারা দেশ)</span>
                                            <span class="shutki-zone-fee">ফ্রি ডেলিভারি (৳ {{ $outsideFee }})</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Optional Note -->
                            <div class="col-12">
                                <label for="note" class="shutki-form-label">
                                    বিশেষ কোনো নোট <span class="text-muted fw-normal">(ঐচ্ছিক)</span>
                                </label>
                                <textarea class="shutki-input"
                                          name="note"
                                          id="note"
                                          rows="2"
                                          placeholder="যেমন: বিকেলে ডেলিভারি দিলে ভালো হয়">{{ old('note') }}</textarea>
                            </div>
                        </div>

                        <!-- Summary Calculation Box -->
                        <div class="shutki-summary-box">
                            <div class="shutki-summary-row">
                                <span>প্যাকেজ মূল্য (<span id="calc-qty">১</span> টি):</span>
                                <span class="fw-bold">৳ <span id="calc-subtotal">{{ $offerPrice }}</span></span>
                            </div>
                            <div class="shutki-summary-row">
                                <span>ডেলিভারি চার্জ:</span>
                                <span class="fw-bold text-success" id="calc-delivery-text">ফ্রি (৳ 0)</span>
                            </div>
                            <div class="shutki-summary-total">
                                <span>সর্বমোট পরিশোধযোগ্য:</span>
                                <span class="text-danger">৳ <span id="calc-grand-total">{{ $offerPrice }}</span></span>
                            </div>
                        </div>

                        <!-- Submit Order Button -->
                        <div class="text-center">
                            <button type="submit" id="shutki-submit-btn" class="shutki-cta-btn w-100 py-3">
                                <i class="fa-solid fa-circle-check me-2"></i> Place Order — অর্ডার কনফার্ম করুন (ক্যাশ অন ডেলিভারি)
                            </button>
                        </div>
                    </form>

                    <!-- Direct WhatsApp Alternative -->
                    <div class="mt-3 text-center">
                        <p class="text-muted fs-13 mb-1">সরাসরি হোয়াটসঅ্যাপে কথা বলে অর্ডার করতে চান?</p>
                        <a href="https://wa.me/{{ $whatsappRaw }}?text={{ urlencode('Hello Food Junction, I want to order 3 Shwader Shutki Vorta Combo.') }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="shutki-btn-wa"
                           style="padding: 10px 22px; font-size: 14.5px;">
                            <i class="fa-brands fa-whatsapp fs-18"></i> হোয়াটসঅ্যাপে অর্ডার করুন
                        </a>
                    </div>

                    <!-- Trust Pills -->
                    <div class="shutki-trust-pills">
                        <div class="shutki-trust-pill">
                            <i class="fa-solid fa-truck-fast text-danger"></i> সারা বাংলাদেশে দ্রুত ডেলিভারি
                        </div>
                        <div class="shutki-trust-pill">
                            <i class="fa-solid fa-hand-holding-dollar text-success"></i> ক্যাশ অন ডেলিভারি
                        </div>
                        <div class="shutki-trust-pill">
                            <i class="fa-solid fa-shield-halved text-warning"></i> ১০০% স্বাস্থ্যসম্মত উপাদানের নিশ্চয়তা
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════════════════════
             6. FAQ ACCORDION SECTION (cb7 Layout)
             ══════════════════════════════════════════════════════════ -->
        <section class="shutki-faq-sec">
            <div class="shutki-container">
                <h2 class="shutki-sec-title">আপনার মনে থাকা কিছু প্রশ্ন</h2>
                <p class="shutki-sec-sub">
                    কম্বো এবং ডেলিভারি সংক্রান্ত সচরাচর জিজ্ঞাসিত প্রশ্ন ও উত্তর
                </p>

                <div class="shutki-faq-list">
                    <!-- Q1 -->
                    <details class="shutki-faq-item" open>
                        <summary class="shutki-faq-summary">
                            <span>কম্বোতে কী কী পাব?</span>
                        </summary>
                        <div class="shutki-faq-content">
                            চিংড়ি শুটকি ভর্তা, চাপা শুটকি ভর্তা আর বাঁশপাতা শুটকি ভর্তা, এই তিনটা জার একসাথে একটা কম্বোতে পাবেন।
                        </div>
                    </details>

                    <!-- Q2 -->
                    <details class="shutki-faq-item">
                        <summary class="shutki-faq-summary">
                            <span>দাম কত আর ডেলিভারি চার্জ কত?</span>
                        </summary>
                        <div class="shutki-faq-content">
                            অফার মূল্য ৳১৩০০, আগের দাম ছিল ৳১৫০০। আজকের এই স্পেশাল কম্বোতে ডেলিভারি সম্পূর্ণ ফ্রি।
                        </div>
                    </details>

                    <!-- Q3 -->
                    <details class="shutki-faq-item">
                        <summary class="shutki-faq-summary">
                            <span>কীভাবে খাব?</span>
                        </summary>
                        <div class="shutki-faq-content">
                            গরম ভাত, খিচুড়ি, রুটি বা পরোটার সাথে সরাসরি খেতে পারবেন।
                        </div>
                    </details>

                    <!-- Q4 -->
                    <details class="shutki-faq-item">
                        <summary class="shutki-faq-summary">
                            <span>কীভাবে অর্ডার করব?</span>
                        </summary>
                        <div class="shutki-faq-content">
                            পেজের নিচের অর্ডার ফর্মে নাম, মোবাইল নম্বর আর ঠিকানা দিন। "অর্ডার কনফার্ম করুন" বাটনে চাপ দিলেই আপনার অর্ডারটি কনফার্ম হয়ে যাবে এবং আমরা কল করে পাঠিয়ে দেব।
                        </div>
                    </details>
                </div>

                <!-- CTA Button -->
                <div class="text-center">
                    <a href="#order-section" class="shutki-cta-btn">
                        <i class="fa-solid fa-cart-shopping"></i> অর্ডার করতে চাই
                    </a>
                </div>
            </div>
        </section>

        <!-- ══════════════════════════════════════════════════════════
             7. CONTACT / URGENT SUPPORT (am7 Layout)
             ══════════════════════════════════════════════════════════ -->
        <section class="shutki-contact-sec">
            <div class="shutki-container">
                <div class="shutki-contact-card">
                    <div class="shutki-contact-icon">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>

                    <h2>জরুরি প্রয়োজনে কল বা মেসেজ করুন</h2>
                    <p class="text-muted small mb-1">অর্ডার বা যেকোনো প্রশ্নে সরাসরি আমাদের সাথে কথা বলুন।</p>

                    <a class="shutki-contact-num" href="tel:{{ $phoneRaw }}">
                        {{ $phoneDisplay }}
                    </a>

                    <div class="shutki-contact-btns">
                        <a class="shutki-btn-call" href="tel:{{ $phoneRaw }}">
                            <i class="fa-solid fa-phone"></i> কল করুন
                        </a>
                        <a class="shutki-btn-wa" href="https://wa.me/{{ $whatsappRaw }}" target="_blank" rel="noopener">
                            <i class="fa-brands fa-whatsapp fs-18"></i> মেসেজ করুন
                        </a>
                    </div>

                    <div style="margin-top: 28px; padding-top: 18px; border-top: 1px solid #E5E7EB; font-size: 13px; color: #9CA3AF;">
                        © {{ date('Y') }} Food Junction'র সর্বস্বত্ব সংরক্ষিত।
                    </div>
                </div>
            </div>
        </section>

    </div>

    <!-- ══════════════════════════════════════════════════════════
         8. STICKY BOTTOM FLOATING ORDER BAR
         ══════════════════════════════════════════════════════════ -->
    <div id="stickyBottomBar" class="sticky-bottom-bar">
        <div class="sticky-bar-left">
            <span class="sticky-bar-label">স্পেশাল প্যাকেজ মূল্য</span>
            <span class="sticky-bar-price">৳<span id="sticky-amount-display">{{ $offerPrice }}</span></span>
        </div>
        <a href="#order-section" class="sticky-buy-btn">
            <i class="fa-solid fa-cart-shopping"></i> এখনই কিনুন
        </a>
    </div>

@endsection

@push('scripts')
<script>
    // Bengali number formatting helper
    function toBengaliDigits(num) {
        const en = ['0','1','2','3','4','5','6','7','8','9'];
        const bn = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        return String(num).replace(/[0-9]/g, function(d) {
            return bn[d];
        });
    }

    // Live Order Calculation
    let unitPrice = {{ $offerPrice }};
    let currentQty = 1;

    function updateShutkiQty(delta) {
        currentQty += delta;
        if (currentQty < 1) currentQty = 1;
        if (currentQty > 50) currentQty = 50;

        document.getElementById('shutki-qty-input').value = currentQty;
        document.getElementById('form-quantity').value = currentQty;
        document.getElementById('calc-qty').innerText = toBengaliDigits(currentQty);

        recalculateShutkiOrder();
    }

    function recalculateShutkiOrder() {
        const selectedZoneRadio = document.querySelector('input[name="delivery_zone"]:checked');
        const deliveryFee = selectedZoneRadio ? parseFloat(selectedZoneRadio.getAttribute('data-fee') || 0) : 0;

        const subtotal = unitPrice * currentQty;
        const grandTotal = subtotal + deliveryFee;

        // Update DOM elements
        const subtotalEl = document.getElementById('calc-subtotal');
        if (subtotalEl) subtotalEl.innerText = subtotal.toLocaleString('en-US');

        const deliveryTextEl = document.getElementById('calc-delivery-text');
        if (deliveryTextEl) {
            if (deliveryFee === 0) {
                deliveryTextEl.innerText = 'ফ্রি (৳ 0)';
                deliveryTextEl.className = 'fw-bold text-success';
            } else {
                deliveryTextEl.innerText = '৳ ' + deliveryFee;
                deliveryTextEl.className = 'fw-bold text-dark';
            }
        }

        const grandTotalEl = document.getElementById('calc-grand-total');
        if (grandTotalEl) grandTotalEl.innerText = grandTotal.toLocaleString('en-US');

        const stickyDisplay = document.getElementById('sticky-amount-display');
        if (stickyDisplay) stickyDisplay.innerText = grandTotal.toLocaleString('en-US');
    }

    // 24-Hour Recurring Urgency Countdown Timer
    function startShutkiTimer() {
        const daysEl = document.getElementById('shutki-days');
        const hoursEl = document.getElementById('shutki-hours');
        const minutesEl = document.getElementById('shutki-minutes');
        const secondsEl = document.getElementById('shutki-seconds');

        if (!daysEl || !hoursEl || !minutesEl || !secondsEl) return;

        // Calculate end of day target
        function getRemainingTime() {
            const now = new Date();
            const endOfDay = new Date();
            endOfDay.setHours(23, 59, 59, 999);
            let diff = endOfDay - now;
            if (diff <= 0) {
                diff = 24 * 60 * 60 * 1000;
            }

            const h = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const m = Math.floor((diff / 1000 / 60) % 60);
            const s = Math.floor((diff / 1000) % 60);

            return {
                d: '০০',
                h: String(h).padStart(2, '0'),
                m: String(m).padStart(2, '0'),
                s: String(s).padStart(2, '0')
            };
        }

        function tick() {
            const t = getRemainingTime();
            daysEl.innerText = toBengaliDigits(t.d);
            hoursEl.innerText = toBengaliDigits(t.h);
            minutesEl.innerText = toBengaliDigits(t.m);
            secondsEl.innerText = toBengaliDigits(t.s);
        }

        tick();
        setInterval(tick, 1000);
    }

    // Sticky Bottom Bar visibility on scroll (Design & Behavior as Baklava Offer)
    function initStickyBar() {
        const bar = document.getElementById('stickyBottomBar') || document.getElementById('shutkiStickyBar');
        const orderSection = document.getElementById('order-section');
        if (!bar) return;

        function handleScroll() {
            const scrollY = window.scrollY || window.pageYOffset;
            if (scrollY > 300) {
                if (orderSection) {
                    const rect = orderSection.getBoundingClientRect();
                    if (rect.top <= window.innerHeight && rect.bottom >= 0) {
                        bar.classList.remove('show-bar');
                        bar.classList.remove('visible');
                        return;
                    }
                }
                bar.classList.add('show-bar');
                bar.classList.add('visible');
            } else {
                bar.classList.remove('show-bar');
                bar.classList.remove('visible');
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    // Smooth scroll for all CTA links targeting #order or #order-section
    document.querySelectorAll('a[href^="#order"]').forEach(function(anchor) {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.getElementById('order-section') || document.getElementById('order');
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        recalculateShutkiOrder();
        startShutkiTimer();
        initStickyBar();
    });
</script>
@endpush
