@extends('site.layouts.app-main')
<style>
    span.text-danger {
        font-size: 20px;
        font-weight: bold;
    }

    select.form-control {
        padding: 0;
    }

    .form-control {
        height: 50px !important;
    }
</style>
@section('content')
    <!-- ==========Banner-Section========== -->
    <section class="banner-section" style="padding-top:140px!important; ">
        <div class="banner-bg bg_img bg-fixed" data-background="{{asset('assets/images/banner/banner01.jpg')}}"></div>
        <div class="container">
            <div class="banner-content">

                <h1 class="text-center mb-5">
                    @if(App::getLocale() == 'ar')
                        انشاء شركة جديدة
                    @else
                        Create a New Company
                    @endif
                </h1>
                <form action="{{route('company.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-3 col-xs-12 pull-right text-right">
                        <div class="form-group">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    اسم الشركة
                                @else
                                    Company Name
                                @endif
                                <span class="text-danger pull-left">*</span>
                            </label>
                            <input value="{{old('company_name')}}" required type="text" class="form-control text-right"
                                   dir="rtl" name="company_name"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 pull-right text-right">
                        <div class="form-group">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    هاتف الشركة
                                @else
                                    Company Phone Number
                                @endif
                            </label>
                            <input value="{{old('phone_number')}}" type="text" class="form-control text-left" dir="ltr"
                                   name="phone_number"/>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 pull-right text-right">
                        <div class="form-group">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    الدولة
                                @else
                                    Country
                                @endif
                            </label>
                            <select name="country" class="form-control selectpicker show-tick"
                                    data-live-search="true" data-style="btn-info"
                                    title="@if(App::getLocale() == 'ar')
                                        اختر الدولة
                                    @else
                                        Choose country
                                    @endif" id="">
                                @foreach($timezones as $timezone)
                                    <option
                                        @if($timezone->timezone == "Asia/Riyadh") selected @endif
                                    value="{{$timezone->timezone}}">
                                        @if(App::getLocale() == 'ar')
                                            {{$timezone->name_ar}}
                                        @else
                                            {{$timezone->name_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xs-12 pull-right text-right">
                        <div class="form-group">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    العملة
                                @else
                                    Currency
                                @endif
                            </label>
                            <select name="currency" class="form-control selectpicker show-tick"
                                    data-live-search="true" data-style="btn-danger"
                                    title="@if(App::getLocale() == 'ar')
                                        اختر العملة
                                    @else
                                        Choose Currency
                                    @endif" id="">
                                @foreach($currencies as $currency)
                                    <option
                                        @if($currency->currency == "ريال سعودى") selected @endif
                                    value="{{$currency->currency}}">{{__('main.'.$currency->currency)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-xs-12 text-center justify-content-center text-center mt-3">
                        <button type="submit" dir="rtl" class="col-lg-4 btn btn-md btn-outline-danger"
                                style="color: #fff !important;">
                            <i class="fa fa-check" style="color: #fff !important;"></i>
                            @if(App::getLocale() == 'ar')
                                انشاء الشركة الان
                            @else
                                Create Now
                            @endif
                        </button>
                        <div class="form-group checkgroup text-center mt-3" dir="rtl">
                            <a href="{{ route('client.login') }}" class="forget-pass text-white">
                                @if(App::getLocale() == 'ar')
                                    تسجيل الدخول بدلا من ذلك
                                @else
                                    Login instead !
                                @endif
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
