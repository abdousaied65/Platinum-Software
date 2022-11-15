@extends('client.layouts.app-pos')
<style>
    .form-control {
        height: 40px !important;
        border-radius: 0px !important;
    }

    @media print {
        a {
            text-decoration: none !important;
        }
    }

    * {
        color: #222 !important;
    }

    .no-border-radius {
        border-radius: 0 !important;
    }

    .title {
        min-width: 300px;
        font-size: 17px !important;
        border-radius: 0;
        padding: 5px !important;
        color: #fff !important;
    }

    .bootstrap-select {
        width: 100% !important;
        height: 40px !important;
    }

    .btn.dropdown-toggle.bs-placeholder.btn-dark {
        border-radius: 0px !important;
        padding: 5px 10px !important;
    }

    * {
        font-size: 12px !important;
    }

    label {
        font-size: 12px !important;
    }

    h1, h2, h3, h4, h5, h6, p, div, span {
        font-size: 12px !important;
    }

    .alert-dark {
        background: #444 !important;
        border: 1px solid #444 !important;
        color: #fff !important;
    }
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="company_details printy" style="display: none;">
                            <div class="text-center">
                                <img class="logo" style="width: 100px; height: 100px;"
                                     src="{{asset($company->company_logo)}}" alt="">
                            </div>
                            <div class="text-center">
                                <div class="col-lg-12 text-center justify-content-center">
                                    <p class="alert alert-secondary text-center alert-sm"
                                       style="margin: 10px auto; font-size: 17px;line-height: 1.9;" dir="rtl">
                                        {{$company->company_name}} -- {{$company->business_field}} <br>
                                        {{$company->company_owner}} -- {{$company->phone_number}} <br>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <h2 class="title alert alert-sm alert-dark text-center mt-0 p-1">
                            @if(App::getLocale() == 'ar')
                                طباعة ايصال استلام جهاز صيانة
                            @else
                                Print receipt of maintenance device
                            @endif
                        </h2>
                        <div class="clearfix"></div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        رقم الفاتورة
                                    @else
                                        Bill Number
                                    @endif
                                </label>
                                <input readonly dir="ltr" type="number" id="bill_id" name="bill_id"
                                       class="form-control"
                                       value="{{$maintenance_device->Bill->bill_id}}"/>
                            </div>
                        </div>


                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم العميل
                                    @else
                                        Client Name
                                    @endif
                                </label>
                                <input readonly dir="rtl" required
                                       class="form-control"
                                       value="{{$maintenance_device->device_owner_name}}"
                                       name="device_owner_name" type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        هاتف العميل
                                    @else
                                        Client Phone
                                    @endif
                                </label>
                                <input readonly dir="ltr" required
                                       class="form-control"
                                       value="{{$maintenance_device->device_owner_phone}}"
                                       name="device_owner_phone" type="number">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم الجهاز
                                    @else
                                        Device Name
                                    @endif
                                </label>
                                <input readonly dir="rtl" required class="form-control"
                                       name="device_name"
                                       value="{{$maintenance_device->device_name}}"
                                       type="text">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        نوع الجهاز
                                    @else
                                        Device Type
                                    @endif
                                </label>
                                <input readonly class="form-control"
                                       value="{{$maintenance_device->deviceType->device_type}}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        سيريال الجهاز
                                    @else
                                        Device Serial
                                    @endif
                                </label>
                                <input readonly dir="ltr" required class="form-control"
                                       name="device_serial"
                                       value="{{$maintenance_device->device_serial}}"
                                       type="text">
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        مشكلة الجهاز
                                    @else
                                        Device Issue
                                    @endif
                                </label>
                                <input type="text" readonly class="form-control"
                                       value="{{$maintenance_device->deviceIssue->issue}}"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        التاريخ المتوقع للتسليم
                                    @else
                                        Expected Delivery Date
                                    @endif
                                </label>
                                <input readonly dir="ltr" required class="form-control"
                                       name="expected_delivery_date"
                                       value="{{$maintenance_device->expected_delivery_date}}"
                                       type="date">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        شكوى العميل
                                    @else
                                        Client Complain
                                    @endif
                                </label>
                                <textarea readonly
                                          style="resize: none; width: 100%; height: 120px!important; border-radius: 5px;"
                                          name="owner_complain" dir="rtl"
                                          class="form-control">{{$maintenance_device->owner_complain}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        التكلفة التقريبية
                                    @else
                                        approximate cost
                                    @endif
                                </label>
                                <input readonly dir="ltr" required class="form-control"
                                       value="{{$maintenance_device->approximate_cost}}"
                                       name="approximate_cost" type="number">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        Notes
                                    @endif
                                </label>
                                <td width="55%">
                                    <input readonly dir="rtl" class="form-control" name="notes" type="text"
                                           value="{{$maintenance_device->notes}}">
                                </td>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        الضمان
                                    @else
                                        warranty
                                    @endif
                                </label>
                                <input readonly type="text"
                                       @if($maintenance_device->warranty == "0")
                                       @if(App::getLocale() == 'ar')
                                       value="لا يوجد"
                                       @else
                                       value="no warranty"
                                       @endif
                                       @else
                                       @if(App::getLocale() == 'ar')
                                       value="نعم"
                                       @else
                                       value="yes"
                                       @endif
                                       @endif
                                       class="form-control"/>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        فترة الضمان باليوم
                                    @else
                                        warranty Period in Days
                                    @endif
                                </label>
                                <input readonly required name="warranty_period" type="text"
                                       value="{{$maintenance_device->warranty_period}}"
                                       class="form-control"/>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        تاريخ الاستلام
                                    @else
                                        Received Date
                                    @endif
                                </label>
                                <input readonly type="date" id="date" name="date" class="form-control"
                                       value="{{$maintenance_device->Bill->date}}"/>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group text-center">
                                <label class="d-block">QR Code</label>
                                <div class="qr_code">
                                    {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate(Route('receipt.page.login')); !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pull-right">
                            <div class="form-group text-center">
                                <p class="d-block" style="line-height: 2;font-size: 17px!important;">
                                    @if(App::getLocale() == 'ar')
                                        سيساعدك كود الكيو ار عند عمل Scan له من خلال جوالك
                                        <br>
                                        فى انتقالك الى صفحة الفاتورة الخاصة بجهازك للموافقة عليها
                                        <br>
                                        او من خلال كتابة الرابط الاتى فى متصفح الانترنت الخاص بك
                                        <br>
                                    @else
                                        The QR code will help you when scanning it through your mobile phone
                                        <br>
                                        When you go to the billing page of your device for approval
                                        <br>
                                        Or by typing the following link in your internet browser
                                        <br>
                                    @endif
                                    <a style="font-size: 16px!important;color: darkblue!important;"
                                       href="{{route('receipt.page.login')}}">{{route('receipt.page.login')}}</a>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 pull-right">
                            <div class="form-group text-center">
                                <button onclick="window.print();"
                                        class="btn btn-md btn-info btn-block text-white no-print"
                                        style="font-size: 14px!important;">
                                    <i class="fa fa-print text-white"></i>
                                    @if(App::getLocale() == 'ar')
                                        طباعة الايصال
                                    @else
                                        Print Receipt
                                    @endif

                                </button>
                                <a href="{{route('maintenance.devices')}}"
                                   class="btn btn-md btn-danger btn-block mt-3 text-white no-print"
                                   style="font-size: 14px!important;">
                                    <i class="fa fa-print text-white"></i>
                                    @if(App::getLocale() == 'ar')
                                        العودة الى الصفحة السابقة
                                    @else
                                        Back to previous page
                                    @endif
                                </a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
