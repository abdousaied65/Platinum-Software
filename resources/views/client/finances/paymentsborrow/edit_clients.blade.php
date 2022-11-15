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
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اعطاء سلفة الى عميل
                            @else
                                Give Money To Client
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.update.borrow.clients',$cash->id)}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        رقم العملية
                                    @else
                                        Process Number
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required readonly value="{{$cash->cash_number}}" class="form-control"
                                       name="cash_number" type="text">
                            </div>
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم العميل
                                    @else
                                        Client Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="outer_client_id" class="form-control selectpicker"
                                        data-style="btn-info" data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                    @endif
                                >
                                    @foreach($outer_clients as $outer_client)
                                        <option
                                            @if($cash->outerClient->id == $outer_client->id)
                                            selected
                                            @endif
                                            value="{{$outer_client->id}}">{{$outer_client->client_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        المبلغ المدفوع
                                    @else
                                        Paid Amount
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control" value="{{abs($cash->amount)}}"
                                       name="amount" type="text" dir="ltr">
                            </div>
                        </div>
                        <div class="row mb-3">

                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        التاريخ
                                    @else
                                        Date
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control"
                                       name="date" type="date" dir="ltr" value="{{$cash->date}}">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        الوقت
                                    @else
                                        Time
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control"
                                       name="time" type="time" dir="ltr" value="{{$cash->time}}">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        خزنة الدفع
                                    @else
                                        Payment Safe
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="safe_id" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر خزنة الدفع
                                        @else
                                            Choose Payment Safe
                                        @endif
                                    </option>
                                    @foreach($safes as $safe)
                                        <option
                                            @if($cash->safe->id == $safe->id)
                                            selected
                                            @endif
                                            value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        Notes
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control"
                                       name="notes" type="text" dir="rtl" value="{{$cash->notes}}">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" type="submit">
                                @if(App::getLocale() == 'ar')
                                    تحديث
                                @else
                                    Update
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
