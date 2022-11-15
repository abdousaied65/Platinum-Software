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
    <div class="row">
        <div class="col-12">
            <p class="alert alert-info alert-sm text-center">
                @if(App::getLocale() == 'ar')
                    اعدادات ظهور الشاشات
                @else
                    Screens Display Settings
                @endif
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <form action="{{route('screens.settings.update')}}" method="POST">
                        @csrf
                        @method("PATCH")
                        <input type="hidden" name="screen_id" value="{{$screen->id}}"/>
                        <div class="col-lg-4 pull-right">
                            <div class="form-group">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        اسم الفرع
                                    @else
                                        Branch Name
                                    @endif
                                </label>
                                <select disabled name="branch_id" required class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر الفرع
                                        @else
                                            Choose Branch
                                        @endif
                                    </option>
                                    @foreach($branches as $branch)
                                        <option
                                            @if($screen->branch_id == $branch->id)
                                            selected
                                            @endif
                                            value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <div class="form-group">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        اختر الشاشات
                                    @else
                                        Choose Screens
                                    @endif
                                </label>
                                <select name="screens[]" required
                                        class="form-control selectpicker show-tick"
                                        data-style="btn-danger" multiple data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                    @endif>
                                    <option @if($screen->products == "1") selected @endif value="products">
                                        @if(App::getLocale() == 'ar')
                                            شاشة المنتجات
                                        @else
                                            Products
                                        @endif
                                    </option>
                                    <option @if($screen->debt == "1") selected @endif value="debt">
                                        @if(App::getLocale() == 'ar')
                                            شاشة الديون
                                        @else
                                            Debts (Clients - Suppliers)
                                        @endif
                                    </option>
                                    <option @if($screen->banks_safes == "1") selected @endif value="banks_safes">
                                        @if(App::getLocale() == 'ar')
                                            شاشة البنوك والخزن
                                        @else
                                            Banks - Safes
                                        @endif
                                    </option>
                                    <option @if($screen->sales == "1") selected @endif value="sales">
                                        @if(App::getLocale() == 'ar')
                                            شاشة المبيعات
                                        @else
                                            Sales
                                        @endif
                                    </option>
                                    <option @if($screen->purchases == "1") selected @endif value="purchases">
                                        @if(App::getLocale() == 'ar')
                                            شاشة المشتريات
                                        @else
                                            Purchases
                                        @endif
                                    </option>
                                    <option @if($screen->finance == "1") selected @endif value="finance">
                                        @if(App::getLocale() == 'ar')
                                            شاشة الماليات
                                        @else
                                            Finance
                                        @endif
                                    </option>
                                    <option @if($screen->marketing == "1") selected @endif value="marketing">
                                        @if(App::getLocale() == 'ar')
                                            شاشة التسويق
                                        @else
                                            Marketing
                                        @endif
                                    </option>
                                    <option @if($screen->accounting == "1") selected @endif value="accounting">
                                        @if(App::getLocale() == 'ar')
                                            شاشة دفتر اليومية
                                        @else
                                            Daily Journal Report
                                        @endif
                                    </option>
                                    <option @if($screen->reports == "1") selected @endif value="reports">
                                        @if(App::getLocale() == 'ar')
                                            شاشة التقارير
                                        @else
                                            Reports
                                        @endif
                                    </option>
                                    <option @if($screen->settings == "1") selected @endif value="settings">
                                        @if(App::getLocale() == 'ar')
                                            شاشة الضبط والاعدادات
                                        @else
                                            Settings
                                        @endif
                                    </option>
                                    <option @if($screen->maintenance == "1") selected @endif value="maintenance">
                                        @if(App::getLocale() == 'ar')
                                            شاشة الصيانة
                                        @else
                                            Maintenance
                                        @endif
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-md btn-success"
                                    style="font-size: 15px; margin-top: 25px;" type="submit">
                                <i class="fa fa-check"></i>
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
