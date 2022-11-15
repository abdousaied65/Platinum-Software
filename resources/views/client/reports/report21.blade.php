@extends('client.layouts.app-main')
<style>

</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('error') }}
        </div>
    @endif
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <h5 class="pull-right alert alert-sm alert-success">
                                @if(App::getLocale() == 'ar')
                                    تقرير حركة فرع
                                @else
                                    branch movement report
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
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
                    <hr>
                    <form action="{{route('client.report21.post')}}" class="no-print" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-4 pull-right no-print">
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
                                    <option
                                        @if(isset($branch_id) && $branch->id == $branch_id)
                                        selected
                                        @endif
                                        value="{{$branch->id}}">{{$branch->branch_name}}</option>
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

                    @if(isset($branch_k) && !empty($branch_k))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير حركة فرع
                            @else
                                branch movement report
                            @endif
                        </p>
                    @endif
                    <div class="clearfix"></div>
                    @if(isset($products_k) && !$products_k->isEmpty())
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير حركة مخازن فرع
                            @else
                                branch's stores movement report
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم المنتج
                                        @else
                                            product name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الكود
                                        @else
                                            barcode
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            مشتريات
                                        @else
                                            purchases
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            مبيعات
                                        @else
                                            sales
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sum = 0;?>
                                @foreach($products_k as $product_k)
                                    <tr>
                                        <td>{{ $product_k->product_name }}</td>
                                        <td>{{ $product_k->code_universal }}</td>
                                        <td>
                                            <?php
                                            $buy_elements = \App\Models\BuyBillElement::where('product_id', $product_k->id)->get();
                                            $total_buy_elements = 0;
                                            foreach ($buy_elements as $buy_element) {
                                                $total_buy_elements = $total_buy_elements + $buy_element->quantity;
                                            }
                                            echo floatval($total_buy_elements);
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $sale_elements = \App\Models\SaleBillElement::where('product_id', $product_k->id)->get();
                                            $pos_elements = \App\Models\PosOpenElement::where('product_id', $product_k->id)->get();
                                            $total_sale_elements = 0;
                                            foreach ($sale_elements as $sale_element) {
                                                $total_sale_elements = $total_sale_elements + $sale_element->quantity;
                                            }
                                            foreach ($pos_elements as $pos_element) {
                                                $total_sale_elements = $total_sale_elements + $pos_element->quantity;
                                            }
                                            $total_sold = $total_sale_elements;
                                            echo floatval($total_sold);
                                            ?>
                                        </td>
                                    </tr>
                                    <?php $total = $product_k->first_balance * $product_k->purchasing_price;
                                    $sum = $sum + $total;
                                    ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <span class="col-lg-4 col-sm-12 alert alert-secondary alert-sm mr-5">
                                @if(App::getLocale() == 'ar')
                                    اجمالى التكلفة
                                @else
                                    total cost
                                @endif
                                ({{floatval($sum)}})
                            </span>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    @if(isset($bank_safe_transfers) && !$bank_safe_transfers->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات التحويل من بنك الى خزنة
                            @else
                                Transfers From bank to Safe
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            البنك
                                        @else
                                            Bank
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الخزنة
                                        @else
                                            Safe
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
                                            السبب
                                        @else
                                            Reason
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المسؤول
                                        @else
                                            User
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($bank_safe_transfers as $key => $transfer)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $transfer->bank->bank_name }}</td>
                                        <td>{{ $transfer->safe->safe_name }}</td>
                                        <td>
                                            {{floatval($transfer->amount)}}
                                        </td>
                                        <td>{{ $transfer->reason }}</td>
                                        <td>{{ $transfer->client->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($safe_bank_transfers) && !$safe_bank_transfers->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات التحويل من خزنة الى بنك
                            @else
                                Transfers From Safe to bank
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الخزنة
                                        @else
                                            Safe
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
                                            المبلغ
                                        @else
                                            Amount
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            السبب
                                        @else
                                            Reason
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المسؤول
                                        @else
                                            User
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($safe_bank_transfers as $key => $transfer)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $transfer->safe->safe_name }}</td>
                                        <td>{{ $transfer->bank->bank_name }}</td>
                                        <td>
                                            {{floatval($transfer->amount)}}
                                        </td>
                                        <td>{{ $transfer->reason }}</td>
                                        <td>{{ $transfer->client->name }}</td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($buy_cashs) && !$buy_cashs->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                مدفوعات الموردين وفواتير المشتريات
                            @else
                                suppliers payments and purchases invoices
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"> م</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            نوع العملية
                                        @else
                                            process type
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المبلغ
                                        @else
                                            amount
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الخزنة
                                        @else
                                            safe
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
                                            المسؤول
                                        @else
                                            user
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($buy_cashs as $cash)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            <?php
                                            if ($cash->bill_id != "") {
                                                if (App::getLocale() == "ar") {
                                                    echo "فاتورة مشتريات";
                                                } else {
                                                    echo "purchase invoice ";
                                                }
                                            } else {
                                                if ($cash->amount > 0) {
                                                    if (App::getLocale() == "ar") {
                                                        echo "  دفعة الى المورد " . $cash->supplier->supplier_name;
                                                    } else {
                                                        echo "  payment to supplier " . $cash->supplier->supplier_name;
                                                    }
                                                } else {
                                                    if (App::getLocale() == "ar") {
                                                        echo "سلفة من المورد " . $cash->supplier->supplier_name;
                                                    } else {
                                                        echo "payment from supplier " . $cash->supplier->supplier_name;
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            {{floatval(abs($cash->amount))}}
                                        </td>
                                        <td>{{$cash->safe->safe_name}}</td>
                                        <td>{{$cash->date}}</td>
                                        <td>{{$cash->client->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($capitals) && !$capitals->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                مبالغ راس المال المضافة
                            @else
                                Added Capital Amounts
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المبلغ
                                        @else
                                            amount
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الخزنة
                                        @else
                                            safe
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رصيد ما قبل
                                        @else
                                            balance before
                                        @endif

                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رصيد ما بعد
                                        @else
                                            balance after
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            تاريخ - وقت
                                        @else
                                            date -time
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($capitals as $key => $capital)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            {{floatval($capital->amount)}}
                                        </td>
                                        <td>{{ $capital->safe->safe_name }}</td>
                                        <td>
                                            {{floatval($capital->balance_before)}}
                                        </td>
                                        <td>
                                            {{floatval($capital->balance_after)}}
                                        </td>
                                        <td>{{ $capital->created_at }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($cashs) && !$cashs->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                مدفوعات العملاء وفواتير البيع عملاء
                            @else
                                clients payments and sale bills
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center"> م</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            نوع العملية
                                        @else
                                            process type
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المبلغ
                                        @else
                                            amount
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الخزنة
                                        @else
                                            safe
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
                                            المسؤول
                                        @else
                                            user
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach($cashs as $cash)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            <?php
                                            if ($cash->bill_id != "") {
                                                if (App::getLocale() == "ar") {
                                                    echo "فاتورة مبيعات عملاء ";
                                                } else {
                                                    echo "sale bill";
                                                }
                                            } else {
                                                if ($cash->amount > 0) {
                                                    if (App::getLocale() == "ar") {
                                                        echo "تحصيل من العميل " . $cash->outerClient->client_name;
                                                    } else {
                                                        echo "payment from client " . $cash->outerClient->client_name;
                                                    }
                                                } else {
                                                    if (App::getLocale() == "ar") {
                                                        echo "سلفة الى العميل " . $cash->outerClient->client_name;
                                                    } else {
                                                        echo "payment from client " . $cash->outerClient->client_name;
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            {{floatval(abs($cash->amount))}}
                                        </td>
                                        <td>{{$cash->safe->safe_name}}</td>
                                        <td>{{$cash->date}}</td>
                                        <td>{{$cash->client->name}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($employees_cashs) && !$employees_cashs->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                مدفوعات الموظفين ورواتبهم
                            @else
                                employees payments
                            @endif
                        </p>

                        <table class="table table-condensed table-striped table-bordered text-center table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        اسم الموظف
                                    @else
                                        employee name
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
                                        المبلغ
                                    @else
                                        amount
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الخزنة
                                    @else
                                        safe
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
                                $i=0;
                            @endphp
                            @foreach ($employees_cashs as $key => $employee_cash)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $employee_cash->employee->name}}</td>
                                    <td>{{ $employee_cash->date}}</td>
                                    <td>{{ $employee_cash->amount}}</td>
                                    <td>{{ $employee_cash->safe->safe_name}}</td>
                                    <td>{{ $employee_cash->notes}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if(isset($expenses) && !$expenses->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                المصروفات
                            @else
                                expenses
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رقم المصروف
                                        @else
                                            Expense Number
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            تفاصيل المصروف
                                        @else
                                            Expense Details
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            نوع المصروف
                                        @else
                                            Expense Type
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
                                            الموظف
                                        @else
                                            Employee
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            صورة المصروف
                                        @else
                                            Expense Picture
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            خزنة الدفع
                                        @else
                                            Payment Safe
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            بنك الدفع
                                        @else
                                            Payment Bank
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            ملاحظات
                                        @else
                                            Notes
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المسؤول
                                        @else
                                            User
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($expenses as $key => $expense)
                                    <tr>
                                        <td>{{ $expense->expense_number }}</td>
                                        <td>{{ $expense->expense_details }}</td>
                                        <td>{{ $expense->fixed->fixed_expense}}</td>
                                        <td>
                                            {{floatval($expense->amount)}}
                                        </td>
                                        <td>
                                            @if(!empty($expense->employee_id))
                                                {{$expense->employee->name}}
                                            @endif
                                        </td>
                                        <td>
                                            <img data-toggle="modal" href="#modaldemo8"
                                                 src="{{asset($expense->expense_pic)}}"
                                                 style="width:50px; height: 50px;cursor:pointer;"
                                                 alt=""/>
                                        </td>
                                        <td>
                                            @if(!empty($expense->safe_id))
                                                {{ $expense->safe->safe_name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(!empty($expense->bank_id))
                                                {{ $expense->bank->bank_name }}
                                            @endif
                                        </td>
                                        <td>{{ $expense->notes }}</td>
                                        <td>{{ $expense->client->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100"
                        style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            عرض صورة المصروف
                        @else
                            show expense image
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <img id="image_larger" alt="image" style="width: 100%; "/>
                </div>
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-sm btn-danger"><i class="fa fa-colse"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('img').on('click', function () {
            var image_larger = $('#image_larger');
            var path = $(this).attr('src');
            $(image_larger).prop('src', path);
        });
    });
</script>
