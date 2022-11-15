@extends('client.layouts.app-main')
<style>
    .nav-link {
        border-radius: 5px !important;
        margin: 2px;
    }

    .active {
        background: #4e4ed5;
        color: #fff;

    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <p class="alert alert-danger alert-sm text-center">
                @if(App::getLocale() == 'ar')
                    الاعدادات العامة للنظام
                @else
                    System General Settings
                @endif
            </p>
        </div>

        <a class="nav-link active" style="border:1px solid #bbb" href="{{route('client.basic.settings.edit')}}">
            <i class="fa fa-home"></i>
            @if(App::getLocale() == 'ar')
                البيانات الاساسية للنظام
            @else
                System Basic Settings
            @endif
        </a>

        <a class="nav-link" style="border:1px solid #bbb" href="{{route('client.extra.settings.edit')}}">
            <i class="fa fa-money"></i>
            @if(App::getLocale() == 'ar')
                البيانات الاضافية للنظام
            @else
                System Extra Settings
            @endif
        </a>

        <a class="nav-link " style="border:1px solid #bbb" href="{{route('client.backup.settings.edit')}}">
            <i class="fa fa-copy"></i>
            @if(App::getLocale() == 'ar')
                اعدادات النسخة الاحتياطية
            @else
                Backup - Restore Settings
            @endif
        </a>

        <a class="nav-link " style="border:1px solid #bbb" href="{{route('client.billing.settings.edit')}}">
            <i class="fa fa-envelope"></i>
            @if(App::getLocale() == 'ar')
                بيانات الفواتير والضرائب
            @else
                Billing & Taxes Details
            @endif
        </a>
        <div class="col-12  mt-3">
            <form action="{{route('client.basic.settings.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="company_id" value="{{$company->id}}"/>
                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="brand_name">
                            @if(App::getLocale() == 'ar')
                                اسم الشركة
                            @else
                                Company Name
                            @endif
                        </label>
                        <input type="text" class="form-control" name="company_name"
                               value="{{$company->company_name}}"
                               id="brand_name"/>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="person_name">
                            @if(App::getLocale() == 'ar')
                                اسم صاحب الشركة
                            @else
                                Company owner name
                            @endif
                        </label>
                        <input type="text" class="form-control" name="company_owner"
                               value="{{$company->company_owner}}"
                               id="person_name"/>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="person_name">
                            @if(App::getLocale() == 'ar')
                                مجال او نشاط الشركة
                            @else
                                Company Field
                            @endif
                        </label>
                        <input type="text" class="form-control" name="business_field"
                               value="{{$company->business_field}}"
                               id="person_name"/>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="location">
                            @if(App::getLocale() == 'ar')
                                عنوان الشركة
                            @else
                                Company Address
                            @endif
                        </label>
                        <input type="text" class="form-control" name="company_address"
                               value="{{$company->company_address}}"
                               id="location"/>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="phone_1">
                            @if(App::getLocale() == 'ar')
                                رقم تليفون
                            @else
                                Phone Number
                            @endif
                        </label>
                        <input type="text" value="{{$company->phone_number}}" dir="ltr" class="form-control"
                               name="phone_number" id="phone_1"/>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="fileToUpload30">
                            @if(App::getLocale() == 'ar')
                                لوجو الشركة
                            @else
                                Company Logo
                            @endif
                        </label>
                        <input accept=".jpg,.png,.jpeg" oninput="pic.src=window.URL.createObjectURL(this.files[0])"
                               type="file" class="form-control" name="company_logo"/>
                        <label for="" class="d-block">
                            @if(App::getLocale() == 'ar')
                                معاينة الصورة
                            @else
                                Picture Preview
                            @endif
                        </label>
                        <img id="pic" src="{{asset($company->company_logo)}}"
                             style="width: 100px; height:100px;"/>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="fileToUpload40">
                            @if(App::getLocale() == 'ar')
                                هيدر الفواتير
                            @else
                                Bills Header
                            @endif
                        </label>
                        <input accept=".jpg,.png,.jpeg" oninput="pic2.src=window.URL.createObjectURL(this.files[0])"
                               type="file" class="form-control" name="header"/>
                        <label for="" class="d-block">
                            @if(App::getLocale() == 'ar')
                                معاينة الصورة
                            @else
                                Picture Preview
                            @endif
                        </label>
                        <img id="pic2" src="{{asset($company->basic_settings->header)}}"
                             style="width: 100%; height:100px;"/>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="fileToUpload50">
                            @if(App::getLocale() == 'ar')
                                فوتر الفواتير
                            @else
                                Bills Footer
                            @endif
                        </label>
                        <input accept=".jpg,.png,.jpeg" oninput="pic3.src=window.URL.createObjectURL(this.files[0])"
                               type="file" class="form-control" name="footer"/>
                        <label for="" class="d-block">
                            @if(App::getLocale() == 'ar')
                                معاينة الصورة
                            @else
                                Picture Preview
                            @endif
                        </label>
                        <img id="pic3" src="{{asset($company->basic_settings->footer)}}"
                             style="width: 100%; height:100px;"/>
                    </div>
                </div>

                <div class="col-lg-4 col-xs-12 pull-right">
                    <div class="form-group">
                        <label for="fileToUpload60">
                            @if(App::getLocale() == 'ar')
                                الختم الالكترونى
                            @else
                                Electronic Stamp
                            @endif
                        </label>
                        <input accept=".jpg,.png,.jpeg" oninput="pic4.src=window.URL.createObjectURL(this.files[0])"
                               type="file" class="form-control" name="electronic_stamp"/>
                        <label for="" class="d-block">
                            @if(App::getLocale() == 'ar')
                                معاينة الصورة
                            @else
                                Picture Preview
                            @endif
                        </label>
                        <img id="pic4" src="{{asset($company->basic_settings->electronic_stamp)}}"
                             style="width: 100px; height:100px;"/>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="col-lg-12 col-xs-12 pull-right">
                    <div class="form-group">
                        <button class="btn btn-md btn-success"><i
                                class="fa fa-check"></i>
                            @if(App::getLocale() == 'ar')
                                حفظ
                            @else
                                Save
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
