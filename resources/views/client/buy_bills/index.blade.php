@extends('client.layouts.app-main')
<style>
    .bootstrap-select {
        width: 75% !important;
        height: 40px !important;
    }

    .btn {
        height: 40px !important;
    }

    .btn-sm {
        height: 30px !important;
        padding: 5px !important;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif

    <h4 class="alert alert-sm alert-dark text-center no-print">
        @if(App::getLocale() == 'ar')
            فواتير مشتريات الموردين السابقة
        @else
            Buy Bills
        @endif
    </h4>
    <div class="col-lg-3 pull-right  no-print">
        <form action="{{route('client.buy_bills.filter.key')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label style="display:block;" for="bill_id">
                    @if(App::getLocale() == 'ar')
                        بحث برقم الفاتورة
                    @else
                        Search By Bill Number
                    @endif
                </label>
                <select required class="selectpicker" data-live-search="true"
                        @if(App::getLocale() == 'ar')
                        data-title="ابحث"
                        @else
                        data-title="Search"
                        @endif

                        data-style="btn-danger"
                        name="buy_bill_id" id="buy_bill_id">
                    @foreach($buy_bills as $buy_bill)
                        <option @if(isset($buy_bill_k) && ($buy_bill->id == $buy_bill_k->id))
                                selected
                                @endif
                                value="{{$buy_bill->id}}">{{$buy_bill->buy_bill_number}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-md btn-danger"
                        style="display: inline !important;width: 20% !important; float: left !important;"
                        id="by_buy_bill_id"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="col-lg-3 pull-right  no-print">
        <form action="{{route('client.buy_bills.filter.supplier')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label style="display:block;" for="supplier_id">
                    @if(App::getLocale() == 'ar')
                        بحث باسم المورد
                    @else
                        Search By Supplier Name
                    @endif
                </label>
                <select required class="selectpicker" data-live-search="true"
                        @if(App::getLocale() == 'ar')
                        data-title="ابحث"
                        @else
                        data-title="Search"
                        @endif

                        data-style="btn-info"
                        name="supplier_id" id="supplier_id">
                    @foreach($suppliers as $supplier)
                        <option @if(isset($supplier_k) && ($supplier->id == $supplier_k->id))
                                selected
                                @endif
                                value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-md btn-info"
                        style="display: inline !important;width: 20% !important; float: left !important;"
                        id="by_supplier_id"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="col-lg-3 pull-right  no-print">
        <form action="{{route('client.buy_bills.filter.code')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label style="display:block;" for="code_universal">
                    @if(App::getLocale() == 'ar')
                        بحث بكود المنتج
                    @else
                        Search By Product BarCode
                    @endif
                </label>
                <select required class="selectpicker" data-live-search="true"
                        @if(App::getLocale() == 'ar')
                        data-title="ابحث"
                        @else
                        data-title="Search"
                        @endif
                        data-style="btn-success"
                        name="code_universal" id="code_universal">
                    @foreach($products as $product)
                        <option @if(isset($product_k) && ($product->id == $product_k->id))
                                selected
                                @endif
                                value="{{$product->id}}">{{$product->code_universal}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-md btn-success"
                        style="display: inline !important;width: 20% !important; float: left !important;"
                        id="by_code_universal"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="col-lg-3 pull-right  no-print">
        <form action="{{route('client.buy_bills.filter.product')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label style="display:block;" for="product_name">
                    @if(App::getLocale() == 'ar')
                        بحث باسم المنتج
                    @else
                        Search By Product Name
                    @endif
                </label>
                <select required class="selectpicker" data-live-search="true"
                        @if(App::getLocale() == 'ar')
                        data-title="ابحث"
                        @else
                        data-title="Search"
                        @endif

                        data-style="btn-warning" name="product_name" id="product_name">
                    @foreach($products as $product)
                        <option @if(isset($product_k) && ($product->id == $product_k->id))
                                selected
                                @endif
                                value="{{$product->id}}">{{$product->product_name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-md btn-warning"
                        style="display: inline !important;width: 20% !important; float: left !important;"
                        id="by_product_name"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="clearfix"></div>
    <div class="row" style="margin-top: 30px !important;">
        <div class="col-lg-12 text-center">
            <form action="{{route('client.buy_bills.filter.all')}}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-md btn-dark">
                    <i class="fa fa-list"></i>
                    @if(App::getLocale() == 'ar')
                        عرض كل فواتير المشتريات
                    @else
                        Show All Buy Bills
                    @endif
                </button>
            </form>
        </div>

    </div>

    <input type="hidden" id="total" name="total"/>
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
    <div id="bill_details">
        <div class="clearfix"></div>
        @if(isset($buy_bill_k) && !empty($buy_bill_k))
            <h6 class="alert alert-sm alert-danger text-center">
                <i class="fa fa-info-circle"></i>
                @if(App::getLocale() == 'ar')
                    بيانات عناصر الفاتورة رقم
                @else
                    Buy Bill Items - Number
                @endif
                {{$buy_bill_k->buy_bill_number}}
            </h6>
            <div class="col-lg-12 mb-1  alert alert-secondary alert-sm">
                <div class="col-3 pull-right">
                    @if(App::getLocale() == 'ar')
                        رقم الفاتورة :
                    @else
                        Bill Number
                    @endif
                    {{ $buy_bill_k->buy_bill_number }}
                </div>
                <div class="col-3 pull-right">
                    @if(App::getLocale() == 'ar')
                        تاريخ الفاتورة :
                    @else
                        Bill Date:
                    @endif
                    {{$buy_bill_k->date}}
                </div>
                <div class="col-3 pull-right">
                    @if(App::getLocale() == 'ar')
                        وقت الفاتورة :
                    @else
                        Bill Time :
                    @endif
                    {{$buy_bill_k->time}}
                </div>
                <div class="col-3 pull-right">
                    @if(App::getLocale() == 'ar')
                        ملاحظات الفاتورة :
                    @else
                        Bill Notes :
                    @endif
                    {{$buy_bill_k->notes}}
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="col-lg-12 mb-1  alert alert-secondary alert-sm">
                <div class="col-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        اسم المورد :
                    @else
                        Supplier Name :
                    @endif
                    {{ $buy_bill_k->supplier->supplier_name }}
                </div>
                <div class="col-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        عنوان المورد :
                    @else
                        Supplier Address
                    @endif
                    @if(!$buy_bill_k->supplier->addresses->isEmpty())
                        {{ $buy_bill_k->supplier->addresses[0]->supplier_address }}
                    @endif
                </div>
                <div class="col-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        تليفون المورد :
                    @else
                        Supplier Phone :
                    @endif
                    @if(!$buy_bill_k->supplier->phones->isEmpty())
                        {{ $buy_bill_k->supplier->phones[0]->supplier_phone }}
                    @endif
                </div>
                <div class="clearfix"></div>
            </div>

            <?php
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
            echo "</th>";
            echo "<th>";
            if (App::getLocale() == "ar") {
                echo "الاجمالى";
            } else {
                echo "Total";
            }
            echo "</th>";
            echo "<th class='no-print'>";
            if (App::getLocale() == "ar") {
                echo "ارتجاع";
            } else {
                echo "Return";
            }
            echo "</th>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($elements as $element) {
            array_push($sum, $element->quantity_price);
            echo "<tr>";
            echo "<td>" . ++$i . "</td>";
            echo "<td>" . $element->product->product_name . "</td>";
            echo "<td>" . floatval($element->product_price) . "</td>";
            echo "<td>" . floatval($element->quantity) . " " . $element->unit->unit->unit_name . "</td>";
            echo "<td>" . floatval($element->quantity_price) . "</td>";
            echo "<td class='no-print'>
                    <form action='/client/buy-bills/get-return' method='post'>
                        <input type='hidden' value='" . $element->BuyBill->id . "' name='buy_bill_id' />
                        <input type='hidden' value='" . $element->id . "' name='element_id' />
                        "; ?> @csrf
            <?php
            echo "
                    <button type='submit'
                       class='btn btn-md btn-danger remove_element'>
                        <i class='fa fa-refresh'></i> ";
            if (App::getLocale() == "ar") {
                echo "ارتجاع";
            } else {
                echo "Return";
            }
            echo "</button>
                    </form>
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
                <div class='alert alert-dark alert-sm text-center before_totals'>
                    <div class='pull-right col-6 '>";
            if (App::getLocale() == "ar") {
                echo "اجمالى الفاتورة";
            } else {
                echo "Bill Total ";
            }
            echo floatval($total) . " " . trans('main.' . $currency) . "
                    </div>
                    <div class='pull-left col-6 '>";
            if (App::getLocale() == "ar") {
                echo "اجمالى الفاتورة بعد القيمة المضافة";
            } else {
                echo "Bill Total After VAT";
            }
            echo floatval($after_total) . " " . trans('main.' . $currency) . "
                    </div>
                    <div class='clearfix'></div>
                </div>";
            echo "
                <div class='clearfix'></div>
                <div class='alert alert-dark alert-sm text-center'>";
            foreach ($extras as $key) {
                if ($key->action == "discount") {
                    echo "<div class='pull-right col-6 '>";
                    if ($key->action_type == "pound") {
                        if (App::getLocale() == "ar") {
                            echo "خصم";
                        } else {
                            echo "Discount";
                        }
                        echo $key->value . " " . trans('main.' . $currency);
                    } else {
                        if (App::getLocale() == "ar") {
                            echo "خصم";
                        } else {
                            echo "Discount";
                        }
                        echo $key->value . " % ";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='pull-right col-6 '>";
                    if ($key->action_type == "pound") {
                        if (App::getLocale() == "ar") {
                            echo "مصاريف شحن";
                        } else {
                            echo "Charging Expenses";
                        }
                        echo $key->value . " " . trans('main.' . $currency);
                    } else {
                        if (App::getLocale() == "ar") {
                            echo "مصاريف شحن";
                        } else {
                            echo "Charging Expenses";
                        }
                        echo $key->value . " % ";
                    }
                    echo "</div>";
                }
            }
            echo "<div class='clearfix'></div>";
            echo "</div>";
            echo "
                <div class='clearfix'></div>
                <div class='col-lg-12 col-md-12 col-sm-12 after_totals'>
                    <div class='alert alert-secondary alert-sm text-center'>";
            if (App::getLocale() == "ar") {
                echo "اجمالى الفاتورة النهائى بعد الضريبة والشحن والخصم :";
            } else {
                echo "Bill Total after VAT , Discount & Charging Expense :";
            }
            echo floatval($after_total_all) . " " . trans('main.' . $currency) . "
                    </div>
                </div>";
            if (!empty($cash)) {
                echo "<div class='clearfix'></div>
                <div class='col-lg-12 col-md-12 col-sm-12'>
                    <div class='alert alert-secondary alert-sm text-center'>";
                if (App::getLocale() == "ar") {
                    echo "المبلغ المدفوع :";
                } else {
                    echo "Paid Amount";
                }
                echo floatval($cash->amount) . " " . trans('main.' . $currency) . "
                    </div>
                </div>";
            }
            echo '
               <div class="col-lg-12 no-print" style="padding-top: 25px;height: 40px !important;">';
            ?>
            <a target="_blank" role="button" href="{{route('client.buy_bills.print',$buy_bill_k->buy_bill_number)}}"
               class="btn btn-md btn-info print_btn pull-right"><i
                    class="fa fa-print"></i>
                @if(App::getLocale() == 'ar')
                    طباعة فاتورة المشتريات
                @else
                    Print Buy Bill
                @endif
            </a>
            @if(!empty($buy_bill_k->supplier->supplier_email))
                <a role="button" href="{{route('client.buy_bills.send',$buy_bill_k->buy_bill_number)}}"
                   class="btn btn-md btn-warning pull-right ml-2"><i
                        class="fa fa-envelope"></i>
                    @if(App::getLocale() == 'ar')
                        ارسال الفاتورة الى بريد المورد
                    @else
                        Send Bill To Supplier's Email
                    @endif
                </a>
            @else
                <span class="alert alert-sm pull-right ml-2 alert-warning text-center">
                    @if(App::getLocale() == 'ar')
                        خانه البريد الالكترونى للمورد فارغة
                    @else
                        Supplier Email is not Found
                    @endif
                </span>
            @endif

            @if(!$buy_bill_k->supplier->phones->isEmpty())
                <?php
                $url = 'https://' . request()->getHttpHost() . '/buy-bills/print/' . $buy_bill_k->buy_bill_number;
                if (App::getLocale() == 'ar') {
                    $text = "مرفق رابط لفاتورة مشتريات " . "%0a" . $url;
                } else {
                    $text = "A link to a Buy Bill is attached " . "%0a" . $url;
                }

                $text = str_replace("&", "%26", $text);
                $phone_number = $buy_bill_k->supplier->phones[0]->supplier_phone;
                ?>
                <a class="btn btn-md btn-success pull-right ml-2" target="_blank"
                   href="https://wa.me/{{$phone_number}}?text={{$text}}">
                    @if(App::getLocale() == 'ar')
                        ارسال الفاتورة الى واتساب المورد
                    @else
                        Send Bill To Supplier Whatsapp
                    @endif
                </a>
            @else
                <span class="alert alert-sm alert-warning pull-right ml-2 text-center">
                    @if(App::getLocale() == 'ar')
                        خانه رقم الهاتف للمورد فارغة
                    @else
                        Supplier Phone Number is not found
                    @endif
                </span>
            @endif

            <?php echo '
                    <button bill_id="' . $buy_bill_k->id . '" buy_bill_number="' . $buy_bill_k->supplier->supplier_name . '"
                        data-toggle="modal" href="#modaldemo9"
                        type="button" class="modal-effect ml-2 btn btn-md btn-danger delete_bill pull-right">
                        <i class="fa fa-trash"></i>';
            if (App::getLocale() == "ar") {
                echo "حذف الفاتورة";
            } else {
                echo "Delete Bill";
            }
            echo '</button>
                    <a href="' . route("client.buy_bills.edit", $buy_bill_k->id) . '" role="button" class="ml-2 btn btn-md btn-success pull-right">
                        <i class="fa fa-trash"></i>';
            if (App::getLocale() == "ar") {
                echo "تعديل الفاتورة";
            } else {
                echo "Edit Bill";
            }
            echo '

                    </a>
                </div>';
            }
            ?>
        @endif
        @if(isset($supplier_buy_bills))
            @if(!$supplier_buy_bills->isEmpty())
                <div class="alert alert-sm alert-success text-center mt-1 mb-2">
                    @if(App::getLocale() == 'ar')
                        الفواتير المتاحة لـ
                    @else
                        Available Bills For
                    @endif
                    {{$supplier_k->supplier_name}}
                </div>
                <table class='table table-condensed table-striped table-bordered'>
                    <thead class="text-center">
                    <th>#</th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            رقم الفاتورة
                        @else
                            Bill Number
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ الفاتورة
                        @else
                            Bill Date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            وقت الفاتورة
                        @else
                            Bill Time
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            الاجمالى النهائى
                        @else
                            Final Total
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عدد العناصر
                        @else
                            items count
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عرض
                        @else
                            show
                        @endif
                    </th>
                    </thead>
                    <tbody>
                    <?php $i = 0; $total = 0; ?>
                    @foreach($supplier_buy_bills as $buy_bill)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$buy_bill->buy_bill_number}}</td>
                            <td>{{$buy_bill->date}}</td>
                            <td>{{$buy_bill->time}}</td>
                            <td>
                                <?php $sum = 0; ?>
                                @foreach($buy_bill->elements as $element)
                                    <?php $sum = $sum + $element->quantity_price; ?>
                                @endforeach
                                <?php
                                $extras = $buy_bill->extras;
                                foreach ($extras as $key) {
                                    if ($key->action == "discount") {
                                        if ($key->action_type == "pound") {
                                            $buy_bill_discount_value = $key->value;
                                            $buy_bill_discount_type = "pound";
                                        } else {
                                            $buy_bill_discount_value = $key->value;
                                            $buy_bill_discount_type = "percent";
                                        }
                                    } else {
                                        if ($key->action_type == "pound") {
                                            $buy_bill_extra_value = $key->value;
                                            $buy_bill_extra_type = "pound";
                                        } else {
                                            $buy_bill_extra_value = $key->value;
                                            $buy_bill_extra_type = "percent";
                                        }
                                    }
                                }
                                if ($extras->isEmpty()) {
                                    $buy_bill_discount_value = 0;
                                    $buy_bill_extra_value = 0;
                                    $buy_bill_discount_type = "pound";
                                    $buy_bill_extra_type = "pound";
                                }
                                if ($buy_bill_extra_type == "percent") {
                                    $buy_bill_extra_value = $buy_bill_extra_value / 100 * $sum;
                                }
                                $after_discount = $sum + $buy_bill_extra_value;

                                if ($buy_bill_discount_type == "percent") {
                                    $buy_bill_discount_value = $buy_bill_discount_value / 100 * $sum;
                                }
                                $after_discount = $sum - $buy_bill_discount_value;
                                $after_discount = $sum - $buy_bill_discount_value + $buy_bill_extra_value;
                                $tax_value_added = $company->tax_value_added;
                                $percentage = ($tax_value_added / 100) * $after_discount;
                                $after_total = $after_discount + $percentage;
                                echo floatval($after_total) . " " . trans('main.' . $currency);
                                ?>
                                <?php $total = $total + $after_total; ?>
                            </td>
                            <td>{{$buy_bill->elements->count()}}</td>
                            <td>
                                <form class="d-inline" action="{{route('client.buy_bills.filter.key')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="buy_bill_id" value="{{$buy_bill->id}}">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                        @if(App::getLocale() == 'ar')
                                            عرض
                                        @else
                                            Show
                                        @endif
                                    </button>
                                </form>
                                <button bill_id="{{$buy_bill->id}}" buy_bill_number="{{$buy_bill->buy_bill_number}}"
                                        data-toggle="modal" href="#modaldemo9"
                                        type="button" class="modal-effect btn btn-sm btn-danger delete_bill d-inline">
                                    <i class="fa fa-trash"></i>
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        Delete
                                    @endif
                                </button>

                                <a href="{{route("client.buy_bills.edit",$buy_bill->id)}}" role="button"
                                   class="btn btn-sm btn-success d-inline">
                                    <i class="fa fa-trash"></i>

                                    @if(App::getLocale() == 'ar')
                                        تعديل
                                    @else
                                        Edit
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    <span class="alert alert-secondary alert-sm mr-5">
                        @if(App::getLocale() == 'ar')
                            عدد الفواتير المتاحة لهذا المورد
                        @else
                            total bills count For This Supplier
                        @endif
                        ( {{$i}} )
                    </span>

                    <span class="alert alert-secondary alert-sm">
                        @if(App::getLocale() == 'ar')
                            اجمالى اسعار كل الفواتير لهذا المورد
                        @else
                            total price of all invoices for this supplier
                        @endif
                        ( {{floatval($total)}} ) {{__('main.'.$currency)}}
                    </span>
                </div>
            @else
                <div class="alert alert-sm alert-danger text-center mt-3">
                    <i class="fa fa-close"></i>
                    @if(App::getLocale() == 'ar')
                        لا توجد اى فواتير لهذا المورد
                    @else
                        No bills for this supplier
                    @endif
                </div>
            @endif
        @endif

        @if(isset($product_buy_bills))
            @if(!$product_buy_bills->isEmpty())
                <div class="alert alert-sm alert-success text-center mt-1 mb-2">
                    @if(App::getLocale() == 'ar')
                        الفواتير المتاحة لـ
                    @else
                        available Bills for
                    @endif
                    {{$product_k->product_name}}
                </div>
                <table class='table table-condensed table-striped table-bordered'>
                    <thead class="text-center">
                    <th>#</th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            رقم الفاتورة
                        @else
                            Bill Number
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            اسم المورد
                        @else
                            Supplier Name
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ الفاتورة
                        @else
                            Bill Date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            وقت الفاتورة
                        @else
                            Bill Time
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            الاجمالى النهائى
                        @else
                            Final Total
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عدد العناصر
                        @else
                            items count
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عرض
                        @else
                            show
                        @endif
                    </th>
                    </thead>
                    <tbody>
                    <?php $i = 0; $total = 0; ?>
                    @foreach($product_buy_bills as $buy_bill)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$buy_bill->buy_bill_number}}</td>
                            <td>{{$buy_bill->supplier->supplier_name}}</td>
                            <td>{{$buy_bill->date}}</td>
                            <td>{{$buy_bill->time}}</td>
                            <td>
                                <?php $sum = 0; ?>
                                @foreach($buy_bill->elements as $element)
                                    <?php $sum = $sum + $element->quantity_price; ?>
                                @endforeach
                                <?php
                                $extras = $buy_bill->extras;
                                foreach ($extras as $key) {
                                    if ($key->action == "discount") {
                                        if ($key->action_type == "pound") {
                                            $buy_bill_discount_value = $key->value;
                                            $buy_bill_discount_type = "pound";
                                        } else {
                                            $buy_bill_discount_value = $key->value;
                                            $buy_bill_discount_type = "percent";
                                        }
                                    } else {
                                        if ($key->action_type == "pound") {
                                            $buy_bill_extra_value = $key->value;
                                            $buy_bill_extra_type = "pound";
                                        } else {
                                            $buy_bill_extra_value = $key->value;
                                            $buy_bill_extra_type = "percent";
                                        }
                                    }
                                }
                                if ($extras->isEmpty()) {
                                    $buy_bill_discount_value = 0;
                                    $buy_bill_extra_value = 0;
                                    $buy_bill_discount_type = "pound";
                                    $buy_bill_extra_type = "pound";
                                }
                                if ($buy_bill_extra_type == "percent") {
                                    $buy_bill_extra_value = $buy_bill_extra_value / 100 * $sum;
                                }
                                $after_discount = $sum + $buy_bill_extra_value;

                                if ($buy_bill_discount_type == "percent") {
                                    $buy_bill_discount_value = $buy_bill_discount_value / 100 * $sum;
                                }
                                $after_discount = $sum - $buy_bill_discount_value;
                                $after_discount = $sum - $buy_bill_discount_value + $buy_bill_extra_value;
                                $tax_value_added = $company->tax_value_added;
                                $percentage = ($tax_value_added / 100) * $after_discount;
                                $after_total = $after_discount + $percentage;
                                echo floatval($after_total) . " " . trans('main.' . $currency);
                                ?>
                                <?php $total = $total + $after_total; ?>
                            </td>
                            <td>{{$buy_bill->elements->count()}}</td>
                            <td style="width: 30%!important;padding: 5px !important;">
                                <form class="d-inline" action="{{route('client.buy_bills.filter.key')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="buy_bill_id" value="{{$buy_bill->id}}">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                        @if(App::getLocale() == 'ar')
                                            عرض
                                        @else
                                            show
                                        @endif

                                    </button>
                                </form>
                                <button bill_id="{{$buy_bill->id}}" buy_bill_number="{{$buy_bill->buy_bill_number}}"
                                        data-toggle="modal" href="#modaldemo9"
                                        type="button" class="modal-effect btn btn-sm btn-danger delete_bill d-inline">
                                    <i class="fa fa-trash"></i>

                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        Delete
                                    @endif
                                </button>

                                <a href="{{route("client.buy_bills.edit",$buy_bill->id)}}" role="button"
                                   class="btn btn-sm btn-success d-inline">
                                    <i class="fa fa-trash"></i>

                                    @if(App::getLocale() == 'ar')
                                        تعديل
                                    @else
                                        Edit
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    <span class="alert alert-secondary alert-sm mr-5">
                        @if(App::getLocale() == 'ar')
                            عدد الفواتير لهذا المنتج
                        @else
                            total bills count for this product
                        @endif
                        ( {{$i}} )
                    </span>

                    <span class="alert alert-secondary alert-sm">
                        @if(App::getLocale() == 'ar')
                            اجمالى اسعار كل الفواتير لهذا المنتج
                        @else
                            total price of all invoices for this product
                        @endif
                        ( {{floatval($total)}} ) {{__('main.'.$currency)}}
                    </span>
                </div>
            @else
                <div class="alert alert-sm alert-danger text-center mt-3">
                    <i class="fa fa-close"></i>
                    @if(App::getLocale() == 'ar')
                        لا توجد اى فواتير لهذا المنتج
                    @else
                        No Bills For This Product
                    @endif
                </div>
            @endif
        @endif
        @if(isset($all_buy_bills))
            @if(!$all_buy_bills->isEmpty())
                <div class="alert alert-sm alert-success text-center mt-1 mb-2">
                    @if(App::getLocale() == 'ar')
                        كل فواتير المشتريات
                    @else
                        All Buy Bills
                    @endif
                </div>
                <table class='table table-condensed table-striped table-bordered'>
                    <thead class="text-center">
                    <th>#</th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            رقم الفاتورة
                        @else
                            Bill Number
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            اسم المورد
                        @else
                            Supplier Name
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ الفاتورة
                        @else
                            Bill Date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            وقت الفاتورة
                        @else
                            Bill Time
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            الاجمالى النهائى
                        @else
                            Final Total
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عدد العناصر
                        @else
                            items count
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عرض
                        @else
                            show
                        @endif
                    </th>
                    </thead>
                    <tbody>
                    <?php $i = 0; $total = 0; ?>
                    @foreach($all_buy_bills as $buy_bill)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$buy_bill->buy_bill_number}}</td>
                            <td>{{$buy_bill->supplier->supplier_name}}</td>
                            <td>{{$buy_bill->date}}</td>
                            <td>{{$buy_bill->time}}</td>
                            <td>
                                <?php $sum = 0; ?>
                                @foreach($buy_bill->elements as $element)
                                    <?php $sum = $sum + $element->quantity_price; ?>
                                @endforeach
                                <?php
                                $extras = $buy_bill->extras;
                                foreach ($extras as $key) {
                                    if ($key->action == "discount") {
                                        if ($key->action_type == "pound") {
                                            $buy_bill_discount_value = $key->value;
                                            $buy_bill_discount_type = "pound";
                                        } else {
                                            $buy_bill_discount_value = $key->value;
                                            $buy_bill_discount_type = "percent";
                                        }
                                    } else {
                                        if ($key->action_type == "pound") {
                                            $buy_bill_extra_value = $key->value;
                                            $buy_bill_extra_type = "pound";
                                        } else {
                                            $buy_bill_extra_value = $key->value;
                                            $buy_bill_extra_type = "percent";
                                        }
                                    }
                                }
                                if ($extras->isEmpty()) {
                                    $buy_bill_discount_value = 0;
                                    $buy_bill_extra_value = 0;
                                    $buy_bill_discount_type = "pound";
                                    $buy_bill_extra_type = "pound";
                                }
                                if ($buy_bill_extra_type == "percent") {
                                    $buy_bill_extra_value = $buy_bill_extra_value / 100 * $sum;
                                }
                                $after_discount = $sum + $buy_bill_extra_value;

                                if ($buy_bill_discount_type == "percent") {
                                    $buy_bill_discount_value = $buy_bill_discount_value / 100 * $sum;
                                }
                                $after_discount = $sum - $buy_bill_discount_value;
                                $after_discount = $sum - $buy_bill_discount_value + $buy_bill_extra_value;
                                $tax_value_added = $company->tax_value_added;
                                $percentage = ($tax_value_added / 100) * $after_discount;
                                $after_total = $after_discount + $percentage;
                                echo floatval($after_total) . " " . trans('main.' . $currency);
                                ?>
                                <?php $total = $total + $after_total; ?>
                            </td>
                            <td>{{$buy_bill->elements->count()}}</td>
                            <td style="width: 30%!important;padding: 5px !important;">
                                <form class="d-inline" action="{{route('client.buy_bills.filter.key')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="buy_bill_id" value="{{$buy_bill->id}}">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                        @if(App::getLocale() == 'ar')
                                            عرض
                                        @else
                                            Show
                                        @endif
                                    </button>
                                </form>
                                <button bill_id="{{$buy_bill->id}}" buy_bill_number="{{$buy_bill->buy_bill_number}}"
                                        data-toggle="modal" href="#modaldemo9"
                                        type="button" class="modal-effect btn btn-sm btn-danger delete_bill d-inline">
                                    <i class="fa fa-trash"></i>

                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        Delete
                                    @endif
                                </button>

                                <a href="{{route("client.buy_bills.edit",$buy_bill->id)}}" role="button"
                                   class="btn btn-sm btn-success d-inline">
                                    <i class="fa fa-trash"></i>

                                    @if(App::getLocale() == 'ar')
                                        تعديل
                                    @else
                                        Edit
                                    @endif
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    <span class="alert alert-secondary alert-sm mr-5">
                        @if(App::getLocale() == 'ar')
                            عدد الفواتير
                        @else
                            total bills count
                        @endif
                        ( {{$i}} )
                    </span>

                    <span class="alert alert-secondary alert-sm">
                        @if(App::getLocale() == 'ar')
                            اجمالى اسعار كل الفواتير
                        @else
                            total price for all bills
                        @endif
                         ( {{floatval($total)}} ) {{__('main.'.$currency)}}
                    </span>
                </div>
            @else
                <div class="alert alert-sm alert-danger text-center mt-3">
                    <i class="fa fa-close"></i>
                    @if(App::getLocale() == 'ar')
                        لا توجد اى فواتير
                    @else
                        no bills available
                    @endif
                </div>
            @endif
        @endif
    </div>
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" branch="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            حذف الفاتورة
                        @else
                            Delete Bill
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('client.buy_bills.deleteBill')}}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>@if(App::getLocale() == 'ar')
                                هل انت متأكد من الحذف ؟
                            @else
                                Sure To Delete ?
                            @endif</p><br>
                        <input type="hidden" name="billid" id="billid">
                        <input class="form-control" name="buybillnumber" id="buybillnumber" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@if(App::getLocale() == 'ar')
                                الغاء
                            @else
                                Cancel
                            @endif</button>
                        <button type="submit" class="btn btn-danger">
                            @if(App::getLocale() == 'ar')
                                حذف
                            @else
                                Delete
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.delete_bill').on('click', function () {
            var bill_id = $(this).attr('bill_id');
            var buy_bill_number = $(this).attr('buy_bill_number');
            $('.modal-body #billid').val(bill_id);
            $('.modal-body #buybillnumber').val(buy_bill_number);
        });

        $('#buy_bill_id').on('change', function () {
            let buy_bill_id = $(this).val();
            $('#buy_bill_id_2').val(buy_bill_id);
        });
        $('.remove_element').on('click', function () {
            let element_id = $(this).attr('element_id');
            let buy_bill_number = $(this).attr('buy_bill_number');

            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();

            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();

            $.post('{{url('/client/buy-bills/element/delete')}}',
                {'_token': '{{csrf_token()}}', element_id: element_id},
                function (data) {
                    $.post('{{url('/client/buy-bills/updateData')}}',
                        {'_token': '{{csrf_token()}}', buy_bill_number: buy_bill_number},
                        function (elements) {
                            $('.before_totals').html(elements);
                        });
                });
            $.post('{{url('/client/buy-bills/discount')}}',
                {
                    '_token': '{{csrf_token()}}',
                    buy_bill_number: buy_bill_number,
                    discount_type: discount_type,
                    discount_value: discount_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });

            $.post('{{url('/client/buy-bills/extra')}}',
                {
                    '_token': '{{csrf_token()}}',
                    buy_bill_number: buy_bill_number,
                    extra_type: extra_type,
                    extra_value: extra_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
            $(this).parent().parent().fadeOut(300);
        });
        $('#exec_discount').on('click', function () {
            let buy_bill_number = $(this).attr('buy_bill_number');
            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();
            $.post("{{url('/client/buy-bills/discount')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    buy_bill_number: buy_bill_number,
                    discount_type: discount_type,
                    discount_value: discount_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
        });
        $('#exec_extra').on('click', function () {
            let buy_bill_number = $(this).attr('buy_bill_number');
            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();
            $.post("{{url('/client/buy-bills/extra')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    buy_bill_number: buy_bill_number,
                    extra_type: extra_type,
                    extra_value: extra_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
        });
    });
</script>
