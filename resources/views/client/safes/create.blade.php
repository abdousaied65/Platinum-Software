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

    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اضافة خزينة جديد
                            @else
                                Add New Safe
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.safes.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم الخزينة
                                    @else
                                        Safe Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="safe_name" type="text">
                            </div>

                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        يوجد بداخل فرع
                                    @else
                                        in Branch
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select style="width: 80%;display: inline;" required name="branch_id"
                                        class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر فرع
                                        @else
                                            Choose Branch
                                        @endif
                                    </option>
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.branches.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        رصيد الخزنة
                                    @else
                                        Safe Blanace
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="ltr" required class="form-control" name="balance" type="text">
                            </div>

                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        نوع الخزنة
                                    @else
                                        Safe Type
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="type" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر نوع الخزنة
                                        @else
                                            Choose Safe Type
                                        @endif
                                    </option>
                                    <option value="main">
                                        @if(App::getLocale() == 'ar')
                                            رئيسية
                                        @else
                                            Main
                                        @endif
                                    </option>
                                    <option value="secondary">
                                        @if(App::getLocale() == 'ar')
                                            فرعية
                                        @else
                                            secondary
                                        @endif
                                    </option>
                                    <option value="cashier">
                                        @if(App::getLocale() == 'ar')
                                            درج كاشير
                                        @else
                                            Cashier
                                        @endif
                                    </option>
                                </select>
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
