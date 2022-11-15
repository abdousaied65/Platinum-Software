@extends('client.layouts.app-main')
<style>
    span.badge {
        padding: 10px !important;
    }

</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <h3 class="text-center alert alert-sm alert-light"
                                style="color:#000;font-size: 17px!important;">
                                @if(App::getLocale() == 'ar')
                                    تقرير الوردية - الشيفت
                                @else
                                    Shift Report
                                @endif
                            </h3>
                            <a class="btn pull-left btn-danger text-white btn-md no-print mr-3"
                               onclick="window.print();"><i
                                    class="fa fa-print"></i>
                                @if(App::getLocale() == 'ar')
                                    طباعة التقرير
                                @else
                                    Print Report
                                @endif
                            </a>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body">
                    <table
                        style="width: 45%!important; margin: 10px auto;"
                        class="pull-right table table-condensed table-striped table-bordered text-center table-hover">
                        <tbody>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    الشركة
                                @else
                                    Company
                                @endif
                            </td>
                            <td>{{$shift->company->company_name}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    الفرع
                                @else
                                    Branch
                                @endif
                            </td>
                            <td>{{$shift->branch->branch_name}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المستخدم
                                @else
                                    User
                                @endif
                            </td>
                            <td>{{$shift->client->name}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    رصيد افتتاحى درج الكاشير
                                @else
                                    cashier drawer balance
                                @endif
                            </td>
                            <td>{{$shift->cashier_drawer_balance}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    الرصيد المرحل من الوردية السابقة
                                @else
                                    Amount Converted from previous shift
                                @endif
                            </td>
                            <td>{{$shift->previous_shift_balance}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    فرق الرصيد الافتتاحى
                                @else
                                    balance difference
                                @endif
                            </td>
                            <td>{{$shift->difference_balance}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المبلغ الفعلى المدخل الموجود كاش
                                @else
                                    actual cash payment
                                @endif
                            </td>
                            <td>{{$shift->actual_cash}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المبلغ الفعلى المدخل الموجود دفع بنكى
                                @else
                                    Actual bank payment
                                @endif
                            </td>
                            <td>{{$shift->actual_bank}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    الخزنة المرحل اليها
                                @else
                                    Safe which is converted to
                                @endif
                            </td>
                            <td>{{$shift->safe->safe_name}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المبلغ المرحل الى الخزنة
                                @else
                                    amount converted to safe
                                @endif
                            </td>
                            <td>{{$shift->transfer_safe_amount}}</td>
                        </tr>

                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المبلغ المرحل الى الوردية التالية
                                @else
                                    amount converted to next shift
                                @endif
                            </td>
                            <td>{{$shift->next_shift_balance}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    بداية الشيفت
                                @else
                                    shift start
                                @endif
                            </td>
                            <td>{{$shift->start_date_time}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    نهاية الشيفت
                                @else
                                    shift end
                                @endif
                            </td>
                            <td>{{$shift->end_date_time}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    ملاحظات
                                @else
                                    notes
                                @endif
                            </td>
                            <td>{{$shift->notes}}</td>
                        </tr>
                        </tbody>
                    </table>
                    @php
                        $i=0; $pos_sales = $shift->PosBills;
                        $sum1 = 0; $sum2 = 0 ; $sum3 =0;
                        $total_cash = 0; $total_bank = 0;
                    @endphp
                    @foreach ($pos_sales as $key => $pos)
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
                        $sum1 = $sum1 + $sum;
                        $bill_id = "pos_" . $pos->id;
                        $check = App\Models\Cash::where('bill_id', $bill_id)->first();
                        if (empty($check)) {
                            $check2 = App\Models\BankCash::where('bill_id', $bill_id)->first();
                            if (empty($check2)) {
                                $paid = "0";
                                $sum2 = $sum2 + 0;
                            } else {
                                $paid = $check2->amount;
                                $total_bank = $total_bank + $paid;
                                $sum2 = $sum2 + $check2->amount;
                            }
                        } else {
                            $paid = $check->amount;
                            $total_cash = $total_cash + $paid;
                            $sum2 = $sum2 + $check->amount;
                        }
                        $rest = $sum - $paid;
                        $sum3 = $sum3 + $percent;
                        ?>
                    @endforeach
                    <table
                        style="width: 45%!important; margin: 10px auto;"
                        class="pull-left table table-condensed table-striped table-bordered text-center table-hover">
                        <tbody>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    النقدية فى الدرج
                                @else
                                    cash in drawer
                                @endif
                            </td>
                            <td>
                                <?php
                                $total_drawer_cash = $shift->cashier_drawer_balance + $total_cash;
                                echo $total_drawer_cash;
                                ?>
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المدفوع نقدا كاش
                                @else
                                    paid as cash
                                @endif
                            </td>
                            <td>
                                {{$total_cash}}
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المدفوع بنكى شبكى
                                @else
                                    paid as bank
                                @endif
                            </td>
                            <td>
                                {{$total_bank}}
                            </td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    عدد فواتير المبيعات
                                @else
                                    sale total bills count
                                @endif
                            </td>
                            <td>{{$pos_sales->count()}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    اجمالى ايرادات المبيعات
                                @else
                                    total sales
                                @endif
                            </td>
                            <td>{{$sum1}}</td>
                        </tr>

                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    اجمالى المستحق
                                @else
                                    total deserved
                                @endif
                            </td>
                            <td>{{$sum1}}</td>
                        </tr>

                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    اجمالى المدفوع
                                @else
                                    total paid
                                @endif
                            </td>
                            <td>{{$sum2}}</td>
                        </tr>

                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    اجمالى المتبقى
                                @else
                                    total rest
                                @endif
                            </td>
                            <td>
                                <?php
                                echo $sum_rest = $sum1 - $sum2;
                                ?>
                            </td>
                        </tr>

                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    اجمالى الضريبة
                                @else
                                    total vat
                                @endif
                            </td>
                            <td>{{$sum3}}</td>
                        </tr>
                        </tbody>
                    </table>
                    <table
                        style="width: 45%!important; margin: 10px auto;"
                        class="pull-left table table-condensed table-striped table-bordered text-center table-hover">
                        <tbody>

                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المبلغ الاجمالى لتقفيل اليومية ( حسب النظام )
                                @else
                                    The total amount of the daily closing (according to the system)
                                @endif
                            </td>
                            <td>{{$shift_report->system_total}}</td>
                        </tr>
                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    المبلغ الاجمالى الفعلى المدخل لتقفيل اليومية
                                @else
                                    Actual total amount entered daily closing
                                @endif
                            </td>
                            <td>{{$shift_report->actual_total}}</td>
                        </tr>

                        <tr class="text-center">
                            <td>
                                @if(App::getLocale() == 'ar')
                                    مبلغ العجز (الفرق بين المبلغين السابقين )
                                @else
                                    The amount of the deficit (the difference between the two previous amounts)
                                @endif
                            </td>
                            <td>
                                @if($shift_report->difference_amount == "0")
                                    {{$shift_report->difference_amount}}
                                @elseif($shift_report->difference_amount > 0)
                                    {{$shift_report->difference_amount}}
                                    <br>

                                    @if(App::getLocale() == 'ar')
                                        زائد
                                    @else
                                        plus
                                    @endif
                                @elseif($shift_report->difference_amount < 0)
                                    {{abs($shift_report->difference_amount)}}
                                    <br>

                                    @if(App::getLocale() == 'ar')
                                        ناقص
                                    @else
                                        minus
                                    @endif
                                @endif
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <div class="clearfix"></div>
                    <hr class="no-print">
                    <h3 class="text-center no-print alert alert-sm alert-light"
                        style="color:#000;font-size: 17px!important;">
                        @if(App::getLocale() == 'ar')
                            تقرير فواتير الوردية
                        @else
                            Shift bills report
                        @endif
                    </h3>

                    <div class="table-responsive no-print">
                        <table class="table table-condensed table-striped table-bordered text-center table-hover"
                               id="example-table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رقم الفاتورة
                                    @else
                                        Bill Number
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        اسم العميل
                                    @else
                                        Client Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        تاريخ الفاتورة
                                    @else
                                        Bill Date
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        حالة الدفع
                                    @else
                                        Payment Status
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
                                        taxes
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
                                                    echo "<span class='badge badge-danger'><i class='fa fa-close'></i> Un paid </span>";
                                                }
                                            } else {
                                                if (App::getLocale() == 'ar') {
                                                    echo "<span class='badge badge-info'><i class='fa fa-bank'></i> مدفوعة شيك بنكى</span>";
                                                } else {
                                                    echo "<span class='badge badge-info'><i class='fa fa-bank'></i> paid - bank </span>";
                                                }
                                            }
                                        } else {
                                            if (App::getLocale() == 'ar') {
                                                echo "<span class='badge badge-success'><i class='fa fa-money'></i> مدفوعة كاش</span>";
                                            } else {
                                                echo "<span class='badge badge-success'><i class='fa fa-money'></i> paid - cash </span>";
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
                    </div>
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
