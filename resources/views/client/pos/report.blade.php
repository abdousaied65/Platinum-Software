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
                            <h3 class="pull-right alert alert-sm alert-light"
                                style="color:#000;font-size: 15px!important;">
                                <span class="badge badge-success badge-md">
                                    @if(App::getLocale() == 'ar')
                                        يوميات / ورديات / شيفتات فروع الشركة
                                    @else
                                        Company branches - shifts
                                    @endif
                                </span>
                                @if(App::getLocale() == 'ar')
                                    لكل نقاط البيع والمستخدمين عن اليوم
                                @else
                                    for all pos users
                                @endif
                                <span class="badge badge-dark badge-md">
                                {{date('Y-m-d')}}
                                </span>
                                <span class="badge badge-danger badge-md">
                                    @if(App::getLocale() == 'ar')
                                        المغلقة فقط
                                    @else
                                        Closed only
                                    @endif
                                </span>
                            </h3>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered text-center table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        اليوم
                                    @else
                                        Day
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الفرع
                                    @else
                                        branch
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        المستخدم
                                    @else
                                        user
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        بداية الوردية
                                    @else
                                        shift start
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        نهاية الوردية
                                    @else
                                        shift end
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        عرض التفاصيل
                                    @else
                                        show details
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=0; @endphp
                            @foreach($shifts as $shift)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{date('Y-m-d',strtotime($shift->end_date_time))}}</td>
                                    <td>{{$shift->branch->branch_name}}</td>
                                    <td>{{$shift->client->name}}</td>
                                    <td>{{$shift->start_date_time}}</td>
                                    <td>{{$shift->end_date_time}}</td>
                                    <td>
                                        <a href="{{route('show.shift.details',$shift->id)}}"
                                           class="btn btn-md btn-link">
                                            <i class="fa fa-arrow-right"></i>

                                            @if(App::getLocale() == 'ar')
                                                عرض
                                            @else
                                                show
                                            @endif
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <a class="btn pull-left btn-primary btn-sm"
                               href="{{ route('client.pos.create') }}"><i
                                    class="fa fa-plus"></i>
                                @if(App::getLocale() == 'ar')
                                    الدخول الى نقطة البيع
                                @else
                                    open pos cashier
                                @endif
                            </a>
                            <a class="btn pull-left btn-info btn-sm mr-3" href="{{route('pos.sales.report.print')}}"><i
                                    class="fa fa-print"></i>
                                @if(App::getLocale() == 'ar')
                                    طباعة التقرير
                                @else
                                    print report
                                @endif
                            </a>
                            <h5 class="pull-right alert alert-sm alert-success">
                                @if(App::getLocale() == 'ar')
                                    تقرير مبيعات نقاط البيع ( كل الفواتير )
                                @else
                                    pos report report (all bills)
                                @endif
                            </h5>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
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
                                                if(App::getLocale() == 'ar'){
                                                    echo "<span class='badge badge-danger'><i class='fa fa-close'></i> غير مدفوعة - دين على العميل</span>";
                                                }
                                                else{
                                                    echo "<span class='badge badge-danger'><i class='fa fa-close'></i> un paid </span>";
                                                }
                                            } else {
                                                if(App::getLocale() == 'ar'){
                                                    echo "<span class='badge badge-info'><i class='fa fa-bank'></i> مدفوعة شيك بنكى</span>";
                                                }
                                                else{
                                                    echo "<span class='badge badge-info'><i class='fa fa-bank'></i> paid - bank</span>";
                                                }

                                            }
                                        } else {
                                            if(App::getLocale() == 'ar'){
                                                echo "<span class='badge badge-success'><i class='fa fa-money'></i> مدفوعة كاش</span>";
                                            }
                                            else{
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
                    </div>
                    <div class='row mb-3 mt-3 text-center'>
                        <div class='col-lg-4 pulll-right alert alert-sm alert-secondary'>
                            @if(App::getLocale() == 'ar')
                                اجمالى الفواتير شاملة الضريبة :
                            @else
                                bills total (including VAT)
                            @endif
                            <br/>
                            {{$sum1}}

                        </div>

                        <div class='col-lg-4 pulll-right alert alert-sm alert-secondary'>
                            @if(App::getLocale() == 'ar')
                                اجمالى المبالغ المدفوعة :
                            @else
                                total paid :
                            @endif
                            <br/>
                            {{$sum2}}

                        </div>

                        <div class='col-lg-4 pulll-right alert alert-sm alert-secondary'>
                            @if(App::getLocale() == 'ar')
                                اجمالى الضريبة لكل الفواتير :
                            @else
                                total vat for all bills
                            @endif
                            <br/>
                            {{$sum3}}

                        </div>
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
