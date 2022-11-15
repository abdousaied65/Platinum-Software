@extends('client.layouts.app-pos')
<style>
    .section {
        background: #f5f5f5;
        min-height: 500px !important;
        border: 1px solid #f5f5f5;
        margin: 0px;
    }

    * {
        color: #000;
    }

    i {
        color: #fff;
    }

    .btn {
        border-radius: 0 !important;
    }

    .section .category {
        height: auto;
        padding: 10px;
        font-size: 14px;
        color: #222;
        border: 1px solid #ddd;
    }

    .mytable tr td {
        padding: 10px !important;
    }

    .section .category:hover {
        background: orangered;
        color: #fff !important;
    }

    .section .category label {
        border: 1px solid #888;
        text-align: center;
        margin: 10px auto !important;
        border-radius: 100%;
        padding: 5px 10px;
        width: 30px;
        height: 30px;
    }

    div.product {
        font-size: 11px;
        width: 100% !important;
        border: 1px solid #0A3551;
        color: #0A3551;
        border-radius: 10px;
        height: auto;
        padding: 5px;
        margin-bottom: 10px;
    }

    div.product:hover {
        cursor: pointer;
        color: #fff;
    }

    div.product img {
        height: 50px !important;

    }

    .bootstrap-select {
        width: 80% !important;
    }

    #product_id {
        width: 90% !important;
    }

    .pending {
        width: 100%;
        text-align: center;
        height: 200px;
        color: #fff !important;
        font-size: 13px !important;
    }

    .pending .slice {
        display: block;
        margin-bottom: 10px;
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

    /*.products > div{*/
    /*    display: none!important;*/
    /*}*/

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

    @if($shift_type == "none")
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <form method="POST"
                          style="border: 2px solid #000; border-radius:10px;padding: 20px;width: 60%!important;margin: 20px auto!important;"
                          action="{{route('pos.shift.open')}}">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="status" value="open"/>
                        <h4 class="alert alert-sm alert-cyan text-center">
                            @if(App::getLocale() == 'ar')
                                فتح يومية / شيفت / وردية جديدة
                            @else
                                Start new shift
                            @endif
                        </h4>
                        <div class="form-group col-lg-6 pull-right">
                            <label class="d-block" for="">
                                @if(App::getLocale() == 'ar')
                                    الرصيد المرحل من الوردية السابقة
                                @else
                                    Balance converted to next shift
                                @endif

                            </label>
                            <input required readonly id="previous" type="text" style="height: 45px!important;"
                                   dir="ltr" class="form-control"
                                   name="previous_shift_balance"
                                   @if(empty($last_shift->next_shift_balance))
                                   value="0"
                                   @else
                                   value="{{$last_shift->next_shift_balance}}"
                            @endif
                            "/>
                        </div>
                        <div class="form-group col-lg-6 pull-right">
                            <label class="d-block" for="">
                                @if(App::getLocale() == 'ar')
                                    الرصيد الافتتاحى فى درج الكاشير
                                @else
                                    cashier drawer balance
                                @endif
                            </label>
                            <input required type="number" id="current" style="height: 45px!important;" dir="ltr"
                                   class="form-control"
                                   name="cashier_drawer_balance"/>
                        </div>
                        <div class="form-group col-lg-6 pull-right">
                            <label class="d-block" for="">
                                @if(App::getLocale() == 'ar')
                                    فرق الرصيد الافتتاحى
                                @else
                                    Balance difference
                                @endif
                            </label>
                            <input required readonly id="difference" type="number" style="height: 45px!important;"
                                   dir="ltr" class="form-control"
                                   name="difference_balance"/>
                        </div>
                        <div class="form-group col-lg-6 pull-right">
                            <label class="d-block" for="">
                                @if(App::getLocale() == 'ar')
                                    وقت بداية الشيفت
                                @else
                                    Shift Start Time
                                @endif
                            </label>
                            <input required readonly type="time" style="height: 45px!important;" dir="ltr"
                                   class="form-control"
                                   name="start_date_time" value="{{date('H:i:s')}}"/>
                        </div>
                        <div class="form-group col-lg-4 pull-right">
                            <label class="d-block" for="">
                                @if(App::getLocale() == 'ar')
                                    الشركة
                                @else
                                    company
                                @endif
                            </label>
                            <input type="text" disabled readonly style="height: 45px!important;" dir="rtl"
                                   class="form-control" value="{{$user->company->company_name}}"/>
                        </div>
                        <div class="form-group col-lg-4 pull-right">
                            <label class="d-block" for="">
                                @if(App::getLocale() == 'ar')
                                    الفرع
                                @else
                                    Branch
                                @endif
                            </label>
                            <input type="text" disabled readonly style="height: 45px!important;" dir="rtl"
                                   class="form-control" value="{{$user->branch->branch_name}}"/>
                        </div>
                        <div class="form-group col-lg-4 pull-right">
                            <label class="d-block" for="">
                                @if(App::getLocale() == 'ar')
                                    المستخدم
                                @else
                                    User
                                @endif
                            </label>
                            <input type="text" disabled readonly style="height: 45px!important;" dir="rtl"
                                   class="form-control" value="{{$user->name}}"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group col-lg-12 pull-right">
                            <label class="d-block" for="">
                                @if(App::getLocale() == 'ar')
                                    ملاحظات
                                @else
                                    Notes
                                @endif
                            </label>
                            <textarea name="notes" class="form-control"
                                      style="resize: none; width: 100%;height: 100px;"></textarea>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group text-center">
                            <button class="btn btn-success btn-md text-center" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    فتح يومية جديدة
                                @else
                                    Start New Shift
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="form-group mt-2">
                        <a href="{{route('client.home')}}" class="btn btn-md btn-danger text-center"
                           style="font-size: 16px!important;">
                            @if(App::getLocale() == 'ar')
                                الذهاب الى الصفحة الرئيسية
                            @else
                                Back To Main Page
                            @endif
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-lg-6 pull-right">
                <div class="section">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                               role="tab" aria-controls="nav-home" aria-selected="true">
                                @if(App::getLocale() == 'ar')
                                    الاقسام والفئات
                                @else
                                    Categories
                                @endif
                            </a>
                            @if($pos_settings->suspension_tab == "1")
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                   role="tab" aria-controls="nav-profile" aria-selected="false">
                                    @if(App::getLocale() == 'ar')
                                        الفواتير المعلقة
                                    @else
                                        Suspended Bills
                                    @endif
                                </a>
                            @endif
                            @if($pos_settings->edit_delete_tab == "1")
                                <a class="nav-item nav-link" id="nav-bills-tab" data-toggle="tab" href="#nav-bills"
                                   role="tab" aria-controls="nav-bills" aria-selected="false">
                                    @if(App::getLocale() == 'ar')
                                        تعديل وحذف الفواتير
                                    @else
                                        Edit -  Delete Bills
                                    @endif
                                </a>
                            @endif
                            <a class="nav-item nav-link" id="nav-notes-tab" data-toggle="tab" href="#nav-notes"
                               role="tab" aria-controls="nav-notes" aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    اضافة ملاحظات
                                @else
                                    Add Notes
                                @endif
                            </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                             aria-labelledby="nav-home-tab">
                            <div class="row mt-1">
                                <?php
                                $i = 0;
                                ?>
                                @foreach($categories as $category)
                                    <a class="category col-lg-2 pull-right text-center" category_id="{{$category->id}}">
                                        {{$category->category_name}}
                                    </a>
                                @endforeach
                                <div class="clearfix"></div>
                            </div>
                            <div class="row pl-2 mt-1 sub_categories">

                            </div>
                            <div class="row mt-1 products">
                            </div>
                        </div>
                        <div class="tab-pane fade p-1" id="nav-profile" role="tabpanel"
                             aria-labelledby="nav-profile-tab">
                            <p>
                                @if(App::getLocale() == 'ar')
                                    اضغط على أى من البنود الآتية للتعديل عليها:
                                @else
                                    Click on any of the following items to modify it:
                                @endif
                            </p>
                            <div class="row mb-1">
                                @if(isset($pending_pos) && !$pending_pos->isEmpty())
                                    @foreach($pending_pos as $pending)
                                        <div class="col-lg-4">
                                            <a href="#modaldemo3" class="btn btn-md btn-info pending modal-effect"
                                               data-toggle="modal" pos_open_id="{{$pending->id}}"
                                               notes="{{$pending->notes}}">
                                            <span class="slice">
                                                @if(App::getLocale() == 'ar')
                                                    ملاحظات :
                                                @else
                                                    Notes :
                                                @endif
                                                {{$pending->notes}}
                                            </span>
                                                <span class="slice">
                                                    @if(App::getLocale() == 'ar')
                                                        العميل :
                                                    @else
                                                        Client :
                                                    @endif
                                                    @if(isset($pending->outerClient->client_name))
                                                        {{$pending->outerClient->client_name}}
                                                    @endif
                                            </span>
                                                <span class="slice">
                                                    @if(App::getLocale() == 'ar')
                                                        التاريخ :
                                                    @else
                                                        Date :
                                                    @endif
                                                    {{$pending->created_at}}
                                            </span>
                                                <span class="slice">
                                                    @if(App::getLocale() == 'ar')
                                                        البنود :
                                                    @else
                                                        Items :
                                                    @endif
                                                    @if(isset($pending))
                                                        <?php
                                                        $pending_elements = $pending->elements;
                                                        ?>
                                                        {{$pending_elements->count()}}
                                                    @else
                                                        0
                                                    @endif
                                            </span>
                                                <span class="slice">
                                                    @if(App::getLocale() == 'ar')
                                                        المجموع :
                                                    @else
                                                        Total :
                                                    @endif
                                                    @if(isset($pending))
                                                        <?php
                                                        $pending_elements = $pending->elements;
                                                        $pending_discount = $pending->discount;
                                                        $pending_tax = $pending->tax;

                                                        $sum = 0;
                                                        foreach ($pending_elements as $pending_element) {
                                                            $sum = $sum + $pending_element->quantity_price;
                                                        }
                                                        if (isset($pending) && isset($pending_tax) && empty($pending_discount)) {
                                                            $tax_value = $pending_tax->tax_value;
                                                            $percent = $tax_value / 100 * $sum;
                                                            $sum = $sum + $percent;
                                                        } elseif (isset($pending) && isset($pending_discount) && empty($pending_tax)) {
                                                            $discount_value = $pending_discount->discount_value;
                                                            $discount_type = $pending_discount->discount_type;
                                                            if ($discount_type == "pound") {
                                                                $sum = $sum - $discount_value;
                                                            } else {
                                                                $discount_value = ($discount_value / 100) * $sum;
                                                                $sum = $sum - $discount_value;
                                                            }

                                                        } elseif (isset($pending) && !empty($pending_discount) && !empty($pending_tax)) {
                                                            $tax_value = $pending_tax->tax_value;
                                                            $discount_value = $pending_discount->discount_value;
                                                            $discount_type = $pending_discount->discount_type;
                                                            if ($discount_type == "pound") {
                                                                $sum = $sum - $discount_value;
                                                            } else {
                                                                $discount_value = ($discount_value / 100) * $sum;
                                                                $sum = $sum - $discount_value;
                                                            }
                                                            $sum = $sum - $discount_value;
                                                            $percent = $tax_value / 100 * $sum;
                                                            $sum = $sum + $percent;
                                                        }
                                                        echo $sum;
                                                        ?>
                                                    @else
                                                        0
                                                    @endif

                                            </span>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade p-1" id="nav-bills" role="tabpanel" aria-labelledby="nav-bills-tab">
                            <p class="alert alert-warning alert-sm text-center">
                                @if(App::getLocale() == 'ar')
                                    اذا تم تعديل او حذف فاتورة برقمها سيتم تعليق الفاتورة الحالية المفتوحة
                                @else
                                    If an invoice with its number is modified or deleted, the current open invoice will
                                    be suspended
                                @endif
                            </p>
                            <div class="row mb-3">
                                <div class="col-lg-6 pull-right">
                                    <div class="form-group">
                                        <label for="" class="d-block">
                                            @if(App::getLocale() == 'ar')
                                                اكتب رقم الفاتورة
                                            @else
                                                Type Bill Number
                                            @endif
                                        </label>
                                        <select class="form-control selectpicker"
                                                data-live-search="true"
                                                @if(App::getLocale() == 'ar')
                                                data-title="ابحث"
                                                @else
                                                data-title="Search"
                                                @endif

                                                data-style="btn-danger"
                                                name="bill_id" id="bill_id" dir="rtl">
                                            @foreach($bills as $bill)
                                                <option value="{{$bill->id}}">({{$bill->id}})
                                                    @if(isset($bill->outerClient->client_name))
                                                        ({{$bill->outerClient->client_name}})
                                                    @endif
                                                    ({{$bill->created_at}})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 pull-right" style="padding-top:25px">
                                    <div class="form-group">
                                        <button class="btn btn-md btn-info edit_bill">
                                            <i class="fa fa-edit"></i>
                                            @if(App::getLocale() == 'ar')
                                                تعديل الفاتورة
                                            @else
                                                Edit Bill
                                            @endif
                                        </button>

                                        <button class="btn btn-md btn-danger remove_bill">
                                            <i class="fa fa-trash"></i>
                                            @if(App::getLocale() == 'ar')
                                                حذف الفاتورة
                                            @else
                                                Delete Bill
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p id="msg" class="alert alert-sm alert-danger text-center" style="font-size: 14px;"></p>
                        </div>
                        <div class="tab-pane fade p-1" id="nav-notes" role="tabpanel" aria-labelledby="nav-notes-tab">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="d-block" for="">
                                                @if(App::getLocale() == 'ar')
                                                    اضف ملاحظة متعلقة بهذه الفاتورة
                                                @else
                                                    Add Notes to this bill
                                                @endif
                                            </label>
                                            <input type="text" name="notes" id="notes" class="form-control"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <button onclick="window.open('{{route('client.home')}}','_self')"
                        class="btn btn-md btn-success" style="position:absolute;bottom:0!important;">
                    @if(App::getLocale() == 'ar')
                        العودة الى الصفحة الرئيسية
                    @else
                        Back to Main Page
                    @endif
                </button>
                <button onclick="window.open('{{route('client.pos.shift.close',$shift->id)}}','_self')"
                        class="btn btn-md btn-danger" style="position:absolute;bottom:0!important;
                        margin-right: 200px!important;">
                    @if(App::getLocale() == 'ar')
                        اقفال اليومية / الشيفت
                    @else
                        Close POS Shift
                    @endif
                </button>
            </div>
            <div class="col-lg-6 pull-left">
                <div class="section">
                    <div class="mb-1">
                        <select id="outer_client_id" class="selectpicker"
                                data-style="btn-dark" data-live-search="true"
                                @if(App::getLocale() == 'ar')
                                data-title="ابحث"
                                @else
                                data-title="Search"
                            @endif>
                            @foreach($outer_clients as $outer_client)
                                <option
                                    @if(isset($pos_open) && $pos_open->outer_client_id == $outer_client->id)
                                    selected
                                    @endif
                                    value="{{$outer_client->id}}">{{$outer_client->client_name}}</option>
                            @endforeach
                        </select>
                        <a role="button"
                           style="width: 5%;display: inline; border-radius: 0;margin-left: 5px;"
                           class="modal-effect btn btn-sm btn-dark show_outer_client"
                           data-toggle="modal" href="#">
                            <i class="fa fa-eye"></i>
                        </a>
                        @if($pos_settings->add_outer_client == "1")
                            <a role="button"
                               style="width: 5%;display: inline; border-radius: 0;"
                               class="modal-effect btn btn-sm btn-dark"
                               data-toggle="modal" href="#modaldemo9">
                                <i class="fa fa-plus"></i>
                            </a>
                        @endif
                    </div>
                    <div class="mb-1">
                        <select autofocus id="product_id" class="selectpicker form-control"
                                data-style="btn-dark" data-live-search="true"
                                @if(App::getLocale() == 'ar')
                                data-title="ابحث"
                                @else
                                data-title="Search"
                            @endif>
                            @foreach($products as $product)
                                <option value="{{$product->id}}"
                                        data-tokens="{{$product->code_universal}}">{{$product->product_name}}</option>
                            @endforeach
                        </select>
                        @if($pos_settings->add_product == "1")
                            <a role="button"
                               style="width: 5%;display: inline; border-radius: 0;"
                               class="modal-effect btn btn-sm btn-dark"
                               data-toggle="modal" href="#modaldemo10">
                                <i class="fa fa-plus"></i>
                            </a>
                        @endif
                    </div>
                    <div class="table-responsive"
                         style=" border:1px solid orangered;height: 270px; overflow:auto !important;">
                        <table class="table-bordered mytable"
                               style="margin-bottom: 0px; padding: 0px;width: 100%">
                            <thead style="background: orangered;">
                            <tr>
                                <th style="width: 20%!important;color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        المنتج
                                    @else
                                        Product
                                    @endif
                                </th>
                                <th style="width: 15%!important;color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        الوحدة
                                    @else
                                        Unit
                                    @endif
                                </th>
                                <th style="width: 15%!important;color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        السعر
                                    @else
                                        Price
                                    @endif
                                </th>
                                <th style="width: 15%!important;color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        الكمية
                                    @else
                                        Quantity
                                    @endif
                                </th>
                                <th style="width: 15%!important;color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        اجمالى
                                    @else
                                        Total
                                    @endif
                                </th>
                                <th style="width: 10%!important;color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        سيريالات
                                    @else
                                        Serials
                                    @endif
                                </th>
                                <th style="width: 10%!important;text-align: center;color: #fff!important;">
                                    <i class="fa fa-trash" style="font-size: 25px!important;"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bill_details">
                            @if(isset($pos_open) && !$pos_open_elements->isEmpty())
                                <?php
                                foreach ($pos_open_elements as $element) {
                                $units = $element->product->units;
                                echo "<tr>";
                                echo "<td>" . $element->product->product_name . "</td>";
                                echo "<td>";
                                ?>
                                <select element_id='<?php echo $element->id;?>' class='select_unit'>
                                    @foreach($units as $unit)
                                        <option
                                            @if($unit->id == $element->product_unit_id)
                                            selected
                                            @endif
                                            value="{{$unit->id}}">{{$unit->unit->unit_name}}</option>
                                    @endforeach
                                </select>
                                <?php
                                echo "</td>";
                                echo "<td><input dir='ltr' type='text' class='edit_price' element_id ='" . $element->id . "' style='width:100% !important;' value='" . $element->product_price . "' /></td>";
                                echo "<td><input dir='ltr' type='text' class='edit_quantity' element_id ='" . $element->id . "' style='width:100% !important;' value='" . $element->quantity . "' /></td>";
                                echo "<td><input dir='ltr' type='text' class='edit_quantity_price' element_id ='" . $element->id . "' style='width:100%!important;' value='" . $element->quantity_price . "' /></td>";
                                echo "<td><a style='font-size: 15px!important;' class='btn btn-sm btn-info add_serials' data-toggle='modal'
                                    href='#modaldemo100'><i class='fa fa-barcode'></i></a></td>";
                                echo "<td class='no-print'>
                                        <button type='button' pos_open_number='" . $element->PosOpen->pos_open_number . "'
                                            element_id='" . $element->id . "' style='font-size: 15px!important;'
                                            class='btn btn-sm btn-danger remove_element'>
                                            <i class='fa fa-trash'></i>
                                        </button>
                                    </td>";
                                echo "</tr>";
                                }
                                ?>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    <table id="totalTable" style="width:100%; float:right; padding:5px; color:#000; background: #FFF;">
                        <tbody>
                        <tr>
                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;">
                                @if(App::getLocale() == 'ar')
                                    البنود
                                @else
                                    items
                                @endif
                            </td>
                            <td class="text-right"
                                style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                            <span id="items">
                                @if(isset($pos_open) && !$pos_open_elements->isEmpty())
                                    {{$pos_open_elements->count()}}
                                    <?php
                                    $sum = 0;
                                    foreach ($pos_open_elements as $pos_open_element) {
                                        $sum = $sum + $pos_open_element->quantity;
                                    }
                                    ?>
                                @else
                                    0
                                @endif
                            </span>
                                <span id="total_quantity">
                                @if(isset($pos_open) && !$pos_open_elements->isEmpty())
                                        (
                                        <?php
                                        $sum = 0;
                                        foreach ($pos_open_elements as $pos_open_element) {
                                            $sum = $sum + $pos_open_element->quantity;
                                        }
                                        ?>
                                        {{$sum}}
                                        )
                                    @else
                                    (0)
                                    @endif
                            </span>
                            </td>
                            <td style="padding: 5px 10px;border-top: 1px solid #DDD;">
                                @if(App::getLocale() == 'ar')
                                    مجموع
                                @else
                                    Total
                                @endif
                            </td>
                            <td class="text-right"
                                style="padding: 5px 10px;font-size: 14px; font-weight:bold;border-top: 1px solid #DDD;">
                            <span id="sum">
                                @if(isset($pos_open) && !$pos_open_elements->isEmpty())
                                    <?php
                                    $sum = 0;
                                    foreach ($pos_open_elements as $pos_open_element) {
                                        $sum = $sum + $pos_open_element->quantity_price;
                                    }
                                    ?>
                                    {{$sum}}
                                @else
                                    0
                                @endif
                            </span>
                            </td>
                            @if($pos_settings->tax == "1")
                                <td style="padding: 5px 10px;">
                                    @if(App::getLocale() == 'ar')
                                        ضريبة الطلب
                                    @else
                                        Taxes
                                    @endif
                                    <a href="#modaldemo6" data-toggle="modal" class="modal-effect">
                                        <i class="fa fa-edit"
                                           style="font-size: 17px !important;color:#000 !important;"></i>
                                    </a>
                                </td>
                                <td class="text-right" style="padding: 5px 10px;font-size: 14px; font-weight:bold;">
                            <span id="tds_2">
                                @if(isset($pos_open) && isset($pos_open_tax) && !empty($pos_open_tax))
                                    <?php
                                    $tax_value = $pos_open_tax->tax_value;
                                    $sum = 0;
                                    foreach ($pos_open_elements as $pos_open_element) {
                                        $sum = $sum + $pos_open_element->quantity_price;
                                    }
                                    if (isset($pos_open) && isset($pos_open_discount) && !empty($pos_open_discount)) {
                                        $discount_value = $pos_open_discount->discount_value;
                                        $discount_type = $pos_open_discount->discount_type;
                                        if ($discount_type == "pound") {
                                            $sum = $sum - $discount_value;
                                        } else {
                                            $discount_value = ($discount_value / 100) * $sum;
                                            $sum = $sum - $discount_value;
                                        }
                                    }
                                    $percent = $tax_value / 100 * $sum;
                                    ?>
                                    {{$percent}}
                                    ( {{$pos_open_tax->tax_value}} %)
                                @else
                                    0
                                @endif
                            </span>
                                </td>
                            @endif
                            @if($pos_settings->discount == "1")
                                <td style="padding: 5px 10px;">
                                    @if(App::getLocale() == 'ar')
                                        الخصم
                                    @else
                                        Discount
                                    @endif
                                    <a href="#modaldemo7" style="font-size: 17px !important;" data-toggle="modal"
                                       class="modal-effect">
                                        <i class="fa fa-edit"
                                           style="font-size: 17px !important;color:#000 !important;"></i>
                                    </a>
                                </td>
                                <td class="text-right" style="padding: 5px 10px;font-weight:bold;">
                                <span id="tds">
                                    @if(isset($pos_open) && !empty($pos_open_discount))
                                        <?php
                                        $discount_value = $pos_open_discount->discount_value;
                                        $discount_type = $pos_open_discount->discount_type;
                                        $sum = 0;
                                        foreach ($pos_open_elements as $pos_open_element) {
                                            $sum = $sum + $pos_open_element->quantity_price;
                                        }
                                        if ($discount_type == "pound") {
                                            echo $discount_value;
                                        } else {
                                            echo $discount_value = ($discount_value / 100) * $sum;
                                            echo " ( " . $pos_open_discount->discount_value . " % ) ";
                                        }
                                        ?>
                                    @else
                                        0
                                    @endif
                                </span>
                                </td>
                            @endif
                        </tr>
                        <tr>
                            <td style="padding: 5px 10px; border-top: 1px solid #666; border-bottom: 1px solid #333; font-weight:bold; background:#333; color:#FFF;"
                                colspan="4">
                                @if(App::getLocale() == 'ar')
                                    إجمالى المبلغ المطلوب
                                @else
                                    Total Amount
                                @endif
                            </td>
                            <td class="text-right"
                                style="padding:5px 10px 5px 10px; font-size: 14px;border-top: 1px solid #666; border-bottom: 1px solid #333; font-weight:bold; background:#333; color:#FFF;"
                                colspan="4">
                            <span id="total" style="color: #fff !important;">
                               @if(isset($pos_open))
                                    <?php
                                    $sum = 0;
                                    foreach ($pos_open_elements as $pos_open_element) {
                                        $sum = $sum + $pos_open_element->quantity_price;
                                    }
                                    if (isset($pos_open) && isset($pos_open_tax) && empty($pos_open_discount)) {
                                        $tax_value = $pos_open_tax->tax_value;
                                        $percent = $tax_value / 100 * $sum;
                                        $sum = $sum + $percent;
                                    } elseif (isset($pos_open) && isset($pos_open_discount) && empty($pos_open_tax)) {
                                        $discount_value = $pos_open_discount->discount_value;
                                        $discount_type = $pos_open_discount->discount_type;
                                        if ($discount_type == "pound") {
                                            $sum = $sum - $discount_value;
                                        } else {
                                            $discount_value = ($discount_value / 100) * $sum;
                                            $sum = $sum - $discount_value;
                                        }
                                    } elseif (isset($pos_open) && !empty($pos_open_discount) && !empty($pos_open_tax)) {
                                        $tax_value = $pos_open_tax->tax_value;
                                        $discount_value = $pos_open_discount->discount_value;
                                        $discount_type = $pos_open_discount->discount_type;
                                        if ($discount_type == "pound") {
                                            $sum = $sum - $discount_value;
                                        } else {
                                            $discount_value = ($discount_value / 100) * $sum;
                                            $sum = $sum - $discount_value;
                                        }
                                        $percent = $tax_value / 100 * $sum;
                                        $sum = $sum + $percent;
                                    }
                                    echo $sum;
                                    ?>
                                @else
                                    0
                                @endif
                            </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="clearfix"></div>
                    <div id="botbuttons" class="col-lg-12 text-center">
                        <input type="hidden" name="biller" id="biller" value="3">
                        <div class="row">
                            @if($pos_settings->fast_finish == "1")
                                <div class="col-lg-6" style="padding: 0;">
                                    <div class="btn-block">
                                        @if(empty($pos_settings->safe_id))
                                            <input type="hidden" value="no_safe" id="no_safe"/>
                                        @endif
                                        @if(empty($pos_settings->bank_id))
                                            <input type="hidden" value="no_bank" id="no_bank"/>
                                        @endif
                                        <button type="button" id="finish_cash"
                                                class="btn btn-dark btn-block btn-md modal-effect btn-main">
                                            <i class="fa fa-check-circle-o" style="margin-left: 5px;"></i>
                                            @if(App::getLocale() == 'ar')
                                                دفع كاش كامل المبلغ وحفظ وطباعة
                                            @else
                                                Pay amount Cash and Save Bill
                                            @endif
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6" style="padding: 0;">
                                    <div class="btn-block">
                                        <button type="button" id="finish_bank"
                                                class="btn btn-cyan btn-block btn-md modal-effect btn-main">
                                            <i class="fa fa-check-circle-o" style="margin-left: 5px;"></i>
                                            @if(App::getLocale() == 'ar')
                                                دفع بنكى شبكة كامل المبلغ وحفظ وطباعة
                                            @else
                                                Pay Amount bank and save bill
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <div class="col-lg-3" style="padding: 0;">
                                <div class="\ btn-block">
                                    @if($pos_settings->payment == "1")
                                        <a href="#modaldemo" role="button" data-toggle="modal"
                                           class="btn btn-success btn-block modal-effect btn-main" id="payment"
                                           tabindex="-1">
                                            <i class="fa fa-money" style="margin-left: 5px;"></i>
                                            @if(App::getLocale() == 'ar')
                                                تسجيل الدفع
                                            @else
                                                create payment
                                            @endif
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3" style="padding: 0;">
                                <div class=" btn-block">
                                    @if($pos_settings->print_save == "1")
                                        <button type="button"
                                                class="btn btn-info btn-block btn-main" id="save_pos" tabindex="-1">
                                            <i class="fa fa-save" style="margin-left: 5px;"></i>
                                            @if(App::getLocale() == 'ar')
                                                حفظ وطباعة
                                            @else
                                                save & print
                                            @endif
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3" style="padding: 0;">
                                <div class=" btn-block">
                                    @if($pos_settings->suspension == "1")
                                        <a role="button"
                                           class="btn btn-warning btn-block btn-flat modal-effect btn-main"
                                           data-toggle="modal" href="#modaldemo4">
                                            <i class="fa fa-pause"
                                               style="margin-left: 5px;border:1px solid #fff;border-radius: 100%;padding: 3px;"></i>
                                            @if(App::getLocale() == 'ar')
                                                تعليق الفاتورة
                                            @else
                                                Suspend bill
                                            @endif
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-3" style="padding: 0;">
                                <div class="btn-block">
                                    @if($pos_settings->cancel == "1")
                                        <a role="button"
                                           class="btn btn-danger btn-block btn-flat modal-effect btn-main"
                                           data-toggle="modal" href="#modaldemo5">
                                            <i class="fa fa-close" style="margin-left: 5px;"></i>
                                            @if(App::getLocale() == 'ar')
                                                الغاء الفاتورة
                                            @else
                                                Cancel Invoice
                                            @endif
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="modal fade" dir="rtl" id="modaldemo" tabindex="-1" role="dialog" aria-labelledby="modaldemo">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header w-100">
                    <h4 class="modal-title text-center" id="modaldemo">
                        @if(App::getLocale() == 'ar')
                            دفع نقدى
                        @else
                            cash payment
                        @endif
                    </h4>
                </div>
                <div class="modal-body">
                    @if((isset($pos_cash) && !$pos_cash->isEmpty()) || (isset($pos_bank_cash) && !$pos_bank_cash->isEmpty())
                        || (isset($pos_coupon_cash) && !$pos_coupon_cash->isEmpty()))
                        <table class="table table-condensed table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        المبلغ
                                    @else
                                        Amount
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        طريقة الدفع
                                    @else
                                        Payment method
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        delete
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 0; ?>
                            @if(isset($pos_cash) && !$pos_cash->isEmpty())
                                @foreach($pos_cash as $cash)
                                    <tr>
                                        <td>{{++$j}}</td>
                                        <td>{{$cash->amount}}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                دفع كاش نقدى
                                            @else
                                                cash payment
                                            @endif
                                            <br>
                                            ( {{$cash->safe->safe_name}} )
                                        </td>
                                        <td>
                                            <button type="button" payment_method="cash" cash_id="{{$cash->id}}"
                                                    class="btn btn-danger delete_pay">
                                                @if(App::getLocale() == 'ar')
                                                    حذف
                                                @else
                                                    delete
                                                @endif

                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(isset($pos_bank_cash) && !$pos_bank_cash->isEmpty())
                                @foreach($pos_bank_cash as $cash)
                                    <tr>
                                        <td>{{++$j}}</td>
                                        <td>{{$cash->amount}}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                دفع بنكى شبكة
                                            @else
                                                bank payment
                                            @endif
                                            <br>
                                            ( {{$cash->bank->bank_name}} )
                                            <br>
                                            ( {{$cash->bank_check_number}} )
                                        </td>
                                        <td>
                                            <button type="button" payment_method="bank" cash_id="{{$cash->id}}"
                                                    class="btn btn-danger delete_pay">
                                                @if(App::getLocale() == 'ar')
                                                    حذف
                                                @else
                                                    delete
                                                @endif

                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(isset($pos_coupon_cash) && !$pos_coupon_cash->isEmpty())
                                @foreach($pos_coupon_cash as $cash)
                                    <tr>
                                        <td>{{++$j}}</td>
                                        <td>{{$cash->amount}}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                دفع كوبون خصم
                                            @else
                                                discount coupon payment
                                            @endif
                                            <br>
                                            ( {{$cash->coupon->coupon_code}} )
                                        </td>
                                        <td>
                                            <button type="button" payment_method="coupon" cash_id="{{$cash->id}}"
                                                    class="btn btn-danger delete_pay">
                                                @if(App::getLocale() == 'ar')
                                                    حذف
                                                @else
                                                    delete
                                                @endif
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    @endif
                    <input type="hidden" id="company_id" value="{{$company_id}}">
                    <div class="row mb-3">
                        <div class="col-md-4" style="display: none;">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    رقم العملية
                                @else
                                    Process Number
                                @endif
                                <span class="text-danger">*</span></label>
                            <input required readonly value="{{$pre_cash}}" class="form-control"
                                   id="cash_number" type="text">
                        </div>
                        <div class="col-md-6">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    المبلغ المدفوع
                                @else
                                    paid amount
                                @endif
                                <span class="text-danger">*</span></label>
                            <input required class="form-control"
                                   id="amount" type="number" dir="ltr">
                        </div>
                        <div class="col-md-6">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    طريقة الدفع
                                @else
                                    payment method
                                @endif
                                <span class="text-danger">*</span></label>
                            <select required id="payment_method" name="payment_method" class="form-control">
                                <option value="">
                                    @if(App::getLocale() == 'ar')
                                        اختر طريقة الدفع
                                    @else
                                        choose payment method
                                    @endif
                                </option>
                                <option value="cash">
                                    @if(App::getLocale() == 'ar')
                                        دفع كاش نقدى
                                    @else
                                        cash payment
                                    @endif
                                </option>
                                <option value="bank">
                                    @if(App::getLocale() == 'ar')
                                        دفع بنكى شبكة
                                    @else
                                        bank payment
                                    @endif
                                </option>
                                <option value="coupon">
                                    @if(App::getLocale() == 'ar')
                                        دفع كوبون خصم
                                    @else
                                        discount coupon payment
                                    @endif
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 extra_div cash" style="display: none;">
                        <div class="col-md-6">
                            <label class="d-block">
                                @if(App::getLocale() == 'ar')
                                    خزنة الدفع
                                @else
                                    safe
                                @endif
                                <span class="text-danger">*</span></label>
                            <select style="width: 80% !important; display: inline !important;" required id="safe_id"
                                    class="form-control">
                                <option value="">
                                    @if(App::getLocale() == 'ar')
                                        اختر خزنة الدفع
                                    @else
                                        choose safe
                                    @endif
                                </option>
                                @foreach($safes as $safe)
                                    <option
                                        @if($pos_settings->safe_id == $safe->id)
                                        selected
                                        @endif
                                        value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                @endforeach
                            </select>
                            <a target="_blank" href="{{route('client.safes.create')}}" role="button"
                               style="width: 15%;display: inline;"
                               class="btn btn-sm btn-warning open_popup">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3 extra_div coupon" style="display: none;">
                        <div class="col-md-4">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    رقم كوبون الخصم
                                @else
                                    coupon code
                                @endif
                                <span class="text-danger">*</span></label>
                            <select class="form-control selectpicker show-tick"
                                    data-style="btn-info" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                    @endif

                                    name="couponcode" id="couponcode">
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3 extra_div bank" style="display: none;">
                        <div class="col-md-4">
                            <label class="d-block">
                                @if(App::getLocale() == 'ar')
                                    البنك
                                @else
                                    Bank
                                @endif
                                <span class="text-danger">*</span></label>
                            <select style="width: 80% !important; display: inline !important;" required id="bank_id"
                                    class="form-control">
                                <option value="">
                                    @if(App::getLocale() == 'ar')
                                        اختر البنك
                                    @else
                                        choose bank
                                    @endif
                                </option>
                                @foreach($banks as $bank)
                                    <option
                                        @if($pos_settings->bank_id == $bank->id)
                                        selected
                                        @endif
                                        value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                @endforeach
                            </select>
                            <a target="_blank" href="{{route('client.banks.create')}}" role="button"
                               style="width: 15%;display: inline;"
                               class="btn btn-sm btn-warning open_popup">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <label for="">
                                @if(App::getLocale() == 'ar')
                                    رقم المعاملة
                                @else
                                    bank check number
                                @endif
                            </label>
                            <input type="text" class="form-control" id="bank_check_number"/>
                        </div>
                        <div class="col-md-4">
                            <label for="">
                                @if(App::getLocale() == 'ar')
                                    ملاحظات
                                @else
                                    notes
                                @endif
                            </label>
                            <input type="text" class="form-control" id="bank_notes"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-info pd-x-20 pay_cash" type="button">
                            @if(App::getLocale() == 'ar')
                                تسجيل دفع
                            @else
                                create payment
                            @endif
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="client_name" id="client_name"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i>
                        @if(App::getLocale() == 'ar')
                            اغلاق
                        @else
                            close
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo3">
        <div class="modal-dialog modal-sm modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            انتبه من فضلك
                        @else
                            attetion please :
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        @if(App::getLocale() == 'ar')
                            اضغط على التعديل على الفاتورة المعلقة لترك هذة الصفحة ورجوع للبقاء فى الصفحة
                            <br>
                            سوف تفقد كل بيانات البيع اذا غادرت هذة الصفحة
                        @else
                            Click to edit the pending invoice to leave this page and Back to stay on the page
                            <br>
                            Check your sales data if you leave this page
                        @endif

                    </div>
                    <input type="hidden" id="posopenid"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" id="open_pending">
                        @if(App::getLocale() == 'ar')
                            التعديل على الفاتورة المعلقة
                        @else
                            edit on suspended bill
                        @endif
                    </button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        @if(App::getLocale() == 'ar')
                            رجوع
                        @else
                            back
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo100">
        <div class="modal-dialog modal-lg modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            سيريالات المنتج
                        @else
                            Product Serials
                        @endif
                    </h6>
                </div>
                <div class="modal-body serials">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        @if(App::getLocale() == 'ar')
                            رجوع
                        @else
                            Back
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo4">
        <div class="modal-dialog modal-sm modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            تعليق عملية البيع وحفظها كفاتورة مفتوحة
                        @else
                            Suspend the sale and save it as an open invoice
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h5>
                        @if(App::getLocale() == 'ar')
                            برجاء كتابة الملاحظة المرجعية لتعليق هذة العملية.
                        @else
                            Please write a reference note to suspend this process.
                        @endif
                    </h5>
                    <div class="form-group">
                        <label for="">
                            @if(App::getLocale() == 'ar')
                                ملاحظة مرجعية
                            @else
                                reference note
                            @endif
                        </label>
                        <input type="text" class="form-control" id="notes_2"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" id="pending">
                        @if(App::getLocale() == 'ar')
                            تعليق الفاتورة
                        @else
                            Suspend Bill
                        @endif
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        @if(App::getLocale() == 'ar')
                            رجوع
                        @else
                            Back
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo5">
        <div class="modal-dialog modal-sm modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            الغاء الفاتورة المفتوحة حاليا
                        @else
                            Cancel Open Bill Now
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        @if(App::getLocale() == 'ar')
                            هل تريد بالفعل الغاء الفاتورة المفتوحة حاليا ؟؟
                        @else
                            Do you really want to cancel the currently open invoice??
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="reset">
                        @if(App::getLocale() == 'ar')
                            الغاء
                        @else
                            Cancel
                        @endif
                    </button>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">
                        @if(App::getLocale() == 'ar')
                            رجوع
                        @else
                            back
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo6">
        <div class="modal-dialog modal-sm modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            تضاف على اجمالى الفاتورة بعد الخصم
                        @else
                            It is added to the total bill after the discount
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="d-block">
                            @if(App::getLocale() == 'ar')
                                ضريبة الطلب
                            @else
                                Tax
                            @endif
                        </label>

                        <select id="tax_id" class="form-control d-inline float-left w-50">
                            <option value="0">
                                @if(App::getLocale() == 'ar')
                                    بدون ضريبة
                                @else
                                    Without Tax
                                @endif
                            </option>
                            @foreach($taxes as $tax)
                                <option
                                    @if(isset($pos_open) && !empty($pos_open_tax) && $pos_open_tax->tax_id == $tax->id)
                                    selected
                                    @endif
                                    taxvalue="{{$tax->tax_value}}"
                                    value="{{$tax->id}}">{{$tax->tax_name}}</option>
                            @endforeach
                        </select>
                        <input type="number" id="tax_value"
                               @if(isset($pos_open) && !empty($pos_open_tax))
                               value="{{$pos_open_tax->tax_value}}"
                               @endif
                               style="width: 40%;" name="tax_value" class="form-control d-inline float-right"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success save_tax">
                        @if(App::getLocale() == 'ar')
                            حفظ
                        @else
                            Save
                        @endif
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@if(App::getLocale() == 'ar')
                            الغاء
                        @else
                            Cancel
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo7">
        <div class="modal-dialog modal-sm modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            خصم على إجمالى الفاتورة
                        @else
                            Discount on Bill Total
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="" class="d-block">
                            @if(App::getLocale() == 'ar')
                                قيمة الخصم
                            @else
                                Discount Value
                            @endif
                        </label>
                        <select name="discount_type" id="discount_type" class="form-control"
                                style="width: 40%;display: inline;float: right; margin-left:5px;">
                            <option
                                @if(isset($pos_open) && !empty($pos_open_discount) &&
                                    $pos_open_discount -> discount_type == "pound" )
                                selected
                                @endif
                                value="pound">{{__('main.'.$currency)}}</option>
                            <option
                                @if(isset($pos_open) && !empty($pos_open_discount) &&
                                    $pos_open_discount -> discount_type == "percent" )
                                selected
                                @endif
                                value="percent"> %
                            </option>
                        </select>
                        <input type="number" dir="ltr" class="form-control text-right"
                               @if(isset($pos_open) && !empty($pos_open_discount))
                               value="{{$pos_open_discount->discount_value}}"
                               @endif style="width: 50%;display: inline;float: right;"
                               id="discount_value"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success save_discount">
                        @if(App::getLocale() == 'ar')
                            حفظ
                        @else
                            Save
                        @endif
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@if(App::getLocale() == 'ar')
                            الغاء
                        @else
                            Cancel
                        @endif</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo8">
        <div class="modal-dialog modal-lg modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            عرض بيانات العميل
                        @else
                            View Client Details
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body outer_client_details">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        @if(App::getLocale() == 'ar')
                            الغاء
                        @else
                            Cancel
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-lg modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            اضافة عميل جديد
                        @else
                            Add New Client
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-6 pull-right">
                        <div class="form-group col-lg-12 pull-right" dir="rtl">
                            <label for="order">
                                @if(App::getLocale() == 'ar')
                                    اسم العميل
                                @else
                                    Client Name
                                @endif

                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="client_name2" class="form-control">
                        </div>
                        <div class="form-group col-lg-12 pull-right" dir="rtl">
                            <label for="client_category">
                                @if(App::getLocale() == 'ar')
                                    فئة التعامل
                                @else
                                    Client Category
                                @endif
                                <span class="text-danger">*</span>
                            </label>
                            <select id="client_category" class="form-control">
                                <option value="">
                                    @if(App::getLocale() == 'ar')
                                        اختر الفئة
                                    @else
                                        Choose Category
                                    @endif
                                </option>
                                <option value="جملة">
                                    {{trans('main.جملة')}}
                                </option>
                                <option selected value="قطاعى">{{trans('main.قطاعى')}}</option>
                            </select>
                        </div>
                        <div class="form-group pull-right col-lg-12" dir="rtl">
                            <label for="prev_balance">
                                @if(App::getLocale() == 'ar')
                                    مديونية العميل
                                @else
                                    Previous debts
                                @endif
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" value="0" id="prev_balance" class="form-control" dir="ltr"/>
                        </div>
                        <div class="form-group pull-right col-lg-12" dir="rtl">
                            <label for="address">

                                @if(App::getLocale() == 'ar')
                                    العنوان
                                @else
                                    Address
                                @endif
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" value="" id="client_address" class="form-control" dir="rtl"/>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-6  pull-left">
                        <div class="form-group col-lg-12 pull-right" dir="rtl">
                            <label for="client_email">
                                @if(App::getLocale() == 'ar')
                                    البريد الالكترونى
                                @else
                                    Email Address
                                @endif
                            </label>
                            <input type="email" id="client_email" dir="ltr"
                                   class="form-control">
                        </div>
                        <div class="form-group pull-right col-lg-12" dir="rtl">
                            <label for="shop_name">
                                @if(App::getLocale() == 'ar')
                                    اسم محل / شركة العميل
                                @else
                                    Shop Name
                                @endif
                            </label>
                            <input type="text" id="shop_name"
                                   class="form-control" dir="rtl">
                        </div>
                        <div class="form-group pull-right col-lg-12" dir="rtl">
                            <label for="client_national">
                                @if(App::getLocale() == 'ar')
                                    جنسية العميل
                                @else
                                    Nationality
                                @endif

                                <span class="text-danger">*</span>
                            </label>
                            <select id="client_national" class="form-control">
                                <option value="">
                                    @if(App::getLocale() == 'ar')
                                        اختر دولة
                                    @else
                                        Chose Country
                                    @endif
                                </option>
                                @foreach($timezones as $timezone)
                                    <option
                                        @if($timezone->name_ar == "السعودية")
                                        selected
                                        @endif
                                        value="{{$timezone->name_ar}}">
                                        @if(App::getLocale() == 'ar')
                                            {{$timezone->name_ar}}
                                        @else
                                            {{$timezone->name_en}}
                                        @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group pull-right col-lg-12" dir="rtl">
                            <label for="client_phone">
                                @if(App::getLocale() == 'ar')
                                    رقم الهاتف
                                @else
                                    Phone Number
                                @endif
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" value="" id="client_phone" class="form-control" dir="ltr"/>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        @if(App::getLocale() == 'ar')
                            الغاء
                        @else
                            Cancel
                        @endif
                    </button>
                    <button type="button" class="btn btn-success add_outer_client">
                        @if(App::getLocale() == 'ar')
                            اضافة
                        @else
                            Add
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo10">
        <div class="modal-dialog modal-lg modal-dialog-centered" capital="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">اضافة منتج جديد</h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="col-lg-6 pull-right">
                        <div class="form-group  col-lg-6  pull-right" dir="rtl">
                            <label for="store_id">اسم المخزن</label>
                            <select style="width: 80%; display: inline;" id="store_id"
                                    class="form-control">
                                <option value="">اختر المخزن</option>
                                @foreach($stores as $store)
                                    <option value="{{$store->id}}">{{$store->store_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group  col-lg-6  pull-right" dir="rtl">
                            <label for="category_id">اسم الفئة</label>
                            <select style="display: inline; width: 80%;" id="category_id"
                                    class="form-control">
                                <option value="">اختر الفئة</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"
                                            type="{{$category->category_type}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group  col-lg-12  pull-right" dir="rtl">
                            <label style="display: block;">رقم الباركود </label>
                            <input type="text" value="{{$code_universal}}" class="form-control text-left" dir="ltr"
                                   id="code_universal"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group  col-lg-12  pull-right" dir="rtl">
                            <label for="order">اسم المنتج </label>
                            <input type="text" id="product_name" class="form-control" dir="rtl">
                        </div>
                        <div class="form-group col-lg-12  pull-right" dir="ltr">
                            <label for="first_balance">رصيد المخازن</label>
                            <input value="0" type="number" id="first_balance"
                                   class="form-control text-right">
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-lg-6  pull-left">
                        <div class="form-group  pull-right col-lg-12" dir="ltr">
                            <label for="purchasing_price">سعر التكلفة</label>
                            <input value="0" type="number" id='purchasing_price'
                                   class="form-control text-right">
                        </div>
                        <div class="clearfix"></div>
                        <div class="form-group  pull-right col-lg-12" dir="ltr">
                            <label for="wholesale_price">سعر الجملة</label>
                            <input value="0" type="number" id="wholesale_price"
                                   class="form-control text-right"
                            >
                        </div>
                        <div class="form-group  pull-right col-lg-12" dir="ltr">
                            <label for="sector_price">سعر القطاعى</label>
                            <input value="0" type="number" id="sector_price"
                                   class="form-control text-right">
                        </div>
                        <div class="form-group pull-right col-lg-12" dir="ltr">
                            <label for="min_balance">رصيد حد أدنى المخازن</label>
                            <input value="0" type="number" id="min_balance"
                                   class="form-control text-right"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">@if(App::getLocale() == 'ar')
                            الغاء
                        @else
                            Cancel
                        @endif</button>
                    <button type="button" class="btn btn-success add_product">اضافة</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="final_total"
           @if(isset($pos_open))
           value="{{$sum}}"
           @else
           value="0"
        @endif
    />
    <input type="hidden" value="{{date('Y-m-d')}}" id="date"/>
    <input type="hidden" value="{{date('h:i:s')}}" id="time"/>
    <input type="hidden"
           @if(isset($pos_open))
           value="{{$pos_open->id}}"
           @else
           value="0"
           @endif
           id="sale_bill_number">
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.select_unit').on('change', function () {
            let unit_id = $(this).val();
            let element_id = $(this).attr('element_id');
            $.post("{{route('change.product.element.unit')}}", {
                unit_id: unit_id,
                element_id: element_id,
                "_token": "{{csrf_token()}}"
            }, function (data) {
                $.post("{{url('/client/pos-open/elements')}}",
                    {"_token": "{{ csrf_token() }}"},
                    function (elements) {
                        $('.bill_details').html(elements);
                    });
                $.post("{{url('/client/pos-open/refresh')}}",
                    {"_token": "{{ csrf_token() }}"},
                    function (proto) {
                        $('#items').html(proto.items);
                        $('#total_quantity').html("( " + proto.total_quantity + " )");
                        $('#sum').html(proto.sum);
                        $('#total').html(proto.total);
                        $('#final_total').val(proto.total);
                        $('#tds_2').html(proto.percent);
                        $('#tds').html(proto.discount_value);
                        $('#sale_bill_number').val(proto.pos_open_id);
                    });
                var audioElement = document.createElement('audio');
                audioElement.setAttribute('src', "{{asset('app-assets/mp3/beep.mp3')}}");
                audioElement.play();
            });
        });
        $('#product_id').on('change', function () {
            let product_id = $(this).val();
            let notes = $('#notes').val();
            let outer_client_id = $('#outer_client_id').val();
            $.post("{{url('/client/pos-open/post')}}", {
                outer_client_id: outer_client_id,
                product_id: product_id,
                notes: notes,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $.post("{{url('/client/pos-open/elements')}}",
                    {"_token": "{{ csrf_token() }}"},
                    function (elements) {
                        $('.bill_details').html(elements);
                    });
                $.post("{{url('/client/pos-open/refresh')}}",
                    {"_token": "{{ csrf_token() }}"},
                    function (proto) {
                        $('#items').html(proto.items);
                        $('#total_quantity').html("( " + proto.total_quantity + " )");
                        $('#sum').html(proto.sum);
                        $('#total').html(proto.total);
                        $('#final_total').val(proto.total);
                        $('#tds_2').html(proto.percent);
                        $('#tds').html(proto.discount_value);
                        $('#sale_bill_number').val(proto.pos_open_id);
                    });
                var audioElement = document.createElement('audio');
                audioElement.setAttribute('src', "{{asset('app-assets/mp3/beep.mp3')}}");
                audioElement.play();
            });
            $('#product_id').val('');
        });
        $('.edit_quantity').on('change', function () {
            let element_id = $(this).attr('element_id');
            let edit_quantity = $(this).val();
            if (edit_quantity > 0) {
                $.post("{{url('/client/pos-open/edit-quantity')}}", {
                    element_id: element_id,
                    edit_quantity: edit_quantity,
                    "_token": "{{csrf_token()}}"
                }, function (data) {
                    $.post("{{url('/client/pos-open/elements')}}",
                        {"_token": "{{csrf_token()}}"},
                        function (elements) {
                            $('.bill_details').html(elements);
                        });
                    $.post("{{url('/client/pos-open/refresh')}}",
                        {"_token": "{{ csrf_token() }}"},
                        function (proto) {
                            $('#items').html(proto.items);
                            $('#total_quantity').html("( " + proto.total_quantity + " )");
                            $('#sum').html(proto.sum);
                            $('#total').html(proto.total);
                            $('#final_total').val(proto.total);
                            $('#tds_2').html(proto.percent);
                            $('#tds').html(proto.discount_value);
                        });
                    var audioElement = document.createElement('audio');
                    audioElement.setAttribute('src', "{{asset('app-assets/mp3/beep.mp3')}}");
                    audioElement.play();
                });
            } else {
                @if(App::getLocale() == 'ar')
                alert('اكتب رقم صحيح اكبر من 0');
                @else
                alert('Write an integer greater than 0');
                @endif
            }

        });
        $('.edit_price').on('change', function () {
            let element_id = $(this).attr('element_id');
            let edit_price = $(this).val();
            if (edit_price > 0) {
                $.post("{{url('/client/pos-open/edit-price')}}", {
                    element_id: element_id,
                    edit_price: edit_price,
                    "_token": "{{csrf_token()}}"
                }, function (data) {
                    $.post("{{url('/client/pos-open/elements')}}",
                        {"_token": "{{csrf_token()}}"},
                        function (elements) {
                            $('.bill_details').html(elements);
                        });
                    $.post("{{url('/client/pos-open/refresh')}}",
                        {"_token": "{{ csrf_token() }}"},
                        function (proto) {
                            $('#items').html(proto.items);
                            $('#total_quantity').html("( " + proto.total_quantity + " )");
                            $('#sum').html(proto.sum);
                            $('#total').html(proto.total);
                            $('#final_total').val(proto.total);
                            $('#tds_2').html(proto.percent);
                            $('#tds').html(proto.discount_value);
                        });
                    var audioElement = document.createElement('audio');
                    audioElement.setAttribute('src', "{{asset('app-assets/mp3/beep.mp3')}}");
                    audioElement.play();
                });
            } else {
                @if(App::getLocale() == 'ar')
                alert('اكتب رقم صحيح اكبر من 0');
                @else
                alert('Write an integer greater than 0');
                @endif
            }

        });
        $('.edit_quantity_price').on('change', function () {
            let element_id = $(this).attr('element_id');
            let edit_quantity_price = $(this).val();
            if (edit_quantity_price > 0) {
                $.post("{{url('/client/pos-open/edit-quantity-price')}}", {
                    element_id: element_id,
                    edit_quantity_price: edit_quantity_price,
                    "_token": "{{csrf_token()}}"
                }, function (data) {
                    $.post("{{url('/client/pos-open/elements')}}",
                        {"_token": "{{csrf_token()}}"},
                        function (elements) {
                            $('.bill_details').html(elements);
                        });
                    $.post("{{url('/client/pos-open/refresh')}}",
                        {"_token": "{{ csrf_token() }}"},
                        function (proto) {
                            $('#items').html(proto.items);
                            $('#total_quantity').html("( " + proto.total_quantity + " )");
                            $('#sum').html(proto.sum);
                            $('#total').html(proto.total);
                            $('#final_total').val(proto.total);
                            $('#tds_2').html(proto.percent);
                            $('#tds').html(proto.discount_value);
                        });
                    var audioElement = document.createElement('audio');
                    audioElement.setAttribute('src', "{{asset('app-assets/mp3/beep.mp3')}}");
                    audioElement.play();
                });
            } else {
                @if(App::getLocale() == 'ar')
                alert('اكتب رقم صحيح اكبر من 0');
                @else
                alert('Write an integer greater than 0');
                @endif
            }

        });
        $('.remove_element').on('click', function () {
            let element_id = $(this).attr('element_id');
            $.post("{{url('/client/pos-open/delete-element')}}", {
                element_id: element_id,
                "_token": "{{csrf_token()}}"
            }, function (data) {
                $.post("{{url('/client/pos-open/elements')}}",
                    {"_token": "{{csrf_token()}}"},
                    function (elements) {
                        $('.bill_details').html(elements);
                    });
                $.post("{{url('/client/pos-open/refresh')}}",
                    {"_token": "{{ csrf_token() }}"},
                    function (proto) {
                        $('#items').html(proto.items);
                        $('#total_quantity').html("( " + proto.total_quantity + " )");
                        $('#sum').html(proto.sum);
                        $('#total').html(proto.total);
                        $('#final_total').val(proto.total);
                        $('#tds_2').html(proto.percent);
                        $('#tds').html(proto.discount_value);
                    });
                var audioElement = document.createElement('audio');
                audioElement.setAttribute('src', "{{asset('app-assets/mp3/beep.mp3')}}");
                audioElement.play();
            });
        });
        $('.save_discount').on('click', function () {
            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();
            if (discount_value == "") {
                $('#discount_value').css('border', '1px solid red');
            } else {
                $('#discount_value').css('border', '1px solid #BABFC7');
                $.post("{{route('pos.open.store.discount')}}", {
                    discount_type: discount_type,
                    discount_value: discount_value,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('#modaldemo7').modal('toggle');
                    if (discount_type == "pound") {
                        $('#tds').html(discount_value);
                    } else {
                        $('#tds').html(discount_value + " % ");
                    }
                    $.post("{{url('/client/pos-open/refresh')}}",
                        {"_token": "{{ csrf_token() }}"},
                        function (proto) {
                            $('#items').html(proto.items);
                            $('#total_quantity').html("( " + proto.total_quantity + " )");
                            $('#sum').html(proto.sum);
                            $('#total').html(proto.total);
                            $('#final_total').val(proto.total);
                            $('#tds_2').html(proto.percent);
                            $('#tds').html(proto.discount_value);
                        });
                    var audioElement = document.createElement('audio');
                    audioElement.setAttribute('src', "{{asset('app-assets/mp3/beep.mp3')}}");
                    audioElement.play();
                });
            }
        });
        $('#tax_id').on('change', function () {
            let tax_id = $(this).val();
            let tax_value = 0;
            if (tax_id == 0) {
                tax_value = 0;
            } else {
                tax_value = $('option:selected', this).attr('taxvalue');
            }
            $('#tax_value').val(tax_value)
        });
        $('.save_tax').on('click', function () {
            let tax_id = $('#tax_id').val();
            let tax_value = $('#tax_value').val();
            if (tax_id == "") {
                $('#tax_id').css('border', '1px solid red');
            } else if (tax_value == "") {
                $('#tax_value').css('border', '1px solid red');
            } else {
                $('#tax_id').css('border', '1px solid #BABFC7');
                $('#tax_value').css('border', '1px solid #BABFC7');
                $.post("{{route('pos.open.store.tax')}}", {
                    tax_id: tax_id,
                    tax_value: tax_value,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('#modaldemo6').modal('toggle');
                    $('#tds_2').html(data.percent);
                    $('#tds').html(proto.discount_value);
                });
                $.post("{{url('/client/pos-open/refresh')}}",
                    {"_token": "{{ csrf_token() }}"},
                    function (proto) {
                        $('#items').html(proto.items);
                        $('#total_quantity').html("( " + proto.total_quantity + " )");
                        $('#sum').html(proto.sum);
                        $('#total').html(proto.total);
                        $('#final_total').val(proto.total);
                        $('#tds_2').html(proto.percent);
                        $('#tds').html(proto.discount_value);
                    });
                var audioElement = document.createElement('audio');
                audioElement.setAttribute('src', "{{asset('app-assets/mp3/beep.mp3')}}");
                audioElement.play();
            }
        });
        $('#pending').on('click', function () {
            let notes = $('#notes_2').val();
            if (notes == "") {
                @if(App::getLocale() == 'ar')
                alert('لابد وان تكتب الملاحظة المرجعية');
                @else
                alert('You must write the reference note');
                @endif
            } else {
                $.post("{{route('pos.open.pending')}}", {
                    "_token": "{{ csrf_token() }}",
                    notes: notes
                }, function (data) {
                    $('#modaldemo4').modal('toggle');
                    alert(data.reason);
                    if (data.success == 1) {
                        location.reload();
                    }
                });
            }
        });
        $('#reset').on('click', function () {
            let final_total = $('#final_total').val();
            $.post("{{route('pos.open.delete')}}", {
                "_token": "{{ csrf_token() }}",
                final_total: final_total,
            }, function (data) {
                $('#modaldemo5').modal('toggle');
                alert(data.reason);
                if (data.success == 1) {
                    location.reload();
                }
            });
        });
        $('.category').on('click', function () {
            var category_id = $(this).attr('category_id');
            var sub_category_id = "all";
            $.post("{{url('/client/pos/get-subcategories-by-category-id')}}", {
                category_id: category_id,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $('.sub_categories').html(data);
                $.post("{{url('/client/pos/get-products-by-sub-category-id')}}", {
                    sub_category_id: sub_category_id,
                    category_id: category_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('.products').html(data);
                });
            });
        });
        $('.sub_category').on('click', function () {
            var sub_category_id = $(this).attr('sub_category_id');
            $.post("{{url('/client/pos/get-products-by-sub-category-id')}}", {
                sub_category_id: sub_category_id,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $('.products').html(data);
            });
        });
        $('.add_outer_client').on('click', function () {
            let client_name = $('#client_name2').val();
            let client_email = $('#client_email').val();
            let client_phone = $('#client_phone').val();
            let client_address = $('#client_address').val();
            let client_national = $('#client_national').val();
            let prev_balance = $('#prev_balance').val();
            let shop_name = $('#shop_name').val();
            let client_category = $('#client_category').val();
            if (client_name == "" || client_national == "" || prev_balance == "" || client_category == "") {
                if (client_name == "") {
                    $('#client_name2').css('border', '1px solid red');
                } else {
                    $('#client_name2').css('border', '1px solid #BABFC7');
                }
                if (client_national == "") {
                    $('#client_national').css('border', '1px solid red');
                } else {
                    $('#client_national').css('border', '1px solid #BABFC7');
                }
                if (prev_balance == "") {
                    $('#prev_balance').css('border', '1px solid red');
                } else {
                    $('#prev_balance').css('border', '1px solid #BABFC7');
                }
                if (client_category == "") {
                    $('#client_category').css('border', '1px solid red');
                } else {
                    $('#client_category').css('border', '1px solid #BABFC7');
                }
            } else {
                $.post("{{route('client.outer_clients.storePos')}}", {
                    client_name: client_name,
                    client_email: client_email,
                    client_phone: client_phone,
                    client_address: client_address,
                    client_national: client_national,
                    prev_balance: prev_balance,
                    shop_name: shop_name,
                    client_category: client_category,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    let outer_client_id = data.outer_client_id;
                    let outer_client_name = data.client_name;
                    $('#client_name2').val('');
                    $('#client_email').val('');
                    $('#client_phone').val('');
                    $('#client_address').val('');
                    $('#client_national').val('');
                    $('#prev_balance').val('');
                    $('#shop_name').val('');
                    $('#client_category').val('');
                    $('#modaldemo9').modal('toggle');
                    $('select#outer_client_id').append('<option selected value="' + outer_client_id + '">' + outer_client_name + '</option>');
                    $('select#outer_client_id').selectpicker('refresh');
                });
            }
        });
        $('.show_outer_client').on('click', function () {
            let outer_client_id = $('#outer_client_id').val();
            if (outer_client_id == "") {
                @if(App::getLocale() == 'ar')
                alert('اختر العميل اولا');
                @else
                alert('Choose Client First');
                @endif
            } else {
                $.post("{{route('client.outer_clients.showPos')}}", {
                    outer_client_id: outer_client_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('.outer_client_details').html(data);
                    $('#modaldemo8').modal('toggle');
                });
            }
        });
        $('.add_product').on('click', function () {
            let store_id = $('#store_id').val();
            let category_id = $('#category_id').val();
            let product_name = $('#product_name').val();
            let wholesale_price = $('#wholesale_price').val();
            let first_balance = $('#first_balance').val();
            let sector_price = $('#sector_price').val();
            let purchasing_price = $('#purchasing_price').val();
            let code_universal = $('#code_universal').val();
            let min_balance = $('#min_balance').val();

            if (product_name == "" || store_id == "" || category_id == "" || wholesale_price == "" || first_balance == ""
                || sector_price == "" || purchasing_price == "" || min_balance == "") {

                if (product_name == "") {
                    $('#product_name').css('border', '1px solid red');
                } else {
                    $('#product_name').css('border', '1px solid #BABFC7');
                }
                if (store_id == "") {
                    $('#store_id').css('border', '1px solid red');
                } else {
                    $('#store_id').css('border', '1px solid #BABFC7');
                }
                if (category_id == "") {
                    $('#category_id').css('border', '1px solid red');
                } else {
                    $('#category_id').css('border', '1px solid #BABFC7');
                }
                if (wholesale_price == "") {
                    $('#wholesale_price').css('border', '1px solid red');
                } else {
                    $('#wholesale_price').css('border', '1px solid #BABFC7');
                }
                if (first_balance == "") {
                    $('#first_balance').css('border', '1px solid red');
                } else {
                    $('#first_balance').css('border', '1px solid #BABFC7');
                }
                if (sector_price == "") {
                    $('#sector_price').css('border', '1px solid red');
                } else {
                    $('#sector_price').css('border', '1px solid #BABFC7');
                }
                if (purchasing_price == "") {
                    $('#purchasing_price').css('border', '1px solid red');
                } else {
                    $('#purchasing_price').css('border', '1px solid #BABFC7');
                }
                if (min_balance == "") {
                    $('#min_balance').css('border', '1px solid red');
                } else {
                    $('#min_balance').css('border', '1px solid #BABFC7');
                }

            } else {
                $.post("{{route('client.products.storePos')}}", {
                    store_id: store_id,
                    category_id: category_id,
                    product_name: product_name,
                    wholesale_price: wholesale_price,
                    first_balance: first_balance,
                    sector_price: sector_price,
                    purchasing_price: purchasing_price,
                    code_universal: code_universal,
                    min_balance: min_balance,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    let product_id = data.product_id;
                    let product_name = data.product_name;
                    let code_universal = data.code_universal;
                    $('#store_id').val('');
                    $('#category_id').val('');
                    $('#product_name').val('');
                    $('#wholesale_price').val('');
                    $('#first_balance').val('');
                    $('#sector_price').val('');
                    $('#purchasing_price').val('');
                    $('#code_universal').val('');
                    $('#min_balance').val('');
                    $('#modaldemo10').modal('toggle');
                    $('select#product_id').append('<option selected value="' + product_id + '" data-tokens= "' + code_universal + '">' + product_name + '</option>');
                    $('select#product_id').selectpicker('refresh');
                });
            }
        });
        $('.pending').on('click', function () {
            var pos_open_id = $(this).attr('pos_open_id');
            var notes = $(this).attr('notes');
            $('#posopenid').val(pos_open_id);
            $('#notes_2').val(notes);
        });
        $('#open_pending').on('click', function () {
            let pos_open_id = $('#posopenid').val();
            $.post("{{route('pos.open.restore')}}", {
                "_token": "{{ csrf_token() }}",
                "pos_open_id": pos_open_id
            }, function (data) {
                $('#modaldemo3').modal('toggle');
                location.reload();
            });
        });
        $('#payment_method').on('change', function () {
            let payment_method = $(this).val();
            let outer_client_id = $('#outer_client_id').val();
            if (payment_method == "cash") {
                $('.cash').show();
                $('.bank').hide();
                $('.coupon').hide();
            } else if (payment_method == "bank") {
                $('.bank').show();
                $('.cash').hide();
                $('.coupon').hide();
            } else if (payment_method == "coupon") {
                $.post("{{route('get.coupon.codes')}}", {
                    "_token": "{{ csrf_token() }}",
                    outer_client_id: outer_client_id,
                }, function (data) {
                    $('#couponcode').html(data);
                    $('#couponcode').selectpicker('refresh');
                });

                $('.coupon').show();
                $('.bank').hide();
                $('.cash').hide();
            } else {
                $('.bank').hide();
                $('.cash').hide();
                $('.coupon').hide();
            }
        });
        $('#couponcode').on('change', function () {
            let coupon_code = $(this).val();
            $.post("{{route('get.coupon.code')}}", {
                "_token": "{{ csrf_token() }}",
                "coupon_code": coupon_code,
            }, function (data) {
                if (data.status == "success") {
                    $('#amount').val(data.coupon_value).attr('readonly', true);
                    $('.pay_cash').removeClass('disabled');
                    $('.pay_cash').attr('disabled', false);
                } else {
                    $('.pay_cash').addClass('disabled');
                    $('.pay_cash').attr('disabled', true);
                    $('#amount').val("").attr('readonly', false);
                }
            });
        });
        $('#payment').on('click', function () {
            let final_total = $('#final_total').val();
            $('#amount').val(final_total);
            $.post("{{route('pos.open.check')}}", {
                "_token": "{{ csrf_token() }}",
            }, function (data) {
                if (data.success == 0) {
                    alert(data.reason);
                    $('#modaldemo').modal('hide');
                }
            });
        });
        $('.pay_cash').on('click', function () {
            let company_id = $('#company_id').val();
            let outer_client_id = $('#outer_client_id').val();
            let sale_bill_number = "pos_" + $('#sale_bill_number').val();
            let date = $('#date').val();
            let time = $('#time').val();
            let coupon_code = $('#couponcode').val();
            let cash_number = $('#cash_number').val();
            let amount = $('#amount').val();
            let safe_id = $('#safe_id').val();
            let bank_id = $('#bank_id').val();
            let bank_check_number = $('#bank_check_number').val();
            let notes = $('#bank_notes').val();
            let payment_method = $('#payment_method').val();
            if (payment_method == "") {
                @if(App::getLocale() == 'ar')
                alert('اختر طريقة الدفع');
                @else
                alert('choose payment method');
                @endif
            } else {
                $.post("{{route('client.store.cash.clients.pos','test')}}", {
                    outer_client_id: outer_client_id,
                    company_id: company_id,
                    bill_id: sale_bill_number,
                    date: date,
                    time: time,
                    coupon_code: coupon_code,
                    cash_number: cash_number,
                    amount: amount,
                    safe_id: safe_id,
                    bank_id: bank_id,
                    bank_check_number: bank_check_number,
                    notes: notes,
                    payment_method: payment_method,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    if (data.status == true) {
                        $('<div class="alert alert-dark alert-sm"> ' + data.msg + '</div>').insertAfter('#company_id');

                        $('.delete_pay').on('click', function () {
                            let payment_method = $(this).attr('payment_method');
                            let cash_id = $(this).attr('cash_id');
                            $.post("{{route('pay.delete')}}", {
                                '_token': "{{csrf_token()}}",
                                payment_method: payment_method,
                                cash_id: cash_id,
                            }, function (data) {

                            });
                            $(this).parent().hide();
                        });
                    } else {
                        $('<p class="alert alert-danger alert-sm"> ' + data.msg + '</p>').insertAfter('#company_id');
                    }
                });
            }
        });
        $('#save_pos').on('click', function () {
            let final_total = $('#final_total').val();
            let notes = $('#notes').val();
            $.post("{{route('pos.open.done')}}", {
                "_token": "{{ csrf_token() }}",
                final_total: final_total,
                notes: notes,
            }, function (data) {
                alert(data.reason);
                if (data.success == 1) {
                    location.href = '/client/pos-print/' + data.pos_id;
                }
            });
        });
        $('#finish_cash').on('click', function () {
            let final_total = $('#final_total').val();
            let no_safe = $('#no_safe').val();
            if (no_safe == "no_safe") {
                @if(App::getLocale() == 'ar')
                alert('لم يتم تحديد خزنة لنقطة البيع فى اعدادات نقطة البيع');
                @else
                alert('The point of sale safe is not specified in the point of sale settings');
                @endif
            } else {
                $.post("{{route('pos.open.finish.cash')}}", {
                    "_token": "{{ csrf_token() }}",
                    final_total: final_total,
                }, function (data) {
                    alert(data.reason);
                    if (data.success == 1) {
                        location.href = '/client/pos-print/' + data.pos_id;
                    }
                });
            }
        });

        $('#finish_bank').on('click', function () {
            let final_total = $('#final_total').val();
            let no_bank = $('#no_bank').val();
            if (no_bank == "no_bank") {
                @if(App::getLocale() == 'ar')
                alert('لم يتم تحديد بنك لنقطة البيع فى اعدادات نقطة البيع');
                @else
                alert('The point of sale bank is not specified in the point of sale settings');
                @endif
            } else {
                $.post("{{route('pos.open.finish.bank')}}", {
                    "_token": "{{ csrf_token() }}",
                    final_total: final_total,
                }, function (data) {
                    alert(data.reason);
                    if (data.success == 1) {
                        location.href = '/client/pos-print/' + data.pos_id;
                    }
                });
            }
        });
        $('.edit_bill').on('click', function () {
            let bill_id = $('#bill_id').val();
            $.post("{{route('pos.edit')}}", {
                "_token": "{{ csrf_token() }}",
                bill_id: bill_id,
            }, function (data) {
                if (data.success == 1) {
                    location.reload();
                } else {
                    $('#msg').html(data.message);
                }
            });
        });
        $('.remove_bill').on('click', function () {
            let bill_id = $('#bill_id').val();
            $.post("{{route('pos.delete')}}", {
                "_token": "{{ csrf_token() }}",
                bill_id: bill_id,
            }, function (data) {
                if (data.success == 1) {
                    alert(data.message);
                    location.reload();
                } else {
                    $('#msg').html(data.message);
                }
            });
        });
        $('.delete_pay').on('click', function () {
            let payment_method = $(this).attr('payment_method');
            let cash_id = $(this).attr('cash_id');
            $.post("{{route('pay.delete')}}", {
                "_token": "{{ csrf_token() }}",
                payment_method: payment_method,
                cash_id: cash_id,
            }, function (data) {

            });
            $(this).parent().parent().hide();
        });
        $('#current').on('keyup blur change', function () {
            let current = $(this).val();
            let previous = $('#previous').val();
            let difference = previous - current;
            $('#difference').val(difference);
        });
        $('.add_serials').on('click', function () {
            let element_id = $(this).parent().parent().find('.select_unit').attr('element_id');
            let product_unit_id = $(this).parent().parent().find('.select_unit').val();
            let quantity = $(this).parent().parent().find('.edit_quantity').val();
            if (quantity <= 0) {
                @if(App::getLocale() == 'ar')
                alert('الكمية غير مقبولة');
                @else
                alert('Quantity is not suitable');
                @endif
            } else {
                $.post('{{route('add.serials.pos')}}', {
                    quantity: quantity,
                    element_id: element_id,
                    product_unit_id: product_unit_id
                }, function (data) {
                    $('.serials').html(data);
                });
            }
        });
    });
</script>
