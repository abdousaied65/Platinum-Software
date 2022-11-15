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

    .form-control, .input-group-addon {
        padding: 10px !important;
        height: 40px !important;
        border: 1px solid #ddd;
        border-right: 0;
    }

    .input-group-addon {
        border-top-left-radius: 5px !important;
        border-bottom-left-radius: 5px !important;
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
    }

    .input-spec {
        border-right: 0;
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
        border-top-right-radius: 5px !important;
        border-bottom-right-radius: 5px !important;
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

        <a class="nav-link" style="border:1px solid #bbb" href="{{route('client.basic.settings.edit')}}">
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

        <a class="nav-link active" style="border:1px solid #bbb" href="{{route('client.backup.settings.edit')}}">
            <i class="fa fa-copy"></i>
            @if(App::getLocale() == 'ar')
                اعدادات النسخة الاحتياطية
            @else
                Backup - Restore Settings
            @endif
        </a>

        <a class="nav-link " style="border:1px solid #bbb"
           href="{{route('client.billing.settings.edit')}}">
            <i class="fa fa-envelope"></i>
            @if(App::getLocale() == 'ar')
                بيانات الفواتير والضرائب
            @else
                Billing & Taxes Details
            @endif
        </a>
        <div class="col-12 mt-3">
            <div class="row text-center">
                <div class="col-lg-12">
                    <div class="col-lg-6 col-xs-12 pull-right">
                        <div class="card">
                            <div class="card-body" style="border-radius: 0 !important;">
                                <h4 class="alert alert-sm alert-danger"
                                    style="padding: 10px 10px; margin:0 auto 10px;"><i
                                        class="fa fa-download"></i>
                                    @if(App::getLocale() == 'ar')
                                        تحميل النسخة الاحتياطية من قاعدة البيانات
                                    @else
                                        Download Backup
                                    @endif
                                </h4>
                                <a class="btn btn-danger btn-sm" href="{{route('client.get.backup')}}"><i
                                        class="fa fa-download"></i>
                                    @if(App::getLocale() == 'ar')
                                        اضغط هنا لتحميلها
                                    @else
                                        Click here to download
                                    @endif
                                </a> <br>
                                <div class="text-danger">
                                    @if(App::getLocale() == 'ar')
                                        تحذير : يجب جيدا الاحتفاظ بهذه النسخة وعدم العبث بها
                                    @else
                                        Note : you must keep this copy of your back up carefully !

                                    @endif
                                </div>
                                <div class="text-danger">
                                    @if(App::getLocale() == 'ar')
                                        تنوية : يجب المداومة على اخذ نسخة احتياطية من البيانات كل يوم
                                    @else
                                        Note: You must keep taking a backup copy of your data every day
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xs-12 pull-right">
                        <div class="card">
                            <div class="card-body" style="border-radius: 0 !important;">
                                <h4 class="alert alert-sm alert-success"
                                    style="padding: 10px 10px; margin:0 auto 10px;"><i
                                        class="fa fa-upload"></i>
                                    @if(App::getLocale() == 'ar')
                                        رفع النسخة الاحتياطية الى قاعدة البيانات
                                    @else
                                        Upload the backup to the database
                                    @endif
                                </h4>
                                <form method="POST" action="{{route('client.restore')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <input class="form-control" required type="file" name="sql_file"
                                           style="margin: 10px auto; width: 80%;  "/>
                                    <button type="submit" class="btn btn-success btn-sm" name="submit"><i
                                            class="fa fa-upload"></i>
                                        @if(App::getLocale() == 'ar')
                                            اضغط هنا لرفعها
                                        @else
                                            Click here to upload
                                        @endif
                                    </button>
                                    <br>
                                </form>
                                <div class="text-success">
                                    @if(App::getLocale() == 'ar')
                                        تحذير : بعد عملية الرفع لن تكون قادرا على العودة الى ما كنت عليه مؤخرا
                                    @else
                                        Warning: After the upload process, you will not be able to go back to the way
                                        you were last
                                    @endif
                                </div>
                                <div class="text-success">
                                    @if(App::getLocale() == 'ar')
                                        تنوية : سيتم تغيير كل البيانات بناءا على النسخة التى ستقوم برفعها
                                    @else
                                        Note: All data will be changed based on the version you upload
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
