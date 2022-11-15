@extends('client.layouts.app-main')
<style>
    .bootstrap-select, select.form-control {
        width: 80% !important;
        display: inline !important;
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
    @if (session('error'))
        <div class="alert alert-danger">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اضافة مصروف جديد
                            @else
                                Add New Expense
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.expenses.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        رقم المصروف
                                    @else
                                        Expense Number
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required readonly value="{{$pre_expenses}}" class="form-control"
                                       name="expense_number" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        نوع المصروف
                                    @else
                                        Expense Type
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="fixed_expense" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر المصروف الثابت
                                        @else
                                            Choose Fixed Expense
                                        @endif
                                    </option>
                                    @foreach($fixed_expenses as $fixed_expense)
                                        <option
                                            value="{{$fixed_expense->id}}">{{$fixed_expense->fixed_expense}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.fixed.expenses')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        تفاصيل المصروف
                                    @else
                                        Expense Details
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="expense_details" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        المبلغ
                                    @else
                                        Amount
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required class="form-control"
                                       name="amount" type="text">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        Notes
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input class="form-control"
                                       name="notes" id="notes" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        خزنة الدفع
                                    @else
                                        Payment Safe
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select name="safe_id" class="form-control">
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
                                        بنك الدفع
                                    @else
                                        Payment Bank
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select name="bank_id" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر بنك الدفع
                                        @else
                                            Choose Payment Bank
                                        @endif
                                    </option>
                                    @foreach($banks as $bank)
                                        <option
                                            value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.banks.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        الموظف
                                    @else
                                        Employee
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select name="employee_id"
                                        data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif

                                        data-style="btn-danger"
                                        class="form-control selectpicker show-tick">
                                    @foreach($employees as $employee)
                                        <option
                                            value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        صورة المصروف
                                    @else
                                        Expense Picture
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input accept=".jpg,.png,.jpeg" type="file"
                                       oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                       name="expense_pic" class="form-control">
                                <label for="" class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        معاينة الصورة
                                    @else
                                        Picture Preview
                                    @endif
                                </label>
                                <img id="pic" style="width: 100px; height:100px;"/>
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
