@extends('client.layouts.app-main')
<style>
    .form-control {
        height: 40px !important;
    }

    .message {
        display: none;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="col-lg-12">
        <div class="message alert alert-success text-center mt-1 mb-1">
            <span>
                @if(App::getLocale() == 'ar')
                    تم حفظ التغييرات
                @else
                    All Changes Saved
                @endif
            </span>
        </div>
    </div>
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <h5 class="pull-right alert alert-sm alert-success">
                                @if(App::getLocale() == 'ar')
                                    عرض كل الاجهزة المستلمة
                                @else
                                    Show All Received Devices
                                @endif
                            </h5>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered text-center table-hover"
                               id="example-table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رقم الايصال
                                    @else
                                        Receipt Number
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        اسم الجهاز
                                    @else
                                        Device Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        اسم العميل
                                    @else
                                        Client Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رقم فاتورة المبيعات
                                    @else
                                        Maintenance Bill Number
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        المخزن
                                    @else
                                        Store
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        التاريخ
                                    @else
                                        Date
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الاجمالى
                                    @else
                                        total
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الحالة
                                    @else
                                        Status
                                    @endif
                                </th>
                                <th class="text-center nosort">
                                    @if(App::getLocale() == 'ar')
                                        خيارات
                                    @else
                                        Options
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($maintenance_devices as $key => $maintenance_device)
                                @if($maintenance_device->Bill->status != "تم التسليم الى العميل")
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $maintenance_device->receipt_number}}</td>
                                        <td>{{$maintenance_device->device_name}}</td>
                                        <td>{{$maintenance_device->device_owner_name}}</td>
                                        <td>{{$maintenance_device->Bill->bill_id}}</td>
                                        <td>{{$maintenance_device->store->store_name}}
                                            - {{$maintenance_device->store->branch->branch_name}}</td>
                                        <td>{{$maintenance_device->received_date}}</td>
                                        <td>{{$maintenance_device->Bill->total_cost}}</td>
                                        <td>{{$maintenance_device->Bill->status}}</td>
                                        <td>
                                            <a href="{{route('maintenance.bill.create',$maintenance_device->id)}}"
                                               type="button" class="btn btn-block btn-danger">
                                                <i class="fa fa-file"></i>
                                                @if(App::getLocale() == 'ar')
                                                    فاتورة المبيعات
                                                @else
                                                    Maintenance Bill
                                                @endif
                                            </a>
                                            <button id="hand_over" type="button"
                                                    bill_id="{{$maintenance_device->Bill->id}}"
                                                    class="btn btn-block btn-success">
                                                <i class="fa fa-check"></i>

                                                @if(App::getLocale() == 'ar')
                                                    التسليم
                                                @else
                                                    Hand Over
                                                @endif
                                            </button>
                                            <a href="{{route('print.device.receipt',$maintenance_device->id)}}"
                                               type="button" class="btn btn-block btn-info">
                                                <i class="fa fa-print"></i>

                                                @if(App::getLocale() == 'ar')
                                                    طباعة
                                                @else
                                                    Print
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#hand_over').on('click', function () {
            let bill_id = $(this).attr('bill_id');
            $.post("{{url('/receipt/maintenance-devices/receipt/hand-over')}}",
                {"_token": "{{ csrf_token() }}", bill_id: bill_id},
                function (data) {
                    if (data.status == "done") {
                        @if(App::getLocale() == 'ar')
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("تم التسليم الى العميل وتسجيل المبلغ فى الخزنة");
                        @else
                        $('.message').fadeIn().delay(2000).fadeOut(500).html("The device was delivered to the customer and the amount was saved in the safe");
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
