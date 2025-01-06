@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    FAQ | Food Junction
@endsection

@push('styles')
    <style>
        .accordion .accordion-item {
            border-top: none;
            border-left: none;
            border-right: none;
            border-bottom: none;
        }
        .accordion .accordion-item .accordion-header {
            border-bottom: 2px solid var(--red);
        }
        .accordion .accordion-item .accordion-header .accordion-button {
            background-color: white;
            padding: 10px 5px ;
        }
        .accordion .accordion-item .accordion-header .accordion-button:focus {
            box-shadow: none;
            outline: none;
        }
        .accordion .accordion-item .accordion-body {
            padding: 10px 5px ;
        }
    </style>
@endpush

@section('content')

    <section class="sweet-page">

        <div class="container-fluid pb-3">
            <div class="row">
                <div class="col-lg-12 section-heading background-gradient">
                    <p class="heading-text">FAQ</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-md-8 col-sm-12 col-12">
                    <div class="accordion" id="accordionExample">
                        @foreach($faqs as $index => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->question }}
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <p>{{ $faq->answer }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
