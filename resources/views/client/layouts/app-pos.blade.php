<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0"/>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <meta name="description" content="@if(App::getLocale() == 'ar')
    {{$system->name_ar}}
@else
    {{$system->name_en}}
@endif"/>
    <meta name="keywords" content="@if(App::getLocale() == 'ar')
    {{$system->name_ar}}
@else
    {{$system->name_en}}
@endif"/>
    <title>
        @if(App::getLocale() == 'ar')
    {{$system->name_ar}}
@else
    {{$system->name_en}}
@endif
    </title>
    <link rel="icon" href="{{asset('app-assets/images/favicon.ico')}}" type="image/png">
    <meta name="_token" content="{{csrf_token()}}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('client.layouts.common.css_links')

    <style type="text/css" media="print">
        @media print {
            body {
                -webkit-print-color-adjust: exact;
                -moz-print-color-adjust: exact;
                print-color-adjust: exact;
                -o-print-color-adjust: exact;
            }
            .no-print {display:none;}
            .printy {display: block !important;}
        }
    </style>
    <style>
        .img-icon{
            width: 15px; height: 15px; margin-left: 10px;
        }
        @font-face {
            font-family: 'Cairo';
            src: url("{{asset('fonts/Cairo.ttf')}}");
        }
        label{
            font-size: 13px !important;
        }

        table {
            font-size: 13px !important;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo' !important;
        }
        .dropdown-menu.dropdown-menu-right.show{
            width: 200px !important;
        }
        body, html {
            font-family: 'Cairo' !important;
            font-size: 13px !important;
            margin: 0!important;padding: 0!important;
        }
        .navigation.navigation-main{
            padding-bottom: 50px !important;
        }
        .alarm-upgrade{
            font-family: 'Cairo' !important;
            font-size: 14px;
        }
        .btn.dropdown-toggle.bs-placeholder,.btn.dropdown-toggle{
            height: 40px !important;
        }
        *{
            text-transform: capitalize !important;
        }
    </style>
    <!-- Facebook Pixel Code -->
</head>

<body>
<div class="app-content content">
    @yield('content')
</div>
@include('client.layouts.common.js_links')
</body>
</html>
