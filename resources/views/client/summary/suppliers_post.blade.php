<?php
$company = \App\Models\Company::FindOrFail($supplier_k->company_id);
$extra_settings = \App\Models\ExtraSettings::where('company_id', $company->id)->first();
$currency = $extra_settings->currency;
?>
    <!DOCTYPE html>
<html>
<head>
    <title>
        @if(App::getLocale() == 'ar')
            كشف حساب مورد
        @else
            Supplier Summary Report
        @endif
    </title>
    <meta charset="utf-8"/>
    <link href="{{asset('app-assets/css-rtl/bootstrap.css')}}" rel="stylesheet"/>
    <style type="text/css" media="screen">
        @font-face {
            font-family: 'Cairo';
            src: url({{asset('fonts/Cairo.ttf')}});
        }

        body, html {
            font-family: 'Cairo' !important;
            direction: rtl !important;
            text-align: center !important;
            font-size: 13px;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo' !important;
        }

        .table-container {
            width: 80%;
            margin: 10px auto;
        }

        .no-print {
            bottom: 0;
            right: 30px;
            border-radius: 0;
            z-index: 9999;
        }

        table tr th, table tr td {
            text-align: center !important;
        }
    </style>
    <style type="text/css" media="print">
        body, html {
            font-family: 'Cairo' !important;
            direction: rtl !important;
            text-align: center !important;
            font-size: 13px;
            -webkit-print-color-adjust: exact !important;
            -moz-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            -o-print-color-adjust: exact !important;
        }

        table tr th, table tr td {
            text-align: center !important;
        }

        .no-print {
            display: none;
        }
    </style>
