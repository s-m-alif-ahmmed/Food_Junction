@extends('frontend.master')

@section('meta_infos')
    <meta name="author" content="Food Junction">
    <meta name="description" content="Food Junction">
    <meta name="keywords" content="Food Junction, Food, Junction, Dhaka, Sweets">
@endsection

@section('title')
    Contact | Food Junction
@endsection

@section('content')

    <section class="contact-page-section">
        <div class="container">

            <div class="sec-title-style1 text-center max-width">
                <div class="title">Contact Us</div>
                <div class="text"><div class="decor-left"><span></span></div><p>Quick Contact</p><div class="decor-right"><span></span></div></div>
                <div class="bottom-text">
                    <p>Fixyman is proud to be the name that nearly 1 million homeowners have trusted since 1996 for home improvement and repair, providing virtually any home repair.</p>
                </div>
            </div>

            <div class="form-container">
                <div class="left-container">
                    <div class="left-inner-container">
                        <h2>Let's Chat</h2>
                        <p class="text-center">Lorem ipsum dolor sit amet, consectetur adi? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci, corporis.</p>
                        <div class="contact-infos">
                            <p><span><i class="fa-brands fa-whatsapp"></i></span> Whatsapp: <span>+88 01799-999999</span> </p>
                            <p><span><i class="fa fa-mobile-phone"></i></span> Phone Number: <span>+88 01799-999999</span> </p>
                            <p><span><i class="fa fa-envelope"></i></span> Email: <span>foodjunction@gmail.com</span> </p>
                            <p><span><i class="fa-solid fa-location-dot"></i></span> Location: <span>Uttara, Dhaka-1212</span> </p>
                        </div>
                    </div>
                </div>
                <div class="right-container">
                    <div class="right-inner-container">
                        <h2 class="lg-view">Contact</h2>
                        <form action="{{ route('contact.store') }}" method="post">
                            @csrf
                            @method('POST')

                            <input type="text" name="name" placeholder="Name *"  />
                            @error('name')
                            <div class="error-message">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror

                            <input type="email" name="email" placeholder="Email *" />
                            @error('email')
                            <div class="error-message">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror

                            <input type="text" name="number" placeholder="Phone Number *" />
                            @error('number')
                            <div class="error-message">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror

                            <input type="text" name="subject" placeholder="Subject" />
                            @error('subject')
                            <div class="error-message">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror

                            <textarea name="message" rows="4" placeholder="Message"></textarea>
                            @error('message')
                            <div class="error-message">
                                <span>{{ $message }}</span>
                            </div>
                            @enderror

                            <button type="submit">Submit</button>

                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('scripts')
    <script>
        // Trigger toaster based on session messages
        @if (session('t-success'))
        showSuccessToast("{{ session('t-success') }}");
        @endif

        @if (session('t-error'))
        showErrorToast("{{ session('t-error') }}");
        @endif
    </script>
@endpush
