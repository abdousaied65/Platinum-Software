@extends('site.layouts.app-main')
<style>
</style>
@section('content')

    <!-- ==========Speaker-Single========== -->
    <section class="about-section mt-5 padding-bottom" style=" padding-top: 200px!important;">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6 pull-right">
                    <div class="about-thumb w-100">
                        <img class="w-100" src="{{asset('assets/images/about/about01.png')}}" alt="about">
                    </div>
                </div>
                <div class="col-lg-6 pull-left">
                    <div class="event-about-content">
                        <div class="section-header-3 left-style m-0">
                            <span class="cate">
                                @if(App::getLocale() == 'ar')
                                    {{$system->name_ar}}
                                @else
                                    {{$system->name_en}}
                                @endif
                            </span>
                            <h2 class="title">
                                @if(App::getLocale() == 'ar')
                                    اعرف عنا الكثير والكثير
                                @else
                                    Know a lot about us
                                @endif
                            </h2>
                            <p>
                                @if(App::getLocale() == 'ar')
                                    تأسست الشركة في عام 2010 بعد أن قدمنا خدمات كثيرة ومميزة
                                    <br>
                                    في عالم البرمجيات المحاسبية والحاسب الآلي
                                    <br>
                                    وقمنا في وضع بصمة في أكثر من دولة عربية
                                @else
                                    The company was established in 2010 after we provided many distinguished services
                                    <br>
                                    In the world of accounting software and computers
                                    <br>
                                    We have made a mark in more than one Arab country
                                @endif

                            </p>
                            <p>
                                @if(App::getLocale() == 'ar')
                                    تم العمل على هذا البرنامج ليلبي حاجة المستخدم
                                    <br>
                                    ويضيف مفهوم جديد بعالم المحاسبة والأعمال....
                                    <br>
                                    نضع بين أيديكم ناتج خبرة لأكثر من 15 سنة في مجال المحاسبة
                                    <br>
                                    و إدارة الأعمال وشعارنا هو العميل اولا
                                @else
                                    This program was designed to meet the needs of the user
                                    <br>
                                    It adds a new concept to the world of accounting and business....
                                    <br>
                                    We offer you the product of more than 15 years of experience in the field of
                                    accounting
                                    <br>
                                    And business management and our motto is the customer first
                                @endif
                            </p>
                            <a href="{{route('index3')}}" class="custom-button">
                                @if(App::getLocale() == 'ar')
                                    الحصول على نسخة تجريبية من النظام
                                @else
                                    Get a trial version of the system
                                @endif
                            </a>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
    <!-- ==========Speaker-Single========== -->

    <!-- ==========Philosophy-Section========== -->
    <div class="philosophy-section padding-top padding-bottom bg-one bg_img bg_quater_img"
         data-background="{{asset('assets/images/about/about-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 offset-lg-3 bg-two">
                    <div class="philosophy-content">
                        <div class="section-header-3 left-style">
                            <span class="cate">
                                @if(App::getLocale() == 'ar')
                                    القى نظرة سريعة على
                                @else
                                    Take a quick look at
                                @endif
                            </span>
                            <h2 class="title">
                                @if(App::getLocale() == 'ar')
                                    الرؤية والهدف والرسالة
                                @else
                                    Vision, goal and mission
                                @endif
                            </h2>
                            <p class="ml-0">
                                @if(App::getLocale() == 'ar')
                                    نرغب وبكل امل فى ضم الشركات
                                    التى تحتاج الى ادارة عملها عن بعد من خلالنا
                                    ونسعى ان نكون على قدرالثقة
                                    <br>
                                    التى منحها لنا عملاؤنا السابقين
                                    وجلب ثقة عملاء جدد
                                    ونخطط لان نكون البرنامج
                                    <br>
                                    رقم 1 على مستوى العالم العربى
                                @else
                                    We hope, with hope, to include companies
                                    Who needs to manage their work remotely through us
                                    We strive to be trustworthy
                                    <br>
                                    that our previous clients gave us
                                    Attracting new customers' confidence
                                    We plan to be the programme
                                    <br>
                                    Number 1 in the Arab world
                                @endif
                            </p>
                        </div>
                        <ul class="phisophy-list">
                            <li>
                                <div class="thumb">
                                    <img src="{{asset('assets/images/philosophy/icon1.png')}}" alt="philosophy">
                                </div>
                                <h5 class="title">
                                    @if(App::getLocale() == 'ar')
                                        الامانة فى التعامل والاحترام
                                    @else
                                        Honesty in dealing and respect
                                    @endif
                                </h5>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{asset('assets/images/philosophy/icon2.png')}}" alt="philosophy">
                                </div>
                                <h5 class="title">
                                    @if(App::getLocale() == 'ar')
                                        الوضوح والشفافية
                                    @else
                                        Clarity and transparency
                                    @endif
                                </h5>
                            </li>
                            <li>
                                <div class="thumb">
                                    <img src="{{asset('assets/images/philosophy/icon3.png')}}" alt="philosophy">
                                </div>
                                <h5 class="title">
                                    @if(App::getLocale() == 'ar')
                                        المتابعة المستمرة مع عملاؤنا
                                    @else
                                        Constant follow-up with our clients
                                    @endif
                                </h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ==========Philosophy-Section========== -->

    <!-- ==========About-Counter-Section========== -->
    <section class="about-counter-section padding-bottom padding-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="section-header-3 left-style mb-lg-0">
                        <span class="cate">
                        @if(App::getLocale() == 'ar')
                                حقائق وارقام
                            @else
                                facts and figures
                            @endif
                        </span>
                        <h2 class="title">
                            @if(App::getLocale() == 'ar')
                                ارقام تعبر عنا
                            @else
                                numbers that represent us
                            @endif
                        </h2>
                        <p>
                            @if(App::getLocale() == 'ar')
                                الاسلوب الذى تتبعه الشركة فى معاملة الشركات والعملاء تجعلنا دائما فى الصدارة
                                <br>
                                غير ان السرعة فى تنفيذ المطلوب والمتابعة
                                <br>
                                المستمرة مع العملاء فى حينواجهوا مشاكل هى اولى اولوياتنا
                            @else
                                The way the company treats companies and customers makes us always at the fore
                                <br>
                                However, the speed in implementing the required and follow-up
                                <br>
                                Continuing with customers when they encounter problems is our first priority
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="about-counter">
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="{{asset('assets/images/about/about-counter01.png')}}" alt="about">
                            </div>
                            <div class="counter-content">
                                <h3 class="title odometer" data-odometer-final="30"></h3>
                                <h3 class="title">100+</h3>
                            </div>
                            <span class="d-block info">
                                @if(App::getLocale() == 'ar')
                                    عميل
                                @else
                                    cLients
                                @endif
                            </span>
                        </div>
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="{{asset('assets/images/about/about-counter02.png')}}" alt="about">
                            </div>
                            <div class="counter-content">
                                <h3 class="title odometer" data-odometer-final="30"></h3>
                                <h3 class="title">24/7</h3>
                            </div>
                            <span class="d-block info">
                                @if(App::getLocale() == 'ar')
                                    دعم فنى متواصل
                                @else
                                    Ongoing technical support
                                @endif
                            </span>
                        </div>
                        <div class="counter-item">
                            <div class="counter-thumb">
                                <img src="{{asset('assets/images/about/about-counter03.png')}}" alt="about">
                            </div>
                            <div class="counter-content">
                                <h3 class="title odometer" data-odometer-final="30"></h3>
                                <h3 class="title">30</h3>
                            </div>
                            <span class="d-block info">
                                @if(App::getLocale() == 'ar')
                                    شاشة لاقسام البرنامج
                                @else
                                    Screen for program sections
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ==========About-Counter-Section========== -->

@endsection
