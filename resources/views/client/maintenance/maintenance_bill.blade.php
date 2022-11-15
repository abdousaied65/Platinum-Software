@extends('client.layouts.app-pos')
<style>
    .form-control {
        height: 30px !important;
        border-radius: 0px !important;
    }

    .no-border-radius {
        border-radius: 0 !important;
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

    .btn-main {
        margin: 5px auto;
        text-shadow: 0px 0px 7px #000;
        width: 80% !important;
        height: 80px !important;
        font-size: 13px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
    }
</style>
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>@if(App::getLocale() == 'ar')
                    الاخطاء :
                @else
                    Errors :
                @endif</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row" style=" min-height: 100%!important">
        <div class="col-md-12">
            <div class="card" style="padding:0!important;margin: 0!important; min-height: 100%!important;">
                <div class="card-body" style="padding:0!important;margin: 0!important;">
                    <h2 style="min-width: 300px;font-size: 17px!important;border-radius: 0;
                    padding: 5px!important;color: #fff!important;"
                        class="alert alert-sm alert-info text-center mt-0 p-0">
                        @if(App::getLocale() == 'ar')
                            فاتورة صيانة
                        @else
                            Maintenance Bill
                        @endif
                    </h2>
                    <div class="clearfix"></div>
                    <form>
                        <input type="hidden" id="company_id" name="company_id" value="{{$company_id}}"/>
                        <div class="col-lg-6 pull-right"
                             style="border-left: 1px solid #444;min-height: 100%!important;">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group d-inline">
                                        <label class="d-block">
                                            @if(App::getLocale() == 'ar')
                                                رقم الايصال
                                            @else
                                                Receipt Number
                                            @endif
                                        </label>
                                        <select required name="maintenance_device_id"
                                                id="maintenance_device_id" class="form-control d-inline">
                                            <option value="">
                                                @if(App::getLocale() == 'ar')
                                                    اختر رقم الايصال
                                                @else
                                                    Choose Receipt Number
                                                @endif
                                            </option>
                                            @foreach($maintenance_devices as $device)
                                                <option
                                                    @if(isset($maintenance_device) && $maintenance_device->id == $device->id)
                                                    selected
                                                    @endif
                                                    value="{{$device->id}}">{{$device->receipt_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group d-inline ml-1">
                                        <label class="d-block">
                                            @if(App::getLocale() == 'ar')
                                                اسم العميل
                                            @else
                                                Client Name
                                            @endif
                                        </label>
                                        <input readonly dir="rtl" required
                                               class="form-control d-inline"
                                               @if(isset($maintenance_device)) value="{{$maintenance_device->device_owner_name}}"
                                               @endif
                                               name="device_owner_name" type="text">
                                    </div>

                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group d-inline ml-1">
                                        <label class="d-block">
                                            @if(App::getLocale() == 'ar')
                                                هاتف العميل
                                            @else
                                                Client Phone
                                            @endif
                                        </label>
                                        <input readonly dir="ltr" required
                                               class="form-control d-inline"
                                               @if(isset($maintenance_device)) value="{{$maintenance_device->device_owner_phone}}"
                                               @endif
                                               name="device_owner_phone" type="number">
                                    </div>

                                </div>

                            </div>
                            <div class="row mt-1">
                                <div class="col-lg-5">
                                    <table>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        اسم الجهاز
                                                    @else
                                                        Device Name
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <input readonly dir="rtl" required class="form-control"
                                                       name="device_name"
                                                       @if(isset($maintenance_device)) value="{{$maintenance_device->device_name}}"
                                                       @endif
                                                       type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        نوع الجهاز
                                                    @else
                                                        Device Type
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <select readonly class="form-control" name="device_type"
                                                        id="device_type">
                                                    <option value="">
                                                        @if(App::getLocale() == 'ar')
                                                            اختر نوع الجهاز
                                                        @else
                                                            Choose Device Type
                                                        @endif
                                                    </option>
                                                    @foreach($devices_types as $device_type)
                                                        <option
                                                            @if(isset($maintenance_device) && $maintenance_device->device_type == $device_type->id)
                                                            selected
                                                            @endif
                                                            value="{{$device_type->id}}">{{$device_type->device_type}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        سيريال الجهاز
                                                    @else
                                                        Device Serial
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <input readonly dir="ltr" required class="form-control"
                                                       name="device_serial"
                                                       @if(isset($maintenance_device)) value="{{$maintenance_device->device_serial}}"
                                                       @endif
                                                       type="text">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        مشكلة الجهاز
                                                    @else
                                                        Device Issue
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <select readonly class="form-control" name="device_type"
                                                        id="device_type">
                                                    <option value="">
                                                        @if(App::getLocale() == 'ar')
                                                            اختر مشكلة الجهاز
                                                        @else
                                                            Choose Device Issue
                                                        @endif
                                                    </option>
                                                    @foreach($devices_issues as $device_issue)
                                                        <option
                                                            @if(isset($maintenance_device) && $maintenance_device->device_issue == $device_issue->id)
                                                            selected
                                                            @endif
                                                            value="{{$device_issue->id}}">{{$device_issue->issue}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        التاريخ المتوقع للتسليم
                                                    @else
                                                        Expected Delivery Date
                                                    @endif
                                                    <span
                                                        class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <input readonly dir="ltr" required class="form-control"
                                                       name="expected_delivery_date"
                                                       @if(isset($maintenance_device)) value="{{$maintenance_device->expected_delivery_date}}"
                                                       @endif
                                                       type="date">
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="form-group mb-0">
                                        <label>
                                            @if(App::getLocale() == 'ar')
                                                شكوى العميل
                                            @else
                                                Client Complain
                                            @endif
                                        </label>
                                        <textarea readonly
                                                  style="resize: none; width: 100%; height: 80px!important; border-radius: 5px;"
                                                  name="owner_complain" dir="rtl"
                                                  class="form-control">@if(isset($maintenance_device)){{$maintenance_device->owner_complain}}@endif</textarea>
                                    </div>
                                    <table class="mt-0">
                                        <tr>
                                            <td width="45%">
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        التكلفة التقريبية
                                                    @else
                                                        approximate cost
                                                    @endif
                                                    <span class="text-danger">*</span>
                                                </label>
                                            <td width="55%">
                                                <input readonly dir="ltr" required class="form-control"
                                                       @if(isset($maintenance_device)) value="{{$maintenance_device->approximate_cost}}"
                                                       @endif
                                                       name="approximate_cost" type="number">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="45%">
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        ملاحظات
                                                    @else
                                                        Notes
                                                    @endif
                                                </label>
                                            </td>
                                            <td width="55%">
                                                <input readonly dir="rtl" class="form-control" name="notes" type="text"
                                                       @if(isset($maintenance_device)) value="{{$maintenance_device->notes}}"
                                                    @endif
                                                >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        الضمان
                                                    @else
                                                        warranty
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <select readonly required name="warranty" class="form-control">
                                                    <option
                                                        @if(isset($maintenance_device) && $maintenance_device->warranty == "1")
                                                        selected
                                                        @endif
                                                        value="1">
                                                        @if(App::getLocale() == 'ar')
                                                            نعم
                                                        @else
                                                            Yes
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(isset($maintenance_device) && $maintenance_device->warranty == "0")
                                                        selected
                                                        @endif
                                                        value="0">
                                                        @if(App::getLocale() == 'ar')
                                                            لا
                                                        @else
                                                            No
                                                        @endif
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        فترة الضمان باليوم
                                                    @else
                                                        warranty Period in Days
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <input readonly required name="warranty_period" type="number"
                                                       @if(isset($maintenance_device)) value="{{$maintenance_device->warranty_period}}"
                                                       @endif
                                                       class="form-control"/>
                                            </td>
                                        </tr>
                                    </table>
                                    <table class="mt-1 table-bordered text-center w-100">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>
                                                @if(App::getLocale() == 'ar')
                                                    اجمالى الفاتورة
                                                @else
                                                    Bill Total
                                                @endif
                                            </th>
                                            <th>
                                                @if(App::getLocale() == 'ar')
                                                    اجمالى الصيانة
                                                @else
                                                    Maintenance Total
                                                @endif
                                            </th>
                                            <th>
                                                @if(App::getLocale() == 'ar')
                                                    المبلغ المطلوب
                                                @else
                                                    Deserved Amount
                                                @endif
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <span id="bill_total">
                                                    @if(!empty($maintenance_bill))
                                                        @if($maintenance_bill->spare_parts_cost == "0")
                                                            {{$maintenance_bill->repair_cost}}
                                                        @else
                                                            {{$maintenance_bill->spare_parts_cost}}
                                                        @endif
                                                    @else
                                                        0
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span id="maintenance_total">
                                                    @if(!empty($maintenance_bill))
                                                        @if($maintenance_bill->maintenance_cost == "0")
                                                            {{$maintenance_bill->delegate_cost}}
                                                        @else
                                                            {{$maintenance_bill->maintenance_cost}}
                                                        @endif
                                                    @else
                                                        0
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span id="final_total">
                                                    @if(!empty($maintenance_bill))
                                                        {{$maintenance_bill->total_cost}}
                                                    @else
                                                        0
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-lg-7">
                                    <table class="w-100 ">
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        اختر المهندس
                                                    @else
                                                        Choose Engineer
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <select required name="engineer_id" id="engineer_id"
                                                        class="form-control">
                                                    <option value="">
                                                        @if(App::getLocale() == 'ar')
                                                            اختر مهندس الصيانة
                                                        @else
                                                            Choose Maintenance Engineer
                                                        @endif
                                                    </option>
                                                    @foreach($engineers as $engineer)
                                                        <option
                                                            @if(!empty($maintenance_bill) && $maintenance_bill->engineer_id == $engineer->id)
                                                            selected
                                                            @endif
                                                            value="{{$engineer->id}}">{{$engineer->name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        تقييم المهندس
                                                    @else
                                                        Engineer Evaluation
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <select required name="engineer_evaluation" class="form-control">
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->engineer_evaluation == "لم يوافق")
                                                        selected
                                                        @endif
                                                        value="لم يوافق">
                                                        @if(App::getLocale() == 'ar')
                                                            لم يوافق
                                                        @else
                                                            Refused
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->engineer_evaluation == "ليس له حل")
                                                        selected
                                                        @endif
                                                        value="ليس له حل">
                                                        @if(App::getLocale() == 'ar')
                                                            ليس له حل
                                                        @else
                                                            has no solution
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->engineer_evaluation == "تم التصليح")
                                                        selected
                                                        @endif
                                                        value="تم التصليح">
                                                        @if(App::getLocale() == 'ar')
                                                            تم التصليح
                                                        @else
                                                            Fixed
                                                        @endif
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>
                                                    @if(App::getLocale() == 'ar')
                                                        نوع الصيانة
                                                    @else
                                                        Maintenance Type
                                                    @endif
                                                    <span class="text-danger">*</span></label>
                                            </td>
                                            <td>
                                                <select required name="maintenance_type" id="maintenance_type"
                                                        class="form-control">
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->maintenance_type == "داخلية")
                                                        selected
                                                        @endif
                                                        value="داخلية">
                                                        @if(App::getLocale() == 'ar')
                                                            داخلية
                                                        @else
                                                            Internal
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->maintenance_type == "خارجية")
                                                        selected
                                                        @endif
                                                        value="خارجية">
                                                        @if(App::getLocale() == 'ar')
                                                            خارجية
                                                        @else
                                                            External
                                                        @endif
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="internal @if(!empty($maintenance_bill) && $maintenance_bill->maintenance_type == "خارجية") hidden @endif">
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    تكلفة قطع الغيار
                                                @else
                                                    Spare Parts Cost
                                                @endif
                                            </td>
                                            <td>
                                                <input readonly required name="spare_parts_cost" dir="ltr"
                                                       @if(!empty($maintenance_bill))
                                                       value="{{$maintenance_bill->spare_parts_cost}}"
                                                       @else
                                                       value="0"
                                                       @endif
                                                       type="number" class="form-control"/>
                                            </td>
                                        </tr>
                                        <tr class="internal @if(!empty($maintenance_bill) && $maintenance_bill->maintenance_type == "خارجية") hidden @endif">
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    تكلفة الصيانة
                                                @else
                                                    Maintenance Cost
                                                @endif
                                            </td>
                                            <td>
                                                <input required name="maintenance_cost" dir="ltr"
                                                       @if(!empty($maintenance_bill))
                                                       value="{{$maintenance_bill->maintenance_cost}}"
                                                       @else
                                                       value="0"
                                                       @endif
                                                       type="number" class="form-control"/>
                                            </td>
                                        </tr>
                                        <tr class="external @if(empty($maintenance_bill) || $maintenance_bill->maintenance_type == "داخلية") hidden @endif">
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    اسم المندوب
                                                @else
                                                    Delegate Name
                                                @endif
                                            </td>
                                            <td>
                                                <select name="delegate_name" class="form-control">
                                                    <option value="">
                                                        @if(App::getLocale() == 'ar')
                                                            اختر المندوب
                                                        @else
                                                            Choose Delegate
                                                        @endif
                                                    </option>
                                                    @foreach($delegates as $delegate)
                                                        <option
                                                            @if(!empty($maintenance_bill) && $maintenance_bill->delegate_name == $delegate->id)
                                                            selected
                                                            @endif
                                                            value="{{$delegate->id}}">{{$delegate->delegate_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="external @if(empty($maintenance_bill) || $maintenance_bill->maintenance_type == "داخلية") hidden @endif">
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    مكان الاصلاح
                                                @else
                                                    Maintenance Place
                                                @endif
                                            </td>
                                            <td>
                                                <select name="maintenance_place" class="form-control">
                                                    <option value="">
                                                        @if(App::getLocale() == 'ar')
                                                            اختر مكان الاصلاح
                                                        @else
                                                            Choose Maintenance Place
                                                        @endif
                                                    </option>
                                                    @foreach($maintenance_places as $maintenance_place)
                                                        <option
                                                            @if(!empty($maintenance_bill) && $maintenance_bill->maintenance_place == $maintenance_place->id)
                                                            selected
                                                            @endif
                                                            value="{{$maintenance_place->id}}">{{$maintenance_place->place_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr class="external @if(empty($maintenance_bill) || $maintenance_bill->maintenance_type == "داخلية") hidden @endif">
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    تكلفة الاصلاح
                                                @else
                                                    Repair Cost
                                                @endif
                                            </td>
                                            <td>
                                                <input name="repair_cost" dir="ltr"
                                                       @if(!empty($maintenance_bill))
                                                       value="{{$maintenance_bill->repair_cost}}"
                                                       @else
                                                       value="0"
                                                       @endif
                                                       type="number" class="form-control"/>
                                            </td>
                                        </tr>
                                        <tr class="external @if(empty($maintenance_bill) || $maintenance_bill->maintenance_type == "داخلية") hidden @endif">
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    تكلفة المندوب
                                                @else
                                                    Delegate Cost
                                                @endif
                                            </td>
                                            <td>
                                                <input name="delegate_cost" dir="ltr"
                                                       @if(!empty($maintenance_bill))
                                                       value="{{$maintenance_bill->delegate_cost}}"
                                                       @else
                                                       value="0"
                                                       @endif
                                                       type="number" class="form-control"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    اجمالى مع الضريبة
                                                @else
                                                    Total includes VAT
                                                @endif
                                            </td>
                                            <td>
                                                <input readonly required name="total_cost" dir="ltr"
                                                       @if(!empty($maintenance_bill))
                                                       value="{{$maintenance_bill->total_cost}}"
                                                       @else
                                                       value="0"
                                                       @endif
                                                       type="number" class="form-control"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    موافقة العميل على المبلغ
                                                @else
                                                    Customer approval of the amount
                                                @endif
                                            </td>
                                            <td>
                                                <select required name="owner_approval" class="form-control">
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->owner_approval == "موافق")
                                                        selected
                                                        @endif
                                                        value="موافق">
                                                        @if(App::getLocale() == 'ar')
                                                            موافق
                                                        @else
                                                            Accepted
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->owner_approval == "غير موافق")
                                                        selected
                                                        @endif
                                                        value="غير موافق">
                                                        @if(App::getLocale() == 'ar')
                                                            غير موافق
                                                        @else
                                                            Refused
                                                        @endif
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    حالة الجهاز
                                                @else
                                                    Device Status
                                                @endif
                                            </td>
                                            <td>
                                                <select required name="status" class="form-control">
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->status == "تم الاستلام من العميل")
                                                        selected
                                                        @endif
                                                        value="تم الاستلام من العميل">
                                                        @if(App::getLocale() == 'ar')
                                                            تم الاستلام من العميل
                                                        @else
                                                            Received From Customer
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->status == "فى انتظار التسليم")
                                                        selected
                                                        @endif
                                                        value="فى انتظار التسليم">
                                                        @if(App::getLocale() == 'ar')
                                                            فى انتظار التسليم
                                                        @else
                                                            Waiting for delivery
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->status == "فى مرحلة الكشف")
                                                        selected
                                                        @endif
                                                        value="فى مرحلة الكشف">
                                                        @if(App::getLocale() == 'ar')
                                                            فى مرحلة الكشف
                                                        @else
                                                            In the detection stage
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->status == "فى انتظار موافقة العميل")
                                                        selected
                                                        @endif
                                                        value="فى انتظار موافقة العميل">
                                                        @if(App::getLocale() == 'ar')
                                                            فى انتظار موافقة العميل
                                                        @else
                                                            Waiting for customer approval
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->status == "فى انتظار قطع الغيار")
                                                        selected
                                                        @endif
                                                        value="فى انتظار قطع الغيار">
                                                        @if(App::getLocale() == 'ar')
                                                            فى انتظار قطع الغيار
                                                        @else
                                                            Waiting for spare parts
                                                        @endif
                                                    </option>
                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->status == "العميل غير موافق على التكلفة ورفض الاستلام")
                                                        selected
                                                        @endif
                                                        value="العميل غير موافق على التكلفة ورفض الاستلام">
                                                        @if(App::getLocale() == 'ar')
                                                            العميل غير موافق على التكلفة ورفض الاستلام
                                                        @else
                                                            The customer does not agree to the cost and refuses to
                                                            receive
                                                        @endif
                                                    </option>

                                                    <option
                                                        @if(!empty($maintenance_bill) && $maintenance_bill->status == "تم التسليم الى العميل")
                                                        selected
                                                        @endif
                                                        value="تم التسليم الى العميل">
                                                        @if(App::getLocale() == 'ar')
                                                            تم التسليم الى العميل
                                                        @else
                                                            Delivered to the customer
                                                        @endif
                                                    </option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if(App::getLocale() == 'ar')
                                                    ملاحظات مع الفاتورة
                                                @else
                                                    Notes For The bill
                                                @endif
                                            </td>
                                            <td>
                                                <textarea name="notes_bill" class="form-control" id="notes"
                                                          style="width: 100%!important;resize: none; height: 100px!important;">@if(!empty($maintenance_bill)){{$maintenance_bill->notes}}@endif</textarea>
                                            </td>
                                        </tr>
                                    </table>

                                    <table class="mt-5 table-bordered text-center w-100">
                                        <thead class="bg-primary text-white">
                                        <tr>
                                            <th>
                                                @if(App::getLocale() == 'ar')
                                                    المبلغ المدفوع
                                                @else
                                                    Paid Amount
                                                @endif
                                            </th>
                                            <th>
                                                @if(App::getLocale() == 'ar')
                                                    نسبة المهندس
                                                @else
                                                    Engineer Percentage
                                                @endif
                                            </th>
                                            <th>
                                                @if(App::getLocale() == 'ar')
                                                    صافى الربح
                                                @else
                                                    Profits
                                                @endif
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>0</td>
                                            <td>
                                                <span id="engineer_percent">
                                                    <?php
                                                    if (!empty($maintenance_bill) && !empty($maintenance_bill->engineer_id)) {
                                                        $engineer = \App\Models\Engineer::FindOrFail($maintenance_bill->engineer_id);
                                                        $commission_rate = $engineer->commission_rate;
                                                        $MaintenanceBill = \App\Models\MaintenanceBill::where('bill_id', $maintenance_bill->bill_id)->first();
                                                        if (empty($MaintenanceBill)) {
                                                            $engineer_percent = 0;
                                                        } else {
                                                            if ($MaintenanceBill->maintenance_cost == "0") {
                                                                $cost = $MaintenanceBill->delegate_cost;
                                                            } else {
                                                                $cost = $MaintenanceBill->maintenance_cost;
                                                            }
                                                            $engineer_percent = $commission_rate / 100 * $cost;
                                                        }
                                                    } else {
                                                        $engineer_percent = 0;
                                                    }
                                                    ?>
                                                    {{$engineer_percent}}
                                                </span>
                                            </td>
                                            <td>0</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 pull-left">
                            <table>
                                <tr>
                                    <td style="width: 80px!important;text-align: center">
                                        @if(App::getLocale() == 'ar')
                                            رقم الفاتورة
                                        @else
                                            Bill Number
                                        @endif
                                    </td>
                                    <td>
                                        <input readonly dir="ltr" type="number" id="bill_id" name="bill_id"
                                               class="form-control"
                                               value="{{$bill_id}}"/>
                                    </td>
                                    <td style="width: 50px!important;text-align: center">
                                        @if(App::getLocale() == 'ar')
                                            التاريخ
                                        @else
                                            Date
                                        @endif
                                    </td>
                                    <td>
                                        <input type="date" id="date" name="date" class="form-control"
                                               @if(!empty($maintenance_bill))
                                               value="{{$maintenance_bill->date}}"
                                               @else
                                               value="{{date('Y-m-d')}}"
                                            @endif
                                        />
                                    </td>
                                    <td style="width: 80px!important;text-align: center">
                                        @if(App::getLocale() == 'ar')
                                            اختر المخزن
                                        @else
                                            Choose Store
                                        @endif
                                    </td>
                                    <td>
                                        <select name="store_id" id="store_id" class="form-control">
                                            <option value="">
                                                @if(App::getLocale() == 'ar')
                                                    كل المخازن
                                                @else
                                                    All Stores
                                                @endif
                                            </option>
                                            @foreach($stores as $store)
                                                <option value="{{$store->id}}">{{$store->store_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <h4 class="text-center bg-cyan text-white" style="padding: 10px;">
                                @if(App::getLocale() == 'ar')
                                    تفاصيل فاتورة الصيانة ( بيانات قطع الغيار )
                                @else
                                    Maintenance invoice details (spare parts data)
                                @endif
                            </h4>
                            <hr>
                            <table style="width: 100%!important;">
                                <tr>
                                    <td style="width: 40%!important;">
                                        <label class="d-block" for="">
                                            @if(App::getLocale() == 'ar')
                                                بيانات المنتج
                                            @else
                                                Product Details
                                            @endif
                                            <span class="available"></span>
                                        </label>
                                        <select data-live-search="true"
                                                @if(App::getLocale() == 'ar')
                                                data-title="ابحث"
                                                @else
                                                data-title="Search"
                                                @endif
                                                data-style="btn-dark"
                                                class="form-control selectpicker show-tick d-block"
                                                name="product_id"
                                                id="product_id">
                                            @foreach($products as $product)
                                                <option value="{{$product->id}}"
                                                        data-tokens="{{$product->code_universal}}">{{$product->product_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 15%!important;">
                                        <label class="d-block" for="">
                                            @if(App::getLocale() == 'ar')
                                                الكمية
                                            @else
                                                Quantity
                                            @endif
                                        </label>
                                        <input dir="ltr" style="width: 100%!important;height: 40px!important;"
                                               type="number" name="quantity"
                                               id="quantity" class="form-control" min="1"/>
                                    </td>
                                    <td style="width: 15%!important;">
                                        <label class="d-block" for="">
                                            @if(App::getLocale() == 'ar')
                                                السعر
                                            @else
                                                Price
                                            @endif
                                        </label>
                                        <input dir="ltr" style="width: 100%!important;height: 40px!important;"
                                               type="number" name="product_price"
                                               id="product_price" class="form-control" min="1"/>
                                    </td>
                                    <td style="width: 15%!important;">
                                        <label class="d-block" for="">
                                            @if(App::getLocale() == 'ar')
                                                الاجمالى
                                            @else
                                                total
                                            @endif
                                        </label>
                                        <input dir="ltr" style="width: 100%!important;height: 40px!important;"
                                               type="number" name="quantity_price"
                                               id="quantity_price" class="form-control" min="1"/>
                                    </td>
                                    <td style="width: 15%!important;text-align: center">
                                        <button id="add" style="margin-top: 25px!important;height: 40px!important;"
                                                class="btn btn-md btn-info no-border-radius" type="button">
                                            <i class="fa fa-arrow-down" style="font-size: 17px!important;"></i>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                            <div class="table-responsive"
                                 style=" border:1px solid darkcyan;height: 270px; overflow:auto !important;">
                                <table class="text-center w-100 table-bordered">
                                    <thead style="background: darkcyan;">
                                    <tr style="padding: 10px!important;height: 30px!important;">
                                        <th style="text-align: center;color: #fff!important;">
                                            @if(App::getLocale() == 'ar')
                                                المنتج
                                            @else
                                                Product
                                            @endif
                                        </th>
                                        <th style="text-align: center;color: #fff!important;">
                                            @if(App::getLocale() == 'ar')
                                                السعر
                                            @else
                                                Price
                                            @endif
                                        </th>
                                        <th style="text-align: center;color: #fff!important;">
                                            @if(App::getLocale() == 'ar')
                                                الكمية
                                            @else
                                                Quantity
                                            @endif
                                        </th>
                                        <th style="text-align: center;color: #fff!important;">
                                            @if(App::getLocale() == 'ar')
                                                اجمالى
                                            @else
                                                Total
                                            @endif
                                        </th>
                                        <th style="text-align: center;color: #fff!important;">
                                            <i class="fa fa-trash" style="font-size: 20px!important;"></i>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody class="bill_details">
                                    <?php
                                    if (!empty($maintenance_bill)) {
                                        $elements = \App\Models\MaintenanceBillElement::where('maintenance_bill_id', $maintenance_bill->id)->get();
                                        if (!$elements->isEmpty()) {
                                            $i = 0;
                                            foreach ($elements as $element) {
                                                echo "<tr>";
                                                echo "<td>" . $element->product->product_name . "</td>";
                                                echo "<td>" . $element->product_price . "</td>";
                                                echo "<td>" . $element->quantity . "</td>";
                                                echo "<td>" . $element->quantity_price . "</td>";
                                                echo "<td class='no-print'>
                                                    <button type='button' bill_id='" . $element->MaintenanceBill->bill_id . "' element_id='" . $element->id . "' class='btn btn-sm btn-danger remove_element'>
                                                        <i class='fa fa-trash'></i>
                                                    </button>
                                                </td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-3" style="padding: 0;">
                                    <div class=" btn-block">
                                        <button type="button"
                                                class="btn btn-info btn-block btn-main no-border-radius save_btn"
                                                tabindex="-1">
                                            <i class="fa fa-save" style="margin-left: 5px;"></i>
                                            @if(App::getLocale() == 'ar')
                                                حفظ الفاتورة
                                            @else
                                                Save The Bill
                                            @endif
                                        </button>
                                    </div>
                                </div>

                                <div class="col-lg-3" style="padding: 0;">
                                    <div class="btn-block">
                                        <button type="button" id="close_btn"
                                                class="btn btn-danger btn-block btn-flat modal-effect btn-main no-border-radius">
                                            <i class="fa fa-close" style="margin-left: 5px;"></i>
                                            @if(App::getLocale() == 'ar')
                                                الغاء
                                            @else
                                                Cancel
                                            @endif
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 p-1">
                                    <div class="message alert alert-success" style="display: none;">
                                        <span>
                                            @if(App::getLocale() == 'ar')
                                                تم حفظ التغييرات
                                            @else
                                                All Changes Saved
                                            @endif
                                             </span>
                                    </div>
                                </div>
                            </div>

                            <button type="button" onclick="window.open('{{route('client.home')}}','_self')"
                                    class="btn btn-md btn-danger pull-left ml-2 no-border-radius">
                                @if(App::getLocale() == 'ar')
                                    العودة الى الصفحة الرئيسية
                                @else
                                    Back To Dashboard
                                @endif
                            </button>
                            <button onclick="window.open('{{route('maintenance.devices')}}','_self')"
                                    class="btn btn-md btn-info pull-left no-border-radius"
                                    style="margin-right: 200px!important;" type="button">
                                @if(App::getLocale() == 'ar')
                                    العودة الى الاجهزة المستلمة
                                @else
                                    Back To Received Devices
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#maintenance_type').on('change', function () {
            let maintenance_type = $(this).val();
            if (maintenance_type == "داخلية") {
                $('.internal').removeClass('hidden');
                $('.external').addClass('hidden');
            } else {
                $('.external').removeClass('hidden');
                $('.internal').addClass('hidden');
            }
        });
        $('#maintenance_device_id').on('change', function () {
            let maintenance_device_id = $(this).val();
            location.href = "/client/maintenance-bill-create/" + maintenance_device_id;
        });
        $('#store_id').on('change', function () {
            let store_id = $(this).val();
            if (store_id != "" || store_id != "0") {
                $('.options').fadeIn(200);
                $.post("{{url('/client/sale-bills/getProducts')}}", {
                    store_id: store_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('select#product_id').html(data);
                    $('select#product_id').selectpicker('refresh');
                });
            } else {
                $('.options').fadeOut(200);
            }
        });
        $('#product_id').on('change', function () {
            $('#quantity').val('');
            let product_id = $(this).val();
            $.post("{{url('/client/maintenance-bills/get')}}", {
                product_id: product_id,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $('input#product_price').val(data.sector_price);
                $('input#quantity').val('1').attr('max', data.first_balance);
                @if(App::getLocale() == 'ar')
                $('.available').html('( الكمية المتاحة : ' + data.first_balance + ' ) ');
                @else
                $('.available').html('( Available Quantity : ' + data.first_balance + ' ) ');
                @endif
                $('input#quantity_price').val(data.sector_price);
            });
        });
        $('#quantity').on('keyup change', function () {
            let product_price = $('#product_price').val();
            let quantity = $(this).val();
            let quantity_price = quantity * product_price;
            $('#quantity_price').val(quantity_price);
        });
        $('#product_price').on('keyup change', function () {
            let product_id = $('#product_id').val();
            let product_price = $(this).val();
            let quantity = $('#quantity').val();
            let quantity_price = quantity * product_price;
            $('#quantity_price').val(quantity_price);
        });
        $('#add').on('click', function () {
            let bill_id = $('#bill_id').val();
            let date = $('#date').val();
            let company_id = $("[name*='company_id']").val();
            let status = $("[name*='status']").val();
            let maintenance_device_id = $("select[name*='maintenance_device_id']").val();
            let engineer_id = $("[name*='engineer_id']").val();
            let engineer_evaluation = $("[name*='engineer_evaluation']").val();
            let maintenance_type = $("[name*='maintenance_type']").val();
            let spare_parts_cost = $("[name*='spare_parts_cost']").val();
            let maintenance_cost = $("[name*='maintenance_cost']").val();
            let total_cost = $("[name*='total_cost']").val();
            let delegate_name = $("[name*='delegate_name']").val();
            let maintenance_place = $("[name*='maintenance_place']").val();
            let repair_cost = $("[name*='repair_cost']").val();
            let delegate_cost = $("[name*='delegate_cost']").val();
            let owner_approval = $("[name*='owner_approval']").val();
            let notes = $("[name*='notes_bill']").val();
            let product_id = $('#product_id').val();
            let product_price = $('#product_price').val();
            let quantity = $('#quantity').val();
            let quantity_price = quantity * product_price;
            let first_balance = parseFloat($('#quantity').attr('max'));
            if (maintenance_device_id == "") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار رقم الايصال أولا");
                @else
                alert("You must choose the receipt number first");
                @endif
            } else if (engineer_id == "") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار مهندس الصيانة أولا");
                @else
                alert("You must choose a maintenance engineer first");
                @endif
            } else if (product_id == "" || product_id <= "0") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار المنتج أولا");
                @else
                alert("You must choose the product first");
                @endif
            } else if (product_price == "" || product_price == "0") {
                @if(App::getLocale() == 'ar')
                alert("لم يتم اختيار سعر المنتج");
                @else
                alert("product price is not chosen");
                @endif
            } else if (quantity == "" || quantity <= "0" || quantity > first_balance) {
                @if(App::getLocale() == 'ar')
                alert("الكمية غير مناسبة");
                @else
                alert("quantity is not correct");
                @endif
            } else if (quantity_price == "" || quantity_price == "0") {
                @if(App::getLocale() == 'ar')
                alert("الكمية غير مناسبة او الاجمالى غير صحيح");
                @else
                alert("quantity is not suitable or total is not correct");
                @endif
            } else {
                $.post("{{url('/client/maintenance-bills/post')}}", {
                    bill_id: bill_id,
                    product_id: product_id,
                    product_price: product_price,
                    quantity: quantity,
                    quantity_price: quantity_price,
                    date: date,
                    company_id: company_id,
                    status: status,
                    maintenance_device_id: maintenance_device_id,
                    engineer_id: engineer_id,
                    engineer_evaluation: engineer_evaluation,
                    maintenance_type: maintenance_type,
                    spare_parts_cost: spare_parts_cost,
                    maintenance_cost: maintenance_cost,
                    total_cost: total_cost,
                    delegate_name: delegate_name,
                    maintenance_place: maintenance_place,
                    repair_cost: repair_cost,
                    delegate_cost: delegate_cost,
                    owner_approval: owner_approval,
                    notes: notes,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('#product_id').val('').selectpicker('refresh');
                    $('.pay_btn').attr('disabled', false);
                    $('.save_btn').removeClass('disabled');
                    $('.available').html("");
                    $('#product_price').val('0');
                    $('#quantity').val('');
                    $('#quantity_price').val('');
                    $.post('/client/maintenance-bills/refresh',
                        {"_token": "{{ csrf_token() }}", bill_id: bill_id},
                        function (proto) {
                            $("[name*='spare_parts_cost']").val(proto.total).trigger('change');
                            $('#bill_total').html(proto.total);
                            $.post("{{url('/client/maintenance-bills/elements')}}",
                                {"_token": "{{ csrf_token() }}", bill_id: bill_id},
                                function (elements) {
                                    $('.bill_details').html(elements);
                                });
                        });
                });
            }
        });

        $('.remove_element').on('click', function () {
            let element_id = $(this).attr('element_id');
            let bill_id = $(this).attr('bill_id');
            $.post('/client/maintenance-bills/element/delete',
                {'_token': "{{ csrf_token() }}", element_id: element_id},
                function (data) {
                    $.post('/client/maintenance-bills/elements',
                        {'_token': "{{ csrf_token() }}", bill_id: bill_id},
                        function (elements) {
                            $('.bill_details').html(elements);
                        });
                    $.post('/client/maintenance-bills/refresh',
                        {"_token": "{{ csrf_token() }}", bill_id: bill_id},
                        function (proto) {
                            $('#bill_total').html(proto.total);
                            $("[name*='spare_parts_cost']").val(proto.total).trigger('change');
                        });
                });
            $(this).parent().parent().fadeOut(300);

        });
        $('.save_btn').on('click', function () {
            let bill_id = $('#bill_id').val();
            let date = $('#date').val();
            let company_id = $("[name*='company_id']").val();
            let status = $("[name*='status']").val();
            let maintenance_device_id = $("select[name*='maintenance_device_id']").val();
            let engineer_id = $("[name*='engineer_id']").val();
            let engineer_evaluation = $("[name*='engineer_evaluation']").val();
            let maintenance_type = $("[name*='maintenance_type']").val();
            let spare_parts_cost = $("[name*='spare_parts_cost']").val();
            let maintenance_cost = $("[name*='maintenance_cost']").val();
            let total_cost = $("[name*='total_cost']").val();
            let delegate_name = $("[name*='delegate_name']").val();
            let maintenance_place = $("[name*='maintenance_place']").val();
            let repair_cost = $("[name*='repair_cost']").val();
            let delegate_cost = $("[name*='delegate_cost']").val();
            let owner_approval = $("[name*='owner_approval']").val();
            let notes = $("[name*='notes_bill']").val();
            let payment_method = $('#payment_method').val();
            if (maintenance_device_id == "") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار رقم الايصال أولا");
                @else
                alert("You must choose the receipt number first");
                @endif
            } else if (engineer_id == "") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار مهندس الصيانة أولا");
                @else
                alert("You must choose a maintenance engineer first");
                @endif
            } else {
                $.post("{{url('/client/maintenance-bills/saveAll')}}", {
                    bill_id: bill_id,
                    date: date,
                    company_id: company_id,
                    status: status,
                    maintenance_device_id: maintenance_device_id,
                    engineer_id: engineer_id,
                    engineer_evaluation: engineer_evaluation,
                    maintenance_type: maintenance_type,
                    spare_parts_cost: spare_parts_cost,
                    maintenance_cost: maintenance_cost,
                    total_cost: total_cost,
                    delegate_name: delegate_name,
                    maintenance_place: maintenance_place,
                    repair_cost: repair_cost,
                    delegate_cost: delegate_cost,
                    owner_approval: owner_approval,
                    notes: notes,
                    payment_method: payment_method,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('.message').fadeIn(500).delay(2000).fadeOut(500);
                });
            }
        });
        $('#close_btn').on('click', function () {
            let bill_id = $('#bill_id').val();
            $.post('/client/maintenance-bills/delete-bill',
                {'_token': "{{ csrf_token() }}", bill_id: bill_id},
                function (data) {
                    location.href = "/client/maintenance-bill-create";
                });
        });
        $('[name*="repair_cost"],[name*="delegate_cost"]').on('keyup change blur', function () {
            let repair_cost = $('[name*="repair_cost"]').val();
            let delegate_cost = $('[name*="delegate_cost"]').val();
            $.post("{{url('/client/maintenance-bills/total-cost')}}",
                {"_token": "{{ csrf_token() }}", repair_cost: repair_cost, delegate_cost: delegate_cost},
                function (data) {
                    $('[name*="total_cost"]').val(data.total_cost);
                    $('#bill_total').html(repair_cost);
                    $('#maintenance_total').html(delegate_cost);
                    $('#final_total').html(data.total_cost);
                });
        });
        $('[name*="spare_parts_cost"],[name*="maintenance_cost"]').on('keyup change blur', function () {
            let spare_parts_cost = $('[name*="spare_parts_cost"]').val();
            let maintenance_cost = $('[name*="maintenance_cost"]').val();
            $.post("{{url('/client/maintenance-bills/total-cost-2')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    spare_parts_cost: spare_parts_cost,
                    maintenance_cost: maintenance_cost
                },
                function (data) {
                    $('[name*="total_cost"]').val(data.total_cost);
                    $('#maintenance_total').html(maintenance_cost);
                    $('#final_total').html(data.total_cost);
                    $('.save_btn').trigger('click');
                });
        });
        $('#engineer_id,[name*="maintenance_cost"],[name*="delegate_cost"]').on('change keyup blur', function () {
            let bill_id = $('#bill_id').val();
            let engineer_id = $('#engineer_id').val();
            let maintenance_cost = $('[name*="maintenance_cost"]').val();
            let delegate_cost = $('[name*="delegate_cost"]').val();
            if (engineer_id == "") {
                $('#engineer_percent').html("0");
            } else {
                $.post("{{url('/client/maintenance-bills/engineer-percent')}}",
                    {
                        "_token": "{{ csrf_token() }}",
                        bill_id: bill_id,
                        maintenance_cost: maintenance_cost,
                        delegate_cost: delegate_cost,
                        engineer_id: engineer_id
                    },
                    function (data) {
                        $('#engineer_percent').html(data.engineer_percent);
                    });
            }
        });
    });
</script>
