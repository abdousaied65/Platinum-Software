@extends('client.layouts.app-main')
<style>
    .btn.dropdown-toggle.bs-placeholder {
        height: 40px;
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
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اضافة مورد جديد
                            @else
                                Add New Supplier
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.suppliers.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="col-lg-6 col-xs-12 pull-right">

                            <div class="form-group  col-lg-12  pull-right" dir="rtl">
                                <label for="order">
                                    @if(App::getLocale() == 'ar')
                                        اسم المورد
                                    @else
                                        Supplier Name
                                    @endif
                                </label>
                                <input type="text" name="supplier_name" class="form-control" required>
                            </div>

                            <div class="form-group pull-right col-lg-12" dir="ltr">
                                <label style="display: block" for="note">
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات المورد
                                    @else
                                        Supplier Notes
                                    @endif
                                </label>
                                <input type="text" name="notes[]" class="form-control"
                                       style="width:90%; display: inline; float: right;" dir="rtl">
                                <button type="button" id="add_note" class="btn btn-md btn-info"
                                        style="width:7%;height: 35px;display: inline; float: left;padding: 5px;">
                                    <i class="fa fa-plus" style="font-size: 17px; font-weight: bold;"></i>
                                </button>
                                <div class="clearfix"></div>
                                <div class="dom2"></div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-xs-12  pull-left">

                            <div class="form-group  pull-right col-lg-6" dir="rtl">
                                <label for="prev_balance">
                                    @if(App::getLocale() == 'ar')
                                        مستحقات المورد
                                    @else
                                        Supplier Dues
                                    @endif
                                </label>
                                <input style="margin-right:5px;margin-left:5px;" checked type="radio" value="for"
                                       name="balance"/>
                                @if(App::getLocale() == 'ar')
                                    له
                                @else
                                    Creditor
                                @endif
                                <input style="margin-right:5px;margin-left:5px;" type="radio" value="on"
                                       name="balance"/>
                                @if(App::getLocale() == 'ar')
                                    عليه
                                @else
                                    Debtor
                                @endif
                                <input type="text" required value="0" name="prev_balance" class="form-control"
                                       dir="ltr"/>
                            </div>
                            <div class="form-group pull-right col-lg-6" dir="ltr">
                                <label style="display: block" for="phone">
                                    @if(App::getLocale() == 'ar')
                                        رقم الهاتف بمفتاح الدولة
                                    @else
                                        Phone Number with country key
                                    @endif
                                </label>
                                <input type="text" name="phones[]" class="form-control"
                                       style="width:80%; display: inline; float: right;" dir="ltr">
                                <button type="button" id="add_phone" class="btn btn-md btn-success"
                                        style="width:15%;height: 30px;display: inline; float: left;padding: 5px;">
                                    <i class="fa fa-plus" style="font-size: 17px; font-weight: bold;"></i>
                                </button>
                                <div class="clearfix"></div>
                                <div class="dom1"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group pull-right col-lg-12" dir="ltr">
                                <label style="display: block" for="address">
                                    @if(App::getLocale() == 'ar')
                                        عنوان المورد
                                    @else
                                        Supplier Address
                                    @endif
                                </label>
                                <input type="text" name="addresses[]" class="form-control"
                                       style="width:90%; display: inline; float: right;" dir="rtl">
                                <button type="button" id="add_address" class="btn btn-md btn-success"
                                        style="width:7%;height: 30px;display: inline; float: left;padding: 5px;">
                                    <i class="fa fa-plus" style="font-size: 17px; font-weight: bold;"></i>
                                </button>
                                <div class="clearfix"></div>
                                <div class="dom3"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <a href="javascript:;" class="btn btn-link open_extras">
                            <i class="fa fa-plus"></i>
                            @if(App::getLocale() == 'ar')
                                خيارات اضافية
                            @else
                                extra options
                            @endif
                        </a>
                        <div class="clearfix"></div>
                        <div class="extras" style="display: none">
                            <div class="col-lg-12">
                                <div class="form-group  col-lg-4  pull-right" dir="rtl">
                                    <label for="supplier_category">
                                        @if(App::getLocale() == 'ar')
                                            فئة التعامل
                                        @else
                                            Client Category
                                        @endif
                                    </label>
                                    <select name="supplier_category" class="form-control" required>
                                        <option value="">
                                            @if(App::getLocale() == 'ar')
                                                اختر الفئة
                                            @else
                                                Choose category
                                            @endif
                                        </option>
                                        <option selected value="جملة">
                                            @if(App::getLocale() == 'ar')
                                                جملة
                                            @else
                                                wholesale
                                            @endif
                                        </option>
                                        <option value="قطاعى">
                                            @if(App::getLocale() == 'ar')
                                                قطاعى
                                            @else
                                                Sector
                                            @endif
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4  pull-right" dir="rtl">
                                    <label for="supplier_email">
                                        @if(App::getLocale() == 'ar')
                                            البريد الالكترونى
                                        @else
                                            Email
                                        @endif
                                    </label>
                                    <input type="email" name="supplier_email" dir="ltr"
                                           class="form-control">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group  pull-right col-lg-4" dir="rtl">
                                    <label for="shop_name">
                                        @if(App::getLocale() == 'ar')
                                            اسم محل / شركة المورد
                                        @else
                                            Shop Name
                                        @endif
                                    </label>
                                    <input type="text" name="shop_name"
                                           class="form-control" dir="rtl">
                                </div>
                                <div class="form-group  pull-right col-lg-4" dir="rtl">
                                    <label for="supplier_national">
                                        @if(App::getLocale() == 'ar')
                                            جنسية المورد
                                        @else
                                            Nationality
                                        @endif
                                    </label>
                                    <select name="supplier_national" class="form-control">
                                        <option value="">
                                            @if(App::getLocale() == 'ar')
                                                اختر دولة
                                            @else
                                                Choose Country
                                            @endif
                                        </option>
                                        @foreach($timezones as $timezone)
                                            <option
                                                @if($timezone->name_ar == "السعودية")
                                                selected
                                                @endif
                                                value="{{$timezone->name_ar}}">
                                                @if(App::getLocale() == 'ar')
                                                    {{$timezone->name_ar}}
                                                @else
                                                    {{$timezone->name_en}}
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group  pull-right col-lg-4" dir="rtl">
                                    <label for="tax_number">
                                        @if(App::getLocale() == 'ar')
                                            الرقم الضريبى
                                        @else
                                            Tax Number
                                        @endif
                                    </label>
                                    <input type="text" name="tax_number"
                                           class="form-control" dir="ltr"/>
                                </div>
                                <div class="clearfix"></div>

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
    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#add_phone').on("click", function () {
            $('<div><input autofocus type="text" name="phones[]" class="form-control" dir="ltr" style="margin:10px 0; display:inline;float:right;width:80%"  />' +
                '<button type="button" class="btn btn-danger btn-sm delete_phone" style="width:15%;height: 30px;display: inline; float: left;padding: 5px; margin-top: 10px"><i style="font-size: 18px;" class="fa fa-trash"></i></button>' +
                '<div class="clearfix"></div></div>').insertBefore('.dom1');
            $('.delete_phone').on('click', function () {
                $(this).parent().remove();
            });
        });
        $('#add_address').on("click", function () {
            $('<div><input autofocus type="text" name="addresses[]" class="form-control" dir="rtl" style="margin:10px 0; display:inline;float:right;width:90%"  />' +
                '<button type="button" class="btn btn-danger btn-sm delete_address" style="width:7%;height: 30px;display: inline; float: left;padding: 5px; margin-top: 10px"><i style="font-size: 18px;" class="fa fa-trash"></i></button>' +
                '<div class="clearfix"></div></div>').insertBefore('.dom3');
            $('.delete_address').on('click', function () {
                $(this).parent().remove();
            });
        });
        $('#add_note').on("click", function () {
            $('<div><input autofocus type="text" name="notes[]" class="form-control" dir="rtl" style="margin:10px 0; display:inline;float:right;width:90%"  />' +
                '<button type="button" class="btn btn-danger btn-sm delete_note" style="width:7%;height: 35px;display: inline; float: left;padding: 5px; margin-top: 10px"><i style="font-size: 18px;" class="fa fa-trash"></i></button>' +
                '<div class="clearfix"></div></div>').insertBefore('.dom2');
            $('.delete_note').on('click', function () {
                $(this).parent().remove();
            });
        });
        $('.open_extras').on('click', function () {
            $('.extras').fadeIn(300);
            $(this).fadeOut(300);
        });
    </script>
@endsection
