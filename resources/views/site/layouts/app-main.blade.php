<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="{{asset('images/favicon.png')}}" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>
        @if(App::getLocale() == 'ar')
            {{$system->name_ar}}
        @else
            {{$system->name_en}}
        @endif
    </title>
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" type="image/x-icon">
    @include('site.layouts.common.css_links')
    <style>
        @font-face {
            font-family: 'Cairo';
            src: url("{{asset('fonts/Cairo.ttf')}}");
        }

        body, html {
            font-family: 'Cairo' !important;
        }

        h1, h2, h3, h4, h5, h6, p, span {
            font-family: 'Cairo' !important;
        }

        .dropdown-item {
            font-size: 14px !important;
        }

        .language a img {
            width: 30px !important;
            height: 20px !important;
        }
    </style>
</head>
<body>
<!-- ==========Preloader========== -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- ==========Preloader========== -->
<!-- ==========Overlay========== -->
<div class="overlay"></div>
<a href="#0" class="scrollToTop pt-2">
    <i class="fa fa-angle-up" style="font-size: 26px;"></i>
</a>
<!-- ==========Header-Section========== -->
<header class="header-section">
    <div class="container">
        <div class="header-wrapper">
            <div class="logo text-center">
                <a class="text-center" href="{{route('index')}}">
                    @if(empty($system->profile->profile_pic))
                        <img style="width: 60px; height: 60px;margin-top: 10px; margin-bottom: 5px;"
                             src="{{asset('app-assets/images/logo.png')}}" alt="logo">
                    @else
                        <img style="width: 60px; height: 60px;margin-top: 10px; margin-bottom: 5px;"
                             src="{{asset($system->profile->profile_pic)}}" alt="logo">
                    @endif
                </a><br>
                <a style="margin-bottom: 10px;">
                    @if(App::getLocale() == 'ar')
                        {{$system->name_ar}}
                    @else
                        {{$system->name_en}}
                    @endif
                </a>
            </div>
            <ul class="menu">
                <li>
                    <a href="{{route('index')}}">
                        <i class="fa fa-home"></i>

                        @if(App::getLocale() == 'ar')
                            الرئيسية
                        @else
                            Home
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{route('about')}}">
                        <i class="fa fa-info-circle"></i>
                        @if(App::getLocale() == 'ar')
                            من نحن
                        @else
                            About
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{route('contact')}}">
                        <i class="fa fa-envelope-o"></i>
                        @if(App::getLocale() == 'ar')
                            تواصل معنا
                        @else
                            Contact Us
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{route('index3')}}">
                        <i class="fa fa-user-plus"></i>
                        @if(App::getLocale() == 'ar')
                            انشاء حساب جديد
                        @else
                            Create an Account
                        @endif
                    </a>
                </li>

                <li>
                    <a href="{{route('client.login')}}">
                        <i class="fa fa-sign-in"></i>
                        @if(App::getLocale() == 'ar')
                            تسجيل الدخول
                        @else
                            Login
                        @endif
                    </a>
                </li>
                @if(App::getLocale() == 'ar')
                    <li class="language">
                        <a href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                            <img src="{{asset('images/lang/en.png')}}" alt="">
                        </a>
                    </li>
                @else
                    <li class="language">
                        <a href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                            <img src="{{asset('images/lang/ar.png')}}" alt="">
                        </a>
                    </li>
                @endif
            </ul>
            <div class="header-bar d-lg-none">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
</header>
<!-- ==========Header-Section========== -->

<!-- ==========Overlay========== -->
@yield('content')
<footer class="footer-section" style="background:#0a1e5e;padding-top: 10px;">
    <div class="container">
        <div class="footer-top">
            <div class="logo text-center">
                <a href="{{route('index')}}">


                    @if(empty($system->profile->profile_pic))
                        <img style="width: 60px!important;height: 60px!important;"
                             src="{{asset('app-assets/images/logo.png')}}" alt="footer">
                    @else
                        <img style="width: 60px!important;height: 60px!important;"
                             src="{{asset($system->profile->profile_pic)}}" alt="footer">
                    @endif

                </a>
                <br>
            </div>
            <ul class="social-icons">
                <li>
                    <a class="pt-2" target="_blank"
                       href="https://api.whatsapp.com/send/?phone={{$informations->whatsapp_number}}&text={{$informations->whatsapp_message}}&app_absent=0">
                        <i class="fa fa-whatsapp"></i>
                    </a>
                </li>
                <li>
                    <a class="pt-2" target="_blank" href="mailto:{{$informations->email_link}}">
                        <i class="fa fa-google"></i>
                    </a>
                </li>
                <li>
                    <a class="pt-2" target="_blank" href="{{$informations->facebook_link}}">
                        <i class="fa fa-facebook"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="footer-bottom">
            <div class="footer-bottom-area">
                <div class="left">
                    <p dir="rtl">
                        @if(App::getLocale() == 'ar')
                            حقوق المنصة محفوظة
                        @else
                            All copy rights are reserved .
                    @endif
                    @if(App::getLocale() == 'ar')
                        {{$system->name_ar}}
                    @else
                        {{$system->name_en}}
                    @endif
                </div>
                <ul class="links" dir="rtl">
                    <li>
                        <a href="{{route('index')}}">
                            @if(App::getLocale() == 'ar')
                                الرئيسية
                            @else
                                Home
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{route('about')}}">
                            @if(App::getLocale() == 'ar')
                                من نحن
                            @else
                                About
                            @endif
                        </a>
                    </li>
                    <li>
                        <a href="{{route('contact')}}">
                            @if(App::getLocale() == 'ar')
                                تواصل معنا
                            @else
                                Contact
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{route('index3')}}">
                            <i class="fa fa-user-plus"></i>
                            @if(App::getLocale() == 'ar')
                                انشاء حساب جديد
                            @else
                                Create an Account
                            @endif
                        </a>
                    </li>

                    <li>
                        <a href="{{route('client.login')}}">
                            <i class="fa fa-sign-in"></i>
                            @if(App::getLocale() == 'ar')
                                تسجيل الدخول
                            @else
                                Login
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
@include('site.layouts.common.js_links')
</body>
</html>
