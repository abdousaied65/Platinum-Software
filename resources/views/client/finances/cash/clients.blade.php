@extends('client.layouts.app-main')
<style>
    .bootstrap-select, select.form-control {
        width: 80% !important;
        /*display: inline !important;*/
    }
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
                                استلام نقدية من عميل
                            @else
                                Take Money From Client
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.store.cash.clients','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
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
                                <input required readonly value="{{$pre_cash}}" class="form-control"
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
                                            value="{{$outer_client->id}}">{{$outer_client->client_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.outer_clients.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>

                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        المبلغ المدفوع
                                    @else
                                        Paid Amount
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control"
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
                                       name="date" type="date" dir="ltr" value="{{date('Y-m-d')}}">
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
                                       name="time" type="time" dir="ltr" value="{{date('H:i:s')}}">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        خزنة الدفع
                                    @else
                                        Payment Safe
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required style="display: inline !important;" name="safe_id"
                                        class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر خزنة الدفع
                                        @else
                                            Choose Payment Safe
                                        @endif
                                    </option>
                                    @foreach($safes as $safe)
                                        <option
                                            value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.safes.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        Notes
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input class="form-control"
                                       name="notes" type="text" dir="rtl"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" type="submit">
                                @if(App::getLocale() == 'ar')
                                    اضافة
                                @else
                                    Add
                                @endif
                            </button>
                        </div>
                    </form>
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
