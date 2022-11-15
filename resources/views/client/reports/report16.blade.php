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
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-danger">
                            @if(App::getLocale() == 'ar')
                                تقرير العمل الشامل
                            @else
                                Comprehensive work report
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report16.post')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-3 pull-right">
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
                    @if(isset($result) && !empty($result))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير العمل الشامل
                            @else
                                Comprehensive work report
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"> م</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم الحساب
                                        @else
                                            Account Name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            نوع الحساب
                                        @else
                                            account type
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            له دائن
                                        @else
                                            creditor
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            عليه ديون
                                        @else
                                            debtor
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $total_for = 0;
                                $total_on = 0;
                                $i = 0;
                                ?>
                                @foreach($outerClients as $outerClient)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $outerClient->client_name }}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                عميل
                                            @else
                                                client
                                            @endif
                                        </td>
                                        @if($outerClient->prev_balance > 0)
                                            <?php
                                            $total_on = $total_on + $outerClient->prev_balance;
                                            ?>
                                            <td>0</td>
                                            <td>{{$outerClient->prev_balance}}</td>
                                        @else
                                            <?php
                                            $total_for = $total_for + abs($outerClient->prev_balance);
                                            ?>
                                            <td>{{abs($outerClient->prev_balance)}}</td>
                                            <td>0</td>
                                        @endif
                                    </tr>
                                @endforeach

                                @foreach($suppliers as $supplier)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                مورد
                                            @else
                                                supplier
                                            @endif
                                        </td>
                                        @if($supplier->prev_balance < 0)
                                            <?php
                                            $total_on = $total_on + $supplier->prev_balance;
                                            ?>
                                            <td>0</td>
                                            <td>{{$supplier->prev_balance}}</td>
                                        @else
                                            <?php
                                            $total_for = $total_for + abs($supplier->prev_balance);
                                            ?>
                                            <td>{{abs($supplier->prev_balance)}}</td>
                                            <td>0</td>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row mt-3 mb-3">
                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-2">
                                @if(App::getLocale() == 'ar')
                                    اجمالى لهم ( عليك ديون )
                                @else
                                    total debts
                                @endif
                                ( {{floatval($total_for)}} )
                            </span>
                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-2">
                                @if(App::getLocale() == 'ar')
                                    اجمالى عليهم ( لك دائن )
                                @else
                                    total creditor
                                @endif
                                ( {{floatval($total_on)}} )
                            </span>

                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-2">
                                @if(App::getLocale() == 'ar')
                                    عدد العملاء
                                @else
                                    number of clients
                                @endif
                                ( {{floatval($outerClients->count())}} )
                            </span>

                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-2">
                                @if(App::getLocale() == 'ar')
                                    عدد الموردين
                                @else
                                    number of suppliers
                                @endif
                                 ( {{floatval($suppliers->count())}} )
                            </span>
                            <div class="clearfix"></div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"> #</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            نوع الفاتورة
                                        @else
                                            bill type
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رقم الفاتورة
                                        @else
                                            bill time
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            التاريخ
                                        @else
                                            date
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الاجمالى
                                        @else
                                            total
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الربح
                                        @else
                                            profits
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; $total = 0; $total_profits = 0; ?>
                                @foreach($sale_bills as $sale_bill)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                فاتورة مبيعات عملاء
                                            @else
                                                sale bill
                                            @endif
                                        </td>
                                        <td>{{ $sale_bill->sale_bill_number }}</td>
                                        <td>{{ $sale_bill->date }}</td>
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
                                            ?>
                                            <?php $total = $total + $after_total; ?>
                                            <?php
                                            $total_real_price = 0;
                                            foreach ($sale_bill->elements as $element) {
                                                $product_unit_id = $element->product_unit_id;
                                                $product_unit = App\Models\ProductUnit::FindOrFail($product_unit_id);
                                                $purchasing_price = $product_unit->purchasing_price;
                                                $real_price = $element->quantity * $purchasing_price;
                                                $total_real_price = $total_real_price + $real_price;
                                            }
                                            $profit = $after_total - $total_real_price;
                                            $total_profits = $total_profits + $profit;
                                            echo floatval($after_total) . " " . trans('main.' . $currency);
                                            ?>
                                        </td>
                                        <td>
                                            {{floatval($profit)}}
                                            {{ trans('main.'.$currency) }}
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($pos_bills as $pos_bill)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                فاتورة كاشير نقاط بيع
                                            @else
                                                POS Cashier Bill
                                            @endif
                                        </td>
                                        <td>{{ $pos_bill->id }}</td>
                                        <td>{{ $pos_bill->created_at }}</td>
                                        <td>
                                            <?php $sum = 0; ?>
                                            @foreach($pos_bill->elements as $element)
                                                <?php $sum = $sum + $element->quantity_price; ?>
                                            @endforeach
                                            <?php
                                            $merchandise_cost = 0;
                                            foreach ($pos_bill->elements as $element) {
                                                $merchandise_cost = $merchandise_cost + $element->unit->purchasing_price * $element->quantity;
                                            }
                                            $pos_elements = $pos_bill->elements;
                                            $pos_discount = $pos_bill->discount;
                                            $pos_tax = $pos_bill->tax;
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
                                            echo $sum . " " . trans('main.' . $currency);
                                            $total = $total + $sum;
                                            $profit = $sum - $merchandise_cost;
                                            $total_profits = $total_profits + $profit
                                            ?>
                                        </td>
                                        <td>
                                            {{floatval($profit)}}
                                            {{ trans('main.'.$currency) }}
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($buy_bills as $buy_bill)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                فاتورة مشتريات
                                            @else
                                                purchase invoice
                                            @endif
                                        </td>
                                        <td>{{ $buy_bill->buy_bill_number }}</td>
                                        <td>{{ $buy_bill->date }}</td>
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
                                            ?>
                                            <?php $total = $total + $after_total;
                                            echo floatval($after_total) . " " . trans('main.' . $currency);
                                            ?>
                                        </td>
                                        <td>
                                            0
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row mt-3 mb-3">
                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-4">
                                @if(App::getLocale() == 'ar')
                                    اجمالى الداخل الى الخزن
                                @else
                                    total income
                                @endif
                                <?php
                                $total_in = 0;
                                foreach ($cashs as $cash) {
                                    $total_in = $total_in + $cash->amount;
                                }
                                foreach ($capitals as $capital) {
                                    $total_in = $total_in + $capital->amount;
                                }
                                echo "( " . floatval($total_in) . " ) " . trans('main.' . $currency);
                                ?>
                            </span>
                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-4">
                                @if(App::getLocale() == 'ar')
                                    اجمالى الخارج من الخزن
                                @else
                                    total outcome
                                @endif
                                <?php
                                $total_out = 0;
                                foreach ($buy_cashs as $cash) {
                                    $total_out = $total_out + $cash->amount;
                                }
                                foreach ($expenses as $expense) {
                                    $total_out = $total_out + $expense->amount;
                                }
                                echo "( " . floatval($total_out) . " ) " . trans('main.' . $currency);
                                ?>
                            </span>

                            <span class="col-lg-4 col-sm-12 alert alert-secondary alert-sm mr-4">
                                @if(App::getLocale() == 'ar')
                                    اجمالى ارصدة الخزن
                                @else
                                    safes total balances
                                @endif
                                {{floatval($safes_balances)}}
                                {{ trans('main.'.$currency) }}
                            </span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row mt-3 mb-3">

                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-4">
                                @if(App::getLocale() == 'ar')
                                    اجمالى تكلفة المخازن
                                @else
                                    stores total costs
                                @endif
                                {{floatval($total_purchase_prices)}}
                                {{ trans('main.'.$currency) }}

                            </span>

                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-4">
                                @if(App::getLocale() == 'ar')
                                    اجمالى حسابات البنوك
                                @else
                                    banks total balances
                                @endif
                                {{floatval($banks_balances)}}
                                {{ trans('main.'.$currency) }}

                            </span>

                            <span class="col-lg-3 col-sm-12 alert alert-secondary alert-sm mr-4">
                                @if(App::getLocale() == 'ar')
                                    اجمالى الربح
                                @else
                                    total profits
                                @endif
                                {{floatval($total_profits)}}
                                {{ trans('main.'.$currency) }}

                            </span>

                            <div class="clearfix"></div>
                        </div>

                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>
