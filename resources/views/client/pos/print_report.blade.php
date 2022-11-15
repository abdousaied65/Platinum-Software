<!DOCTYPE html>
<html>
<head>
    <title>
        @if(App::getLocale() == 'ar')
            طباعة تقرير مبيعات نقاط البيع
        @else
            print pos sales report
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
            font-size: 13px;
        }

        i.la {
            font-size: 13px !important;
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

        .badge {
            background: #fff !important;
            color: #000 !important;
            border: 0 !important;
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
<div class="text-center m-1 p-1">
    <img class="logo" src="{{asset($company->company_logo)}}" alt="">
</div>

<div class="text-center m-1 p-1">
    <div class="col-lg-12 text-center justify-content-center p-1">
        <p class="alert alert-secondary text-center alert-sm"
           style="margin: 0px auto; font-size: 14px;line-height: 1.5;" dir="rtl">
            {{$company->company_name}} --
            {{$company->business_field}} <br>
            {{$company->company_owner}} --
            {{$company->phone_number}} <br>

        </p>
    </div>
    <h6 class="alert alert-sm alert-success text-center">
        @if(App::getLocale() == 'ar')
            تقرير مبيعات نقاط البيع
        @else
            pos sales report
        @endif
    </h6>
</div>

<table class="table table-condensed table-striped table-bordered text-center table-hover"
       id="example-table">
    <thead>
    <tr>
        <th class="text-center">#</th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                رقم الفاتورة
            @else
                bill number
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                اسم العميل
            @else
                client name
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                تاريخ الفاتورة
            @else
                bill date
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                حالة الدفع
            @else
                payment status
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                المبلغ المستحق
            @else
                deserved amount
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                المبلغ المدفوع
            @else
                paid amount
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                المبلغ المتبقى
            @else
                rest amount
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                الضريبة
            @else
                tax value
            @endif
        </th>
        <th class="text-center">
            @if(App::getLocale() == 'ar')
                عدد المواد
            @else
                items count
            @endif
        </th>
    </tr>
    </thead>
    <tbody>
    @php
        $i=0;
        $sum1 = 0; $sum2 = 0 ; $sum3 =0;
    @endphp
    @foreach ($pos_sales as $key => $pos)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $pos->id }}</td>
            <td>
                @if(isset($pos->outerClient->client_name))
                    {{$pos->outerClient->client_name}}
                @else
                    @if(App::getLocale() == 'ar')
                        زبون
                    @else
                        walk in customer
                    @endif
                @endif
            </td>
            <td>{{ $pos->created_at}}</td>
            <td>
                <?php
                $bill_id = "pos_" . $pos->id;
                $check = App\Models\Cash::where('bill_id', $bill_id)->first();
                if (empty($check)) {
                    $check2 = App\Models\BankCash::where('bill_id', $bill_id)->first();
                    if (empty($check2)) {
                        if (App::getLocale() == 'ar') {
                            echo "<span class='badge badge-danger'><i class='fa fa-close'></i> غير مدفوعة - دين على العميل</span>";
                        } else {
                            echo "<span class='badge badge-danger'><i class='fa fa-close'></i> un paid </span>";
                        }
                    } else {
                        if (App::getLocale() == 'ar') {
                            echo "<span class='badge badge-info'><i class='fa fa-bank'></i> مدفوعة شيك بنكى</span>";
                        } else {
                            echo "<span class='badge badge-info'><i class='fa fa-bank'></i> paid - bank</span>";
                        }

                    }
                } else {
                    if (App::getLocale() == 'ar') {
                        echo "<span class='badge badge-success'><i class='fa fa-money'></i> مدفوعة كاش</span>";
                    } else {
                        echo "<span class='badge badge-success'><i class='fa fa-money'></i> paid - cash  </span>";
                    }

                }
                ?>
            </td>
            <td>
                @if(isset($pos))
                    <?php
                    $pos_elements = $pos->elements;
                    $pos_discount = $pos->discount;
                    $pos_tax = $pos->tax;
                    $percent = 0;

                    $sum = 0;
                    foreach ($pos_elements as $pos_element) {
                        $sum = $sum + $pos_element->quantity_price;
                    }
                    if (isset($pos) && isset($pos_tax) && empty($pos_discount)) {
                        $tax_value = $pos_tax->tax_value;
                        $percent = $tax_value / 100 * $sum;
                        $sum = $sum + $percent;
                    } elseif (isset($pos) && isset($pos_discount) && empty($pos_tax)) {
                        $discount_value = $pos_discount->discount_value;
                        $discount_type = $pos_discount->discount_type;
                        if ($discount_type == "pound") {
                            $sum = $sum - $discount_value;
                        } else {
                            $discount_value = ($discount_value / 100) * $sum;
                            $sum = $sum - $discount_value;
                        }
                    } elseif (isset($pos) && !empty($pos_discount) && !empty($pos_tax)) {
                        $tax_value = $pos_tax->tax_value;
                        $discount_value = $pos_discount->discount_value;
                        $discount_type = $pos_discount->discount_type;
                        if ($discount_type == "pound") {
                            $sum = $sum - $discount_value;
                        } else {
                            $discount_value = ($discount_value / 100) * $sum;
                            $sum = $sum - $discount_value;
                        }
                        $percent = $tax_value / 100 * $sum;
                        $sum = $sum + $percent;
                    }
                    echo $sum;
                    $sum1 = $sum1 + $sum;
                    ?>
                @else
                    0
                @endif
            </td>
            <td>
                <?php
                $bill_id = "pos_" . $pos->id;
                $check = App\Models\Cash::where('bill_id', $bill_id)->first();
                if (empty($check)) {
                    $check2 = App\Models\BankCash::where('bill_id', $bill_id)->first();
                    if (empty($check2)) {
                        echo $paid = "0";
                        $sum2 = $sum2 + 0;
                    } else {
                        echo $paid = $check2->amount;
                        $sum2 = $sum2 + $check2->amount;
                    }
                } else {
                    echo $paid = $check->amount;
                    $sum2 = $sum2 + $check->amount;
                }
                ?>
            </td>
            <td>
                <?php
                $rest = $sum - $paid;
                echo $rest;
                ?>
            </td>
            <td>
                {{$percent}}
                <?php
                $sum3 = $sum3 + $percent;
                ?>
            </td>
            <td>
                @if(isset($pos))
                    <?php
                    $pos_elements = $pos->elements;
                    ?>
                    {{$pos_elements->count()}}
                @else
                    0
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
        print
    @endif
</button>
<a href="{{route('client.pos.create')}}" style="margin-right:110px;"
   class="no-print btn btn-lg btn-danger">
    @if(App::getLocale() == 'ar')
        عودة الى نقطة البيع
    @else
        Back To POS
    @endif
</a>
</body>
</html>
