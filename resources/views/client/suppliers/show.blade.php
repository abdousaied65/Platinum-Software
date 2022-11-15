@extends('client.layouts.app-main')
<style>

</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <h5 class="pull-right alert alert-sm alert-info">
                                @if(App::getLocale() == 'ar')
                                    عرض بيانات المورد
                                @else
                                    Show Supplier Data
                                @endif
                            </h5>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                اسم المورد :
                            @else
                                Supplier Name
                            @endif
                            {{$supplier->supplier_name}}
                        </p>
                    </div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                فئة التعامل :
                            @else
                                Client Category
                            @endif
                            {{trans('main.'.$supplier->supplier_category)}}
                        </p>
                    </div>
                    <div class="clearfix"></div>

                    <div class="clearfix"></div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                مستحقات المورد :
                            @else
                                Supplier Dues
                            @endif
                            @if($supplier->prev_balance > 0 )
                                @if(App::getLocale() == 'ar')
                                    له
                                @else
                                    Creditor
                                @endif

                                {{floatval( $supplier->prev_balance  )}}
                            @elseif($supplier->prev_balance < 0)
                                @if(App::getLocale() == 'ar')
                                    عليه
                                @else
                                    Debtor
                                @endif
                                {{floatval( abs($supplier->prev_balance)  )}}
                            @else
                                0
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                اسم المحل او الشركة :
                            @else
                                Shop Name
                            @endif
                            {{$supplier->shop_name}}
                        </p>
                    </div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                جنسية المورد
                            @else
                                Nationality
                            @endif
                            {{$supplier->supplier_national}}
                        </p>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-6 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                البريد الالكترونى
                            @else
                                Email
                            @endif
                            {{$supplier->supplier_email}}
                        </p>
                    </div>

                    <div class="col-lg-6 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                الرقم الضريبى
                            @else
                                Tax Number
                            @endif
                            {{$supplier->tax_number}}
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-6 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                رقم الهاتف بمفتاح الدولة
                            @else
                                Phone Number with country key
                            @endif

                        @if(!$supplier->phones->isEmpty())
                                @foreach($supplier->phones as $phone)
                                    <span class="badge badge-success">{{$phone->supplier_phone}}</span>
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-6 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                عنوان المورد
                            @else
                                Supplier Address
                            @endif
                            @if(!$supplier->addresses->isEmpty())
                                @foreach($supplier->addresses as $address)
                                    <span class="badge badge-success">{{$address->supplier_address}}</span>
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-6 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                ملاحظات المورد
                            @else
                                Supplier Notes
                            @endif

                            @if(!$supplier->notes->isEmpty())
                                @foreach($supplier->notes as $note)
                                    <span class="badge badge-danger">{{$note->supplier_note}}</span>
                                @endforeach
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
