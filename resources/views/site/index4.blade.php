@extends('site.layouts.app-main')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@section('content')
    <!-- ==========Banner-Section========== -->
    <section class="banner-section" style="padding-top: 120px!important;">
        <div class="banner-bg bg_img bg-fixed" data-background="{{asset('assets/images/banner/banner01.jpg')}}"></div>
        <div class="container">
            <div class="banner-content">
                @if (session('error'))
                    <div class="alert alert-danger fade show">
                        {{ session('error') }}
                    </div>
                @endif

                <h1 class="text-center mb-5">
                    @if(App::getLocale() == 'ar')
                        انشاء شركة جديدة
                    @else
                        Create a New Company
                    @endif
                </h1>
                <form action="{{route('company.store.s2')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="company_id" value="{{$_GET['company_id']}}"/>
                    <div class="col-lg-4 col-xs-12">
                        <div class="form-group">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    هل يوجد فروع للشركة ؟
                                @else
                                    Your Company have branches ?
                                @endif
                            </label>
                            @if(App::getLocale() == 'ar')
                                <span style="margin-left: 20px;">
                                @if(App::getLocale() == 'ar')
                                        نعم
                                    @else
                                        Yes
                                    @endif
                                </span>
                                <label class="switch">
                                    <input type="checkbox" name="have_branches" value="yes">
                                    <span class="slider round"></span>
                                </label>

                                <span style="margin-right: 20px;">
                                    @if(App::getLocale() == 'ar')
                                        لا
                                    @else
                                        No
                                    @endif
                                </span>
                            @else
                                <span style="margin-right: 20px;">
                                @if(App::getLocale() == 'ar')
                                            لا
                                        @else
                                            No
                                        @endif
                                </span>
                                <label class="switch">
                                    <input type="checkbox" name="have_branches" value="yes">
                                    <span class="slider round"></span>
                                </label>
                                <span style="margin-left: 20px;">
                                @if(App::getLocale() == 'ar')
                                        نعم
                                    @else
                                        Yes
                                    @endif
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-12 col-xs-12 text-center justify-content-center text-center mt-3">
                        <button type="submit" dir="rtl" class="col-lg-4 btn btn-md btn-outline-danger"
                                style="color: #fff !important;">
                            <i class="fa fa-check" style="color: #fff !important;"></i>
                            @if(App::getLocale() == 'ar')
                                تنفيذ
                            @else
                                Submit
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

@endsection
