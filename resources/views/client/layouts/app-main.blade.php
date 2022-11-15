<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>
        @if(App::getLocale() == 'ar')
            {{$system->name_ar}}
        @else
            {{$system->name_en}}
        @endif
    </title>
    <meta name="_token" content="{{csrf_token()}}"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @include('client.layouts.common.css_links')

    <style type="text/css" media="print">
        @media print {
            .app-content, .content {
                margin-right: 0 !important;
            }

            body {
                -webkit-print-color-adjust: exact;
                -moz-print-color-adjust: exact;
                print-color-adjust: exact;
                -o-print-color-adjust: exact;
            }

            .no-print {
                display: none;
            }

            .printy {
                display: block !important;
            }

            table thead tr th, table tbody tr td {
                color: #000 !important;
                border: 1px solid #000 !important;
            }

            .alert, .alert-sm, .alert-info, .alert-primary {
                color: #000 !important;
            }
        }
    </style>
    <style>

        .tx-20 {
            font-size: 20px !important;
        }

        .tx-18 {
            font-size: 18px !important;
        }

        .tx-16 {
            font-size: 16px !important;
        }

        .img-icon {
            width: 15px;
            height: 15px;
            margin-left: 10px;
        }

        @font-face {
            font-family: 'Cairo';
            src: url("{{asset('fonts/Cairo.ttf')}}");
        }

        label {
            font-size: 13px !important;
            display: block !important;
        }

        table {
            font-size: 13px !important;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo' !important;
        }

        .dropdown-menu.dropdown-menu-right.show {
            width: 200px !important;
        }

        body, html {
            font-family: 'Cairo' !important;
        }

        * {
            font-size: {{$extra->font_size}}px !important;
            text-transform: capitalize !important;
        }

        .navigation.navigation-main {
            padding-bottom: 50px !important;
        }

        .btn.dropdown-toggle.bs-placeholder, .btn.dropdown-toggle {
            height: 40px !important;
        }

        .alarm-upgrade {
            font-family: 'Cairo' !important;
            font-size: 14px;
            padding-top: 10px;
        }

        table thead tr th, table tbody tr td {
            color: #000 !important;
            border: 1px solid #000 !important;
        }

        .alert, .alert-sm, .alert-info, .alert-primary {
            color: #000 !important;
        }

    </style>
</head>

<body class="vertical-layout vertical-menu-modern 2-columns menu-expanded fixed-navbar"
    data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
@include('client.layouts.common.header')

@include('client.layouts.common.ul_sidebar')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">

        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
@include('client.layouts.common.footer')

@include('client.layouts.common.js_links')
<div class="modal" id="modaldemo">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content modal-content-demo">
            <div class="modal-header text-center">
                <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                    @if(App::getLocale() == 'ar')
                        سياسة الخصوصية
                    @else
                        Privacy Policy
                    @endif
                </h6>
                <button aria-label="Close" class="close"
                        data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body text-center" dir="rtl">
                <ul dir="rtl">
                    @if(App::getLocale() == 'ar')
                        <li> قد يتم استخدام بياناتك لضمان حفظ الجودة</li>
                        <li> لا يتم مشاركة بيانات مع افراد اخرين</li>
                        <li> قد يتم استعمال بياناتك من أجل التواصل معك او لحل مشاكل</li>
                        <li> مع ملاحظة ان أمن بياناتك هى من اهم اولوياتنا</li>
                    @else
                        <li>Your data may be used to ensure quality preservation</li>
                        <li>No data is shared with other people</li>
                        <li>Your data may be used to communicate with you or solve problems</li>
                        <li>Noting that the security of your data is one of our top priorities</li>
                    @endif
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
            </div>
        </div>
    </div>
</div>

</body>
</html>
