@extends('client.layouts.app-main')
<style>
    .btn.dropdown-toggle.bs-placeholder, .form-control {
        height: 40px !important;
    }

    a, a:hover {
        text-decoration: none;
        color: #444;
    }

    .bootstrap-select {
        width: 80% !important;
    }

    .bill_details {
        margin-top: 30px !important;
        min-height: 150px !important;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show text-center">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="alert alert-success alert-dismissable text-center box_success d-none no-print">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        <span class="msg_success"></span>
    </div>

    <div class="alert alert-dark alert-dismissable text-center box_error d-none no-print">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        <span class="msg_error"></span>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-dark no-print">
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
    <form target="_blank" action="#" method="POST">
        @csrf
        @method('POST')
        @if(isset($open_sale_bill) && !empty($open_sale_bill))
            <input type="hidden" value="{{$open_sale_bill->sale_bill_number}}" id="sale_bill_number"/>
        @else
            <input type="hidden" value="{{$pre_bill}}" id="sale_bill_number"/>
        @endif
        <h6 class="alert alert-success alert-sm text-center no-print" dir="rtl">
            <center>
                @if(isset($open_sale_bill) && !empty($open_sale_bill))
                    @if(App::getLocale() == 'ar')
                        تعديل فاتورة مبيعات عملاء
                    @else
                        Edit Sale Bill
                    @endif
                @else
                    @if(App::getLocale() == 'ar')
                        اضافة فاتورة مبيعات عملاء جديدة
                    @else
                        Add New Sale Bill
                    @endif
                @endif

                <span>
                    @if(App::getLocale() == 'ar')
                        رقم العملية  :
                    @else
                        Process Number :
                    @endif

                    @if(isset($open_sale_bill) && !empty($open_sale_bill))
                        {{$open_sale_bill->sale_bill_number}}
                    @else
                        {{$pre_bill}}
                    @endif
                </span>
            </center>
        </h6>
        <div class="col-lg-3 pull-right no-print">
            <label for="" class="d-block">
                @if(App::getLocale() == 'ar')
                    اسم العميل
                @else
                    Client Name
                @endif
            </label>
            <select required name="outer_client_id" id="outer_client_id" class="selectpicker"
                    data-style="btn-danger" data-live-search="true"
                    @if(App::getLocale() == 'ar')
                    data-title="ابحث"
                    @else
                    data-title="Search"
                @endif
            >
                <option
                    @if(isset($open_sale_bill) && !empty($open_sale_bill) && empty($open_sale_bill->outer_client_id))
                    selected
                    @endif
                    value="">
                    @if(App::getLocale() == 'ar')
                        فاتورة بيع نقدى
                    @else
                        Cash Sale Bill
                    @endif
                </option>
                @foreach($outer_clients as $outer_client)
                    <option
                        @if(isset($open_sale_bill) && !empty($open_sale_bill) && $outer_client->id == $open_sale_bill->outer_client_id)
                        selected value="{{$open_sale_bill->outer_client_id}}"
                        @else
                        value="{{$outer_client->id}}"
                        @endif
                    >{{$outer_client->client_name}}</option>
                @endforeach
            </select>
            <a target="_blank" href="{{route('client.outer_clients.create')}}" role="button"
               style="width: 15%;display: inline;"
               class="btn btn-sm btn-danger open_popup">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 pull-right no-print">
            <div class="form-group" dir="rtl">
                <label for="date">
                    @if(App::getLocale() == 'ar')
                        تاريخ الفاتورة
                    @else
                        Bill Date
                    @endif
                </label>
                <input type="date" required name="date"
                       @if(isset($open_sale_bill) && !empty($open_sale_bill))
                       value="{{$open_sale_bill->date}}"
                       @else
                       value="<?php echo date("Y-m-d"); ?>"
                       @endif
                       id="date"
                       class="form-control"/>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 pull-right no-print">
            <div class="form-group" dir="rtl">
                <label for="time">
                    @if(App::getLocale() == 'ar')
                        وقت الفاتورة
                    @else
                        Bill Time
                    @endif
                </label>
                <input type="time" required name="time"
                       @if(isset($open_sale_bill) && !empty($open_sale_bill))
                       value="{{$open_sale_bill->time}}"
                       @else
                       value="<?php echo date("H:i:s"); ?>"
                       @endif
                       id="time"
                       class="form-control"/>
            </div>
        </div>
        <div class="col-lg-3 pull-right">
            <label for="">
                @if(App::getLocale() == 'ar')
                    اختر المخزن
                @else
                    Choose Store
                @endif
            </label>
            <select name="store_id" id="store_id" class="selectpicker"
                    data-style="btn-danger" data-live-search="true"
                    @if(App::getLocale() == 'ar')
                    data-title="ابحث"
                    @else
                    data-title="Search"
                @endif
            >
                <?php $i = 0; ?>
                @foreach($stores as $store)
                    @if($stores->count() == 1)
                        <option selected value="{{$store->id}}">{{$store->store_name}}</option>
                    @else
                        @if($i ==  0)
                            <option selected value="{{$store->id}}">{{$store->store_name}}</option>
                        @else
                            <option value="{{$store->id}}">{{$store->store_name}}</option>
                        @endif
                    @endif
                    <?php $i++; ?>
                @endforeach
            </select>
            <a target="_blank" href="{{route('client.stores.create')}}" role="button"
               style="width: 15%;display: inline;"
               class="btn btn-sm btn-danger open_popup">
                <i class="fa fa-plus"></i>
            </a>
        </div>


        <div class="clearfix no-print"></div>

        <div class="outer_client_details no-print"
             @if(!isset($open_sale_bill) || empty($open_sale_bill) || empty($open_sale_bill->outer_client_id))
             style="display: none !important;"
            @endif>
            <table class="table table-bordered table-striped table-condensed table-hover w-75 float-left">
                <thead>
                <th>
                    @if(App::getLocale() == 'ar')
                        الفئة
                    @else
                        Category
                    @endif
                </th>
                <th>
                    @if(App::getLocale() == 'ar')
                        مديونية سابقة
                    @else
                        Previous Debt
                    @endif
                </th>
                <th>
                    @if(App::getLocale() == 'ar')
                        جنسية
                    @else
                        Nationality
                    @endif
                </th>
                <th>
                    @if(App::getLocale() == 'ar')
                        رقم ضريبى
                    @else
                        Tax Number
                    @endif
                </th>
                <th>
                    @if(App::getLocale() == 'ar')
                        رقم هاتف
                    @else
                        Phone Number
                    @endif
                </th>
                <th>
                    @if(App::getLocale() == 'ar')
                        عنوان
                    @else
                        Address
                    @endif
                </th>
                <th>
                    @if(App::getLocale() == 'ar')
                        المحل
                    @else
                        Shop Name
                    @endif
                </th>
                </thead>
                <tbody>
                <tr>
                    <td id="category">
                        @if(isset($open_sale_bill) && !empty($open_sale_bill) && !empty($open_sale_bill->outer_client_id))
                            {{trans('main.'.$open_sale_bill->OuterClient->client_category)}}
                        @endif
                    </td>
                    <td id="balance_before">
                        @if(isset($open_sale_bill) && !empty($open_sale_bill) && !empty($open_sale_bill->outer_client_id))
                            {{$open_sale_bill->OuterClient->prev_balance}}
                        @endif
                    </td>
                    <td id="client_national">
                        @if(isset($open_sale_bill) && !empty($open_sale_bill) && !empty($open_sale_bill->outer_client_id))
                            {{$open_sale_bill->OuterClient->client_national}}
                        @endif
                    </td>
                    <td id="tax_number">
                        @if(isset($open_sale_bill) && !empty($open_sale_bill) && !empty($open_sale_bill->outer_client_id))
                            {{$open_sale_bill->OuterClient->tax_number}}
                        @endif
                    </td>
                    <td id="client_phone">
                        @if(isset($open_sale_bill) && !empty($open_sale_bill) && !empty($open_sale_bill->outer_client_id) && !$open_sale_bill->OuterClient->phones->isEmpty())
                            {{$open_sale_bill->OuterClient->phones[0]->client_phone}}
                        @endif
                    </td>
                    <td id="client_address">
                        @if(isset($open_sale_bill) && !empty($open_sale_bill) && !empty($open_sale_bill->outer_client_id) && !$open_sale_bill->OuterClient->addresses->isEmpty())
                            {{$open_sale_bill->OuterClient->addresses[0]->client_address}}
                        @endif
                    </td>
                    <td id="shop_name">
                        @if(isset($open_sale_bill) && !empty($open_sale_bill) && !empty($open_sale_bill->outer_client_id))
                            {{$open_sale_bill->OuterClient->shop_name}}
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="col-lg-3 col-md-3 col-sm-3 pull-right no-print">
                <div class="form-group" dir="rtl">
                    <label for="time">
                        @if(App::getLocale() == 'ar')
                            ملاحظات على الفاتورة
                        @else
                            Notes
                        @endif
                    </label>
                    <input type="text" name="notes"
                           @if(isset($open_sale_bill) && !empty($open_sale_bill))
                           value="{{$open_sale_bill->notes}}"
                           @endif id="notes"
                           class="form-control"/>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <hr class="no-print">
        <div class="options no-print">
            <div class="col-lg-3 pull-right">
                <label for="">
                    @if(App::getLocale() == 'ar')
                        كود المنتج او الاسم
                    @else
                        Product Name Or Barcode
                    @endif
                </label>
                <select name="product_id" id="product_id" class="selectpicker"
                        data-style="btn-success" data-live-search="true"
                        @if(App::getLocale() == 'ar')
                        data-title="ابحث"
                        @else
                        data-title="Search"
                    @endif
                >
                    @foreach($all_products as $product)
                        <option value="{{$product->id}}"
                                data-tokens="{{$product->code_universal}}"
                        >{{$product->product_name}}</option>
                    @endforeach
                </select>
                <a target="_blank" href="{{route('client.products.create')}}" role="button"
                   style="width: 15%;display: inline;"
                   class="btn btn-sm btn-danger open_popup">
                    <i class="fa fa-plus"></i>
                </a>
                <div class="available text-center" style="color: #000; font-size: 14px; margin-top: 10px;"></div>

            </div>
            <div class="col-lg-3 pull-right">
                <label class="d-block" for="">
                    @if(App::getLocale() == 'ar')
                        الكمية
                    @else
                        Quantity
                    @endif
                </label>
                <input style="width: 50%;" type="text" name="quantity" id="quantity"
                       class="form-control d-inline float-left"/>
                <select style="width: 50%;" class="form-control d-inline float-right" name="product_unit_id"
                        id="product_unit_id">
                </select>
            </div>
            <div class="col-lg-3 pull-right">
                <label for="">
                    @if(App::getLocale() == 'ar')
                        سعر المنتج
                    @else
                        Product Price
                    @endif
                </label>
                <input style="margin-right:5px;margin-left:5px;" type="radio" name="price" id="sector"/>
                {{trans('main.قطاعى')}}
                <input style="margin-right:5px;margin-left:5px;" type="radio" name="price" id="wholesale"/>
                {{trans('main.جملة')}}
                <input
                    @cannot('تعديل السعر في فاتورة البيع')
                    readonly
                    @endcan
                    type="text" name="product_price" value="0" id="product_price" class="form-control"/>
            </div>

            <div class="col-lg-3 pull-right">
                <label for="">
                    @if(App::getLocale() == 'ar')
                        الاجمالى
                    @else
                        Total
                    @endif
                </label>
                <input @cannot('تعديل السعر في فاتورة البيع')
                       readonly
                       @endcan
                       type="text" name="quantity_price" id="quantity_price" class="form-control"/>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
        <div class="col-lg-12 text-center">
            <button type="button" id="add" class="btn btn-info btn-md mt-3">
                <i class="fa fa-plus"></i>
                @if(App::getLocale() == 'ar')
                    اضافة الى فاتورة المبيعات
                @else
                    Add To Sale Bill
                @endif
            </button>
            <button type="button" id="edit" style="display: none" class="btn btn-success btn-md mt-3">
                <i class="fa fa-pencil"></i>
                @if(App::getLocale() == 'ar')
                    تعديل
                @else
                    Edit
                @endif
            </button>
        </div>
        <hr>
        </div>
        <div class="company_details printy" style="display: none;">
            <div class="text-center">
                <img class="logo" style="width: 20%;" src="{{asset($company->company_logo)}}" alt="">
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
        <div class="col-lg-12 col-md-12 col-sm-12 bill_details">
            <h6 class="alert alert-sm alert-dark text-center">
                <i class="fa fa-success-circle"></i>
                @if(App::getLocale() == 'ar')
                    بيانات عناصر فاتورة المبيعات رقم
                @else
                    Sale Bill items - number :
                @endif
                @if(isset($open_sale_bill) && !empty($open_sale_bill))
                    {{$open_sale_bill->sale_bill_number}}
                @else
                    {{$pre_bill}}
                @endif
            </h6>

            <?php
            if (isset($open_sale_bill) && !empty($open_sale_bill)) {
                $elements = \App\Models\SaleBillElement::where('sale_bill_id', $open_sale_bill->id)->get();
                $extras = \App\Models\SaleBillExtra::where('sale_bill_id', $open_sale_bill->id)->get();
                $extra_settings = \App\Models\ExtraSettings::where('company_id', $company_id)->first();
                $currency = $extra_settings->currency;
                $tax_value_added = $company->tax_value_added;
                $sum = array();
                if (!$elements->isEmpty()) {
                    $i = 0;
                    echo "<table class='table table-condensed table-striped table-bordered'>";
                    echo "<thead>";
                    echo "<th>  # </th>";
                    echo "<th>";
                    if (App::getLocale() == "ar") {
                        echo "اسم المنتج";
                    } else {
                        echo "Product Name";
                    }
                    echo "</th>";
                    echo "<th>";
                    if (App::getLocale() == "ar") {
                        echo "سعر الوحدة";
                    } else {
                        echo "Unit Price";
                    }
                    echo "</th>";
                    echo "<th>";
                    if (App::getLocale() == "ar") {
                        echo "الكمية";
                    } else {
                        echo "Quantity";
                    }
                    echo "
                    </th>";
                    echo "<th>";
                    if (App::getLocale() == "ar") {
                        echo "الاجمالى";
                    } else {
                        echo "Total";
                    }
                    echo "</th>";
                    echo "<th> ";
                    if (App::getLocale() == "ar") {
                        echo "سيريالات";
                    } else {
                        echo "Serials";
                    }
                    echo "</th>";
                    echo "<th class='no-print'>";
                    if (App::getLocale() == 'ar') {
                        echo "تحكم";
                    } else {
                        echo "Control";
                    }
                    echo "</th>";
                    echo "</thead>";
                    echo "<tbody>";
                    foreach ($elements as $element) {
                        array_push($sum, $element->quantity_price);
                        echo "<tr>";
                        echo "<td>" . ++$i . "</td>";
                        echo "<td>" . $element->product->product_name . "</td>";
                        echo "<td>" . $element->product_price . "</td>";
                        echo "<td>" . $element->quantity . " " . $element->unit->unit->unit_name . "</td>";
                        echo "<td>" . $element->quantity_price . "</td>";
                        echo "<td><a
                            element_id = '" . $element->id . "' product_unit_id = '" . $element->product_unit_id . "'
                            quantity = '" . $element->quantity . "' style='font-size: 20px!important;'
                            class='btn btn-sm btn-info add_serials' data-toggle='modal' href='#modaldemo100'><i class='fa fa-barcode'></i></a></td>";
                        echo "<td class='no-print'>
                            <button type='button' sale_bill_number='" . $element->SaleBill->sale_bill_number . "' element_id='" . $element->id . "' class='btn btn-sm btn-info edit_element'>
                                <i class='fa fa-pencil'></i>
                                ";
                        if (App::getLocale() == 'ar') {
                            echo "تعديل";
                        } else {
                            echo "Edit";
                        }
                        echo "</button>
                            <button type='button' sale_bill_number='" . $element->SaleBill->sale_bill_number . "' element_id='" . $element->id . "' class='btn btn-sm btn-danger remove_element'>
                                <i class='fa fa-trash'></i>";
                        if (App::getLocale() == 'ar') {
                            echo "حذف";
                        } else {
                            echo "Delete";
                        }
                        echo "</button>
                        </td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $total = array_sum($sum);
                    $percentage = ($tax_value_added / 100) * $total;
                    $after_total = $total + $percentage;
                    echo "
            <div class='clearfix'></div>
            <div class='alert alert-dark alert-sm text-center'>
                <div class='pull-right col-lg-6 '>
                     ";
                    if (App::getLocale() == "ar") {
                        echo "اجمالى الفاتورة";
                    } else {
                        echo "Total";
                    }
                    echo $total . " " . trans('main.' . $currency) . "
                </div>
                <div class='pull-left col-lg-6 '>";
                    if (App::getLocale() == "ar") {
                        echo "اجمالى الفاتورة  بعد القيمة المضافة";
                    } else {
                        echo "Bill Total After VAT";
                    }
                    echo $after_total . " " . trans('main.' . $currency) . "
                </div>
                <div class='clearfix'></div>
            </div>";
                }
            }
            ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 after_totals">
            <?php
            if (isset($open_sale_bill) && !empty($open_sale_bill)) {
                $tax_value_added = $company->tax_value_added;
                $sum = array();
                foreach ($elements as $element) {
                    array_push($sum, $element->quantity_price);
                }
                $total = array_sum($sum);
                $previous_extra = \App\Models\SaleBillExtra::where('sale_bill_id', $open_sale_bill->id)
                    ->where('action', 'extra')->first();
                if (!empty($previous_extra)) {
                    $previous_extra_type = $previous_extra->action_type;
                    $previous_extra_value = $previous_extra->value;
                    if ($previous_extra_type == "percent") {
                        $previous_extra_value = $previous_extra_value / 100 * $total;
                    }
                    $after_discount = $total + $previous_extra_value;
                }
                $previous_discount = \App\Models\SaleBillExtra::where('sale_bill_id', $open_sale_bill->id)
                    ->where('action', 'discount')->first();
                if (!empty($previous_discount)) {
                    $previous_discount_type = $previous_discount->action_type;
                    $previous_discount_value = $previous_discount->value;
                    if ($previous_discount_type == "percent") {
                        $previous_discount_value = $previous_discount_value / 100 * $total;
                    }
                    $after_discount = $total - $previous_discount_value;

                }
                if (!empty($previous_extra) && !empty($previous_discount)) {
                    $after_discount = $total - $previous_discount_value + $previous_extra_value;
                } else {
                    $after_discount = $total;
                }
                if (isset($after_discount) && $after_discount != 0) {
                    $percentage = ($tax_value_added / 100) * $after_discount;
                    $after_total_all = $after_discount + $percentage;
                } else {
                    $percentage = ($tax_value_added / 100) * $total;
                    $after_total_all = $total + $percentage;
                }
                echo "
                <div class='clearfix'></div>
                <div class='alert alert-secondary alert-sm text-center'>";
                if (App::getLocale() == "ar") {
                    echo "اجمالى الفاتورة النهائى بعد الضريبة والشحن والخصم :";
                } else {
                    echo "Final total invoice after tax, shipping and discount";
                }
                echo $after_total_all . " " . trans('main.' . $currency) . "
                </div>";
            }
            ?>
        </div>

        <div class="clearfix no-print"></div>
        <hr class="no-print">
        <div class="row no-print" style="margin: 20px auto;">
            <div class="col-lg-12">
                <div class="col-lg-6 col-md-6 col-xs-6 pull-right">
                    <div class="form-group" dir="rtl">
                        <label for="discount">
                            @if(App::getLocale() == 'ar')
                                خصم على اجمالى الفاتورة
                            @else
                                Discount on Bill Total
                            @endif
                        </label> <br>
                        <?php
                        if (isset($open_sale_bill) && !empty($open_sale_bill)) {
                            foreach ($extras as $key) {
                                if ($key->action == "discount") {
                                    if ($key->action_type == "pound") {
                                        $sale_bill_discount_value = $key->value;
                                        $sale_bill_discount_type = "pound";
                                    } else {
                                        $sale_bill_discount_value = $key->value;
                                        $sale_bill_discount_type = "percent";
                                    }
                                } else {
                                    if ($key->action_type == "pound") {
                                        $sale_bill_extra_value = $key->value;
                                        $sale_bill_extra_type = "pound";
                                    } else {
                                        $sale_bill_extra_value = $key->value;
                                        $sale_bill_extra_type = "percent";
                                    }
                                }
                            }
                        }
                        ?>
                        @if (isset($open_sale_bill) && !empty($open_sale_bill))
                            <select name="discount_type" id="discount_type" class="form-control"
                                    style="width: 20%;display: inline;float: right; margin-left:5px;">
                                <option @if($sale_bill_discount_type == "pound") selected
                                        @endif value="pound">{{$extra_settings->currency}}</option>
                                <option @if($sale_bill_discount_type == "percent") selected @endif value="percent">%
                                </option>
                            </select>
                            <input type="text" value="{{$sale_bill_discount_value}}" name="discount_value"
                                   style="width: 50%;display: inline;float: right;"
                                   id="discount_value" class="form-control "/>
                            <button type="button" class="btn btn-md btn-success pull-right text-center"
                                    style="display: inline !important;width: 20% !important; height: 40px;margin-right: 20px; "
                                    id="exec_discount">
                                @if(App::getLocale() == 'ar')
                                    تطبيق
                                @else
                                    Apply
                                @endif

                            </button>
                        @else
                            <select name="discount_type" id="discount_type" class="form-control" disabled
                                    style="width: 20%;display: inline;float: right; margin-left:5px;">
                                <option value="pound">{{$extra_settings->currency}}</option>
                                <option value="percent">%</option>
                            </select>
                            <input type="text" value="0" name="discount_value"
                                   style="width: 50%;display: inline;float: right;"
                                   disabled id="discount_value" class="form-control "/>
                            <button type="button" disabled class="btn btn-md btn-success pull-right text-center"
                                    style="display: inline !important;width: 20% !important; height: 40px;margin-right: 20px; "
                                    id="exec_discount">
                                @if(App::getLocale() == 'ar')
                                    تطبيق
                                @else
                                    Apply
                                @endif

                            </button>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6 pull-right">
                    <div class="form-group" dir="rtl">
                        <label for="extra">
                            @if(App::getLocale() == 'ar')
                                مصاريف الشحن
                            @else
                                Shipping Fees
                            @endif
                        </label> <br>
                        @if (isset($open_sale_bill) && !empty($open_sale_bill))
                            <select name="extra_type" id="extra_type" class="form-control"
                                    style="width: 20%;display: inline;float: right;margin-left: 5px">
                                <option @if($sale_bill_extra_type == "pound") selected
                                        @endif value="pound">{{$extra_settings->currency}}</option>
                                <option @if($sale_bill_extra_type == "percent") selected @endif value="percent">%
                                </option>
                            </select>
                            <input value="{{$sale_bill_extra_value}}" type="text" name="extra_value"
                                   style="width: 50%;display: inline;float: right;"
                                   id="extra_value" class="form-control"/>
                            <button type="button" class="btn btn-md btn-success pull-right text-center"
                                    style="display: inline !important;width: 20% !important; height: 40px;margin-right: 20px; "
                                    id="exec_extra">

                                @if(App::getLocale() == 'ar')
                                    تطبيق
                                @else
                                    Apply
                                @endif
                            </button>
                        @else
                            <select disabled name="extra_type" id="extra_type" class="form-control"
                                    style="width: 20%;display: inline;float: right;margin-left: 5px">
                                <option value="pound">{{$extra_settings->currency}}</option>
                                <option value="percent">%</option>
                            </select>
                            <input disabled value="0" type="text" name="extra_value"
                                   style="width: 50%;display: inline;float: right;"
                                   id="extra_value" class="form-control"/>
                            <button disabled type="button" class="btn btn-md btn-success pull-right text-center"
                                    style="display: inline !important;width: 20% !important; height: 40px;margin-right: 20px; "
                                    id="exec_extra">

                                @if(App::getLocale() == 'ar')
                                    تطبيق
                                @else
                                    Apply
                                @endif
                            </button>
                        @endif
                    </div>
                </div>
                <div class="clearfix"></div>
            </div> <!--  End Col-lg-12 -->
        </div><!--  End Row -->
    </form>
    <div class="col-lg-12 no-print" style="padding-top: 25px;height: 40px !important;">
        <button type="button"
                @if (!isset($open_sale_bill) || empty($open_sale_bill))
                disabled
                @endif
                data-toggle="modal"
                data-target="#myModal2"
                class="btn btn-md btn-dark pay_btn pull-right">
            <i class="fa fa-money"></i>
            @if(App::getLocale() == 'ar')
                تسجيل الدفع
            @else
                Create Payment
            @endif
        </button>

        <form class="d-inline" method="POST" action="{{route('client.sale_bills.cancel')}}">
            @csrf
            @method('POST')
            @if (isset($open_sale_bill) && !empty($open_sale_bill))
                <input type="hidden" value="{{$open_sale_bill->sale_bill_number}}" name="sale_bill_number"/>
            @else
                <input type="hidden" value="{{$pre_bill}}" name="sale_bill_number"/>
            @endif
            <button href="" type="submit" @if (!isset($open_sale_bill) || empty($open_sale_bill)) disabled @endif
            class="btn btn-md close_btn btn-danger pull-right ml-3"><i
                    class="fa fa-check"></i>
                @if(App::getLocale() == 'ar')
                    الغاء وخروج
                @else
                    Cancel & Exit
                @endif
            </button>
        </form>
        <a href="javascript:;" role="button"
           class="btn @if (!isset($open_sale_bill) || empty($open_sale_bill)) disabled @endif save_btn btn-md btn-success pull-right ml-3"><i
                class="fa fa-check"></i>
            @if(App::getLocale() == 'ar')
                حفظ وطباعة وخروج
            @else
                Save & Print
            @endif
        </a>
    </div>

    <div class="modal fade" dir="rtl" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header w-100">
                    <h4 class="modal-title text-center" id="myModalLabel2">
                        @if(App::getLocale() == 'ar')
                            دفع نقدى
                        @else
                            Create Cash Payment
                        @endif
                    </h4>
                </div>
                <div class="modal-body">
                    @if((isset($sale_bill_cash) && !$sale_bill_cash->isEmpty()) || (isset($sale_bill_bank_cash) && !$sale_bill_bank_cash->isEmpty()))
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
                                        Payment Method
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        Delete
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $j = 0; ?>
                            @if(isset($sale_bill_cash) && !$sale_bill_cash->isEmpty())
                                @foreach($sale_bill_cash as $cash)
                                    <tr>
                                        <td>{{++$j}}</td>
                                        <td>{{$cash->amount}}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                دفع كاش نقدى
                                            @else
                                                Cash Payment
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
                                                    Delete
                                                @endif
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            @if(isset($sale_bill_bank_cash) && !$sale_bill_bank_cash->isEmpty())
                                @foreach($sale_bill_bank_cash as $cash)
                                    <tr>
                                        <td>{{++$j}}</td>
                                        <td>{{$cash->amount}}</td>
                                        <td>
                                            @if(App::getLocale() == 'ar')
                                                دفع بنكى شبكة
                                            @else
                                                Bank Payment
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
                                                    Delete
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
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    المبلغ المدفوع
                                @else
                                    Paid Amount
                                @endif
                                <span class="text-danger">*</span></label>
                            <input required class="form-control"
                                   id="amount" type="text" dir="ltr">
                        </div>
                        <div class="col-md-4">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    طريقة الدفع
                                @else
                                    Payment Method
                                @endif
                                <span class="text-danger">*</span></label>
                            <select required id="payment_method" name="payment_method" class="form-control">
                                <option value="">
                                    @if(App::getLocale() == 'ar')
                                        اختر طريقة الدفع
                                    @else
                                        Choose Payment Method
                                    @endif
                                </option>
                                <option value="cash">
                                    @if(App::getLocale() == 'ar')
                                        دفع كاش نقدى
                                    @else
                                        Cash Payment
                                    @endif
                                </option>
                                <option value="bank">
                                    @if(App::getLocale() == 'ar')
                                        دفع بنكى شبكة
                                    @else
                                        Bank Payment
                                    @endif
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 cash" style="display: none;">
                        <div class="col-md-4">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    خزنة الدفع
                                @else
                                    Safe Name
                                @endif
                                <span class="text-danger">*</span></label>
                            <select style="width: 80% !important; display: inline !important;" required id="safe_id"
                                    class="form-control">
                                <option value="">
                                    @if(App::getLocale() == 'ar')
                                        اختر خزنة الدفع
                                    @else
                                        Choose Safe
                                    @endif
                                </option>
                                @foreach($safes as $safe)
                                    <option
                                        value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                @endforeach
                            </select>
                            <a target="_blank" href="{{route('client.safes.create')}}" role="button"
                               style="width: 15%;display: inline;"
                               class="btn btn-sm btn-danger open_popup">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3 bank" style="display: none;">
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
                                        Choose Bank
                                    @endif
                                </option>
                                @foreach($banks as $bank)
                                    <option
                                        value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                @endforeach
                            </select>
                            <a target="_blank" href="{{route('client.banks.create')}}" role="button"
                               style="width: 15%;display: inline;"
                               class="btn btn-sm btn-danger open_popup">
                                <i class="fa fa-plus"></i>
                            </a>
                        </div>
                        <div class="col-md-4">
                            <label for="">
                                @if(App::getLocale() == 'ar')
                                    رقم المعاملة
                                @else
                                    Bank Check Number
                                @endif
                            </label>
                            <input type="text" class="form-control" id="bank_check_number"/>
                        </div>
                        <div class="col-md-4">
                            <label for="">
                                @if(App::getLocale() == 'ar')
                                    ملاحظات
                                @else
                                    Notes
                                @endif
                            </label>
                            <input type="text" class="form-control" id="bank_notes"/>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-success pd-x-20 pay_cash" type="button">
                            @if(App::getLocale() == 'ar')
                                تسجيل الدفع
                            @else
                                Create Payment
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
                            Close
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
    <input type="hidden" id="final_total"
           @if (isset($open_sale_bill) && !empty($open_sale_bill)) value="{{$open_sale_bill->final_total}}" @endif />
    <input type="hidden" id="product" name="product"/>
    <input type="hidden" id="total" name="total"/>
    <input type="hidden" value="0" id="check"/>
    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $('.save_btn').on('click', function () {
            let sale_bill_number = $('#sale_bill_number').val();
            let payment_method = $('#payment_method').val();
            $.post("{{url('/client/sale-bills/saveAll')}}", {
                sale_bill_number: sale_bill_number,
                payment_method: payment_method,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                location.href = '/sale-bills/print/' + sale_bill_number;
            });
        });
        $('.pay_cash').on('click', function () {
            let company_id = $('#company_id').val();
            let outer_client_id = $('#outer_client_id').val();
            let sale_bill_number = $('#sale_bill_number').val();
            let date = $('#date').val();
            let time = $('#time').val()
            let cash_number = $('#cash_number').val();
            let amount = $('#amount').val();
            let safe_id = $('#safe_id').val();
            let bank_id = $('#bank_id').val();
            let bank_check_number = $('#bank_check_number').val();
            let notes = $('#bank_notes').val();
            let payment_method = $('#payment_method').val();
            $.post("{{route('client.store.cash.outerClients.SaleBill','test')}}", {
                outer_client_id: outer_client_id,
                company_id: company_id,
                bill_id: sale_bill_number,
                date: date,
                time: time,
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
                        $.post("{{route('sale_bills.pay.delete')}}", {
                            '_token': "{{csrf_token()}}",
                            payment_method: payment_method,
                            cash_id: cash_id,
                        }, function (data) {

                        });
                        $(this).parent().hide();
                    });
                } else {
                    $('<br/><br/> <p class="alert alert-dark alert-sm"> ' + data.msg + '</p>').insertAfter('#company_id');
                }
            });
        });
        $('.delete_pay').on('click', function () {
            let payment_method = $(this).attr('payment_method');
            let cash_id = $(this).attr('cash_id');
            $.post("{{route('sale_bills.pay.delete')}}", {
                '_token': "{{csrf_token()}}",
                payment_method: payment_method,
                cash_id: cash_id,
            }, function (data) {

            });
            $(this).parent().parent().hide();

        });
        $('#outer_client_id').on('change', function () {
            let outer_client_id = $(this).val();
            if (outer_client_id != "") {
                $('.outer_client_details').fadeIn(200);
                $.post("{{url('/client/sale-bills/getOuterClientDetails')}}", {
                    outer_client_id: outer_client_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('#category').html(data.category);
                    $('#balance_before').html(data.balance_before);
                    $('#client_national').html(data.client_national);
                    $('#tax_number').html(data.tax_number);
                    $('#shop_name').html(data.shop_name);
                    $('#client_phone').html(data.client_phone);
                    $('#client_address').html(data.client_address);
                });
            } else {
                $('.outer_client_details').fadeOut(200);
            }
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
            $('#sector').prop('checked', false);
            $('#quantity').val('');
            $('#quantity_price').val('');
            let sale_bill_number = $('#sale_bill_number').val();
            let product_id = $(this).val();
            $.post("{{route('get.product.units')}}", {
                product_id: product_id,
                "_token": "{{ csrf_token() }}"
            }, function (proto) {
                $('#product_unit_id').html(proto);
            });
            $.post("{{url('/client/sale-bills/get')}}", {
                product_id: product_id,
                sale_bill_number: sale_bill_number,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $('#wholesale').prop('checked', true);
                $('input#product_price').val(data.wholesale_price);
                $('input#quantity').val('1').attr('max', data.first_balance);
                $('input#quantity_price').val(data.wholesale_price);
                @if(App::getLocale() == 'ar')
                $('.available').html('الكمية المتاحة : ' + data.first_balance);
                @else
                $('.available').html('Available Quantity  : ' + data.first_balance);
                @endif
            });
        });
        $('#product_unit_id').on('change', function () {
            let product_unit_id = $(this).val();
            let sale_bill_number = $('#sale_bill_number').val();
            let quantity = $('#quantity').val();
            $.post("{{route('change.product.unit')}}", {
                product_unit_id: product_unit_id,
                sale_bill_number: sale_bill_number,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                let quantity_price = data.wholesale_price * quantity;
                $('#wholesale').prop('checked', true);
                $('input#product_price').val(data.wholesale_price);
                $('input#quantity').attr('max', data.first_balance);
                $('input#quantity_price').val(quantity_price);
                @if(App::getLocale() == 'ar')
                $('.available').html('الكمية المتاحة : ' + data.first_balance);
                @else
                $('.available').html('Available Quantity  : ' + data.first_balance);
                @endif
            });
        });
        $('#wholesale').on('click', function () {
            let product_id = $('#product_id').val();
            let product_unit_id = $('#product_unit_id').val();
            $.post("{{url('/client/sale-bills/change-product-price')}}", {
                product_id: product_id,
                product_unit_id: product_unit_id,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $('input#product_price').val(data.wholesale_price);
                let quantity = $('#quantity').val();
                let quantity_price = quantity * data.wholesale_price;
                $('#quantity_price').val(quantity_price);
            });
        });
        $('#sector').on('click', function () {
            let product_id = $('#product_id').val();
            let product_unit_id = $('#product_unit_id').val();
            $.post("{{url('/client/sale-bills/change-product-price')}}", {
                product_id: product_id,
                product_unit_id: product_unit_id,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $('input#product_price').val(data.sector_price);
                let quantity = $('#quantity').val();
                let quantity_price = quantity * data.sector_price;
                $('#quantity_price').val(quantity_price);
            });
        });
        $('#quantity').on('keyup change', function () {
            let product_id = $('#product_id').val();
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
            let outer_client_id = $('#outer_client_id').val();
            let sale_bill_number = $('#sale_bill_number').val();
            let product_id = $('#product_id').val();
            let product_price = $('#product_price').val();
            let quantity = $('#quantity').val();
            let date = $('#date').val();
            let time = $('#time').val();
            let notes = $('#notes').val();
            let quantity_price = quantity * product_price;
            let product_unit_id = $('#product_unit_id').val();
            let first_balance = parseFloat($('#quantity').attr('max'));

            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();

            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();

            if (product_id == "" || product_id <= "0") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار المنتج أولا");
                @else
                alert("You Must Choose Product First !");
                @endif
            } else if (product_price == "" || product_price == "0") {
                @if(App::getLocale() == 'ar')
                alert("لم يتم اختيار سعر المنتج");
                @else
                alert("You Haven't Chosen Product Price Yet !");
                @endif

            } else if (quantity == "" || quantity <= "0" || quantity > first_balance) {
                @if(App::getLocale() == 'ar')
                alert("الكمية غير مناسبة");
                @else
                alert("Quantity is not correct");
                @endif
            } else if (quantity_price == "" || quantity_price == "0") {
                @if(App::getLocale() == 'ar')
                alert("الكمية غير مناسبة او الاجمالى غير صحيح");
                @else
                alert("Quantity is not correct or total is not correct");
                @endif
            } else if (product_unit_id == "" || product_unit_id == "0") {
                @if(App::getLocale() == 'ar')
                alert("اختر الوحدة");
                @else
                alert("Choose Unit First !");
                @endif
            } else {
                $.post("{{url('/client/sale-bills/post')}}", {
                    outer_client_id: outer_client_id,
                    sale_bill_number: sale_bill_number,
                    product_id: product_id,
                    product_price: product_price,
                    quantity: quantity,
                    product_unit_id: product_unit_id,
                    quantity_price: quantity_price,
                    date: date,
                    notes: notes,
                    time: time,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('#outer_client_id').attr('disabled', true).addClass('disabled');
                    $('#product_id').val('').trigger('change');
                    $('#product_unit_id').val('');
                    $('#discount_type').attr('disabled', false);
                    $('.print_btn').removeClass('disabled');
                    $('.pay_btn').attr('disabled', false);
                    $('.close_btn').attr('disabled', false);
                    $('.save_btn').removeClass('disabled');
                    $('.send_btn').removeClass('disabled');
                    $('#discount_value').attr('disabled', false);
                    $('#exec_discount').attr('disabled', false);
                    $('#extra_type').attr('disabled', false);
                    $('#extra_value').attr('disabled', false);
                    $('#exec_extra').attr('disabled', false);
                    $('.available').html("");
                    $('#product_price').val('0');
                    $('#quantity').val('');
                    $('#quantity_price').val('');
                    if (data.status == true) {
                        $('.box_success').removeClass('d-none').fadeIn(200);
                        $('.msg_success').html(data.msg);
                        $('.box_success').delay(3000).fadeOut(300);
                        $.post("{{url('/client/sale-bills/elements')}}",
                            {"_token": "{{ csrf_token() }}", sale_bill_number: sale_bill_number},
                            function (elements) {
                                $('.bill_details').html(elements);
                            });

                        $.post("{{url('/client/sale-bills/discount')}}",
                            {
                                "_token": "{{ csrf_token() }}",
                                sale_bill_number: sale_bill_number,
                                discount_type: discount_type,
                                discount_value: discount_value
                            },
                            function (data) {
                                $('.after_totals').html(data);
                            });

                        $.post("{{url('/client/sale-bills/extra')}}",
                            {
                                "_token": "{{ csrf_token() }}",
                                sale_bill_number: sale_bill_number,
                                extra_type: extra_type,
                                extra_value: extra_value
                            },
                            function (data) {
                                $('.after_totals').html(data);
                            });
                        $.post("{{url('/client/sale-bills/refresh')}}",
                            {
                                "_token": "{{ csrf_token() }}",
                                sale_bill_number: sale_bill_number,
                            },
                            function (data) {
                                $('#final_total').val(data.final_total);
                            });

                    } else {
                        $('.box_error').removeClass('d-none').fadeIn(200);
                        $('.msg_error').html(data.msg);
                        $('.box_error').delay(3000).fadeOut(300);
                        $.post("{{url('/client/sale-bills/elements')}}",
                            {"_token": "{{ csrf_token() }}", sale_bill_number: sale_bill_number},
                            function (elements) {
                                $('.bill_details').html(elements);
                            });

                        $.post("{{url('/client/sale-bills/discount')}}",
                            {
                                "_token": "{{ csrf_token() }}",
                                sale_bill_number: sale_bill_number,
                                discount_type: discount_type,
                                discount_value: discount_value
                            },
                            function (data) {
                                $('.after_totals').html(data);
                            });

                        $.post("{{url('/client/sale-bills/extra')}}",
                            {
                                "_token": "{{ csrf_token() }}",
                                sale_bill_number: sale_bill_number,
                                extra_type: extra_type,
                                extra_value: extra_value
                            },
                            function (data) {
                                $('.after_totals').html(data);
                            });
                        $.post("{{url('/client/sale-bills/refresh')}}",
                            {
                                "_token": "{{ csrf_token() }}",
                                sale_bill_number: sale_bill_number,
                            },
                            function (data) {
                                $('#final_total').val(data.final_total);
                            });
                    }
                });
            }
        });
        $('#exec_discount').on('click', function () {
            let sale_bill_number = $('#sale_bill_number').val();
            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();
            $.post("{{url('/client/sale-bills/discount')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    sale_bill_number: sale_bill_number,
                    discount_type: discount_type,
                    discount_value: discount_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
            $.post("{{url('/client/sale-bills/refresh')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    sale_bill_number: sale_bill_number,
                },
                function (data) {
                    $('#final_total').val(data.final_total);
                });
        });
        $('.pay_btn').on('click', function () {
            let final_total = $('#final_total').val();
            $('#amount').val(final_total);
        })
        $('.edit_element').on('click', function () {
            let element_id = $(this).attr('element_id');
            let sale_bill_number = $(this).attr('sale_bill_number');
            let product_unit_id = $('#product_unit_id').val();
            $.post("{{url('/client/sale-bills/edit-element')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    sale_bill_number: sale_bill_number,
                    element_id: element_id
                },
                function (data) {
                    $('#product_id').val(data.product_id);
                    $('#product_id').selectpicker('refresh');
                    $('#product_price').val(data.product_price);
                    $('#quantity').val(data.quantity);
                    $('#quantity_price').val(data.quantity_price);
                    let product_id = data.product_id;
                    $.post("{{url('/client/sale-bills/get-edit')}}", {
                        product_id: product_id,
                        product_unit_id: data.product_unit_id,
                        sale_bill_number: sale_bill_number,
                        "_token": "{{ csrf_token() }}"
                    }, function (data) {
                        $('input#quantity').attr('max', data.first_balance);
                        @if(App::getLocale() == 'ar')
                        $('.available').html('الكمية المتاحة : ' + data.first_balance);
                        @else
                        $('.available').html('Avaialble Quantity : ' + data.first_balance);
                        @endif
                    });
                    $.post("{{route('get.edit.product.units')}}", {
                        product_id: product_id,
                        "_token": "{{ csrf_token() }}"
                    }, function (proto) {
                        $('#product_unit_id').html(proto).val(data.product_unit_id);
                    });
                    $('#add').hide();
                    $('#edit').show();
                    $('#edit').attr('element_id', element_id);
                    $('#edit').attr('sale_bill_number', sale_bill_number);

                });
        });
        $('#edit').on('click', function () {
            let element_id = $(this).attr('element_id');
            let sale_bill_number = $(this).attr('sale_bill_number');

            let product_id = $('#product_id').val();
            let product_price = $('#product_price').val();
            let quantity = $('#quantity').val();
            let quantity_price = $('#quantity_price').val();
            let product_unit_id = $('#product_unit_id').val();

            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();
            let first_balance = parseFloat($('#quantity').attr('max'));
            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();
            if (product_id == "" || product_id <= "0") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار المنتج أولا");
                @else
                alert("You Must Choose Product First !");
                @endif
            } else if (product_price == "" || product_price == "0") {
                @if(App::getLocale() == 'ar')
                alert("لم يتم اختيار سعر المنتج");
                @else
                alert("You Haven't Chosen Product Price Yet !");
                @endif
            } else if (quantity == "" || quantity <= "0" || quantity > first_balance) {
                @if(App::getLocale() == 'ar')
                alert("الكمية غير مناسبة");
                @else
                alert("Quantity is not correct");
                @endif
            } else if (quantity_price == "" || quantity_price == "0") {
                @if(App::getLocale() == 'ar')
                alert("الكمية غير مناسبة او الاجمالى غير صحيح");
                @else
                alert("Quantity is not correct or total is not correct");
                @endif
            } else if (product_unit_id == "" || product_unit_id == "0") {
                @if(App::getLocale() == 'ar')
                alert("اختر الوحدة");
                @else
                alert("Choose Unit First !");
                @endif
            } else {
                $.post('/client/sale-bills/element/update',
                    {
                        '_token': "{{ csrf_token() }}",
                        element_id: element_id,
                        product_id: product_id,
                        product_price: product_price,
                        quantity: quantity,
                        quantity_price: quantity_price,
                        product_unit_id: product_unit_id,
                    },
                    function (data) {
                        $.post('/client/sale-bills/elements',
                            {'_token': "{{ csrf_token() }}", sale_bill_number: sale_bill_number},
                            function (elements) {
                                $('.bill_details').html(elements);
                            });
                        $('#add').show();
                        $('#edit').hide();
                        $('#product_id').val('').trigger('change');
                        $('#product_unit_id').val('');
                        $('.available').html("");
                        $('#product_price').val('0');
                        $('#quantity').val('');
                        $('#quantity_price').val('');
                    });
                $.post('/client/sale-bills/discount',
                    {
                        '_token': "{{ csrf_token() }}",
                        sale_bill_number: sale_bill_number,
                        discount_type: discount_type,
                        discount_value: discount_value
                    },
                    function (data) {
                        $('.after_totals').html(data);
                    });

                $.post('/client/sale-bills/extra',
                    {
                        '_token': "{{ csrf_token() }}",
                        sale_bill_number: sale_bill_number,
                        extra_type: extra_type,
                        extra_value: extra_value
                    },
                    function (data) {
                        $('.after_totals').html(data);
                    });
                $.post("{{url('/client/sale-bills/refresh')}}",
                    {
                        "_token": "{{ csrf_token() }}",
                        sale_bill_number: sale_bill_number,
                    },
                    function (data) {
                        $('#final_total').val(data.final_total);
                    });
            }

        });
        $('.remove_element').on('click', function () {
            let element_id = $(this).attr('element_id');
            let sale_bill_number = $(this).attr('sale_bill_number');

            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();

            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();

            $.post('/client/sale-bills/element/delete',
                {'_token': "{{ csrf_token() }}", element_id: element_id},
                function (data) {
                    $.post('/client/sale-bills/elements',
                        {'_token': "{{ csrf_token() }}", sale_bill_number: sale_bill_number},
                        function (elements) {
                            $('.bill_details').html(elements);
                        });
                });
            $.post('/client/sale-bills/discount',
                {
                    '_token': "{{ csrf_token() }}",
                    sale_bill_number: sale_bill_number,
                    discount_type: discount_type,
                    discount_value: discount_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });

            $.post('/client/sale-bills/extra',
                {
                    '_token': "{{ csrf_token() }}",
                    sale_bill_number: sale_bill_number,
                    extra_type: extra_type,
                    extra_value: extra_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
            $.post("{{url('/client/sale-bills/refresh')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    sale_bill_number: sale_bill_number,
                },
                function (data) {
                    $('#final_total').val(data.final_total);
                });

            $(this).parent().parent().fadeOut(300);
        });
        $('#exec_extra').on('click', function () {
            let sale_bill_number = $('#sale_bill_number').val();
            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();
            $.post("{{url('/client/sale-bills/extra')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    sale_bill_number: sale_bill_number,
                    extra_type: extra_type,
                    extra_value: extra_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
            $.post("{{url('/client/sale-bills/refresh')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    sale_bill_number: sale_bill_number,
                },
                function (data) {
                    $('#final_total').val(data.final_total);
                });
        });
        $('#payment_method').on('change', function () {
            let payment_method = $(this).val();
            if (payment_method == "cash") {
                $('.cash').show();
                $('.bank').hide();
            } else if (payment_method == "bank") {
                $('.bank').show();
                $('.cash').hide();
            } else {
                $('.bank').hide();
                $('.cash').hide();
            }
        });
        $('.add_serials').on('click', function () {
            let element_id = $(this).attr('element_id');
            let product_unit_id = $(this).attr('product_unit_id');
            let quantity = $(this).attr('quantity');
            if (quantity <= 0) {
                @if(App::getLocale() == 'ar')
                alert('الكمية غير مقبولة');
                @else
                alert('Quantity is not suitable');
                @endif
            } else {
                $.post('{{route('add.serials.sales')}}', {
                    quantity: quantity,
                    element_id: element_id,
                    product_unit_id: product_unit_id
                }, function (data) {
                    $('.serials').html(data);
                });
            }
        });
    </script>
@endsection
