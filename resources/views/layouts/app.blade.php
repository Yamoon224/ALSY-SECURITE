<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'ALSY SECURITE') }}</title>
        <meta name="description" content="ALSY SECURITE OFFICIAL WEBSITE">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('flaticon/flaticon.css') }}">
        <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/featherlight.css') }}">
        <link rel="stylesheet" href="{{ asset('css/featherlight.gallery.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        @stack('links')
    </head>
    <body>
        <x-header></x-header>

        {{ $slot }}

        <x-footer></x-footer>
        
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/featherlight.js') }}"></script>
        <script src="{{ asset('js/featherlight.gallery.js') }}"></script>
        <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
        @stack('scripts')
        <script src="{{ asset('js/gmap.js') }}"></script>
        <script src="{{ asset('js/progressbar.min.js') }}"></script>
        <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('js/waypoints-min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
    </body>
</html>
