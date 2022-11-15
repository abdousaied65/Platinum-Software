@extends('client.layouts.app-main')
<style>
    .form-control {
        height: 30px !important;
        border-radius: 0px !important;
    }

    .bootstrap-select {
        width: 150px !important;
    }

    .btn.dropdown-toggle.bs-placeholder.btn-dark {
        height: 30px !important;
        border-radius: 0px !important;
        padding: 5px 10px !important;
    }

    * {
        font-size: 12px !important;
    }

    label {
        font-size: 12px !important;
    }

    h1, h2, h3, h4, h5, h6, p, div, span {
        font-size: 12px !important;
    }

    .btn-main {
        margin: 5px auto;
        text-shadow: 0px 0px 7px #000;
        width: 80% !important;
        height: 80px !important;
        font-size: 13px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }

    .input-group-addon {
        border-radius: 0px 5px 5px 0px;
        border: 1px solid #444;
        border-left: 0;
        font-size: 17px !important;
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
                        <h2 style="min-width: 300px;font-size: 17px!important;"
                            class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                استلام جهاز صيانة
                            @else
                                Receive Maintenance Device
                            @endif
                        </h2>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <form action="{{route('post.maintenance.device')}}" enctype="multipart/form-data" method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-2">
                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        رقم الايصال
                                    @else
                                        Receipt Number
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="ltr" value="{{$receipt_number}}" required readonly class="form-control"
                                       name="receipt_number" type="number">
                            </div>
                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        تاريخ الاستلام
                                    @else
                                        Received Date
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="ltr" value="{{date('Y-m-d')}}" required class="form-control"
                                       name="received_date" type="date">
                            </div>
                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        المخزن - الفرع
                                    @else
                                        Store - Branch
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="store_id" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر المخزن
                                        @else
                                            Choose Store
                                        @endif
                                    </option>
                                    @foreach($stores as $store)
                                        <option value="{{$store->id}}">{{$store->store_name}}
                                            - {{$store->branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم العميل
                                    @else
                                        Client Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="device_owner_name" type="text">
                            </div>

                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        هاتف العميل
                                    @else
                                        Client Phone
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="ltr" required class="form-control" name="device_owner_phone" type="number">
                            </div>

                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        عنوان العميل
                                    @else
                                        Client Address
                                    @endif
                                </label>
                                <input dir="rtl" class="form-control" name="device_owner_address" type="text">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم الجهاز
                                    @else
                                        Device Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="device_name" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        نوع الجهاز
                                    @else
                                        Device Type
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select name="device_type" id="device_type" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر نوع الجهاز
                                        @else
                                            Choose Device Type
                                        @endif
                                    </option>
                                    @foreach($devices_types as $device_type)
                                        <option value="{{$device_type->id}}">{{$device_type->device_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        سيريال الجهاز
                                    @else
                                        Device Serial
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="ltr" required class="form-control" name="device_serial" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        مشكلة الجهاز
                                    @else
                                        Device Issue
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select name="device_issue" id="device_issue" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر مشكلة الجهاز
                                        @else
                                            Choose Device Issue
                                        @endif
                                        </option>
                                    @foreach($devices_issues as $device_issue)
                                        <option value="{{$device_issue->id}}">{{$device_issue->issue}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        التاريخ المتوقع للتسليم
                                    @else
                                        Expected Delivery Date
                                    @endif
                                     <span class="text-danger">*</span></label>
                                <input dir="ltr" required class="form-control" name="expected_delivery_date"
                                       type="date" value="{{date('Y-m-d',strtotime('+4 days'))}}">
                            </div>
                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        التكلفة التقريبية
                                    @else
                                        approximate cost
                                    @endif
                                     <span class="text-danger">*</span></label>
                                <input dir="ltr" required class="form-control"
                                       name="approximate_cost" value="0" type="number">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        Notes
                                    @endif
                                </label>
                                <input dir="rtl" class="form-control" name="notes" type="text">
                            </div>
                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        الضمان
                                    @else
                                        warranty
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="warranty" class="form-control">
                                    <option selected value="1">نعم
                                        @if(App::getLocale() == 'ar')
                                            نعم
                                        @else
                                            Yes
                                        @endif
                                    </option>
                                    <option value="0">
                                        @if(App::getLocale() == 'ar')
                                            لا
                                        @else
                                            No
                                        @endif
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        فترة الضمان باليوم
                                    @else
                                        warranty Period in Days
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required name="warranty_period" value="0" type="number" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        شكوى العميل
                                    @else
                                        Client Complain
                                    @endif
                                </label>
                                <textarea
                                    style="resize: none; width: 100%; height: 100px!important; border-radius: 5px;"
                                    name="owner_complain" class="form-control"></textarea>
                            </div>
                            <div class="col-md-3">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        صورة الجهاز
                                    @else
                                        Device Picture
                                    @endif
                                     </label>
                                <input accept=".jpg,.png,.jpeg" type="file"
                                       oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                       name="device_pic" class="form-control"> <br>
                            </div>
                            <div class="col-md-3">
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
                            <button class="btn btn-info btn-md pd-x-20" type="submit">
                                <i class="fa fa-save"></i>
                                @if(App::getLocale() == 'ar')
                                    حفظ
                                @else
                                    Save
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
