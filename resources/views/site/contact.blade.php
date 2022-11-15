@extends('site.layouts.app-main')
<style>
</style>
@section('content')
    <!-- ======= Contact Section ======= -->
    <section class="contact-section padding-bottom" style=" padding-top: 200px!important;">
        <div class="contact-container">
            <div class="bg-thumb bg_img" data-background="{{asset('assets/images/contact/contact.jpg')}}"></div>
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-7 col-lg-6 col-xl-5">
                        @if (session('success'))
                            <div class="clearfix"></div>
                            <div class="alert alert-success text-center" style="border-radius: 0;">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="clearfix"></div>
                            <div class="alert alert-danger text-right" dir="rtl">
                                <strong>
                                    @if(App::getLocale() == 'ar')
                                        الاخطاء
                                    @else
                                        Errors
                                    @endif
                                </strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="section-header-3 left-style text-right">
                            <span class="cate">
                                @if(App::getLocale() == 'ar')
                                    تواصل معنا
                                @else
                                    Contact Us
                                @endif
                            </span>
                            <h4 class="title">
                                @if(App::getLocale() == 'ar')
                                    كن دائما على اتصال بنا
                                @else
                                    Always be in touch with us
                                @endif
                            </h4>
                            <p>
                                @if(App::getLocale() == 'ar')
                                    نود التحدث عن كيفية العمل معًا.
                                    <br>
                                    أرسل لنا رسالة أدناه وسنقوم بالرد في أسرع وقت ممكن.
                                @else
                                    We'd like to talk about how we can work together.
                                    <br>
                                    Send us a message below and we will respond as soon as possible.
                                @endif
                            </p>
                        </div>
                        <form action="{{route('send.message')}}" method="post" class="contact-form"
                              id="contact_form_submit">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label for="name" class="float-right">
                                    @if(App::getLocale() == 'ar')
                                        الاسم
                                    @else
                                        Name
                                    @endif
                                    <span>*</span></label>
                                <input required type="text" name="name" id="name"
                                       placeholder="@if(App::getLocale() == 'ar')اكتب اسمك هنا@else Type Your Name @endif"/>
                            </div>
                            <div class="form-group">
                                <label for="phone" class="float-right">
                                    @if(App::getLocale() == 'ar')
                                        رقم الجوال 
                                    @else Phone Number @endif
                                        <span class="text-danger">( رقم الجوال لابد ان يكون 9665xxxxxx ) </span>    
                                </label>
                                <input style="direction: ltr!important;" required type="number" name="phone" id="phone"
                                       placeholder="@if(App::getLocale() == 'ar')اكتب رقم الجوال  @else Type Your Phone Number @endif"/>
                            </div>
                            <div class="form-group">
                                <label for="subject" class="float-right">
                                    @if(App::getLocale() == 'ar')
                                        موضوع الرسالة
                                    @else
                                        Subject
                                    @endif
                                    <span>*</span></label>
                                <input required type="text" name="subject" id="subject"
                                       placeholder="@if(App::getLocale() == 'ar') الموضوع@else Subject @endif"/>
                            </div>
                            <div class="form-group">
                                <label for="message" class="float-right">
                                    @if(App::getLocale() == 'ar')
                                        نص الرسالة
                                    @else Message @endif
                                    <span>*</span></label>
                                <textarea required id="message" name="message" rows="5"
                                          placeholder="@if(App::getLocale() == 'ar') نص الرسالة @else Message @endif"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="@if(App::getLocale() == 'ar') ارسل الرسالة الان @else Send Message @endif">
                            </div>
                        </form>
                    </div>
                    <div class="col-md-5 col-lg-6">
                        <div class="padding-top padding-bottom contact-info">
                            <div class="info-area">
                                <div class="info-item">
                                    <div class="info-thumb">
                                        <img src="{{asset('assets/images/contact/contact01.png')}}" alt="contact">
                                    </div>
                                    <div class="info-content">
                                        <h6 class="title">
                                            @if(App::getLocale() == 'ar')
                                                رقم الجوال / واتساب
                                            @else
                                                Phone & Whatsapp
                                            @endif
                                        </h6>
                                        <a style="direction: ltr!important;"
                                           href="Tel:{{$informations->whatsapp_number}}">{{$informations->whatsapp_number}}</a>
                                    </div>
                                </div>
                                <div class="info-item">
                                    <div class="info-thumb">
                                        <img src="{{asset('assets/images/contact/contact02.png')}}" alt="contact">
                                    </div>
                                    <div class="info-content">
                                        <h6 class="title">
                                            @if(App::getLocale() == 'ar')
                                                البريد الالكترونى
                                            @else
                                                Email Address
                                            @endif
                                        </h6>
                                        <a href="Mailto:{{$informations->email_link}}">{{$informations->email_link}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========Contact-Section========== -->
@endsection
