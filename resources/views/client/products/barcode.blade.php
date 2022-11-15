<!DOCTYPE html>
<html>
<head>
    <title>
        @if(App::getLocale() == 'ar')
            طباعة ليبل الباركود للمنتج
        @else
            Product Barcode label print
        @endif
    </title>
    <meta charset="utf-8"/>
    <link rel="icon" href="{{asset('images/logo-min.png')}}" type="image/png">
    <style>
        body {
            -webkit-print-color-adjust: exact;
            -moz-print-color-adjust: exact;
            print-color-adjust: exact;
            -o-print-color-adjust: exact;
            padding: 0;
            margin: 0;
            color: #000 !important;
        }

        div.barcode {
            max-width: 300px !important;
            min-width: 200px !important;
            width: auto !important;
            height: auto;
            border: 1px solid #000;
            text-align: center;
            padding-bottom: 5px;
            margin: 5px auto;
            font-size: 14px;
            page-break-before: always;
            page-break-after: always;
            page-break-inside: avoid;
        }

        div.barcode div.barcode-img div {
            text-align: center;
            margin: 0px auto;
        }

        div.barcode div {
            margin-top: 5px;
        }

        div.barcode div.barcode-number {
            margin-top: 0px;
        }
    </style>
</head>
<body>
@php $i=1; @endphp
@if(isset($count) && !empty($count))
    @while($i <= $count)
        <div class="barcode">
            <div>{{$product->product_name}}</div>
            <div class="barcode-img">{!! DNS1D::getBarcodeHTML($product->code_universal, 'I25') !!}</div>
            <div class="barcode-number">{{$product->code_universal}}</div>
            <div>

                @if(App::getLocale() == 'ar')
                    السعر
                @else
                    price
                @endif
                :
                {{$product_unit->sector_price}}</div>
        </div>
        @php $i++; @endphp
    @endwhile
@endif

<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(window).on('load', function () {
        window.print();
    });
</script>

</body>
</html>

