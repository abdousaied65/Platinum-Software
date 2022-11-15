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
                        <h5 style="min-width: 300px;" class="pull-right alert alert-md alert-danger">
                            @if(App::getLocale() == 'ar')
                                تقرير الارباح
                            @else
                                profits report
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report13.post')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="row mt-2">
                            <div class="col-lg-3 pull-right no-print">
                                <label for="" class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        اسم الفرع
                                    @else
                                        branch name
                                    @endif
                                </label>
                                <select required name="branch_id" id="branch_id" class="selectpicker"
                                        data-style="btn-warning" data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                    @endif
                                >
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-3 pull-right no-print">
                                <label for="" class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        اسم المستخدم
                                    @else
                                        user name
                                    @endif
                                </label>
                                <select multiple required name="client_id[]" id="client_id" class="selectpicker"
                                        data-style="btn-info" data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                    @endif
                                >
                                </select>
                            </div>
                            <div class="col-lg-3 pull-right no-print">
                                <label for="" class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        من تاريخ
                                    @else
                                        from date
                                    @endif
                                </label>
                                <input type="date" @if(isset($from_date) && !empty($from_date)) value="{{$from_date}}"
                                       @endif class="form-control" name="from_date"/>
                            </div>
                            <div class="col-lg-3 pull-right no-print">
                                <label for="" class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        الى تاريخ
                                    @else
                                        to date
                                    @endif
                                </label>
                                <input type="date" @if(isset($to_date) && !empty($to_date)) value="{{$to_date}}"
                                       @endif  class="form-control" name="to_date"/>
                            </div>

                        </div>
                        <div class="row mb-3 text-center">
                            <div class="col-lg-12">
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
                        </div>
                    </form>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>
                    @if((isset($sale_bills) && !$sale_bills->isEmpty()) || (isset($pos_bills) && !$pos_bills->isEmpty()))
                        <p class="alert alert-md alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                ارباح فواتير البيع
                            @else
                                sale bills profits
                            @endif
                        </p>
                        @foreach ($client_id as $clientid)
                            <?php
                            $client = \App\Models\Client::FindOrFail($clientid);
                            $company_id = $client->company_id;
                            if (empty($from_date) || empty($to_date)) {
                                $sale_bills = \App\Models\SaleBill::where('company_id', $company_id)->Where('client_id', $client->id)->get();
                                $pos_bills = \App\Models\PosOpen::where('company_id', $company_id)->Where('client_id', $client->id)->get();
                                $cashs = \App\Models\Cash::where('company_id', $company_id)->Where('client_id', $client->id)->get();
                                $bank_cashs = \App\Models\BankCash::where('company_id', $company_id)->Where('client_id', $client->id)->get();
                            } else {
                                $sale_bills = \App\Models\SaleBill::where('company_id', $company_id)
                                    ->Where('client_id', $client->id)
                                    ->whereBetween('created_at', [$from_date, date('Y-m-d', strtotime($to_date . ' +1 day'))])->get();
                                $pos_bills = \App\Models\PosOpen::where('company_id', $company_id)
                                    ->Where('client_id', $client->id)
                                    ->whereBetween('created_at', [$from_date, date('Y-m-d', strtotime($to_date . ' +1 day'))])->get();

                                $cashs = \App\Models\Cash::where('company_id', $company_id)
                                    ->Where('client_id', $client->id)
                                    ->whereBetween('created_at', [$from_date, date('Y-m-d', strtotime($to_date . ' +1 day'))])
                                    ->get();
                                $bank_cashs = \App\Models\BankCash::where('company_id', $company_id)->Where('client_id', $client->id)
                                    ->whereBetween('created_at', [$from_date, date('Y-m-d', strtotime($to_date . ' +1 day'))])
                                    ->get();
                            }
                            ?>
                            <h6 class="col-lg-6 col-md-12 pull-right text-black">
                                @if(App::getLocale() == 'ar')
                                    الفرع :
                                @else
                                    branch :
                                @endif
                                <?php
                                $branch = \App\Models\Branch::FindOrFail($branch_id);
                                echo $branch->branch_name;
                                ?>
                            </h6>
                            <h6 class="col-lg-6 col-md-12 pull-right text-black">
                                @if(App::getLocale() == 'ar')
                                    المستخدم :
                                @else
                                    user :
                                @endif
                                {{$client->name}}
                            </h6>
                            <div class="clearfix"></div>
                            <div class="table-responsive">
                                <table class='table table-condensed table-striped table-bordered'>
                                    <thead class="text-center">
                                    <th>#</th>
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            رقم الفاتورة
                                        @else
                                            bill number
                                        @endif
                                    </th>
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            نوع الفاتورة
                                        @else
                                            bill type
                                        @endif
                                    </th>
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            العميل
                                        @else
                                            client
                                        @endif
                                    </th>
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            تاريخ الفاتورة
                                        @else
                                            bill date
                                        @endif
                                    </th>
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            وقت الفاتورة
                                        @else
                                            bill time
                                        @endif
                                    </th>
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            الاجمالى النهائى
                                        @else
                                            final total
                                        @endif
                                    </th>
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            الربح
                                        @else
                                            profit
                                        @endif
                                    </th>
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            المستخدم
                                        @else
                                            user
                                        @endif
                                    </th>
                                    </thead>
                                    <tbody>
                                    <?php $i = 0; $total = 0; $total_profits = 0; ?>
                                    @foreach($sale_bills as $sale_bill)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{$sale_bill->sale_bill_number}}</td>
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    فاتورة مبيعات عملاء
                                                @else
                                                    sale bill
                                                @endif
                                            </td>
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
                                            <td>{{$sale_bill->date}}</td>
                                            <td>{{$sale_bill->time}}</td>
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
                                                echo round($after_total, 2) . " " . trans('main.' . $currency);
                                                ?>
                                                <?php $total = $total + $after_total; ?>
                                            </td>
                                            <td>
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
                                                echo round($profit, 2) . " " . trans('main.' . $currency);
                                                $total_profits = $total_profits + $profit;
                                                ?>
                                            </td>
                                            <td>{{$sale_bill->client->name}}</td>
                                        </tr>
                                    @endforeach
                                    @foreach($pos_bills as $pos_bill)
                                        <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{ $pos_bill->id }}</td>
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    فاتورة كاشير نقاط بيع
                                                @else
                                                    POS Cashier Invoice
                                                @endif
                                            </td>
                                            <td>
                                                @if(empty($pos_bill->outer_client_id))
                                                    @if(App::getLocale() == 'ar')
                                                        عميل مبيعات نقدية
                                                    @else
                                                        walk in customer
                                                    @endif
                                                @else
                                                    {{$pos_bill->outerClient->client_name}}
                                                @endif
                                            </td>
                                            <td colspan="2">{{ $pos_bill->created_at }}</td>
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
                                                {{round($profit,2)}}
                                                {{ trans('main.'.$currency) }}
                                            </td>
                                            <td>{{$pos_bill->client->name}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row mb-3 text-center">
                                <span class=" col-lg-4 col-md-12 alert alert-secondary alert-md">
                                    @if(App::getLocale() == 'ar')
                                        عدد الفواتير
                                    @else
                                        number of bills
                                    @endif
                                     ( {{$i}} )
                                </span>
                                <span class=" col-lg-4 col-md-12 alert alert-secondary alert-md">
                                    @if(App::getLocale() == 'ar')
                                        اجمالى المبيعات
                                    @else
                                        total sales
                                    @endif
                                     ( {{round( $total,2  )}} ) {{__('main.'.$currency)}}
                                </span>
                                <span class="  col-lg-4 col-md-12 alert alert-secondary alert-md">
                                    @if(App::getLocale() == 'ar')
                                        اجمالى الارباح
                                    @else
                                        total profits
                                    @endif
                                     (  {{round( $total_profits,2  )}} ) {{__('main.'.$currency)}}
                                </span>
                            </div>
                            <hr>
                        @endforeach
                    @elseif(isset($sale_bills) && $sale_bills->isEmpty())
                        <div class="alert alert-md alert-danger text-center mt-3">
                            <i class="fa fa-close"></i>
                            @if(App::getLocale() == 'ar')
                                لا توجد اى فواتير
                            @else
                                no bills
                            @endif
                        </div>
                    @endif
                    @if((isset($cashs) && !$cashs->isEmpty()) || (isset($bank_cashs) && !$bank_cashs->isEmpty()))
                        <p class="alert alert-md alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                الماليات
                            @else
                                financial issues
                            @endif
                        </p>

                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table class='table table-condensed table-striped table-bordered'>
                                <thead class="text-center">
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        المستخدم
                                    @else
                                        user
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        اجمالى التحصيل كاش نقدى
                                    @else
                                        total collected cash
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        اجمالى التحصيل بنكى
                                    @else
                                        total collected - bank
                                    @endif
                                </th>
                                </thead>
                                <tbody>
                                @foreach ($client_id as $clientid)
                                    <?php
                                    $client = \App\Models\Client::FindOrFail($clientid);
                                    $company_id = $client->company_id;
                                    if (empty($from_date) || empty($to_date)) {
                                        $cashs = \App\Models\Cash::where('company_id', $company_id)->Where('client_id', $client->id)->get();
                                        $bank_cashs = \App\Models\BankCash::where('company_id', $company_id)->Where('client_id', $client->id)->get();
                                    } else {
                                        $cashs = \App\Models\Cash::where('company_id', $company_id)
                                            ->Where('client_id', $client->id)
                                            ->whereBetween('created_at', [$from_date, date('Y-m-d', strtotime($to_date . ' +1 day'))])
                                            ->get();
                                        $bank_cashs = \App\Models\BankCash::where('company_id', $company_id)->Where('client_id', $client->id)
                                            ->whereBetween('created_at', [$from_date, date('Y-m-d', strtotime($to_date . ' +1 day'))])
                                            ->get();
                                    }

                                    $total_cash = 0; $total_bank = 0;
                                    foreach ($cashs as $cash) {
                                        $total_cash = $total_cash + $cash->amount;
                                    }
                                    foreach ($bank_cashs as $cash) {
                                        $total_bank = $total_bank + $cash->amount;
                                    }
                                    ?>
                                    <tr>
                                        <td>{{$client->name}}</td>
                                        <td>{{$total_cash}}</td>
                                        <td>{{$total_bank}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#branch_id').on('change', function () {
            let branch_id = $(this).val();
            $.post('{{route('get.clients.by.branch.id')}}', {branch_id: branch_id}, function (data) {
                $('#client_id').html(data);
                $('#client_id').selectpicker('refresh');
            });
        });
    </script>
@endsection







