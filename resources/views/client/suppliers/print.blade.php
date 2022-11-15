<!DOCTYPE html>
<html>
<head>
    <title>
        @if(App::getLocale() == 'ar')
            طباعة الموردين الحاليين
        @else
            Print All Suppliers
        @endif
    </title>
    <meta charset="utf-8"/>
    <link rel="icon" href="{{asset('images/logo-min.png')}}" type="image/png">
    <link href="{{asset('app-assets/css-rtl/bootstrap.min.css')}}" rel="stylesheet"/>
    <style>
        @font-face {
            font-family: 'Cairo';
            src: url("{{asset('fonts/Cairo.ttf')}}");
        }

        body, html {
            font-family: 'Cairo';
            font-size: 15px;
        }

        i.la {
            font-size: 15px !important;
        }

        select.form-control {
            padding: 0 5px !important;
        }
    </style>
    <style type="text/css" media="screen">
        body, html {
            font-family: 'Cairo';
        }

        .table-container {
            width: 50%;
            margin: 10px auto;
        }

        .no-print {
            position: fixed;
            bottom: 0;
            right: 30px;
            border-radius: 0;
            z-index: 9999;
        }

        .logo {
            width: 100px;
            height: 100px;
            border: 1px solid #ccc;
            padding: 3px;
            border-radius: 5px;
        }

    </style>
    <style type="text/css" media="print">
        body, html {
            font-family: 'Cairo';
            -webkit-print-color-adjust: exact !important;
            -moz-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            -o-print-color-adjust: exact !important;
        }

        .no-print {
            display: none;
        }

        .img-footer {
            position: fixed;
            bottom: 0;
        }

        .logo {
            width: 100px;
            height: 100px;
            border: 1px solid #ccc;
            padding: 3px;
            border-radius: 5px;
        }
    </style>
</head>
<body style="background: #fff; padding-bottom: 50px;" dir="rtl">
<div class="text-center m-2 p-2">
    <img class="logo" src="{{asset($company->company_logo)}}" alt="">
</div>

<div class="text-center m-2 p-2">
    <div class="col-lg-12 text-center justify-content-center p-2">
        <p class="alert alert-secondary text-center alert-sm"
           style="margin: 10px auto; font-size: 17px;line-height: 1.9;" dir="rtl">
            {{$company->company_name}} <br>
            {{$company->business_field}} <br>
            {{$company->company_owner}} <br>
            {{$company->phone_number}} <br>

        </p>
    </div>
    <h6 class="alert alert-sm alert-success text-center">
        @if(App::getLocale() == 'ar')
            عرض الموردين الحاليين
        @else
            Show All Suppliers
        @endif
    </h6>
</div>

<table class="table table-condensed table-striped table-bordered text-center table-hover"
       id="example-table" dir="rtl">
    <thead>
    <tr>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                الاسم
            @else
                Name
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                الفئة
            @else
                Category
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                مستحقات
            @else
                Dues
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                المحل
            @else
                Shop Name
            @endif
        </th>

        <th class="text-center">
            @if(App::getLocale() == 'ar')
                بريد الكترونى
            @else
                Email
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                جنسية
            @else
                Nationality
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                رقم ضريبى
            @else
                Tax Number
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                تليفون
            @else
                Phone
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                عنوان
            @else
                Address
            @endif
        </th>
    </tr>
    </thead>
    <tbody>
    @php
        $i=0;
    @endphp
    @foreach ($suppliers as $key => $supplier)
        <tr>
            <td>{{ $supplier->supplier_name }}</td>
            <td>{{trans('main.'.$supplier->supplier_category)}}</td>
            <td>
                @if($supplier->prev_balance > 0 )
                    @if(App::getLocale() == 'ar')
                        له
                    @else
                        Creditor
                    @endif
                    {{floatval( $supplier->prev_balance  )}}
                @elseif($supplier->prev_balance < 0)
                    @if(App::getLocale() == 'ar')
                        عليه
                    @else
                        Debtor
                    @endif

                    {{floatval( abs($supplier->prev_balance)  )}}
                @else
                    0
                @endif
            </td>
            <td>{{ $supplier->shop_name }}</td>
            <td>{{ $supplier->supplier_email }}</td>
            <td>{{ $supplier->supplier_national }}</td>
            <td>{{ $supplier->tax_number }}</td>
            <td>
                @if(!$supplier->phones->isEmpty())
                    @foreach($supplier->phones as $phone)
                        {{$phone->supplier_phone}} <br>
                    @endforeach
                @endif
            </td>
            <td>
                @if(!$supplier->addresses->isEmpty())
                    @foreach($supplier->addresses as $address)
                        {{$address->supplier_address}} <br>
                    @endforeach
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
<button onclick="window.print();" class="no-print btn btn-lg btn-success">
    @if(App::getLocale() == 'ar')
        طباعة
    @else
        Print
    @endif
</button>
<a href="{{route('client.suppliers.index')}}" style="margin-right:110px;"
   class="no-print btn btn-lg btn-danger">
    @if(App::getLocale() == 'ar')
        عودة الى عرض الموردين الحاليين
    @else
        Back To All Suppliers
    @endif
</a>
</body>
</html>
