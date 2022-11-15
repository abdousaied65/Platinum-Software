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
                                تقرير ما تم دفعه الى الموردين
                            @else
                                Report what has been paid to suppliers
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report12.post')}}" class="no-print" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-3 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    اسم المورد
                                @else
                                    supplier name
                                @endif
                            </label>
                            <select required name="supplier_id" id="supplier_id" class="selectpicker"
                                    data-style="btn-info" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                @endif
                            >
                                <option
                                    @if(isset($supplier_id) && $supplier_id == "all")
                                    selected
                                    @endif
                                    value="all">
                                    @if(App::getLocale() == 'ar')
                                        كل الموردين
                                    @else
                                        all suppliers
                                    @endif
                                </option>
                                @foreach($suppliers as $supplier)
                                    <option
                                        @if(isset($supplier_id) && $supplier->id == $supplier_id)
                                        selected
                                        @endif
                                        value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
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
                    @if(isset($buy_cashs) && !empty($buy_cashs))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير ما تم دفعه الى الموردين
                            @else
                                Report what has been paid to suppliers
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
                                    $i=0; $totalCashs = 0;
                                @endphp
                                @foreach ($buy_cashs as $key => $cash)
                                    <tr>
                                        <td>{{ $cash->cash_number }}</td>
                                        <td>{{ $cash->supplier->supplier_name }}</td>
                                        <td>{{floatval( $cash->amount  )}}</td>
                                        <td>{{ $cash->bill_id }}</td>
                                        <td>{{ $cash->date }}</td>
                                        <td>{{ $cash->time }}</td>
                                        <td>{{ $cash->safe->safe_name }}</td>
                                        <td class="no-print">{{ $cash->client->name }}</td>
                                    </tr>
                                    <?php $totalCashs = $totalCashs + floatval($cash->amount); ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <span class=" col-lg-4 col-sm-12 alert alert-secondary alert-sm mr-5">
                                @if(App::getLocale() == 'ar')
                                    اجمالى  ما تم تحصيله
                                @else
                                    Total Collected :
                                @endif
                                ( {{floatval( $totalCashs  )}} )
                            </span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="mt-3 no-print">
                            <button type="button" onclick="window.print()" class="btn btn-md btn-info pull-right">
                                <i class="fa fa-print"></i>

                                @if(App::getLocale() == 'ar')
                                    طباعة التقرير
                                @else
                                    print report
                                @endif

                            </button>
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
