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
                        @if (session('error'))
                            <div class="alert alert-danger text-center alert-dismissable fade show">
                                <button class="close" data-dismiss="alert" aria-label="Close">×</button>
                                {{ session('error') }}
                            </div>
                        @endif
                        <h2 class="title alert alert-sm alert-dark text-center mt-0 p-1">
                            @if(App::getLocale() == 'ar')
                                تسجيل الدخول لمتابعة جهاز الصيانة الخاص بك لدينا
                            @else
                                Log in to follow up on your maintenance Device with us
                            @endif
                        </h2>
                        <div class="clearfix"></div>
                        <form class="text-center col-lg-6 col-sm-12 mx-auto justify-content-center"
                              action="{{route('receipt.page.login.post')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            اكتب رقم الهاتف الخاص بك
                                        @else
                                            Type your phone number
                                        @endif
                                         </label>
                                    <input required type="number" value="{{old('device_owner_phone')}}"
                                           class="form-control" name="device_owner_phone"/>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            اكتب رقم الفاتورة الخاصة بك
                                        @else
                                            Enter your invoice number
                                        @endif
                                        </label>
                                    <input required type="number" class="form-control" name="bill_id"
                                           value="{{old('bill_id')}}"/>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <button class="btn btn-md btn-danger text-white">
                                        <i class="fa fa-check text-white"></i>
                                        @if(App::getLocale() == 'ar')
                                            متابعة فاتورة جهاز الصيانة
                                        @else
                                            Follow up on the maintenance bill
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
