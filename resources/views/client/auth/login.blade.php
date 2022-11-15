@extends('site.layouts.app-main')
<style>

</style>
@section('content')
    <section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <div class="section-header-3">
                        <h3>
                            @if(App::getLocale() == 'ar')
                                تسجيل دخول لوحة تحكم الشركة
                            @else
                                Company Dashboard Login
                            @endif
                        </h3>
                    </div>
                    <form class="account-form" name="member_signin" method="POST" action="{{ route('client.login') }}">
                        @csrf
                        <div class="form-group">
                            <label class="d-block"
                                   style="direction: rtl!important;text-align: right!important;"
                                   for="email">
                                @if(App::getLocale() == 'ar')
                                    البريد الالكترونى
                                @else
                                    Email Address
                                @endif

                                <span>*</span></label>
                            <input value="{{old('email')}}" name="email" autofocus
                                   style="direction: ltr!important;text-align: left!important; padding-left: 10px;"
                                   type="email" placeholder="@if(App::getLocale() == 'ar')اكتب البريد الالكترونى@else Type Email Address
                            @endif" id="email" required>
                            @error('email')
                            <span style="direction: rtl!important;text-align: right!important;" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="d-block"
                                   style="direction: rtl!important;text-align: right!important;"
                                   for="pass3">
                                @if(App::getLocale() == 'ar')
                                    كلمة المرور
                                @else
                                    Password
                                @endif
                                <span>*</span></label>
                            <input type="password" placeholder="@if(App::getLocale() == 'ar')كلمة المرور@else Password @endif"
                                   name="password" dir="ltr" id="pass3" required
                                   style="direction: ltr!important;text-align: left!important; padding-left: 10px;">
                            @error('password')
                            <span class="text-right" dir="rtl" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group text-center">
                            <input type="submit" value="@if(App::getLocale() == 'ar')تسجيل الدخول@else Login @endif">
                        </div>
                    </form>
                    @if (Route::has('client.password.request'))
                        <div class="row">
                            <div class="col-lg-6 pull-left">
                                <div class="form-group checkgroup text-right mt-5" dir="rtl">
                                    <a href="{{ route('client.password.request') }}" class="forget-pass text-white">
                                        @if(App::getLocale() == 'ar')
                                            هل نسيت كلمة المرور ؟
                                        @else
                                            Forgot Your Password ?
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 pull-right">
                                <div class="form-group checkgroup text-left mt-5" dir="rtl">
                                    <a href="{{ route('index3') }}" class="forget-pass text-white">
                                        @if(App::getLocale() == 'ar')
                                            انشاء حساب جديد
                                        @else
                                            Create a New Account
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
