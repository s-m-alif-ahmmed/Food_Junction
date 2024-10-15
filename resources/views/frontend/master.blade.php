<!doctype html>
<html lang="ba">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @yield('meta_infos')

    {{--Favicon--}}
    <link rel="icon" type="x-icon/images" href="{{ asset('/frontend/images/brands/food_junction_favicon.jpg') }}">

    <title>@yield('title')</title>

    @include('frontend.includes.css')

    @include('frontend.includes.codes.google-search-console')

    @stack('styles')

</head>
<body>

@include('frontend.includes.header')

@yield('content')

@include('frontend.includes.footer')

@include('frontend.includes.js')

@stack('scripts')

</body>
</html>
