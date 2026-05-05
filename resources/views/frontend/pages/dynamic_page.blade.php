@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    {{ $dynamic_page->page_title }} | Food Junction
@endsection

@section('content')

    <div class="container">
        <h2 class="text-center pt-2">{{ $dynamic_page->page_title ?? '' }}</h2>
        <section class="user-dashboard-page py-5">
            {!! $dynamic_page->page_content !!}
        </section>
    </div>

@endsection

@push('styles')
    <style>

    </style>
@endpush

@push('scripts')
    <script>

    </script>
@endpush

