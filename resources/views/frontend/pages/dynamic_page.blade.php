@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    {{ $dynamic_page->page_title }}
@endsection

@section('content')

    <section class="user-dashboard-page py-5">
        {!! $dynamic_page->page_content !!}
    </section>

@endsection

@push('styles')
    <style>

    </style>
@endpush

@push('scripts')
    <script>

    </script>
@endpush

