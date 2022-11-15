@extends('client.layouts.app-main')
<style>
    .btn.dropdown-toggle.bs-placeholder {
        height: 40px;
    }

    .bootstrap-select {
        width: 100% !important;
    }
</style>
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>@if(App::getLocale() == 'ar')
                    الاخطاء :
                @else
                    Errors :
                @endif</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="company_details printy" style="display: none;">
                        <div class="text-center">
                            <img class="logo" style="width: 20%;" src="{{asset($company->company_logo)}}" alt="">
                        </div>
                        <div class="text-center">
                            <div class="col-lg-12 text-center justify-content-center">
                                <p class="alert alert-secondary text-center alert-sm"
                                   style="margin: 10px auto; font-size: 17px;line-height: 1.9;" dir="rtl">
                                    {{$company->company_name}} -- {{$company->business_field}} <br>
                                    {{$company->company_owner}} -- {{$company->phone_number}} <br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 no-print">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-danger">
                            @if(App::getLocale() == 'ar')
                                تقرير مبيعات حسب المنتج
                            @else
                                sales report by product
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report2.post')}}" class="no-print" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-4 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    اسم المنتج
                                @else
                                    product name
                                @endif
                            </label>
                            <select required name="product_id" id="product_id" class="selectpicker"
                                    data-style="btn-info" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                @endif
                            >
                                <option
                                    @if(isset($product_id) && $product_id == "all")
                                    selected
                                    @endif
                                    value="all">
                                    @if(App::getLocale() == 'ar')
                                        كل المنتجات
                                    @else
                                        all products
                                    @endif
                                </option>
                                @foreach($products as $product)
                                    <option
                                        @if(isset($product_id) && $product->id == $product_id)
                                        selected
                                        @endif
                                        value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <button class="btn btn-md btn-danger"
                                    style="font-size: 15px; height: 40px; margin-top: 25px;" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    عرض التقرير
                                @else
                                    show report
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <?php $i = 0; $total = 0; ?>
                    @if(isset($posBills))
                        <p class="alert alert-sm alert-primary mt-3 text-center">
                            @if(App::getLocale() == 'ar')
                                فواتير الكاشير ( نقطة البيع )
                            @else
                                POS Cashier Bills
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
                                            number
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            عميل
                                        @else
                                            client
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            تاريخ - وقت
                                        @else
                                            date -time
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            تكلفة بضاعة
                                        @else
                                            cost
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            ايراد مبيعات
                                        @else
                                            total
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            ضريبة مبيعات
                                        @else
                                            VAT
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            طريقة الدفع
                                        @else
                                            payment method
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            ملاحظات
                                        @else
                                            notes
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $sum2 = 0 ; $sum3 =0;
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
                                                    walk in customer
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
                                                $total = $total + $sum;
                                                $i = $i + 1;
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
                                                        echo "un paid";
                                                    }
                                                } else {
                                                    if (App::getLocale() == "ar") {
                                                        echo "شيك بنكى" . " ( " . $check2->bank->bank_name . " ) ";
                                                    } else {
                                                        echo "bank payment " . " ( " . $check2->bank->bank_name . " ) ";
                                                    }
                                                    $paid = $check2->amount;
                                                    $rest = $sum - $paid;
                                                    echo "<br/>";
                                                    if (App::getLocale() == "ar") {
                                                        echo "مستحق " . $sum;
                                                        echo "<br/>";
                                                        echo "مدفوع " . $paid;
                                                        echo "<br/>";
                                                        echo "متبقى " . $rest;
                                                    } else {
                                                        echo "deserved " . $sum;
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
                                                    echo "cash payment " . " ( " . $check->safe->safe_name . " ) ";
                                                }
                                                $paid = $check->amount;
                                                $rest = $sum - $paid;
                                                echo "<br/>";
                                                if (App::getLocale() == "ar") {
                                                    echo "مستحق " . $sum;
                                                    echo "<br/>";
                                                    echo "مدفوع " . $paid;
                                                    echo "<br/>";
                                                    echo "متبقى " . $rest;
                                                } else {
                                                    echo "deserved " . $sum;
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
                    @if(isset($saleBills))
                        <p class="alert alert-sm alert-primary mt-3 text-center">
                            @if(App::getLocale() == 'ar')
                                فواتير البيع
                            @else
                                sales bills
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table border="1" cellpadding="14" style="width: 100%!important;">
                                <thead class="text-center">
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رقم
                                    @else
                                        number
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        عميل
                                    @else
                                        client
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        تاريخ - وقت
                                    @else
                                        date -time
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        تكلفة بضاعة
                                    @else
                                        cost
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        ايراد مبيعات
                                    @else
                                        total
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        ضريبة مبيعات
                                    @else
                                        VAT
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        طريقة الدفع
                                    @else
                                        payment method
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        notes
                                    @endif
                                </th>
                                </thead>
                                <tbody>
                                @foreach($saleBills as $sale_bill)
                                    <tr>
                                        <td>{{$sale_bill->sale_bill_number}}</td>
                                        <td>
                                            @if(empty($sale_bill->outer_client_id))
                                                @if(App::getLocale() == 'ar')
                                                    عميل مبيعات نقدية
                                                @else
                                                    walk in customer
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
                                            echo floatval($after_total) . " " . trans('main.' . $currency);
                                            ?>
                                            <?php $total = $total + $after_total; $i = $i + 1; ?>
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
                                                        echo "un paid";
                                                    }
                                                } else {
                                                    if (App::getLocale() == "ar") {
                                                        echo "شيك بنكى" . " ( " . $check2->bank->bank_name . " ) ";
                                                    } else {
                                                        echo "bank payment " . " ( " . $check2->bank->bank_name . " ) ";
                                                    }
                                                    $paid = $check2->amount;
                                                    $rest = $after_total - $paid;
                                                    echo "<br/>";
                                                    if (App::getLocale() == "ar") {
                                                        echo "مستحق " . $after_total;
                                                        echo "<br/>";
                                                        echo "مدفوع " . $paid;
                                                        echo "<br/>";
                                                        echo "متبقى " . $rest;
                                                    } else {
                                                        echo "deserved " . $after_total;
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
                                                    echo "cash payment " . " ( " . $check->safe->safe_name . " ) ";
                                                }
                                                $paid = $check->amount;
                                                $rest = $after_total - $paid;
                                                echo "<br/>";
                                                if (App::getLocale() == "ar") {
                                                    echo "مستحق " . $after_total;
                                                    echo "<br/>";
                                                    echo "مدفوع " . $paid;
                                                    echo "<br/>";
                                                    echo "متبقى " . $rest;
                                                } else {
                                                    echo "deserved " . $after_total;
                                                    echo "<br/>";
                                                    echo "paid " . $paid;
                                                    echo "<br/>";
                                                    echo "rest " . $rest;
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>{{$sale_bill->notes}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    @if(isset($saleBills) || isset($posBills))
                        <div class="row mt-3">
                            <span class="col-lg-4 col-sm-12 alert alert-secondary alert-sm mr-5">
                                @if(App::getLocale() == 'ar')
                                    عدد الفواتير
                                @else
                                    total bills count
                                @endif
                                ( {{$i}} )
                            </span>
                            <span class="col-lg-4 col-sm-12 alert alert-secondary alert-sm">
                                @if(App::getLocale() == 'ar')
                                    اجمالى اسعار كل الفواتير
                                @else
                                    all bills prices total
                                @endif
                                ( {{floatval( $total  )}} ) {{__('main.'.$currency)}}
                            </span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row mt-3 no-print">
                            <button type="button" onclick="window.print()" class="btn btn-md btn-info pull-right">
                                <i class="fa fa-print"></i>
                                @if(App::getLocale() == 'ar')
                                    طباعة التقرير
                                @else
                                    print report
                                @endif
                            </button>
                        </div>
                    @else
                        <div class="alert alert-sm alert-danger text-center mt-3">
                            <i class="fa fa-close"></i>
                            @if(App::getLocale() == 'ar')
                                لا توجد اى فواتير لهذا العميل
                            @else
                                no bills for this client
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>

</script>