</head>
<body style="background: #fff">
<table class="table table-bordered table-container">
    <tbody>
    <tr>
        <td class="thisTD">
            <h3 class="alert alert-sm alert-light text-center" style="margin:20px auto;">
                @if(App::getLocale() == 'ar')
                    كشف حساب مورد
                @else
                    Supplier Summary Report
                @endif
            </h3>
            @if(isset($supplier_k) && !empty($supplier_k))
                <p class="alert alert-sm alert-danger text-center">
                    @if(App::getLocale() == 'ar')
                        عرض بيانات المورد
                    @else
                        Supplier Details
                    @endif
                </p>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered text-center table-hover">
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
                                    اسم المحل
                                @else
                                    Shop Name
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    البريد الالكترونى
                                @else
                                    Email
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    الجنسية
                                @else
                                    Nationality
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    الرقم الضريبى
                                @else
                                    Tax Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    مستحقات
                                @else
                                    Dues
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $supplier_k->supplier_name }}</td>
                            <td>{{ trans('main.'.$supplier_k->supplier_category) }}</td>
                            <td>{{ $supplier_k->shop_name }}</td>
                            <td>{{ $supplier_k->supplier_email }}</td>
                            <td>{{ $supplier_k->supplier_national }}</td>
                            <td>{{ $supplier_k->tax_number }}</td>
                            <td>{{floatval( $supplier_k->prev_balance  )}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="clearfix"></div>
            @if(isset($buyBills) && !$buyBills->isEmpty())
                <p class="alert alert-sm alert-primary mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        فواتير المشتريات لهذا المورد
                    @else
                        Purchases Bills For That Supplier
                    @endif
                </p>
                <div class="table-responsive">
                    <table class='table table-condensed table-striped table-bordered'>
                        <thead class="text-center">
                        <th>#</th>

                        @if(App::getLocale() == 'ar')
                            <th>رقم الفاتورة</th>
                            <th>تاريخ الفاتورة</th>
                            <th> وقت الفاتورة</th>
                            <th>الاجمالى النهائى</th>
                            <th>عدد العناصر</th>
                        @else
                            <th>Bill Number</th>
                            <th> Date</th>
                            <th> Time</th>
                            <th> Final Total</th>
                            <th> items count</th>
                        @endif
                        </thead>
                        <tbody>
                        <?php $i = 0; $total = 0; ?>
                        @foreach($buyBills as $buy_bill)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$buy_bill->buy_bill_number}}</td>
                                <td>{{$buy_bill->date}}</td>
                                <td>{{$buy_bill->time}}</td>
                                <td>
                                    <?php $sum = 0; ?>
                                    @foreach($buy_bill->elements as $element)
                                        <?php $sum = $sum + $element->quantity_price; ?>
                                    @endforeach
                                    <?php
                                    $extras = $buy_bill->extras;
                                    foreach ($extras as $key) {
                                        if ($key->action == "discount") {
                                            if ($key->action_type == "pound") {
                                                $buy_bill_discount_value = $key->value;
                                                $buy_bill_discount_type = "pound";
                                            } else {
                                                $buy_bill_discount_value = $key->value;
                                                $buy_bill_discount_type = "percent";
                                            }
                                        } else {
                                            if ($key->action_type == "pound") {
                                                $buy_bill_extra_value = $key->value;
                                                $buy_bill_extra_type = "pound";
                                            } else {
                                                $buy_bill_extra_value = $key->value;
                                                $buy_bill_extra_type = "percent";
                                            }
                                        }
                                    }
                                    if ($extras->isEmpty()) {
                                        $buy_bill_discount_value = 0;
                                        $buy_bill_extra_value = 0;
                                        $buy_bill_discount_type = "pound";
                                        $buy_bill_extra_type = "pound";
                                    }
                                    if ($buy_bill_extra_type == "percent") {
                                        $buy_bill_extra_value = $buy_bill_extra_value / 100 * $sum;
                                    }
                                    $after_discount = $sum + $buy_bill_extra_value;

                                    if ($buy_bill_discount_type == "percent") {
                                        $buy_bill_discount_value = $buy_bill_discount_value / 100 * $sum;
                                    }
                                    $after_discount = $sum - $buy_bill_discount_value;
                                    $after_discount = $sum - $buy_bill_discount_value + $buy_bill_extra_value;
                                    $tax_value_added = $company->tax_value_added;
                                    $percentage = ($tax_value_added / 100) * $after_discount;
                                    $after_total = $after_discount + $percentage;
                                    echo floatval($after_total) . " " . trans('main.' . $currency);
                                    ?>
                                    <?php $total = $total + $after_total; ?>
                                </td>
                                <td>{{$buy_bill->elements->count()}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            @endif
            <div class="clearfix"></div>
            @if(isset($returns) && !$returns->isEmpty())
                <p class="alert alert-sm alert-dark text-center">
                    @if(App::getLocale() == 'ar')
                        مرتجعات المورد
                    @else
                        Supplier Returns
                    @endif
                </p>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered text-center table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم الفاتورة
                                @else
                                    Bill Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المورد
                                @else
                                    Supplier
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المنتج
                                @else
                                    Product
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    الكمية المرتجعة
                                @else
                                    Return Quantity
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    الوقت
                                @else
                                    time
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    التاريخ
                                @else
                                    Date
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    سعر المنتج
                                @else
                                    Product Price
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    سعر الكمية
                                @else
                                    Quantity Price
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    مستحقات المورد قبل الارتجاع
                                @else
                                    Supplier Dues before Return
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    مستحقات المورد بعد الارتجاع
                                @else
                                    Supplier Dues after Return
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رصيد المنتج قبل الارتجاع
                                @else
                                    Product Balance before return
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رصيد المنتج بعد الارتجاع
                                @else
                                    Product Balance after return
                                @endif
                            </th>

                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($returns as $key => $return)
                            <tr>
                                <td>{{ $return->bill_id }}</td>
                                <td>{{ $return->supplier->supplier_name }}</td>
                                <td>{{ $return->product->product_name}}</td>
                                <td>{{floatval( $return->return_quantity  )}}</td>
                                <td>{{ $return->date}}</td>
                                <td>{{ $return->time}}</td>
                                <td>{{floatval( $return->product_price  )}}</td>
                                <td>{{floatval( $return->quantity_price  )}}</td>

                                <td>{{floatval( $return->balance_before  )}}</td>
                                <td>{{floatval( $return->balance_after  )}}</td>

                                <td>{{floatval( $return->before_return  )}}</td>
                                <td>{{floatval( $return->after_return  )}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="clearfix"></div>
            @if(isset($buyBorrows) && !$buyBorrows->isEmpty())
                <p class="alert alert-sm alert-warning mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        سلفيات من المورد
                    @else
                        Advances Payments from That Supplier
                    @endif
                </p>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered text-center table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم العملية
                                @else
                                    Process Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المورد
                                @else
                                    Supplier
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المبلغ
                                @else
                                    Amount
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم الفاتورة
                                @else
                                    Bill Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    تاريخ
                                @else
                                    Date
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    وقت
                                @else
                                    time
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    خزنة الدفع
                                @else
                                    Payment Safe
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($buyBorrows as $key => $cash)
                            <tr>
                                <td>{{ $cash->cash_number }}</td>
                                <td>{{ $cash->supplier->supplier_name }}</td>
                                <td>{{floatval( abs($cash->amount)  )}}</td>
                                <td>{{ $cash->bill_id }}</td>
                                <td>{{ $cash->date }}</td>
                                <td>{{ $cash->time }}</td>
                                <td>{{ $cash->safe->safe_name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if(isset($buyCashs) && !$buyCashs->isEmpty())
                <p class="alert alert-sm alert-warning mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        مدفوعات نقدية لهذا المورد
                    @else
                        Cash Payment For  That Supplier
                    @endif
                </p>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered text-center table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم العملية
                                @else
                                    Process Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المورد
                                @else
                                    supplier
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المبلغ
                                @else
                                    Amount
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم الفاتورة
                                @else
                                    Bill Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    تاريخ
                                @else
                                    Date
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    وقت
                                @else
                                    time
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    خزنة الدفع
                                @else
                                    Payment Safe
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($buyCashs as $key => $cash)
                            <tr>
                                <td>{{ $cash->cash_number }}</td>
                                <td>{{ $cash->supplier->supplier_name }}</td>
                                <td>{{floatval( $cash->amount  )}}</td>
                                <td>{{ $cash->bill_id }}</td>
                                <td>{{ $cash->date }}</td>
                                <td>{{ $cash->time }}</td>
                                <td>{{ $cash->safe->safe_name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if(isset($bankbuyCashs) && !$bankbuyCashs->isEmpty())
                <p class="alert alert-sm alert-warning mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        مدفوعات بنكية لهذا المورد
                    @else
                        Bank Payments For That Supplier
                    @endif
                </p>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered text-center table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم العملية
                                @else
                                    Process Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المورد
                                @else
                                    Supplier
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المبلغ
                                @else
                                    Amount
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم الفاتورة
                                @else
                                    Bill Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    تاريخ
                                @else
                                    Date
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    وقت
                                @else
                                    time
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    البنك
                                @else
                                    Bank
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم المعاملة
                                @else
                                    Process Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    ملاحظات
                                @else
                                    Notes
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i=0;
                        @endphp
                        @foreach ($bankbuyCashs as $key => $cash)
                            <tr>
                                <td>{{ $cash->cash_number }}</td>
                                <td>{{ $cash->supplier->supplier_name }}</td>
                                <td>{{floatval( $cash->amount  )}}</td>
                                <td>{{ $cash->bill_id }}</td>
                                <td>{{ $cash->date }}</td>
                                <td>{{ $cash->time }}</td>
                                <td>{{ $cash->bank->bank_name }}</td>
                                <td>{{ $cash->bank_check_number }}</td>
                                <td>{{ $cash->notes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if(isset($supplier_k) && !empty($supplier_k))
                <div class="col-lg-12 text-center mt-3 mb-3">
                    <span class="alert alert-secondary text-center ">
                        @if(App::getLocale() == 'ar')
                            مستحقات المورد الحالية
                        @else
                            Current Supplier Dues
                        @endif
                        {{floatval( $supplier_k->prev_balance  )}} {{__('main.'.$currency)}}
                    </span>
                </div>
            @endif

            <div class="row mt-1 mb-1 text-center no-print">
                <div class="col-lg-12 text-center">
                    <button onclick="window.print()" type="button" class="btn btn-md btn-info">
                        <i class="fa fa-print"></i>
                        @if(App::getLocale() == 'ar')
                            طباعة تقرير كشف الحساب
                        @else
                            Print Supplier Summary Report
                        @endif
                    </button>
                    @if(isset($_GET['ref']) && $_GET['ref'] == "email")

                    @else
                        @if(isset($supplier_k) && !empty($supplier_k))
                            @if(!empty($supplier_k->supplier_email))
                                <form class="d-inline" action="{{route('supplier.summary.send')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" value="{{url()->full().'&ref=email'}}" name="url"/>
                                    <input type="hidden" value="{{$supplier_k->id}}" name="id"/>
                                    <button type="submit" class="btn btn-md btn-warning">
                                        <i class="fa fa-envelope-o"></i>
                                        @if(App::getLocale() == 'ar')
                                            ارسال كشف الحساب الى بريد المورد
                                        @else
                                            Send Summary Report To Supplier Email
                                        @endif
                                    </button>
                                </form>
                            @else
                                <span class="alert alert-sm alert-warning text-center">
                                    @if(App::getLocale() == 'ar')
                                        خانه البريد الالكترونى للمورد فارغة
                                    @else
                                        Supplier Email is not found
                                    @endif
                                </span>
                            @endif
                            @if(!$supplier_k->phones->isEmpty())
                                <?php
                                $url = url()->full() . '&ref=email';
                                if (App::getLocale() == "ar") {
                                    $text = "مرفق رابط لكشف حسابك " . "%0a" . $url;
                                } else {
                                    $text = "Attached is a link to your account summary" . "%0a" . $url;
                                }
                                $text = str_replace("&", "%26", $text);
                                $phone_number = $supplier_k->phones[0]->supplier_phone;
                                ?>
                                <a class="btn btn-success btn-md" target="_blank"
                                   href="https://wa.me/{{$phone_number}}?text={{$text}}">
                                    @if(App::getLocale() == 'ar')
                                        ارسال الى واتساب المورد
                                    @else
                                        Send to supplier whatsapp
                                    @endif
                                </a>
                            @else
                                <span class="alert alert-sm alert-warning text-center">
                                    @if(App::getLocale() == 'ar')
                                        خانه رقم الهاتف للمورد فارغة
                                    @else
                                        Supplier Phone Number is not found
                                    @endif
                                </span>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </td>
    </tr>
    </tbody>
</table>
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script type="text/javascript">

</script>
</body>
</html>
