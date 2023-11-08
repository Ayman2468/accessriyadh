<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale()== 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" value="{{ csrf_token() }}"/>
    <link rel="icon" href="{{ asset('img/cropped-Access-2-rgb-02-32x32.jpg') }}" sizes="32x32" />
    <link rel="icon" href="{{ asset('img/cropped-Access-2-rgb-02-192x192.jpg') }}" sizes="192x192" />
    <link rel="apple-touch-icon" href="{{ asset('img/cropped-Access-2-rgb-02-180x180.jpg') }}" />
    <title>@lang('Header.Access_Riyadh')</title>

    @if(app()->getLocale()== 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css"
              integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeQ3fltAfSmuZFrkAif0T+UtNGlKKQv"
              crossorigin="anonymous">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
              crossorigin="anonymous">
    @endif
<!-- Fonts -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.3.0/css/all.min.css"
          integrity="sha256-/4UQcSmErDzPCMAiuOiWPVVsNN2s3ZY/NsmXNcj0IFc=" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @if(app()->getLocale()== 'ar')
        <link rel="stylesheet" href="{{asset('css/style-rtl.css')}}">
    @endif
    <script src="/lang-{{ app()->getLocale() }}.js?v={{ now() }}"></script>
    @if(!empty(auth()->user()))
        <script>
            window.sessionStorage.setItem('user',true);
        </script>
    @else
        <script>
            window.sessionStorage.removeItem('user');
        </script>
    @endif
    @vite('resources/css/app.css')
    <style>
        .invalid-feedback {
            display: initial;
        }
    </style>
</head>
<body class="antialiased">
<div id="app"></div>
<form id="logout-form" action="/logout" method="POST" class="d-none">
    @csrf
</form>
@vite('resources/js/app.js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script>
    window.onload = function () {
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    }
</script>
</body>
</html>
