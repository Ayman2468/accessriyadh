<!doctype html>
@php
    if(!isset(request()->cookie()['locale'])) {
        cookie()->queue(cookie('locale','en'));
        $locale = 'en';
        $dir = 'ltr';
    }else{
        if(request()->cookie()['locale'] == 'ar'){
            $locale = 'ar';
            $dir = 'rtl';
        }else{
            $locale = 'en';
            $dir = 'ltr';
        }
    }
@endphp
<html lang="{{ app()->setLocale($locale) }}" dir="{{ $dir }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
          integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset("dashboard/css/style.css")}}">
    {{--    @if(session('locale') == 'ar')--}}
    <link rel="stylesheet" href="{{asset('dashboard/css/style-rtl.css')}}?v={{ now() }}">
    {{--    @endif--}}
    <title>@lang('Header.'.env("APP_NAME","Access_Riyadh")) {{ $title ?? '' }}</title>
    <link id="favicon" rel="shortcut icon" type="image/png" href="{{asset("dashboard/images/logo.webp")}}" src="{{asset("dashboard/images/logo.webp")}}">

    <style>
        .text-red-600{
            color: #b21432;
        }

    </style>
</head>
<body>

<header class="header position-fixed w-100 d-flex justify-content-between align-items-start p-4">
    <div class="brand mt-2">
        <a href="#" class="logo d-table">
            <img style="width: 120px;" src="{{asset("dashboard/images/logo.webp")}}">
        </a>

    </div>
    <div>
        <a href="/" class="btn btn-light">@lang('general.Home Page')</a>
    </div>
</header>
<section class="signup h-100 ">
    <div class="container-signup d-flex h-100">
        <div class="section-left">
            <h1 class=" d-flex mt-2" style="color: #267c3f;">
                @lang('general.Access Riyadh')
            </h1>
            @if(!isset($_GET['user']))
                <h3 class=" d-flex mt-4" style="color: #629d4b;">
                    @lang('general.Dashboard')
                </h3>
            @endif
        </div>
        <div class="section-right">
            <div class="form-sign card card-width p-5">
                @yield("content")
            </div>
            <div class="footer-signup m-auto my-0">
                <ul class="list-unstyled ">
                    {{--                    <li class="d-inline-block"><a href="https://instagram.com/rubi.sys?igshid=YmMyMTA2M2Y=" target="_blank">@lang('login.Contact Us')</a></li>--}}
                    {{--                    <li class="d-inline-block"><a href="#">@lang('login.FAQ')</a></li>--}}
                    {{--                    <li class="d-inline-block"><a href="#">@lang('login.Privacy Policy')</a></li>--}}
                </ul>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<script src="{{asset("/dashboard/js/jquery-3.6.0.min.js")}}"></script>
<script>
    $('.show-pass').on('click',function(){
        if ($(this).prev().attr('type') == "password") {
            $(this).prev().attr('type','text');
        } else {
            $(this).prev().attr('type','password');
        }
    });
</script>
@yield("js_code")
</body>
</html>
