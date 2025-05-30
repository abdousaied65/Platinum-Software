@extends('site.layouts.app-main')
<style>
    .form-control{
        height: 50px!important;
    }
</style>
@section('content')
    <section class="account-section bg_img" data-background="./assets/images/account/account-bg.jpg">
        <div class="container">
            <div class="padding-top padding-bottom">
                <div class="account-area">
                    <div class="section-header-3">
                        <h3>
                            @if(App::getLocale() == 'ar')
                                اعادة تعيين كلمة المرور
                            @else
                                Reset Password
                            @endif
                        </h3>
                    </div>
                    <form dir="rtl" method="POST" action="{{ route('client.password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                @if(App::getLocale() == 'ar')
                                    البريد الالكترونى
                                @else
                                    Email Address
                                @endif
                            </label>
                            <div class="col-md-8">
                                <input id="email" type="email" style="direction: ltr!important;text-align: left!important;" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                @if(App::getLocale() == 'ar')
                                    كلمة المرور
                                @else
                                    Password
                                @endif
                            </label>

                            <div class="col-md-8">
                                <input id="password" type="password"
                                       style="direction: ltr!important;text-align: left!important;"
                                       class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                @if(App::getLocale() == 'ar')
                                    تأكيد كلمة المرور
                                @else
                                    Confirm Password
                                @endif
                            </label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password"
                                       style="direction: ltr!important;text-align: left!important;"
                                       class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mt-5 ">
                            <div class="col-md-12 text-center justify-content-center">
                                <button type="submit" class="btn btn-outline-danger">
                                    @if(App::getLocale() == 'ar')
                                        اعادة تعيين كلمة المرور
                                    @else
                                        Confirm Password Reset
                                    @endif
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
