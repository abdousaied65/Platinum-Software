@extends('client.layouts.app-main')
<style>
    .box {
        width: 100%;
        height: auto;
        border: 1px solid #aaa;
        box-shadow: 0px 0px 8px #888;
        background: rgba(255, 255, 255, 1);
        color: #000;
        border-radius: 10px;
    }

    .box h3 {
        font-size: 18px !important;
    }

    .active {
        background: #000 !important;
        color: #fff;
    }
</style>
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissable text-center fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissable text-center fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    <div class="row">
        <div class="w-100 alert text-center alert-sm alert-danger">
            @if(App::getLocale() == 'ar')
                الباقات المتاحة للاشتراك
            @else
                Available Packages To Subscribe
            @endif
        </div>

        <div class="col-lg-12">

            @foreach($packages as $package)
                <div class="col-lg-4 pull-right">
                    <div class="box m-1 p-1">
                        <h3 class="alert alert-warning alert-sm text-center">
                            {{$package->package_name}}
                        </h3>
                        <ul>
                            <li>
                                @if(App::getLocale() == 'ar')
                                    عدد المستخدمين :
                                @else
                                    Users Count
                                @endif
                                {{$package->users_count}}
                            </li>
                            <li>
                                @if(App::getLocale() == 'ar')
                                    عدد الموظفين :
                                @else
                                    Employees Count
                                @endif
                                {{$package->employees_count}}
                            </li>
                            <li>
                                @if(App::getLocale() == 'ar')
                                    عدد العملاء :
                                @else
                                    Clients Count
                                @endif
                                {{$package->outer_clients_count}}
                            </li>
                            <li>
                                @if(App::getLocale() == 'ar')
                                    عدد الموردين :
                                @else
                                    Suppliers Count
                                @endif
                                {{$package->suppliers_count}}
                            </li>
                            <li>
                                @if(App::getLocale() == 'ar')
                                    عدد الفواتير :
                                @else
                                    Invoices Count
                                @endif
                                {{$package->bills_count}}
                            </li>
                            <li>
                                @if($package->products == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة المنتجات
                                @else
                                    Products Screen
                                @endif
                            </li>
                            <li>
                                @if($package->debt == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة الديون
                                @else
                                    Debts Screen
                                @endif
                            </li>
                            <li>
                                @if($package->banks_safes == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة البنوك والخزن
                                @else
                                    Banks And Safes Screen
                                @endif
                            </li>
                            <li>
                                @if($package->sales == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة المبيعات
                                @else
                                    Sales Screen
                                @endif
                            </li>
                            <li>
                                @if($package->purchases == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة المشتريات
                                @else
                                    Purchases Screen
                                @endif
                            </li>
                            <li>
                                @if($package->finance == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة الماليات
                                @else
                                    Financial Issues Screen
                                @endif
                            </li>
                            <li>
                                @if($package->marketing == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة التسويق
                                @else
                                    Marketing Screen
                                @endif
                            </li>
                            <li>
                                @if($package->accounting == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة دفتر اليومية
                                @else
                                    Daily Journal Screen
                                @endif
                            </li>
                            <li>
                                @if($package->reports == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة التقارير
                                @else
                                    Reports Screen
                                @endif
                            </li>
                            <li>
                                @if($package->settings == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة الضبط
                                @else
                                    Settings Screen
                                @endif
                            </li>
                            <li>
                                @if($package->maintenance == 1)
                                    <i class="fa fa-check text-success"></i>
                                @else
                                    <i class="fa fa-close text-danger"></i>
                                @endif
                                @if(App::getLocale() == 'ar')
                                    شاشة الصيانة
                                @else
                                    Maintenance Screen
                                @endif

                            </li>
                        </ul>
                        <a href="{{route('go.to.upgrade2',$package->id)}}" class="btn btn-md btn-danger btn-block">
                            <i class="fa fa-arrow-right"></i>
                            @if(App::getLocale() == 'ar')
                                اختيار الباقة
                            @else
                                Choose Package
                            @endif
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>
