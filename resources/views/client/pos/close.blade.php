@extends('client.layouts.app-pos')
<style>

</style>
@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12 text-center">
                <p class="alert alert-warning alert-sm text-center">
                    @if(App::getLocale() == 'ar')
                        باقفال اليومية واغلاق نقطة البيع .. سينتهى البيع فى هذا اليوم وسيتم اغلاق نقطة البيع
                    @else
                        By closing the daily and closing the point of sale.. the sale will end on this day and the point
                        of sale will be closed
                    @endif
                </p>
                <h3 class="text-center mt-2 mb-2">
                    @if(App::getLocale() == 'ar')
                        تفاصيل اليومية والشيفت
                    @else
                        Shift Details
                    @endif
                </h3>
                <table class="table table-bordered table-hover table-striped table-condensed">
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
                                بداية الشيفت
                            @else
                                Shift Start
                            @endif
                        </td>
                        <td>{{$shift->start_date_time}}</td>
                        <td>
                            @if(App::getLocale() == 'ar')
                                نهاية الشيفت
                            @else
                                Shift End
                            @endif
                        </td>
                        <td>{{date('Y-m-d H:i:s')}}</td>
                    </tr>
                    <tr class="text-center">
                        <td colspan="2">
                            @if(App::getLocale() == 'ar')
                                ملاحظات
                            @else
                                Notes
                            @endif
                        </td>
                        <td colspan="2">{{$shift->notes}}</td>
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
                <?php $total_drawer_cash = $shift->cashier_drawer_balance + $total_cash; ?>
                <h3 class="text-center mt-1 mb-1">
                    @if(App::getLocale() == 'ar')
                        مراجعة العمليات
                    @else
                        Processes Review
                    @endif
                </h3>
                <hr>
                <p class="col-lg-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        المدفوع نقدا كاش
                    @else
                        Total Paid Cash
                    @endif
                    <br>
                    {{$total_cash}}
                </p>
                <p class="col-lg-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        المدفوع بنكى شبكى
                    @else
                        Total PAid Bank
                    @endif
                    <br>
                    {{$total_bank}}
                </p>
                <p class="col-lg-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        المبلغ الاجمالى لتقفيل اليومية
                    @else
                        Total Amount for daily close
                    @endif
                    <br>
                    <?php $system_total = $total_cash + $total_bank + $shift->cashier_drawer_balance; ?>
                    <input type="hidden" name="system_total" form="myForm"
                           value="{{$system_total}}"/>
                    {{$system_total}}
                </p>
                <div class="clearfix"></div>
                <hr>
                <p class="col-lg-6 pull-right">
                    <label for="" class="d-block">
                        @if(App::getLocale() == 'ar')
                            المبلغ الموجود كاش
                        @else
                            Cash Amount
                        @endif
                    </label>
                    <input type="number" dir="ltr" required class="form-control" form="myForm"
                           name="actual_cash" id="actual_cash" min="0"/>
                </p>
                <p class="col-lg-6 pull-right">
                    <label for="" class="d-block">
                        @if(App::getLocale() == 'ar')
                            المبلغ الموجود دفع بنكى
                        @else
                            Bank Amount
                        @endif
                    </label>
                    <input type="number" min="0" dir="ltr" required class="form-control" form="myForm"
                           name="actual_bank"/>
                </p>
                <div class="clearfix"></div>
                <p class="col-lg-8 pull-right">
                    <label for="" class="d-block">
                        @if(App::getLocale() == 'ar')
                            المبلغ المرحل الى الخزنة
                        @else
                            Amount converted to safe
                        @endif
                    </label>
                    <select form="myForm" style="width: 80% !important; display: inline !important;"
                            required name="safe_id" class="form-control col-lg-6 pull-right">
                        <option value="">
                            @if(App::getLocale() == 'ar')
                                اختر الخزنة المرحل اليها
                            @else
                                choose Safe
                            @endif
                        </option>
                        @foreach($safes as $safe)
                            @if($safe->type != "cashier")
                                <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                            @endif
                        @endforeach
                    </select>
                    <input required type="number" min="0" dir="ltr"
                           class="form-control col-lg-6 pull-right"
                           form="myForm" id="transfer_safe_amount"
                           name="transfer_safe_amount"/>
                </p>
                <p class="col-lg-4 pull-right">
                    <label for="" class="d-block">
                        @if(App::getLocale() == 'ar')
                            المبلغ المرحل الى الوردية التالية
                        @else
                            the amount converted to next shift
                        @endif
                    </label>
                    <input min="0" disabled required type="number" dir="ltr" class="form-control"
                           form="myForm"
                           name="next_shift_balance" id="next_shift_balance"/>
                </p>
            </div>
            <div class="col-lg-12 mt-2 text-center">
                <a data-toggle="modal" href="#modaldemo30" class="btn btn-md btn-danger ">
                    <i class="fa fa-close"></i>
                    @if(App::getLocale() == 'ar')
                        اقفال اليومية ( اغلاق نقطة البيع )
                    @else
                        POS Close (Shift Close)
                    @endif
                </a>
            </div>
        </div>
    </div>
    <button onclick="window.open('{{route('client.home')}}','_self')"
            class="btn btn-md btn-success">
        @if(App::getLocale() == 'ar')
            العودة الى الصفحة الرئيسية
        @else
            Back To Main Page
        @endif
    </button>
    <button onclick="window.open('{{route('client.pos.create')}}','_self')"
            class="btn btn-md btn-info" style="margin-right: 20px!important;">
        @if(App::getLocale() == 'ar')
            العودة الى نقطة البيع
        @else
            Back To POS Cashier
        @endif
    </button>
    <div class="modal" id="modaldemo30">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            اقفال اليومية ( اغلاق نقطة البيع )
                        @else
                            POS Cashier (Shift Close)
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form id="myForm" action="{{route('pos.shift.close')}}" method="POST">
                    @csrf
                    @method('POST')
                    @if($shift_type == "open")
                        <input type="hidden" name="shift_id" value="{{$shift->id}}"/>
                    @endif
                    <div class="modal-body">
                        <p>
                            @if(App::getLocale() == 'ar')
                                هل انت متأكد انك تريد اقفال اليومية ( اغلاق نقطة البيع ) ؟
                            @else
                                Are you sure you want to close the Shift (close the point of sale)?
                            @endif
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@if(App::getLocale() == 'ar')
                                الغاء
                            @else
                                Cancel
                            @endif</button>
                        <button type="submit" class="btn btn-danger">
                            @if(App::getLocale() == 'ar')
                                اقفال اليومية
                            @else
                                Shift Close
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#actual_cash').on('keyup blur change', function () {
            let actual_cash = $(this).val();
            let transfer_safe_amount = $('#transfer_safe_amount').val();
            let next_shift_balance = actual_cash - transfer_safe_amount;
            $('#next_shift_balance').val(next_shift_balance);
        });
        $('#transfer_safe_amount').on('keyup blur change', function () {
            let transfer_safe_amount = $(this).val();
            let actual_cash = $('#actual_cash').val();
            let next_shift_balance = actual_cash - transfer_safe_amount;
            $('#next_shift_balance').val(next_shift_balance);
        });
    });
</script>
