@extends('client.layouts.app-main')
<style>

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
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12 no-print">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-warning">
                            @if(App::getLocale() == 'ar')
                                كشف حساب المورد
                            @else
                                Supplier Summary
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix no-print"></div>
                    <hr class="no-print">
                    <form class="parsley-style-1 no-print" id="selectForm2" name="selectForm2"
                          action="{{route('suppliers.summary.post')}}" enctype="multipart/form-data"
                          method="get">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        اختر المورد
                                    @else
                                        Choose Supplier
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="supplier_id" id="supplier_id" class="selectpicker"
                                        data-style="btn-info" data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                    @endif

                                >
                                    @foreach($suppliers as $supplier)
                                        <option
                                            @if(isset($supplier_k) && $supplier_k->id == $supplier->id)
                                            selected
                                            @endif
                                            value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        من تاريخ
                                    @else
                                        From Date
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input type="date"
                                       @if(isset($from_date) && !empty($from_date))
                                       value="{{$from_date}}"
                                       @endif
                                       class="form-control" name="from_date"/>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        الى تاريخ
                                    @else
                                        To Date
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input
                                    @if(isset($to_date) && !empty($to_date))
                                    value="{{$to_date}}"
                                    @endif
                                    type="date" class="form-control" name="to_date"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-danger pd-x-20" name="submit" value="all" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    عرض كشف الحساب
                                @else
                                    Show Summary
                                @endif
                            </button>
                            <button class="btn btn-dark pd-x-20" name="submit" value="today" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    كشف حساب اليوم
                                @else
                                    Supplier Summary - Today
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
