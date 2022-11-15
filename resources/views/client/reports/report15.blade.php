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
                                تقرير حركة بنك
                            @else
                                bank movement report
                            @endif

                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report15.post')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-3 pull-right no-print">
                            <label for="bank_id" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    اخترالبنك
                                @else
                                    Choose bank
                                @endif
                            </label>
                            <select required name="bank_id" id="bank_id" class="selectpicker"
                                    data-style="btn-info" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                @endif
                            >
                                @foreach($banks as $bank)
                                    <option
                                        @if(isset($bank_id) && $bank->id == $bank_id)
                                        selected
                                        @endif
                                        value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                @endforeach
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
                    @if(isset($bank_k) && !empty($bank_k))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير حركة بنك
                            @else
                                bank movement report
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم البنك
                                        @else
                                            bank name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رصيد البنك
                                        @else
                                            bank balance
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $bank_k->bank_name }}</td>
                                    <td>
                                        {{floatval($bank_k->bank_balance)}}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(isset($bank_modifications) && !empty($bank_modifications))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تعديلات رصيد البنك
                            @else
                                bank balance modifications
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم البنك
                                        @else
                                            bank name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رصيد ما قبل التعديل
                                        @else
                                            balance before
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رصيد ما بعد التعديل
                                        @else
                                            balance after
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            سبب التعديل
                                        @else
                                            modification reason
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            تاريخ
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
                                @php $i=0; @endphp
                                @foreach($bank_modifications as $modification)
                                    <tr>
                                        <td>{{ $modification->bank->bank_name }}</td>
                                        <td>
                                            {{floatval($modification->balance_before)}}
                                        </td>
                                        <td>
                                            {{floatval($modification->balance_after)}}
                                        </td>
                                        <td>{{ $modification->reason}}</td>
                                        <td>{{ $modification->created_at }}</td>
                                        <td>{{ $modification->client->name }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(isset($bank_processes) && !empty($bank_processes))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات السحب والايداع للبنك
                            @else
                                withdraw & deposit processes
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            نوع العملية
                                        @else
                                            process type
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم البنك
                                        @else
                                            bank name
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
                                            رصيد ما قبل
                                        @else
                                            Balance Before
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رصيد ما بعد
                                        @else
                                            Balance After
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
                                            التاريخ
                                        @else
                                            date
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
                                @foreach ($bank_processes as $key => $process)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            @if($process->process_type == "withdrawal")
                                                @if(App::getLocale() == 'ar')
                                                    سحب نقدى
                                                @else
                                                    withdraw
                                                @endif
                                            @elseif($process->process_type == "deposit")
                                                @if(App::getLocale() == 'ar')
                                                    ايداع نقدى
                                                @else
                                                    Deposit
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $process->bank->bank_name }}</td>
                                        <td>
                                            {{floatval($process->amount)}}
                                        </td>
                                        <td>
                                            {{floatval($process->balance_before)}}
                                        </td>
                                        <td>
                                            {{floatval($process->balance_after)}}
                                        </td>
                                        <td>{{ $process->reason }}</td>
                                        <td>{{ $process->created_at }}</td>
                                        <td>{{ $process->client->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($bank_transfers) && !empty($bank_transfers))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات التحويل من والى البنك
                            @else
                                Transfers from and to the same Bank
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            بنك السحب
                                        @else
                                            Withdrawal Bank
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            بنك الايداع
                                        @else
                                            Deposit Bank
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
                                            التاريخ
                                        @else
                                            Date
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
                                @foreach ($bank_transfers as $key => $transfer)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $transfer->withdrawal->bank_name }}</td>
                                        <td>{{ $transfer->deposit->bank_name }}</td>
                                        <td>{{floatval( $transfer->amount  )}}</td>
                                        <td>{{ $transfer->reason }}</td>
                                        <td>{{ $transfer->created_at }}</td>
                                        <td>{{ $transfer->client->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if(isset($bank_safe_transfers) && !empty($bank_safe_transfers))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات التحويل من البنك الى الخزن
                            @else
                                Transfers From this bank to Safes
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

                    @if(isset($safe_bank_transfers) && !empty($safe_bank_transfers))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات التحويل من الخزن الى البنك
                            @else
                                Transfers From Safes to this bank
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
                    @if(isset($bank_cash) && !$bank_cash->isEmpty())
                        <p class="alert alert-sm alert-warning mt-3 text-center">
                            @if(App::getLocale() == 'ar')
                                مدفوعات بنكية من العملاء لهذا البنك
                            @else
                                bank payments from clients to this bank
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table
                                class="table table-condensed table-striped table-bordered text-center table-hover">
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
                                            اسم العميل
                                        @else
                                            Client Name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المبلغ المدفوع
                                        @else
                                            Paid Amount
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
                                            التاريخ
                                        @else
                                            Date
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الوقت
                                        @else
                                            Time
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            البنك
                                        @else
                                            Bank Name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رقم المعاملة
                                        @else
                                            Bank Check Number
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
                                @foreach ($bank_cash as $key => $cash)
                                    <tr>
                                        <td>{{ $cash->cash_number }}</td>
                                        <td>
                                            @if(empty($cash->outer_client_id))
                                                @if(App::getLocale() == 'ar')
                                                    عميل مبيعات نقدية
                                                @else
                                                    walk in customer
                                                @endif
                                            @else
                                                {{$cash->outerClient->client_name}}
                                            @endif
                                        </td>
                                        <td>
                                            {{floatval($cash->amount)}}
                                        </td>
                                        <td>{{ $cash->bill_id }}</td>
                                        <td>{{ $cash->date }}</td>
                                        <td>{{ $cash->time }}</td>
                                        <td>{{ $cash->bank->bank_name }}</td>
                                        <td>{{ $cash->bank_check_number }}</td>
                                        <td>{{ $cash->notes }}</td>
                                        <td>{{ $cash->client->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    @if(isset($bank_buy_cash) && !$bank_buy_cash->isEmpty())
                        <p class="alert alert-sm alert-warning mt-3 text-center">
                            @if(App::getLocale() == 'ar')
                                مدفوعات بنكية الى الموردين من هذا البنك
                            @else
                                bank payments to suppliers from this bank
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table
                                class="table table-condensed table-striped table-bordered text-center table-hover">
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
                                            اسم المورد
                                        @else
                                            Supplier Name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المبلغ المدفوع
                                        @else
                                            Paid Amount
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
                                            التاريخ
                                        @else
                                            Date
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الوقت
                                        @else
                                            Time
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
                                            Bank Check Number
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
                                @foreach ($bank_buy_cash as $key => $cash)
                                    <tr>
                                        <td>{{ $cash->cash_number }}</td>
                                        <td>{{ $cash->supplier->supplier_name }}</td>
                                        <td>
                                            {{floatval($cash->amount)}}
                                        </td>
                                        <td>{{ $cash->bill_id }}</td>
                                        <td>{{ $cash->date }}</td>
                                        <td>{{ $cash->time }}</td>
                                        <td>{{ $cash->bank->bank_name }}</td>
                                        <td>{{ $cash->bank_check_number }}</td>
                                        <td>{{ $cash->notes }}</td>
                                        <td>{{ $cash->client->name }}</td>
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
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>
