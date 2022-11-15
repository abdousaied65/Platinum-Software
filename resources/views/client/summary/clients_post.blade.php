<?php
$company = \App\Models\Company::FindOrFail($outer_client_k->company_id);
$extra_settings = \App\Models\ExtraSettings::where('company_id', $company->id)->first();
$currency = $extra_settings->currency;
?>
    <!DOCTYPE html>
<html>
<head>
    <title>
        @if(App::getLocale() == 'ar')
            كشف حساب عميل
        @else
            Client Summary Report
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
                    كشف حساب عميل
                @else
                    Client Summary Report
                @endif
            </h3>
            @if(isset($outer_client_k) && !empty($outer_client_k))
                <p class="alert alert-sm alert-danger text-center">
                    @if(App::getLocale() == 'ar')
                        عرض بيانات العميل
                    @else
                        Client Details
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
                                    مديونية
                                @else
                                    Debts
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $outer_client_k->client_name }}</td>
                            <td>{{ trans('main.'.$outer_client_k->client_category) }}</td>
                            <td>{{ $outer_client_k->shop_name }}</td>
                            <td>{{ $outer_client_k->client_email }}</td>
                            <td>{{ $outer_client_k->client_national }}</td>
                            <td>{{ $outer_client_k->tax_number }}</td>
                            <td>
                                {{floatval($outer_client_k->prev_balance)}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="clearfix"></div>
            @if(isset($gifts) && !$gifts->isEmpty())
                <p class="alert alert-sm alert-success mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        عرض هدايا العميل
                    @else
                        Clients Gifts
                    @endif
                </p>
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-bordered text-center table-hover">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    العميل
                                @else
                                    Client
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
                                    الكمية
                                @else
                                    Quantity
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رصيد المنتج ما قبل
                                @else
                                    Product Balance Before
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رصيد المنتج ما بعد
                                @else
                                    Product Balance After
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المخزن
                                @else
                                    Store
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    تاريخ - وقت
                                @else
                                    Date - Time
                                @endif
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($gifts as $key => $gift)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{ $gift->outerClient->client_name }}</td>
                                <td>{{ $gift->product->product_name }}</td>
                                <td>
                                    {{floatval($gift->amount)}}
                                </td>
                                <td>
                                    {{floatval($gift->balance_before)}}
                                </td>
                                <td>
                                    {{floatval($gift->balance_after)}}
                                </td>
                                <td>{{ $gift->store->store_name }}</td>
                                <td>{{ $gift->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="clearfix"></div>
            @if(isset($quotations) && !$quotations->isEmpty())
                <p class="alert alert-sm alert-info mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        عروض أسعار العميل
                    @else
                        Client Quotations
                    @endif
                </p>
                <table class='table table-condensed table-striped table-bordered'>
                    <thead class="text-center">
                    <th>#</th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            رقم عرض السعر
                        @else
                            Quotation Number
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ بداية العرض
                        @else
                            Start Date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ نهاية العرض
                        @else
                            End Date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            الاجمالى النهائى
                        @else
                            Final Total
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عدد العناصر
                        @else
                            Items Count
                        @endif
                    </th>
                    </thead>
                    <tbody>
                    <?php $i = 0; $total = 0; ?>
                    @foreach($quotations as $quotation)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$quotation->quotation_number}}</td>
                            <td>{{$quotation->start_date}}</td>
                            <td>{{$quotation->expiration_date}}</td>
                            <td>
                                <?php $sum = 0; ?>
                                @foreach($quotation->elements as $element)
                                    <?php $sum = $sum + $element->quantity_price; ?>
                                @endforeach
                                <?php
                                $extras = $quotation->extras;
                                foreach ($extras as $key) {
                                    if ($key->action == "discount") {
                                        if ($key->action_type == "pound") {
                                            $quotation_discount_value = $key->value;
                                            $quotation_discount_type = "pound";
                                        } else {
                                            $quotation_discount_value = $key->value;
                                            $quotation_discount_type = "percent";
                                        }
                                    } else {
                                        if ($key->action_type == "pound") {
                                            $quotation_extra_value = $key->value;
                                            $quotation_extra_type = "pound";
                                        } else {
                                            $quotation_extra_value = $key->value;
                                            $quotation_extra_type = "percent";
                                        }
                                    }
                                }
                                if ($extras->isEmpty()) {
                                    $quotation_discount_value = 0;
                                    $quotation_extra_value = 0;
                                    $quotation_discount_type = "pound";
                                    $quotation_extra_type = "pound";
                                }
                                if ($quotation_extra_type == "percent") {
                                    $quotation_extra_value = $quotation_extra_value / 100 * $sum;
                                }
                                $after_discount = $sum + $quotation_extra_value;

                                if ($quotation_discount_type == "percent") {
                                    $quotation_discount_value = $quotation_discount_value / 100 * $sum;
                                }
                                $after_discount = $sum - $quotation_discount_value;
                                $after_discount = $sum - $quotation_discount_value + $quotation_extra_value;
                                $tax_value_added = $company->tax_value_added;
                                $percentage = ($tax_value_added / 100) * $after_discount;
                                $after_total = $after_discount + $percentage;
                                echo floatval($after_total) . " " . $currency;
                                ?>
                                <?php $total = $total + $after_total; ?>
                            </td>
                            <td>{{$quotation->elements->count()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <div class="clearfix"></div>
            @if(isset($posBills) && !$posBills->isEmpty())
                <p class="alert alert-sm alert-primary mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        فواتير الكاشير ( نقطة البيع )
                    @else
                        POS Bills (Cashier)
                    @endif
                </p>
                <div class="table-responsive">
                    <table border="1" cellpadding="14" style="width: 100%!important;">
                        <thead class="text-center">
                        <tr>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم
                                @else
                                    Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    عميل
                                @else
                                    Client
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    تاريخ - وقت
                                @else
                                    Date - Time
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    تكلفة بضاعة
                                @else
                                    Products Costs
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    ايراد مبيعات
                                @else
                                    Total Sales
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    ضريبة مبيعات
                                @else
                                    VAT Value
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    طريقة الدفع
                                @else
                                    Payment Method
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
                            $sum1 = 0; $sum2 = 0 ; $sum3 =0;
                        @endphp
                        @foreach ($posBills as $key => $pos)
                            <tr>
                                <td>{{ $pos->id }}</td>
                                <td>
                                    @if(isset($pos->outerClient->client_name))
                                        {{$pos->outerClient->client_name}}
                                    @else
                                        @if(App::getLocale() == 'ar')
                                            زبون
                                        @else
                                            Walk in Customer
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $pos->created_at}}</td>
                                <td>
                                    <?php $merchandise_cost = 0; ?>
                                    @foreach($pos->elements as $element)
                                        <?php $merchandise_cost = $merchandise_cost + $element->product->purchasing_price * $element->quantity; ?>
                                    @endforeach
                                    {{$merchandise_cost}}
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
                                <td>{{$percent}}</td>
                                <td>
                                    <?php
                                    $bill_id = "pos_" . $pos->id;
                                    $check = App\Models\Cash::where('bill_id', $bill_id)->first();
                                    if (empty($check)) {
                                        $check2 = App\Models\BankCash::where('bill_id', $bill_id)->first();
                                        if (empty($check2)) {
                                            if (App::getLocale() == "ar") {
                                                echo "غير مدفوعة";
                                            } else {
                                                echo "Un Paid";
                                            }
                                        } else {
                                            if (App::getLocale() == "ar") {
                                                echo "شيك بنكى" . " ( " . $check2->bank->bank_name . " ) ";
                                            } else {
                                                echo "Bank Payment " . " ( " . $check2->bank->bank_name . " ) ";
                                            }
                                            $paid = $check2->amount;
                                            $rest = $sum1 - $paid;

                                            if (App::getLocale() == "ar") {
                                                echo "<br/>";
                                                echo "مستحق " . $sum1;
                                                echo "<br/>";
                                                echo "مدفوع " . $paid;
                                                echo "<br/>";
                                                echo "متبقى " . $rest;
                                            } else {
                                                echo "<br/>";
                                                echo "deserved " . $sum1;
                                                echo "<br/>";
                                                echo "paid " . $paid;
                                                echo "<br/>";
                                                echo "rest " . $rest;
                                            }
                                        }
                                    } else {
                                        if (App::getLocale() == "ar") {
                                            echo "نقدى كاش" . " ( " . $check->safe->safe_name . " ) ";
                                        } else {
                                            echo "Cash Payment " . " ( " . $check->safe->safe_name . " ) ";
                                        }
                                        $paid = $check->amount;
                                        $rest = $sum1 - $paid;

                                        if (App::getLocale() == "ar") {
                                            echo "<br/>";
                                            echo "مستحق " . $sum1;
                                            echo "<br/>";
                                            echo "مدفوع " . $paid;
                                            echo "<br/>";
                                            echo "متبقى " . $rest;
                                        } else {
                                            echo "<br/>";
                                            echo "deserved " . $sum1;
                                            echo "<br/>";
                                            echo "paid " . $paid;
                                            echo "<br/>";
                                            echo "rest " . $rest;
                                        }


                                    }
                                    ?>
                                </td>
                                <td>{{$pos->notes}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="clearfix"></div>
            @if(isset($saleBills) && !$saleBills->isEmpty())
                <p class="alert alert-sm alert-primary mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        فواتير البيع
                    @else
                        Sale Bills
                    @endif
                </p>
                <div class="table-responsive">
                    <table border="1" cellpadding="14" style="width: 100%!important;">
                        <thead class="text-center">
                        <th class="text-center">
                            @if(App::getLocale() == 'ar')
                                رقم
                            @else
                                Number
                            @endif
                        </th>
                        <th class="text-center">
                            @if(App::getLocale() == 'ar')
                                عميل
                            @else
                                Client
                            @endif
                        </th>
                        <th class="text-center">
                            @if(App::getLocale() == 'ar')
                                تاريخ - وقت
                            @else
                                Date - Time
                            @endif
                        </th>
                        <th class="text-center">
                            @if(App::getLocale() == 'ar')
                                تكلفة بضاعة
                            @else
                                Products Costs
                            @endif
                        </th>
                        <th class="text-center">
                            @if(App::getLocale() == 'ar')
                                ايراد مبيعات
                            @else
                                Total Sales
                            @endif
                        </th>
                        <th class="text-center">
                            @if(App::getLocale() == 'ar')
                                ضريبة مبيعات
                            @else
                                VAT Value
                            @endif
                        </th>
                        <th class="text-center">
                            @if(App::getLocale() == 'ar')
                                طريقة الدفع
                            @else
                                Payment Method
                            @endif
                        </th>
                        <th class="text-center">
                            @if(App::getLocale() == 'ar')
                                ملاحظات
                            @else
                                Notes
                            @endif
                        </th>
                        <th class="no-print">عرض</th>
                        </thead>
                        <tbody>
                        <?php $i = 0; $total = 0; ?>
                        @foreach($saleBills as $sale_bill)
                            <tr>
                                <td>{{$sale_bill->sale_bill_number}}</td>
                                <td>
                                    @if(empty($sale_bill->outer_client_id))
                                        @if(App::getLocale() == 'ar')
                                            عميل مبيعات نقدية
                                        @else
                                            Walk in Customer
                                        @endif
                                    @else
                                        {{$sale_bill->outerClient->client_name}}
                                    @endif
                                </td>
                                <td>{{$sale_bill->date}} <br> {{$sale_bill->time}}</td>
                                <td>
                                    <?php $merchandise_cost = 0; ?>
                                    @foreach($sale_bill->elements as $element)
                                        <?php $merchandise_cost = $merchandise_cost + $element->product->purchasing_price * $element->quantity; ?>
                                    @endforeach
                                    {{$merchandise_cost}}
                                </td>
                                <td>
                                    <?php $sum = 0; ?>
                                    @foreach($sale_bill->elements as $element)
                                        <?php $sum = $sum + $element->quantity_price; ?>
                                    @endforeach
                                    <?php
                                    $extras = $sale_bill->extras;
                                    foreach ($extras as $key) {
                                        if ($key->action == "discount") {
                                            if ($key->action_type == "pound") {
                                                $sale_bill_discount_value = $key->value;
                                                $sale_bill_discount_type = "pound";
                                            } else {
                                                $sale_bill_discount_value = $key->value;
                                                $sale_bill_discount_type = "percent";
                                            }
                                        } else {
                                            if ($key->action_type == "pound") {
                                                $sale_bill_extra_value = $key->value;
                                                $sale_bill_extra_type = "pound";
                                            } else {
                                                $sale_bill_extra_value = $key->value;
                                                $sale_bill_extra_type = "percent";
                                            }
                                        }
                                    }
                                    if ($extras->isEmpty()) {
                                        $sale_bill_discount_value = 0;
                                        $sale_bill_extra_value = 0;
                                        $sale_bill_discount_type = "pound";
                                        $sale_bill_extra_type = "pound";
                                    }
                                    if ($sale_bill_extra_type == "percent") {
                                        $sale_bill_extra_value = $sale_bill_extra_value / 100 * $sum;
                                    }
                                    $after_discount = $sum + $sale_bill_extra_value;

                                    if ($sale_bill_discount_type == "percent") {
                                        $sale_bill_discount_value = $sale_bill_discount_value / 100 * $sum;
                                    }
                                    $after_discount = $sum - $sale_bill_discount_value;
                                    $after_discount = $sum - $sale_bill_discount_value + $sale_bill_extra_value;
                                    $tax_value_added = $company->tax_value_added;
                                    $percentage = ($tax_value_added / 100) * $after_discount;
                                    $after_total = $after_discount + $percentage;
                                    echo floatval($after_total) . " " . $currency;
                                    ?>
                                    <?php $total = $total + $after_total; ?>
                                </td>
                                <td>{{$percentage}}  {{__('main.'.$currency)}}</td>
                                <td style="min-width: 200px!important;">
                                    <?php
                                    $bill_id = $sale_bill->sale_bill_number;
                                    $check = App\Models\Cash::where('bill_id', $bill_id)->first();
                                    if (empty($check)) {
                                        $check2 = App\Models\BankCash::where('bill_id', $bill_id)->first();
                                        if (empty($check2)) {
                                            if (App::getLocale() == "ar") {
                                                echo "غير مدفوعة";
                                            } else {
                                                echo "Un Paid";
                                            }
                                        } else {
                                            if (App::getLocale() == "ar") {
                                                echo "شيك بنكى" . " ( " . $check2->bank->bank_name . " ) ";
                                            } else {
                                                echo "Bank Payment " . " ( " . $check2->bank->bank_name . " ) ";
                                            }

                                            if (App::getLocale() == "ar") {
                                                echo "<br/>";
                                                echo "مستحق " . $total;
                                                echo "<br/>";
                                                echo "مدفوع " . $paid;
                                                echo "<br/>";
                                                echo "متبقى " . $rest;

                                            } else {
                                                echo "<br/>";
                                                echo "deserved " . $total;
                                                echo "<br/>";
                                                echo "paid " . $paid;
                                                echo "<br/>";
                                                echo "rest " . $rest;
                                            }
                                            $paid = $check2->amount;
                                            $rest = $total - $paid;

                                        }
                                    } else {

                                        if (App::getLocale() == "ar") {
                                            echo " نقدى كاش" . " ( " . $check->safe->safe_name . " ) ";
                                        } else {
                                            echo "Cash Payment " . " ( " . $check->safe->safe_name . " ) ";
                                        }
                                        $paid = $check->amount;
                                        $rest = $total - $paid;
                                        if (App::getLocale() == "ar") {
                                            echo "<br/>";
                                            echo "مستحق " . $total;
                                            echo "<br/>";
                                            echo "مدفوع " . $paid;
                                            echo "<br/>";
                                            echo "متبقى " . $rest;
                                        } else {
                                            echo "<br/>";
                                            echo "deserved " . $total;
                                            echo "<br/>";
                                            echo "paid " . $paid;
                                            echo "<br/>";
                                            echo "rest " . $rest;
                                        }
                                    }
                                    ?>
                                </td>
                                <td>{{$sale_bill->notes}}</td>
                                <td class="no-print">
                                    <form target="_blank" action="{{route('client.sale_bills.filter.key')}}"
                                          method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="sale_bill_id" value="{{$sale_bill->id}}">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa fa-eye"></i>
                                            @if(App::getLocale() == 'ar')
                                                عرض
                                            @else
                                                Show
                                            @endif
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="clearfix"></div>
            @if(isset($returns) && !$returns->isEmpty())
                <p class="alert alert-sm alert-dark mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        مرتجعات العميل
                    @else
                        Client Returns
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
                                    العميل
                                @else
                                    client
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
                                    مديونية العميل قبل الارتجاع
                                @else
                                    Client Debts before Return
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    مديونية العميل بعد الارتجاع
                                @else
                                    Client Debts after Return
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
                                <td>{{ $return->outerClient->client_name }}</td>
                                <td>{{ $return->product->product_name}}</td>
                                <td>
                                    {{floatval($return->return_quantity)}}
                                </td>
                                <td>{{ $return->date}}</td>
                                <td>{{ $return->time}}</td>
                                <td>
                                    {{floatval($return->product_price)}}
                                </td>
                                <td>
                                    {{floatval($return->quantity_price)}}
                                </td>

                                <td>
                                    {{floatval($return->balance_before)}}
                                </td>
                                <td>
                                    {{floatval($return->balance_after)}}
                                </td>

                                <td>
                                    {{floatval($return->before_return)}}
                                </td>
                                <td>
                                    {{floatval($return->after_return)}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            <div class="clearfix"></div>
            @if(isset($cashs) && !$cashs->isEmpty())
                <p class="alert alert-sm alert-warning mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        مدفوعات نقدية لهذا العميل
                    @else
                        Cash Payment For  That Client
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
                                    العميل
                                @else
                                    Client
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
                        @foreach ($cashs as $key => $cash)
                            <tr>
                                <td>{{ $cash->cash_number }}</td>
                                <td>{{ $cash->outerClient->client_name }}</td>
                                <td>
                                    {{floatval($cash->amount)}}
                                </td>
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
            @if(isset($borrows) && !$borrows->isEmpty())
                <p class="alert alert-sm alert-warning mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        سلفيات الى العميل
                    @else
                        Advances Payments To That Client
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
                                    العميل
                                @else
                                    Client
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
                        @foreach ($borrows as $key => $cash)
                            <tr>
                                <td>{{ $cash->cash_number }}</td>
                                <td>{{ $cash->outerClient->client_name }}</td>
                                <td>
                                    {{floatval(abs($cash->amount))}}
                                </td>
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
            @if(isset($bankcashs) && !$bankcashs->isEmpty())
                <p class="alert alert-sm alert-warning mt-3 text-center">
                    @if(App::getLocale() == 'ar')
                        مدفوعات بنكية لهذا العميل
                    @else
                        Bank Payments For That Client
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
                                    العميل
                                @else
                                    Client
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
                        @foreach ($bankcashs as $key => $cash)
                            <tr>
                                <td>{{ $cash->cash_number }}</td>
                                <td>{{ $cash->outerClient->client_name }}</td>
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
            @if(isset($outer_client_k) && !empty($outer_client_k))
                <div class="col-lg-12 text-center mt-3 mb-3">
                    <span class="alert alert-info text-center ">
                        @if(App::getLocale() == 'ar')
                            مديونية العميل الحالية
                        @else
                            Current Client debts
                        @endif
                        {{floatval( $outer_client_k->prev_balance  )}}  {{__('main.'.$currency)}}
                    </span>
                </div>
            @endif
            <div class="row mt-1 mb-1 no-print">
                <div class="col-lg-12 text-center">
                    <button onclick="window.print()" type="button" class="btn btn-md btn-info">
                        <i class="fa fa-print"></i>
                        @if(App::getLocale() == 'ar')
                            طباعة تقرير كشف الحساب
                        @else
                            Print Summary Report
                        @endif
                    </button>
                    @if(isset($_GET['ref']) && $_GET['ref'] == "email")

                    @else
                        @if(isset($outer_client_k) && !empty($outer_client_k))
                            @if(!empty($outer_client_k->client_email))
                                <form class="d-inline" action="{{route('client.summary.send')}}" method="post">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" value="{{url()->full().'&ref=email'}}" name="url"/>
                                    <input type="hidden" value="{{$outer_client_k->id}}" name="id"/>
                                    <button type="submit" class="btn btn-md btn-warning">
                                        <i class="fa fa-envelope-o"></i>
                                        @if(App::getLocale() == 'ar')
                                            ارسال كشف الحساب الى بريد العميل
                                        @else
                                            Send Summary Report To Client Email
                                        @endif
                                    </button>
                                </form>
                            @else
                                <span class="alert alert-sm alert-warning text-center">
                                    @if(App::getLocale() == 'ar')
                                        خانه البريد الالكترونى للعميل فارغة
                                    @else
                                        Client Email is not found
                                    @endif
                                </span>
                            @endif

                            @if(!$outer_client_k->phones->isEmpty())
                                <?php
                                $url = url()->full() . '&ref=email';
                                if (App::getLocale() == "ar") {
                                    $text = "مرفق رابط لكشف حسابك " . "%0a" . $url;
                                } else {
                                    $text = "Attached is a link to your account summary" . "%0a" . $url;
                                }
                                $text = str_replace("&", "%26", $text);
                                $phone_number = $outer_client_k->phones[0]->client_phone;
                                ?>
                                <a class="btn btn-success btn-md" target="_blank"
                                   href="https://wa.me/{{$phone_number}}?text={{$text}}">
                                    @if(App::getLocale() == 'ar')
                                        ارسال الى واتساب العميل
                                    @else
                                        Send to client whatsapp
                                    @endif
                                </a>
                            @else
                                <span class="alert alert-sm alert-warning text-center">
                                    @if(App::getLocale() == 'ar')
                                        خانه رقم الهاتف للعميل فارغة
                                    @else
                                        Client Phone Number is not found
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
