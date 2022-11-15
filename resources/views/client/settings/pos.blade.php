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
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered text-center table-hover"
                               id="example-table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        اسم الفرع
                                    @else
                                        Branch Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        محتوى شاشة نقطة البيع
                                    @else
                                        POS screen content
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الخزنة
                                    @else
                                        Safe Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        البنك
                                    @else
                                        Bank Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        تعديل
                                    @else
                                        Edit
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($pos_settings as $pos_setting)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $pos_setting->branch->branch_name }}</td>
                                    <td>
                                        @if($pos_setting->discount == "1")
                                            <i class="fa fa-check"></i>

                                            @if(App::getLocale() == 'ar')
                                                الخصم
                                            @else
                                                Discount
                                            @endif
                                            <br/>
                                        @endif

                                        @if($pos_setting->tax == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                ضريبة الطلب
                                            @else
                                                Taxes
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->suspension == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                تعليق الفاتورة
                                            @else
                                                Invoice suspension
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->payment == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                تسجيل الدفع
                                            @else
                                                Create Payment
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->print_save == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                حفظ وطباعة الفاتورة
                                            @else
                                                Save & Print Invoice
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->cancel == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                الغاء الفاتورة
                                            @else
                                                Cancel Invoice
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->suspension_tab == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                الفاتورة المعلقة سابقا
                                            @else
                                                Suspended Invoices
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->edit_delete_tab == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                تعديل وحذف الفواتير
                                            @else
                                                Edit - Delete Invoices
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->add_outer_client == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                اضافة عميل جديد
                                            @else
                                                Add New Client
                                            @endif
                                            <br/>
                                        @endif


                                        @if($pos_setting->add_product == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                اضافة منتج جديد
                                            @else
                                                Add New Product
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->fast_finish == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                زر دفع خزنة رئيسية وحفظ الفاتورة
                                            @else
                                                pay with main safe and save invoice
                                            @endif
                                            <br/>
                                        @endif
                                        @if($pos_setting->product_image == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                صورة المنتج
                                            @else
                                                Product Image
                                            @endif
                                            <br/>
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($pos_setting->safe_id))
                                            {{$pos_setting->safe->safe_name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($pos_setting->bank_id))
                                            {{$pos_setting->bank->bank_name}}
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('pos.settings.edit', $pos_setting->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
