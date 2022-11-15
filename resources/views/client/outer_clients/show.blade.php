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
                                    عرض بيانات العميل
                                @else
                                    View Client Details
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
                                اسم العميل :
                            @else
                                Client Name
                            @endif
                            {{$outer_client->client_name}}
                        </p>
                    </div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                فئة التعامل :
                            @else
                                Client Category
                            @endif
                            {{trans('main.'.$outer_client->client_category)}}
                        </p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix"></div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                مديونية العميل :
                            @else
                                Debts
                            @endif
                            @if($outer_client->prev_balance > 0 )
                                @if(App::getLocale() == 'ar')
                                    عليه
                                @else
                                    Debtor
                                @endif

                                {{floatval( $outer_client->prev_balance  )}}
                            @elseif($outer_client->prev_balance < 0)
                                @if(App::getLocale() == 'ar')
                                    له
                                @else
                                    Creditor
                                @endif
                                {{floatval( abs($outer_client->prev_balance)  )}}
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
                            {{$outer_client->shop_name}}
                        </p>
                    </div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                جنسية العميل
                            @else
                                Nationality
                            @endif

                            {{$outer_client->client_national}}
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

                            {{$outer_client->client_email}}
                        </p>
                    </div>

                    <div class="col-lg-6 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                الرقم الضريبى
                            @else
                                Tax Number
                            @endif
                            {{$outer_client->tax_number}}
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

                            @if(!$outer_client->phones->isEmpty())
                                @foreach($outer_client->phones as $phone)
                                    <span class="badge badge-success">{{$phone->client_phone}}</span>
                                @endforeach
                            @endif

                        </p>
                    </div>
                    <div class="col-lg-6 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                ملاحظات العميل
                            @else
                                Client Notes
                            @endif
                            @if(!$outer_client->notes->isEmpty())
                                @foreach($outer_client->notes as $note)
                                    <span class="badge badge-danger">{{$note->client_note}}</span>
                                @endforeach
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-6 pull-right p-2">
                        <p class="alert alert-secondary alert-sm" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                عنوان العميل
                            @else
                                Client Address
                            @endif
                            @if(!$outer_client->addresses->isEmpty())
                                @foreach($outer_client->addresses as $address)
                                    <span class="badge badge-danger">{{$address->client_address}}</span>
                                @endforeach
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
