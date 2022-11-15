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
    <div class="row">
        <div class="col-12">
            <p class="alert alert-danger alert-sm text-center">
                @if(App::getLocale() == 'ar')
                    اعدادات نقطة البيع
                @else
                    POS Settings
                @endif
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <form action="{{route('pos.settings.update')}}" method="POST">
                        @csrf
                        @method("PATCH")
                        <input type="hidden" name="pos_setting_id" value="{{$pos_setting->id}}"/>
                        <div class="col-lg-3 pull-right">
                            <div class="form-group">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        اسم الفرع
                                    @else
                                        Branch Name
                                    @endif
                                </label>
                                <select disabled name="branch_id" required class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر الفرع
                                        @else
                                            Choose Branch
                                        @endif
                                    </option>
                                    @foreach($branches as $branch)
                                        <option
                                            @if($pos_setting->branch_id == $branch->id)
                                            selected
                                            @endif
                                            value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 pull-right">
                            <div class="form-group">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        محتوى شاشة نقطة البيع
                                    @else
                                        POS screen content
                                    @endif
                                </label>
                                <select name="pos[]" required
                                        class="form-control selectpicker show-tick"
                                        data-style="btn-danger" multiple data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                    @endif>
                                    <option @if($pos_setting->discount == "1") selected @endif value="discount">
                                        @if(App::getLocale() == 'ar')
                                            الخصم
                                        @else
                                            Discount
                                        @endif
                                    </option>
                                    <option @if($pos_setting->tax == "1") selected @endif value="tax">
                                        @if(App::getLocale() == 'ar')
                                            ضريبة الطلب
                                        @else
                                            Taxes
                                        @endif
                                    </option>
                                    <option @if($pos_setting->suspension == "1") selected @endif value="suspension">
                                        @if(App::getLocale() == 'ar')
                                            تعليق الفاتورة
                                        @else
                                            Invoice suspension
                                        @endif
                                    </option>
                                    <option @if($pos_setting->payment == "1") selected @endif value="payment">
                                        @if(App::getLocale() == 'ar')
                                            تسجيل الدفع
                                        @else
                                            Create Payment
                                        @endif
                                    </option>
                                    <option @if($pos_setting->print_save == "1") selected @endif value="print_save">
                                        @if(App::getLocale() == 'ar')
                                            حفظ وطباعة الفاتورة
                                        @else
                                            Save & Print Invoice
                                        @endif
                                    </option>
                                    <option @if($pos_setting->cancel == "1") selected @endif value="cancel">
                                        @if(App::getLocale() == 'ar')
                                            الغاء الفاتورة
                                        @else
                                            Cancel Invoice
                                        @endif
                                    </option>
                                    <option @if($pos_setting->suspension_tab == "1") selected
                                            @endif value="suspension_tab">
                                        @if(App::getLocale() == 'ar')
                                            الفاتورة المعلقة سابقا
                                        @else
                                            Suspended Invoices
                                        @endif
                                    </option>
                                    <option @if($pos_setting->edit_delete_tab == "1") selected
                                            @endif value="edit_delete_tab">
                                        @if(App::getLocale() == 'ar')
                                            تعديل وحذف الفواتير
                                        @else
                                            Edit - Delete Invoices
                                        @endif
                                    </option>
                                    <option @if($pos_setting->add_outer_client == "1") selected
                                            @endif value="add_outer_client">
                                        @if(App::getLocale() == 'ar')
                                            اضافة عميل جديد
                                        @else
                                            Add New Client
                                        @endif
                                    </option>
                                    <option @if($pos_setting->add_product == "1") selected @endif value="add_product">
                                        @if(App::getLocale() == 'ar')
                                            اضافة منتج جديد
                                        @else
                                            Add New Product
                                        @endif
                                    </option>
                                    <option @if($pos_setting->fast_finish == "1") selected @endif value="fast_finish">زر
                                        @if(App::getLocale() == 'ar')
                                            زر دفع خزنة رئيسية وحفظ الفاتورة
                                        @else
                                            pay with main safe and save invoice
                                        @endif
                                    </option>
                                    <option @if($pos_setting->product_image == "1") selected
                                            @endif value="product_image">
                                        @if(App::getLocale() == 'ar')
                                            صورة المنتج
                                        @else
                                            Product Image
                                        @endif
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 pull-right">
                            <div class="form-group">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        الخزنة
                                    @else
                                        Safe Name
                                    @endif
                                </label>
                                <select name="safe_id" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر الخزنة
                                        @else
                                            Choose Safe
                                        @endif
                                    </option>
                                    @foreach($safes as $safe)
                                        <option
                                            @if($pos_setting->safe_id == $safe->id)
                                            selected
                                            @endif
                                            value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3 pull-right">
                            <div class="form-group">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        اختر البنك
                                    @else
                                        Choose Bank
                                    @endif
                                </label>
                                <select name="bank_id" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر البنك
                                        @else
                                            Choose Bank
                                        @endif
                                    </option>
                                    @foreach($banks as $bank)
                                        <option
                                            @if($pos_setting->bank_id == $bank->id)
                                            selected
                                            @endif
                                            value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center">
                            <button class="btn btn-md btn-success"
                                    style="font-size: 15px; margin-top: 25px;" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    تحديث
                                @else
                                    Update
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
