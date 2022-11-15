@extends('client.layouts.app-main')
<style>
    .bootstrap-select {
        width: 75% !important;
        height: 40px !important;
    }

    .btn {
        height: 40px;
    }

    .btn-sm {
        padding: 5px !important;
        height: 30px !important;
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
            عروض الاسعار السابقة
        @else
            show all quotations
        @endif

    </h4>
    <div class="col-lg-3 pull-right  no-print">
        <form action="{{route('client.quotations.filter.key')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label style="display:block;" for="bill_id">
                    @if(App::getLocale() == 'ar')
                        بحث برقم عرض السعر
                    @else
                        search by quotation number
                    @endif
                </label>
                <select required class="selectpicker" data-live-search="true"
                        @if(App::getLocale() == 'ar')
                        data-title="ابحث"
                        @else
                        data-title="Search"
                        @endif

                        data-style="btn-danger"
                        name="quotation_id" id="quotation_id">
                    @foreach($quotations as $quotation)
                        <option @if(isset($quotation_k) && ($quotation->id == $quotation_k->id))
                                selected
                                @endif
                                value="{{$quotation->id}}">{{$quotation->quotation_number}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-md btn-danger"
                        style="display: inline !important;width: 20% !important; float: left !important;"
                        id="by_quotation_id"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>

    <div class="col-lg-3 pull-right  no-print">
        <form action="{{route('client.quotations.filter.client')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label style="display:block;" for="outer_client_id">
                    @if(App::getLocale() == 'ar')
                        بحث باسم العميل
                    @else
                        search by client name
                    @endif
                </label>
                <select required class="selectpicker" data-live-search="true"
                        @if(App::getLocale() == 'ar')
                        data-title="ابحث"
                        @else
                        data-title="Search"
                        @endif

                        data-style="btn-info"
                        name="outer_client_id" id="outer_client_id">
                    @foreach($outer_clients as $outer_client)
                        <option @if(isset($outer_client_k) && ($outer_client->id == $outer_client_k->id))
                                selected
                                @endif
                                value="{{$outer_client->id}}">{{$outer_client->client_name}}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-md btn-info"
                        style="display: inline !important;width: 20% !important; float: left !important;"
                        id="by_outer_client_id"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <div class="col-lg-3 pull-right  no-print">
        <form action="{{route('client.quotations.filter.code')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label style="display:block;" for="code_universal">
                    @if(App::getLocale() == 'ar')
                        بحث بكود المنتج
                    @else
                        search by product barcode
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
        <form action="{{route('client.quotations.filter.product')}}" method="POST">
            @csrf
            @method('POST')
            <div class="form-group">
                <label style="display:block;" for="product_name">
                    @if(App::getLocale() == 'ar')
                        بحث باسم المنتج
                    @else
                        search by product name
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
            <form action="{{route('client.quotations.filter.all')}}" method="POST">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-md btn-dark">
                    <i class="fa fa-list"></i>
                    @if(App::getLocale() == 'ar')
                        عرض كل عروض الاسعار
                    @else
                        show all quotations
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
        @if(isset($quotation_k) && !empty($quotation_k))
            <h6 class="alert alert-sm alert-danger text-center">
                <i class="fa fa-info-circle"></i>
                @if(App::getLocale() == 'ar')
                    بيانات عناصر عرض السعر رقم
                @else
                    quotation items - number
                @endif
                {{$quotation_k->quotation_number}}
            </h6>
            <div class="col-lg-12 mb-3 printy alert alert-secondary alert-sm">
                <div class="col-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        اسم العميل :
                    @else
                        client name
                    @endif
                    {{$quotation_k->outerClient->client_name}}
                </div>
                <div class="col-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        تاريخ بدأ العرض :
                    @else
                        quotation start date
                    @endif
                    {{$quotation_k->start_date}}
                </div>
                <div class="col-4 pull-right">
                    @if(App::getLocale() == 'ar')
                        تاريخ انتهاء العرض :
                    @else
                        quotation end date
                    @endif
                    {{$quotation_k->expiration_date}}
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
                echo ' اسم المنتج';
            } else {
                echo 'product name';
            }
            echo "</th>";
            echo "<th>";
            if (App::getLocale() == "ar") {
                echo 'سعر الوحدة';
            } else {
                echo 'unit price';
            }
            echo "</th>";
            echo "<th>";
            if (App::getLocale() == "ar") {
                echo 'الكمية';
            } else {
                echo 'quantity';
            }
            echo "</th>";
            echo "<th>";
            if (App::getLocale() == "ar") {
                echo 'الاجمالى';
            } else {
                echo 'total';
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
                echo '  اجمالى عرض السعر';
            } else {
                echo 'quotation total';
            }
            echo floatval($total) . " " . trans('main.' . $currency) . "
                    </div>
                    <div class='pull-left col-6 '>";
            if (App::getLocale() == "ar") {
                echo 'اجمالى عرض السعر بعد القيمة المضافة';
            } else {
                echo 'quotation total (include VAT)';
            }
            echo floatval($after_total) . " " . trans('main.' . $currency) . "
                    </div>
                    <div class='clearfix'></div>
                </div>";
            echo "
                <div class='clearfix'></div>
                <div class='alert alert-dark alert-sm text-center printy'>";
            foreach ($extras as $key) {
                if ($key->action == "discount") {
                    echo "<div class='pull-right col-6 '>";
                    if ($key->action_type == "pound") {
                        if (App::getLocale() == "ar") {
                            echo " خصم ";
                        } else {
                            echo " discount ";
                        }
                        echo $key->value . " " . trans('main.' . $currency);
                    } else {
                        if (App::getLocale() == "ar") {
                            echo " خصم ";
                        } else {
                            echo " discount ";
                        }
                        echo $key->value . " % ";
                    }
                    echo "</div>";
                } else {
                    echo "<div class='pull-right col-6 '>";
                    if ($key->action_type == "pound") {
                        if (App::getLocale() == "ar") {
                            echo " مصاريف شحن ";
                        } else {
                            echo " charging fees ";
                        }
                        echo $key->value . " " . trans('main.' . $currency);
                    } else {
                        if (App::getLocale() == "ar") {
                            echo " مصاريف شحن ";
                        } else {
                            echo " charging fees ";
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
                echo 'اجمالى عرض السعر النهائى بعد الضريبة والشحن والخصم :';
            } else {
                echo 'quotation final total after discount , shipping fees and VAT';
            }
            echo floatval($after_total_all) . " " . trans('main.' . $currency) . "
                    </div>
                </div>";
            echo '
               <div class="col-lg-12 no-print" style="padding-top: 25px;height: 40px !important;">
                    <button type="button" onclick="window.print()" name="print"
                            class="btn btn-md btn-info print_btn pull-right"><i
                            class="fa fa-print"></i>';
            if (App::getLocale() == "ar") {
                echo " طباعة عرض السعر ";
            } else {
                echo " print quotation ";
            }
            echo '</button>'; ?>

            <a role="button" class="btn btn-dark ml-2 pull-right"
               href="{{route('convert.to.salebill',$quotation_k->id)}}">
                <i class="fa fa-refresh"></i>
                @if(App::getLocale() == 'ar')
                    تحويل لفاتورة مبيعات
                @else
                    Convert to Sale Bill
                @endif
            </a>
            <?php echo '<a href="';?>{{route('client.quotations.send',$quotation_k->quotation_number)}} <?php echo '" role="button"
                       class="btn send_btn btn-md btn-warning pull-right ml-3"><i
                            class="fa fa-check"></i>';
            if (App::getLocale() == "ar") {
                echo "ارسال عرض السعر الى بريد العميل";
            } else {
                echo "send quotation to client email";
            }
            echo '</a>
                    <button bill_id="' . $quotation_k->id . '" quotation_number="' . $quotation_k->outerClient->client_name . '"
                        data-toggle="modal" href="#modaldemo9"
                        type="button" class="modal-effect ml-4 btn btn-md btn-danger delete_bill pull-right">
                        <i class="fa fa-trash"></i>';

            if (App::getLocale() == "ar") {
                echo "حذف عرض السعر";
            } else {
                echo "delete quotation";
            }
            echo '</button>

            <a href="' . route("client.quotations.edit", $quotation_k->id) . '" role="button" class="ml-4 btn btn-md btn-success pull-right">
                        <i class="fa fa-trash"></i>';
            if (App::getLocale() == "ar") {
                echo "تعديل عرض السعر";
            } else {
                echo "edit quotation";
            }
            echo '</a>
                </div>';
            }
            ?>
        @endif
        @if(isset($client_quotations))
            @if(!$client_quotations->isEmpty())
                <div class="alert alert-sm alert-success text-center mt-1 mb-2">
                    @if(App::getLocale() == 'ar')
                        عروض الاسعار المتاحة لـ
                    @else
                        quotations for
                    @endif
                    {{$outer_client_k->client_name}}
                </div>
                <table class='table table-condensed table-striped table-bordered'>
                    <thead class="text-center">
                    <th>#</th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            رقم عرض السعر
                        @else
                            quotation number
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ بداية عرض السعر
                        @else
                            quotation start date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ نهاية عرض السعر
                        @else
                            quotation end date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            الاجمالى النهائى
                        @else
                            final total
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عدد العناصر
                        @else
                            items count
                        @endif
                    </th>
                    <th style="width: 40% !important;">
                        @if(App::getLocale() == 'ar')
                            تحكم
                        @else
                            Control
                        @endif
                    </th>
                    </thead>
                    <tbody>
                    <?php $i = 0; $total = 0; ?>
                    @foreach($client_quotations as $quotation)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$quotation->quotation_number}}</td>
                            <td>{{$quotation->start_date}}</td>
                            <td>{{$quotation->expiration_date}}</td>
                            <td>
                                <?php $sum = 0; ?>
                                @foreach($quotation->elements as $element)
                                    <?php $sum = $sum + $element->quantity_price; ?>
                                @endforeach
                                <?php
                                $extras = $quotation->extras;
                                foreach ($extras as $key) {
                                    if ($key->action == "discount") {
                                        if ($key->action_type == "pound") {
                                            $quotation_discount_value = $key->value;
                                            $quotation_discount_type = "pound";
                                        } else {
                                            $quotation_discount_value = $key->value;
                                            $quotation_discount_type = "percent";
                                        }
                                    } else {
                                        if ($key->action_type == "pound") {
                                            $quotation_extra_value = $key->value;
                                            $quotation_extra_type = "pound";
                                        } else {
                                            $quotation_extra_value = $key->value;
                                            $quotation_extra_type = "percent";
                                        }
                                    }
                                }
                                if ($extras->isEmpty()) {
                                    $quotation_discount_value = 0;
                                    $quotation_extra_value = 0;
                                    $quotation_discount_type = "pound";
                                    $quotation_extra_type = "pound";
                                }
                                if ($quotation_extra_type == "percent") {
                                    $quotation_extra_value = $quotation_extra_value / 100 * $sum;
                                }
                                $after_discount = $sum + $quotation_extra_value;

                                if ($quotation_discount_type == "percent") {
                                    $quotation_discount_value = $quotation_discount_value / 100 * $sum;
                                }
                                $after_discount = $sum - $quotation_discount_value;
                                $after_discount = $sum - $quotation_discount_value + $quotation_extra_value;
                                $tax_value_added = $company->tax_value_added;
                                $percentage = ($tax_value_added / 100) * $after_discount;
                                $after_total = $after_discount + $percentage;
                                echo floatval($after_total) . " " . trans('main.' . $currency);
                                ?>
                                <?php $total = $total + $after_total; ?>
                            </td>
                            <td>{{$quotation->elements->count()}}</td>
                            <td>
                                <form class="d-inline" action="{{route('client.quotations.filter.key')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                        @if(App::getLocale() == 'ar')
                                            عرض
                                        @else
                                            show
                                        @endif
                                    </button>
                                </form>
                                <button bill_id="{{$quotation->id}}"
                                        quotation_number="{{$quotation->outerClient->client_name}}"
                                        data-toggle="modal" href="#modaldemo9"
                                        type="button" class="modal-effect btn btn-sm btn-danger delete_bill d-inline">
                                    <i class="fa fa-trash"></i>
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        delete
                                    @endif
                                </button>

                                <a href="{{route("client.quotations.edit",$quotation->id)}}" role="button"
                                   class="btn btn-sm btn-success d-inline">
                                    <i class="fa fa-trash"></i>
                                    @if(App::getLocale() == 'ar')
                                        تعديل
                                    @else
                                        edit
                                    @endif
                                </a>
                                <a role="button" class="btn btn-sm btn-warning mt-1 d-block"
                                   href="{{route('convert.to.salebill',$quotation->id)}}">
                                    <i class="fa fa-refresh"></i>
                                    @if(App::getLocale() == 'ar')
                                        تحويل لفاتورة مبيعات
                                    @else
                                        convert to sale bill
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
                            عدد عروض الاسعار المتاحة لهذا العميل
                        @else
                            quotations count for this client
                        @endif
                        ( {{$i}} )
                    </span>

                    <span class="alert alert-secondary alert-sm">
                        @if(App::getLocale() == 'ar')
                            اجمالى اسعار كل عروض الاسعار لهذا العميل
                        @else
                            quotations total prices for this client
                        @endif
                        ( {{floatval($total)}} ) {{__('main.'.$currency)}}
                    </span>
                </div>
            @else
                <div class="alert alert-sm alert-danger text-center mt-3">
                    <i class="fa fa-close"></i>
                    @if(App::getLocale() == 'ar')
                        لا توجد اى عروض اسعار  لهذا العميل
                    @else
                        no quotations for this client
                    @endif
                </div>
            @endif
        @endif

        @if(isset($product_quotations))
            @if(!$product_quotations->isEmpty())
                <div class="alert alert-sm alert-success text-center mt-1 mb-2">
                    @if(App::getLocale() == 'ar')
                        عروض الاسعار المتاحة لـ
                    @else
                        quotations for
                    @endif
                    {{$product_k->product_name}}
                </div>
                <table class='table table-condensed table-striped table-bordered'>
                    <thead class="text-center">
                    <td>#</td>
                    <th>
                        @if(App::getLocale() == 'ar')
                            رقم عرض السعر
                        @else
                            quotation number
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ بداية عرض السعر
                        @else
                            quotation start date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ نهاية عرض السعر
                        @else
                            quotation end date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            الاجمالى النهائى
                        @else
                            final total
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عدد العناصر
                        @else
                            items count
                        @endif
                    </th>
                    <th style="width: 40% !important;">
                        @if(App::getLocale() == 'ar')
                            تحكم
                        @else
                            Control
                        @endif
                    </th>
                    </thead>
                    <tbody>
                    <?php $i = 0; $total = 0; ?>
                    @foreach($product_quotations as $quotation)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$quotation->quotation_number}}</td>
                            <td>{{$quotation->outerClient->client_name}}</td>
                            <td>{{$quotation->start_date}}</td>
                            <td>{{$quotation->expiration_date}}</td>
                            <td>
                                <?php $sum = 0; ?>
                                @foreach($quotation->elements as $element)
                                    <?php $sum = $sum + $element->quantity_price; ?>
                                @endforeach
                                <?php
                                $extras = $quotation->extras;
                                foreach ($extras as $key) {
                                    if ($key->action == "discount") {
                                        if ($key->action_type == "pound") {
                                            $quotation_discount_value = $key->value;
                                            $quotation_discount_type = "pound";
                                        } else {
                                            $quotation_discount_value = $key->value;
                                            $quotation_discount_type = "percent";
                                        }
                                    } else {
                                        if ($key->action_type == "pound") {
                                            $quotation_extra_value = $key->value;
                                            $quotation_extra_type = "pound";
                                        } else {
                                            $quotation_extra_value = $key->value;
                                            $quotation_extra_type = "percent";
                                        }
                                    }
                                }
                                if ($extras->isEmpty()) {
                                    $quotation_discount_value = 0;
                                    $quotation_extra_value = 0;
                                    $quotation_discount_type = "pound";
                                    $quotation_extra_type = "pound";
                                }
                                if ($quotation_extra_type == "percent") {
                                    $quotation_extra_value = $quotation_extra_value / 100 * $sum;
                                }
                                $after_discount = $sum + $quotation_extra_value;

                                if ($quotation_discount_type == "percent") {
                                    $quotation_discount_value = $quotation_discount_value / 100 * $sum;
                                }
                                $after_discount = $sum - $quotation_discount_value;
                                $after_discount = $sum - $quotation_discount_value + $quotation_extra_value;
                                $tax_value_added = $company->tax_value_added;
                                $percentage = ($tax_value_added / 100) * $after_discount;
                                $after_total = $after_discount + $percentage;
                                echo floatval($after_total) . " " . trans('main.' . $currency);
                                ?>
                                <?php $total = $total + $after_total; ?>
                            </td>
                            <td>{{$quotation->elements->count()}}</td>
                            <td style="width: 40% !important; padding: 5px !important;">
                                <form class="d-inline" action="{{route('client.quotations.filter.key')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                        @if(App::getLocale() == 'ar')
                                            عرض
                                        @else
                                            show
                                        @endif
                                    </button>
                                </form>

                                <button bill_id="{{$quotation->id}}"
                                        quotation_number="{{$quotation->outerClient->client_name}}"
                                        data-toggle="modal" href="#modaldemo9"
                                        type="button" class="modal-effect btn btn-sm btn-danger delete_bill d-inline">
                                    <i class="fa fa-trash"></i>
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        delete
                                    @endif
                                </button>

                                <a href="{{route("client.quotations.edit",$quotation->id)}}" role="button"
                                   class="btn btn-sm btn-success d-inline">
                                    <i class="fa fa-trash"></i>
                                    @if(App::getLocale() == 'ar')
                                        تعديل
                                    @else
                                        edit
                                    @endif
                                </a>
                                <a role="button" class="btn btn-sm btn-warning mt-1 d-block"
                                   href="{{route('convert.to.salebill',$quotation->id)}}">
                                    <i class="fa fa-refresh"></i>
                                    @if(App::getLocale() == 'ar')
                                        تحويل لفاتورة مبيعات
                                    @else
                                        convert to sale bill
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
                            عدد عروض الاسعار المتاحة لهذا المنتج
                        @else
                            quotations count for this product
                        @endif
                        ( {{$i}} )
                    </span>

                    <span class="alert alert-secondary alert-sm">
                        if(App::getLocale() == 'ar')
                            اجمالى اسعار كل عروض الاسعار لهذا المنتج
                        @else
                            quotations total prices for this product
                        @endif
                        ( {{floatval($total)}} ) {{__('main.'.$currency)}}
                    </span>
                </div>
            @else
                <div class="alert alert-sm alert-danger text-center mt-3">
                    <i class="fa fa-close"></i>
                    @if(App::getLocale() == 'ar')
                        لا توجد اى عروض اسعار  لهذا المنتج
                    @else
                        no quotations for this product
                    @endif
                </div>
            @endif
        @if(isset($all_quotations))
            @if(!$all_quotations->isEmpty())
                <div class="alert alert-sm alert-success text-center mt-1 mb-2">
                    @if(App::getLocale() == 'ar')
                        كل عروض الاسعار
                    @else
                        all quotations
                    @endif
                </div>
                <table class='table table-condensed table-striped table-bordered'>
                    <thead class="text-center">
                    <th>#</th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            رقم عرض السعر
                        @else
                            quotation number
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ بداية عرض السعر
                        @else
                            quotation start date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            تاريخ نهاية عرض السعر
                        @else
                            quotation end date
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            الاجمالى النهائى
                        @else
                            final total
                        @endif
                    </th>
                    <th>
                        @if(App::getLocale() == 'ar')
                            عدد العناصر
                        @else
                            items count
                        @endif
                    </th>
                    <th style="width: 40% !important;">
                        @if(App::getLocale() == 'ar')
                            تحكم
                        @else
                            Control
                        @endif
                    </th>
                    </thead>
                    <tbody>
                    <?php $i = 0; $total = 0; ?>
                    @foreach($all_quotations as $quotation)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$quotation->quotation_number}}</td>
                            <td>{{$quotation->outerClient->client_name}}</td>
                            <td>{{$quotation->start_date}}</td>
                            <td>{{$quotation->expiration_date}}</td>
                            <td>
                                <?php $sum = 0; ?>
                                @foreach($quotation->elements as $element)
                                    <?php $sum = $sum + $element->quantity_price; ?>
                                @endforeach
                                <?php
                                $extras = $quotation->extras;
                                foreach ($extras as $key) {
                                    if ($key->action == "discount") {
                                        if ($key->action_type == "pound") {
                                            $quotation_discount_value = $key->value;
                                            $quotation_discount_type = "pound";
                                        } else {
                                            $quotation_discount_value = $key->value;
                                            $quotation_discount_type = "percent";
                                        }
                                    } else {
                                        if ($key->action_type == "pound") {
                                            $quotation_extra_value = $key->value;
                                            $quotation_extra_type = "pound";
                                        } else {
                                            $quotation_extra_value = $key->value;
                                            $quotation_extra_type = "percent";
                                        }
                                    }
                                }
                                if ($extras->isEmpty()) {
                                    $quotation_discount_value = 0;
                                    $quotation_extra_value = 0;
                                    $quotation_discount_type = "pound";
                                    $quotation_extra_type = "pound";
                                }
                                if ($quotation_extra_type == "percent") {
                                    $quotation_extra_value = $quotation_extra_value / 100 * $sum;
                                }
                                $after_discount = $sum + $quotation_extra_value;

                                if ($quotation_discount_type == "percent") {
                                    $quotation_discount_value = $quotation_discount_value / 100 * $sum;
                                }
                                $after_discount = $sum - $quotation_discount_value;
                                $after_discount = $sum - $quotation_discount_value + $quotation_extra_value;
                                $tax_value_added = $company->tax_value_added;
                                $percentage = ($tax_value_added / 100) * $after_discount;
                                $after_total = $after_discount + $percentage;
                                echo floatval($after_total) . " " . trans('main.' . $currency);
                                ?>
                                <?php $total = $total + $after_total; ?>
                            </td>
                            <td>{{$quotation->elements->count()}}</td>
                            <td style="width: 40% !important; padding: 5px !important;">
                                <form class="d-inline" action="{{route('client.quotations.filter.key')}}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="quotation_id" value="{{$quotation->id}}">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-eye"></i>
                                        @if(App::getLocale() == 'ar')
                                            عرض
                                        @else
                                            show
                                        @endif
                                    </button>
                                </form>

                                <button bill_id="{{$quotation->id}}"
                                        quotation_number="{{$quotation->outerClient->client_name}}"
                                        data-toggle="modal" href="#modaldemo9"
                                        type="button" class="modal-effect btn btn-sm btn-danger delete_bill d-inline">
                                    <i class="fa fa-trash"></i>
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        delete
                                    @endif
                                </button>

                                <a href="{{route("client.quotations.edit",$quotation->id)}}" role="button"
                                   class="btn btn-sm btn-success d-inline">
                                    <i class="fa fa-trash"></i>
                                    @if(App::getLocale() == 'ar')
                                        تعديل
                                    @else
                                        edit
                                    @endif
                                </a>
                                <a role="button" class="btn btn-sm btn-warning mt-1 d-block"
                                   href="{{route('convert.to.salebill',$quotation->id)}}">
                                    <i class="fa fa-refresh"></i>
                                    @if(App::getLocale() == 'ar')
                                        تحويل لفاتورة مبيعات
                                    @else
                                        convert to sale bill
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
                            عدد عروض الاسعار
                        @else
                            quotations count
                        @endif
                        ( {{$i}} )
                    </span>

                    <span class="alert alert-secondary alert-sm">
                        @if(App::getLocale() == 'ar')
                            اجمالى اسعار كل عروض الاسعار
                        @else
                            quotations total prices
                        @endif
                        ( {{floatval($total)}} ) {{__('main.'.$currency)}}
                    </span>
                </div>
            @else
                <div class="alert alert-sm alert-danger text-center mt-3">
                    <i class="fa fa-close"></i>
                    @if(App::getLocale() == 'ar')
                        لا توجد اى عروض اسعار
                    @else
                        no quotations
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
                            حذف عرض السعر
                        @else
                            delete quotation
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('client.quotations.deleteBill')}}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>
                            @if(App::getLocale() == 'ar')
                                هل انت متأكد من الحذف ؟
                            @else
                                Sure To Delete ?
                            @endif
                        </p><br>
                        <input type="hidden" name="billid" id="billid">
                        <input class="form-control" name="quotationnumber" id="quotationnumber" type="text" readonly>
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
            var quotation_number = $(this).attr('quotation_number');
            $('.modal-body #billid').val(bill_id);
            $('.modal-body #quotationnumber').val(quotation_number);
        });
        $('#quotation_id').on('change', function () {
            let quotation_id = $(this).val();
            $('#quotation_id_2').val(quotation_id);
        });
        $('.remove_element').on('click', function () {
            let element_id = $(this).attr('element_id');
            let quotation_number = $(this).attr('quotation_number');

            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();

            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();

            $.post('{{url('/client/quotations/element/delete')}}',
                {'_token': '{{csrf_token()}}', element_id: element_id},
                function (data) {
                    $.post('{{url('/client/quotations/updateData')}}',
                        {'_token': '{{csrf_token()}}', quotation_number: quotation_number},
                        function (elements) {
                            $('.before_totals').html(elements);
                        });
                });
            $.post('{{url('/client/quotations/discount')}}',
                {
                    '_token': '{{csrf_token()}}',
                    quotation_number: quotation_number,
                    discount_type: discount_type,
                    discount_value: discount_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });

            $.post('{{url('/client/quotations/extra')}}',
                {
                    '_token': '{{csrf_token()}}',
                    quotation_number: quotation_number,
                    extra_type: extra_type,
                    extra_value: extra_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
            $(this).parent().parent().fadeOut(300);
        });
        $('#exec_discount').on('click', function () {
            let quotation_number = $(this).attr('quotation_number');
            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();
            $.post("{{url('/client/quotations/discount')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    quotation_number: quotation_number,
                    discount_type: discount_type,
                    discount_value: discount_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
        });
        $('#exec_extra').on('click', function () {
            let quotation_number = $(this).attr('quotation_number');
            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();
            $.post("{{url('/client/quotations/extra')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    quotation_number: quotation_number,
                    extra_type: extra_type,
                    extra_value: extra_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
        });
    });
</script>
