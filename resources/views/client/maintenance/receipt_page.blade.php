@extends('client.layouts.app-pos')
<style>
    .form-control {
        height: 40px !important;
        border-radius: 0px !important;
    }

    .message {
        display: none;
    }

    button {
        height: 40px !important;
    }

    @media print {
        a {
            text-decoration: none !important;
        }
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
                        @if (session('error'))
                            <div class="alert alert-danger text-center alert-dismissable fade show">
                                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                                {{ session('error') }}
                            </div>
                        @endif
                        <h2 class="title alert alert-sm alert-info text-center mt-0 p-1">
                            @if(App::getLocale() == 'ar')
                                متابعة جهاز الصيانة الخاص بك لدينا
                            @else
                                Follow up on your maintenance device with us
                            @endif
                        </h2>
                        <div class="clearfix"></div>
                        <form class="text-center col-lg-12 mx-auto justify-content-center">
                            <input type="hidden" id="bill_id" value="{{$MaintenanceBill->id}}"/>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            اسم العميل
                                        @else
                                            Client Name
                                        @endif
                                    </label>
                                    <input readonly type="text" class="form-control"
                                           value="{{$MaintenanceDevice->device_owner_name}}">
                                </div>
                            </div>
                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            تاريخ الاستلام
                                        @else
                                            Received Date
                                        @endif
                                    </label>
                                    <input readonly type="date" class="form-control"
                                           value="{{$MaintenanceDevice->received_date}}">
                                </div>
                            </div>

                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            هاتف العميل
                                        @else
                                            Client Phone
                                        @endif
                                    </label>
                                    <input readonly type="number" class="form-control"
                                           value="{{$MaintenanceDevice->device_owner_phone}}">
                                </div>
                            </div>

                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            نوع الجهاز
                                        @else
                                            Device Type
                                        @endif
                                    </label>
                                    <input readonly type="text" class="form-control"
                                           value="{{$MaintenanceDevice->deviceType->device_type}} - {{$MaintenanceDevice->device_name}}">
                                </div>
                            </div>

                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            تقييم المهندس
                                        @else
                                            Engineer Evaluation
                                        @endif
                                    </label>
                                    <input readonly type="text" class="form-control"
                                           value="{{$MaintenanceBill->engineer_evaluation}}">
                                </div>
                            </div>

                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            حالة الجهاز
                                        @else
                                            Device Status
                                        @endif
                                    </label>
                                    <input readonly type="text" class="form-control"
                                           value="{{$MaintenanceBill->status}}">
                                </div>
                            </div>

                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            تكلفة الاصلاح
                                        @else
                                            Repair Cost
                                        @endif
                                    </label>
                                    <input readonly type="text" class="form-control"
                                           value="{{$MaintenanceBill->total_cost}} {{$MaintenanceBill->company->extra_settings->currency}}">
                                </div>
                            </div>

                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            التاريخ المتوقع للتسليم
                                        @else
                                            Expected Delivery Date
                                        @endif
                                    </label>
                                    <input readonly type="date" class="form-control"
                                           value="{{$MaintenanceDevice->expected_delivery_date}}">
                                </div>
                            </div>

                            <div class="col-lg-4 pull-right">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            ملاحظات مع الفاتورة
                                        @else
                                            Notes For The bill
                                        @endif
                                    </label>
                                    <input readonly type="text" class="form-control"
                                           value="{{$MaintenanceBill->notes}}">
                                </div>
                            </div>

                            <div class="col-lg-4 pull-right">
                                <div class="form-group" style="margin-top: 25px!important;">
                                    <button type="button" id="accept_cost" class="btn btn-md btn-success">
                                        <i class="fa fa-check"></i>

                                        @if(App::getLocale() == 'ar')
                                            موافق على التكلفة
                                        @else
                                            I Agree on the cost
                                        @endif
                                    </button>
                                    <button type="button" id="deny_cost" class="btn btn-md btn-danger">
                                        <i class="fa fa-close"></i>
                                        @if(App::getLocale() == 'ar')
                                            غير موافق على التكلفة
                                        @else
                                            I don't agree with the cost
                                        @endif
                                    </button>
                                </div>
                            </div>

                            <div class="col-lg-8 pull-right">
                                <div class="message alert alert-success mt-2">
                                    <span>
                                        @if(App::getLocale() == 'ar')
                                            تم حفظ التغييرات
                                        @else
                                            All Changes Saved
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <hr>

                            <div class="col-lg-12 text-center">
                                <div class="form-group" style="margin-top: 25px!important;">
                                    <button type="button" id="agree_receive" class="btn btn-md btn-info">
                                        <i class="fa fa-check"></i>
                                        @if(App::getLocale() == 'ar')
                                            موافق على استلام الجهاز
                                        @else
                                            I agree to receive the device
                                        @endif
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#accept_cost ,#agree_receive').on('click', function () {
            let bill_id = $('#bill_id').val();
            $.post("{{url('/receipt/maintenance-devices/receipt/accept-cost')}}",
                {"_token": "{{ csrf_token() }}", bill_id: bill_id},
                function (data) {
                    if (data.status == "done") {
                        @if(App::getLocale() == 'ar')
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("تم حفظ التغييرات");
                        @else
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("All Changes Saved");
                        @endif
                        location.reload();
                    } else {
                        @if(App::getLocale() == 'ar')
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("هناك خطأ ما .. جرب وقت أخر");
                        @else
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("Something went wrong..try another time");
                        @endif
                    }
                });
        });
        $('#deny_cost').on('click', function () {
            let bill_id = $('#bill_id').val();
            $.post("{{url('/receipt/maintenance-devices/receipt/deny-cost')}}",
                {"_token": "{{ csrf_token() }}", bill_id: bill_id},
                function (data) {
                    if (data.status == "done") {
                        @if(App::getLocale() == 'ar')
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("تم حفظ التغييرات");
                        @else
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("All Changes Saved");
                        @endif

                        location.reload();
                    } else {
                        @if(App::getLocale() == 'ar')
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("هناك خطأ ما .. جرب وقت أخر");
                        @else
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("Something went wrong..try another time");
                        @endif
                    }
                });
        });
    });
</script>

