@extends('site.layouts.app-main')
<style>
    .color-theme p {
        text-align: center !important;
        justify-content: center !important;
        direction: rtl !important;
    }

    i.fa-check {
        margin-left: 20px;
    }

    div.content p {
        margin-bottom: 70px;
    }

    .custom-btn {
        margin-top: 5px;
        text-align: center !important;
        justify-content: center !important;
        direction: rtl !important;
        text-transform: uppercase;
        border-radius: 10px;
        background-image: -webkit-linear-gradient(
            169deg, #5560ff 17%, #aa52a1 63%, #ff4343 100%);
        -webkit-transition: all ease 0.3s;
        transition: all ease 0.3s;
        border: none;
        width: auto;
        color: #fff;
        min-width: 250px;
        padding: 10px 50px;
        height: 50px !important;
        font-weight: 600;
    }

    .cd-words-wrapper {
        text-align: center !important;
    }

    h4.title a {
        color: #ccc !important;
    }

    .overlays {
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.85);
        color: #fff;
        z-index: 9999999999 !important;
        position: fixed;
        display: none;
        padding: 30px;
        top: 0;
        left: 0;
    }

    @media only screen and (max-width: 768px) {
        #myvideo {
            width: 100% !important;
            height: 70% !important;
            margin: 10px;
        }
    }

    #myvideo {
        width: 70%;
        height: 70%;
        margin: 10px;
    }
