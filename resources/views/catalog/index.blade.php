<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <base href="{{ asset('') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stack('canonical')
<!-- Favicons -->
    <link rel="icon" href="{{ asset('catalog/img/favicons/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('catalog/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/libs/flickity/dist/flickity.min.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/libs/highlightjs/styles/vs2015.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/libs/simplebar/dist/simplebar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/libs/flickity-fade/flickity-fade.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/fonts/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('catalog/libs/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <!-- Libs CSS -->
@stack('styles')

<!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('catalog/css/theme.min.css') }}">

    <title>{{ config('main.home.title') }}</title>

</head>
<body>

<!-- MODALS -->
@include('catalog.modals')
<!-- NAVBAR -->
@include('catalog.navbar')
@yield('content')
<!-- FOOTER -->
@include('catalog.footer')

<!-- JAVASCRIPT -->
<!-- Libs JS -->
<script src="{{ asset('catalog/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('catalog/libs/@fancyapps/fancybox/dist/jquery.fancybox.min.js') }}"></script>
<script src="{{ asset('catalog/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('catalog/libs/flickity/dist/flickity.pkgd.min.js') }}"></script>
<script src="{{ asset('catalog/libs/highlightjs/highlight.pack.min.js') }}"></script>
<script src="{{ asset('catalog/libs/jarallax/dist/jarallax.min.js') }}"></script>
<script src="{{ asset('catalog/libs/list.js/dist/list.min.js') }}"></script>
<script src="{{ asset('catalog/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('catalog/libs/smooth-scroll/dist/smooth-scroll.min.js') }}"></script>
<script src="{{ asset('catalog/libs/flickity-fade/flickity-fade.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@stack('scripts')

</body>
</html>