</style>
@section('content')
    <!-- ==========Banner-Section========== -->
    <section class="banner-section" style="padding-bottom: 100px; padding-top: 150px;">
        <div class="banner-bg bg_img bg-fixed" data-background="{{asset('assets/images/banner/banner01.jpg')}}"></div>
        <div class="container">
            <div class="banner-content">
                @if (session('error'))
                    <div class="alert alert-danger fade show">
                        {{ session('error') }}
                        <a class="dropdown-item" href="{{ route('client.logout') }}"
                           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fa fa-power-off"></i>
                            @if(App::getLocale() == 'ar')
                                تسجيل الخروج
                            @else
                                Logout
                            @endif
                        </a>
                        <form id="logout-form" action="{{ route('client.logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    </div>
                @endif
                <h3 class="text-center mb-3">
                    @if(App::getLocale() == 'ar')
                        {{$system->name_ar}}
                    @else
                        {{$system->name_en}}
                    @endif
                </h3>
                <span>
                    @if(App::getLocale() == 'ar')
                        {{$system->name_ar}}
                    @else
                        {{$system->name_en}}
                    @endif
                    @if(App::getLocale() == 'ar')
                        لإدارة المشاريع والمحلات التجارية والمخازن والشركات عند بعد
                        <br>
                        إدخال وإخراج البينات وتحليلها وتصديرها
                        وطباعتها بشكل سريع جداً مبسط ومختصر
                        <br>
                        وفر وقتك والمجهود وإبدئ بإدارة عملك بشكل إحترافي ومتطور وسهل ايضا
                        <br>
                    @else
                        To manage projects, shops, stores and companies remotely
                        <br>
                        Data entry and output, analysis and export
                        It is very quick and simple to print
                        <br>
                        Save your time and effort and start managing your business in a professional, advanced and easy way
                        <br>
                    @endif

                </span>
                <h6 class="mt-3 mb-3">
                    <i class="fa fa-check-circle" style="font-size: 28px!important;margin-left: 10px"></i>
                    @if(App::getLocale() == 'ar')
                        سهل الإستعمال
                    @else
                        Easy For Use
                    @endif
                </h6>
                <h6 class="mt-3 mb-3">
                    <i class="fa fa-check-circle" style="font-size: 28px!important;margin-left: 10px"></i>
                    @if(App::getLocale() == 'ar')
                        لكل الاجهزة
                    @else
                        For All Devices
                    @endif
                </h6>
                <a href="{{route('index3')}}" style="width: 200px" class="btn btn-md btn-outline-danger">
                    <i class="fa fa-check-circle"></i>
                    @if(App::getLocale() == 'ar')
                        ابدأ الان مجانا
                    @else
                        Start Now For Free
                    @endif
                </a>
                <h1 class="title cd-headline clip mb-3 mt-5" dir="rtl" style="font-family: 'Cairo' !important;">
                    <span class="color-theme cd-words-wrapper p-2 m-2">
                        <b class="is-visible">
                            @if(App::getLocale() == 'ar')
                                إدارة الفواتير, بيع
                                <br>
                                شراء ,مرتجعات ضريبية
                                <br>
                            @else
                                bills management , Sale
                                <br>
                                Buying , tax returns
                            @endif
                        </b>
                        <b>
                            @if(App::getLocale() == 'ar')
                                جرد المخازن, وحركة الأصناف
                            @else
                                Inventory of stores, movement of products
                            @endif
                        </b>
                        <b>
                            @if(App::getLocale() == 'ar')
                                ربط الفروع , مخازن ,و المندوبين
                            @else
                                Connecting branches, stores, and representatives
                            @endif
                        </b>
                        <b>
                            @if(App::getLocale() == 'ar')
                                حسابات العملاء والموردين ,و البنوك
                            @else
                                Clients , Suppliers and Banks Accounts
                            @endif
                        </b>
                        <b>
                            @if(App::getLocale() == 'ar')
                                إضافة مستخدمين لانهائيين للنظام لديك
                            @else
                                adding infinite users for your system
                            @endif
                        </b>
                        <b>
                            @if(App::getLocale() == 'ar')
                                إستيراد بياناتك وحفظها على جهازك أونلاين أولا بأول
                            @else
                                Import your data and save it online directly
                            @endif

                        </b>
                        <b>
                            @if(App::getLocale() == 'ar')
                                اكثر من 20 تقرير مختلف
                                <br>
                                يساعدوك فى عملك
                            @else
                                more than 20 reports
                                <br>
                                helps in your work
                            @endif

                        </b>
                    </span>
                </h1>
                <br>
                <p class="mt-3">
                    @if(App::getLocale() == 'ar')
                        كل ما يلزم المشروع خاصتك في مكان واحد لكل الاجهزة
                        <br>
                        الان يمكنك إدارة عملك من أي مكان وفي أي لحظة
                        <br>
                        فقط أدخل الأيميل خاصتك وإبدا فوراً
                    @else
                        Everything you need for your project in one place for all devices
                        <br>
                        Now you can manage your business from anywhere and at any moment
                        <br>
                        Just enter your email and start right away
                    @endif
                </p>
                <a href="{{route('index3')}}" class="custom-btn text-center justify-content-center">
                    <i class="fa fa-check"></i>
                    @if(App::getLocale() == 'ar')
                        الحصول على نسخة تجريبية الان
                    @else
                        Get Free Trial Now
                    @endif
                </a>
                <a href="{{route('client.home')}}" class="custom-btn text-center justify-content-center">
                    <i class="fa fa-dashboard"></i>
                    @if(App::getLocale() == 'ar')
                        الدخول الى لوحة تحكم شركتك
                    @else
                        Enter your Dashboard
                    @endif
                </a>
            </div>
        </div>
    </section>
    <!-- ==========Banner-Section========== -->
    <section class="why-us section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <a href="javascript:;" class="play-btn mb-4"></a>
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center p-5">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-fingerprint"></i></div>
                        <h4 class="title"><a href="">
                                @if(App::getLocale() == 'ar')
                                    {{$system->name_ar}}
                                @else
                                    {{$system->name_en}}
                                @endif
                            </a></h4>
                        <p class="description">
                            @if(App::getLocale() == 'ar')
                                {{$system->name_ar}}
                            @else
                                {{$system->name_en}}
                            @endif
                            @if(App::getLocale() == 'ar')
                                لادارة المشاريع والمحلات التجارية والمخازن
                                <br>
                                والشركات عند بعد. ادخال واخراج البينات وتحليلها وتصديرها
                                <br>
                                وطباعتها كل ما يلزم المشروع في مكان واحد لكل الاجهزة
                            @else
                                To manage projects, shops and stores
                                <br>
                                And companies at a distance. Entering and extracting data, analyzing it and exporting it
                                <br>
                                And print everything needed for the project in one place for all devices
                            @endif

                        </p>
                    </div>

                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-gift"></i></div>
                        <h4 class="title"><a href="">
                                @if(App::getLocale() == 'ar')
                                    ما هى مميزاته ؟
                                @else
                                    What are its features?
                                @endif
                            </a></h4>
                        <p class="description">
                            @if(App::getLocale() == 'ar')
                                وفر وقتك والمجهود وإبدئ بإدارة عملك بشكل إحترافي
                                <br>
                                ومتطور وسهل ايضا كل ما يلزم المشروع خاصتك في مكان
                                <br>
                                واحد لكل الاجهزة الان يمكنك إدارة عملك من أي مكان
                                <br>
                                وفي أي لحظة فقط أدخل الأيميل خاصتك وإبدا فوراً
                            @else
                                Save your time and effort and start managing your business professionally
                                <br>
                                Sophisticated and easy as well, everything you need for your project is in one place
                                <br>
                                One for all devices Now you can manage your business from anywhere
                                <br>
                                At any moment, just enter your email and start immediately
                            @endif
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <div class="overlays text-center justify-content-center">
        <button
            style="width: 40px; height: 40px;top:10px;border-radius: 0; right: 10px; float: right;z-index: 999999; display: inline;position:fixed;"
            class="remove_layout btn btn-md btn-danger">
            <i class="fa fa-close"></i>
        </button>
        <video id='myvideo' controls>
            <source media="all"
                    @if(isset($intro_movie))
                    src="{{asset($intro_movie->intro_movie)}}"
                    @else
                    src=""
                    @endif
                    type="video/mp4"/>
        </video>
    </div>
    <section class="tour-section padding-top padding-bottom">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-lg-12 text-center">
                    <h3>
                        @if(App::getLocale() == 'ar')
                            {{$system->name_ar}}
                        @else
                            {{$system->name_en}}
                        @endif
                        @if(App::getLocale() == 'ar')
                            للمحاسبة والاعمال التجارية
                        @else
                            For Accounting and Business
                        @endif
                    </h3>
                    <h6 class="mt-3">
                        @if(App::getLocale() == 'ar')
                            اختيارك الافضل لادارة مشروعك التجارى
                        @else
                            Your best choice for managing your business
                        @endif
                    </h6>
                </div>
            </div>
            <div class="row" style="margin-top: 100px;">
                <div class="col-lg-6">
                    <div class="tour-content text-right mt-5" dir="rtl">
                        <ul class="list-tour">
                            <li>
                                <div class="content">
                                    <p>
                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')
                                            لوحة تحكم مميزة سهلة الاستخدام مخصصة لاصحاب الشركات
                                            <br>
                                            تحتوى على قائمة جانبية تستطيع من خلالها الانتقال بين اقسام البرنامج المختلفة
                                            <br>
                                        @else
                                            An easy-to-use control panel for business owners
                                            <br>
                                            It contains a side menu through which you can move between the different sections of the program
                                            <br>
                                        @endif
                                    </p>
                                    <p>
                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')

                                            تستطيع تجربة النظام اولا حتى يتثنى لك التعرف على كل مميزاته
                                            <br>
                                            ثم تقوم بمراسلتنا من داخل النظام نفسه للاشتراك على الباقة التى ترغب
                                            <br>
                                            نضمن لك سرية البيانات والا يطلع احد على بياناتك
                                        @else
                                            You can try the system first so that you can learn about all its features
                                            <br>
                                            Then you write to us from within the system itself to subscribe to the package you want
                                            <br>
                                            We guarantee the confidentiality of your data and that no one will see your data
                                        @endif
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="tour-thumb">
                        <img style="border-radius: 0px; box-shadow: 0 5px 25px 0 rgba(214,215,216,0.6);"
                             src="{{asset('assets/images/home/frame.png')}}" alt="tour">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 150px;">
                <div class="col-lg-6 text-right" dir="rtl">
                    <div class="tour-thumb">
                        <img
                            style="width: auto; height:auto;border-radius: 0px; box-shadow: 0 5px 25px 0 rgba(214,215,216,0.6);"
                            src="{{asset('assets/images/home/sale_bill.png')}}" alt="tour">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tour-content text-right mt-5" dir="rtl">
                        <ul class="list-tour">
                            <li>
                                <div class="content">
                                    <p>
                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')
                                            نتيح لك تجربة مرنة في إدارة معاملاتك المالية على نحو احترافي، حيث
                                            يمكنك
                                            تسجيل مصروفاتك وإيراداتك من خلال سندات صرف وقبض
                                        @else
                                            We give you a flexible experience in managing your financial transactions in a professional manner, as
                                            you may
                                            Record your expenses and revenues through exchange and receipt vouchers
                                        @endif
                                    </p>
                                    <p>

                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')
                                            متضمنة كافة البيانات المطلوبة من
                                            تعيين مركز تكلفة والضريبة المطبقة والتصنيف والوصف مع إمكانية إرفاق المستندات
                                            والوثائق المطلوبة حسب الحاجة، بالإضافة إلى إمكانية تتبع مصروفاتك وإيرادتك بدقة
                                            عبر تقارير مفصلة.
                                        @else
                                            Including all required information from
                                            Set a cost center, applicable tax, classification and description with the ability to attach documents
                                            And the required documents as needed, in addition to the ability to track your expenses and income accurately
                                            Through detailed reports.
                                        @endif

                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 150px;">
                <div class="col-lg-6">
                    <div class="tour-content text-right mt-5" dir="rtl">
                        <ul class="list-tour">
                            <li>
                                <div class="content">
                                    <p>
                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')
                                            برنامج محاسبة سهل الأستخدام يتكون من
                                            الفواتير من فواتير بيع وشراء ومرتجعات وفواتير ضريبية ونظام للتخفيضات.
                                            المخازن من كروت اصناف وجرد وحركة أصناف .
                                        @else
                                            An easy-to-use accounting program consisting of
                                            Invoices of sale and purchase invoices, returns, tax invoices, and a system of discounts.
                                            Warehouses of items, inventory and movement of items.
                                        @endif
                                    </p>
                                    <p>
                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')
                                            العملاء والموردين من تعريفات ومدفوعات وكشوفات حساب وخصومات وعروض أسعار.
                                            الخزينه وتسجيل النقدية والأرباح.
                                            أوراق القبض والدفع و حسابات البنوك.
                                        @else
                                            Customers and suppliers of tariffs, payments, account statements, discounts and quotations.
                                            Treasury, cash register and earnings.
                                            Receipt and payment papers and bank accounts.
                                        @endif
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tour-thumb">
                        <img
                            style="width: auto; height:auto;border-radius: 0px; box-shadow: 0 5px 25px 0 rgba(214,215,216,0.6);"
                            src="{{asset('assets/images/home/pos_bill.png')}}" alt="tour">
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 150px;">
                <div class="col-lg-6 text-right" dir="rtl">
                    <div class="tour-thumb">
                        <img
                            style="width: 100%; height:auto;border-radius: 0px; box-shadow: 0 5px 25px 0 rgba(214,215,216,0.6);"
                            src="{{asset('assets/images/home/report.png')}}" alt="tour">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tour-content text-right mt-5" dir="rtl">
                        <ul class="list-tour">
                            <li>
                                <div class="content">
                                    <p>
                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')
                                            أسهل وأبسط برنامج محاسبى متكامل يساعدك على إدارة كافة معاملاتك المالية
                                            والمحاسبية ومتابعتها من أى مكان فى العالم بدون مشاكل.
                                        @else
                                            The easiest and simplest integrated accounting program that helps you manage all your financial transactions
                                            Accounting and follow-up from anywhere in the world without problems.
                                        @endif
                                    </p>
                                    <p>
                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')
                                            يشمل على جميع الفواتير من مبيعات ومشتريات سواء كانت بالضريبة أو بدون
                                            يقوم بالترحيل إلى المخازن و الأرباح و حسابات العملاء والموردين
                                            تلقائياً
                                        @else
                                            It includes all invoices from sales and purchases, whether with or without tax
                                            Posts to stores, profits, customer and supplier accounts
                                            automatically
                                        @endif
                                    </p>
                                    <p>
                                        <i class="fa fa-check-circle"
                                           style="font-size: 28px!important;margin-left: 10px"></i>
                                        @if(App::getLocale() == 'ar')
                                            فتح أكثر من مخزن وأكثر من فرع و عدد لا محدود من الأصناف بجميع أسعارها ومواصفتها
                                            يمكنك إستخدام برنامج حسابات من التابلت أو الموبيل أو الجهاز الشخصى كما تحب وفى
                                            أى وقت
                                            يتضمن اكثر من 20 تقرير عن العملاء والموردين و المخازن
                                        @else
                                            Opening more than one store and more than one branch and an unlimited number of items with all prices and specifications
                                            You can use the accounts program from the tablet, mobile or personal device as you like and in
                                            any time
                                            Includes more than 20 reports on customers, suppliers and stores
                                        @endif
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-counter padding-top padding-bottom">
        <div class="container">
            <div class="row justify-content-center mb-30-none">
                <div class="col-sm-12 col-md-3 text-center mb-5">
                    <div class="content">
                        <i class="fa fa-clock-o mb-4" style="font-size: 60px;color: darkcyan"></i>
                        <br>
                        <h5 class="mb-4">
                            @if(App::getLocale() == 'ar')
                                موفر للوقت
                            @else
                                Time Saver
                            @endif
                        </h5>
                        <p class="mt-3">
                            @if(App::getLocale() == 'ar')
                                بديل عن الورقة والقلم تستطيع تسجيل ومتابعة الاعمال والانشطة التجارية
                                بكل سهولة بدلا عن الطريقةالتقليدية القديمة
                            @else
                                An alternative to paper and pen, you can record and follow up on business and commercial activities
                                Easily instead of the old traditional way
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 text-center mb-5">
                    <div class="content">
                        <i class="fa fa-desktop mb-4" style="font-size: 60px;color: darkcyan"></i>
                        <br>
                        <h5 class="mb-4">
                            @if(App::getLocale() == 'ar')
                                تطبيق متجاوب
                            @else
                                Responsive App
                            @endif
                        </h5>
                        <p class="mt-3">
                            @if(App::getLocale() == 'ar')
                                تصميم رائع متوافق على أى جهاز سواء ديسكتوب أو تابلت أو موبايل
                                <br>
                                وبنفس المميزات فى كل الشاشات
                            @else
                                A great design that is compatible with any device, whether desktop, tablet or mobile
                                <br>
                                With the same features on all screens
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 text-center mb-5">
                    <div class="content">
                        <i class="fa fa-shopping-basket mb-4" style="font-size: 60px;color: darkcyan"></i>
                        <br>
                        <h5 class="mb-4">
                            @if(App::getLocale() == 'ar')
                                أسعارنا فى المتناول
                            @else
                                Our prices are affordable
                            @endif
                        </h5>
                        <p class="mt-3">
                            @if(App::getLocale() == 'ar')
                                نمتلك العديد من خطط الاسعار التى تناسب كافة الاحتياجات من الشركات الصغيرة إلى المتوسطة إلى
                                الكبيرة.
                            @else
                                We have many price plans to suit all needs from small to medium companies to
                                the big one.
                            @endif
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-3 text-center mb-5">
                    <div class="content">
                        <i class="fa fa-download mb-4" style="font-size: 60px;color: darkcyan"></i>
                        <br>
                        <h5 class="mb-4">
                            @if(App::getLocale() == 'ar')
                                مرن سهل الإستخدام
                            @else
                                Flexible Easy-Use
                            @endif
                        </h5>
                        <p class="mt-3">
                            @if(App::getLocale() == 'ar')
                                فى عدة دقائق يمكنك البدء فى استخدام المنصة ومتابعة أعمالك وادارتها باحترافية كاملة.
                            @else
                                In a few minutes, you can start using the platform and follow up and manage your business with complete professionalism.
                            @endif
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="banner-section" style="padding-bottom: 100px;">
        <div class="banner-bg bg_img bg-fixed" data-background="{{asset('assets/images/banner/banner01.jpg')}}"></div>
        <div class="container">
            <div class="banner-content">
                <span>
                    @if(App::getLocale() == 'ar')
                        {{$system->name_ar}}
                    @else
                        {{$system->name_en}}
                    @endif
                    @if(App::getLocale() == 'ar')
                        لإدارة المشاريع والمحلات التجارية والمخازن والشركات عند بعد
                        <br>
                        إدخال وإخراج البينات وتحليلها وتصديرها
                        وطباعتها بشكل سريع جداً مبسط ومختصر
                        <br>
                        وفر وقتك والمجهود وإبدئ بإدارة عملك بشكل إحترافي ومتطور وسهل ايضا
                        <br>
                    @else
                        To manage projects, shops, stores and companies at a distance
                        <br>
                        Data entry and output, analysis and export
                        It is very quick and simple to print
                        <br>
                        Save your time and effort and start managing your business in a professional, advanced and easy way
                        <br>
                    @endif
                </span>
                <h6 class="mt-3 mb-3">
                    <i class="fa fa-check-circle" style="font-size: 28px!important;margin-left: 10px"></i>
                    @if(App::getLocale() == 'ar')
                        سهل الإستعمال
                    @else
                        Easy For Use
                    @endif
                </h6>
                <h6 class="mt-3 mb-3">
                    <i class="fa fa-check-circle" style="font-size: 28px!important;margin-left: 10px"></i>
                    @if(App::getLocale() == 'ar')
                        لكل الاجهزة
                    @else
                        For All Devices
                    @endif
                </h6>
                <a href="{{route('index3')}}" style="width: 200px" class="btn btn-md btn-outline-danger">
                    <i class="fa fa-check-circle"></i>
                    @if(App::getLocale() == 'ar')
                        ابدأ الان مجانا
                    @else
                        Start Now For Free
                    @endif
                </a>
            </div>
        </div>
    </section>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.play-btn').on('click', function () {
            $('.overlays').show();
            $('body').css('overflow', 'hidden');
            $('#myvideo').get(0).play();
        });
        $('.remove_layout').on('click', function () {
            $('.overlays').hide();
            $('body').css('overflow', 'auto');
            $('#myvideo').get(0).pause();
            $('#myvideo').get(0).currentTime = 0;
        });
    });
</script>
