<?php
$company = \App\Models\Company::FindOrFail($buy_bill->company_id);
$company_id = $company->id;
$extra_settings = \App\Models\ExtraSettings::where('company_id', $company->id)->first();
$currency = $extra_settings->currency;
$tax_value_added = $company->tax_value_added;
?>
    <!DOCTYPE html>
<html>
<head>
    <title>
        @if(App::getLocale() == 'ar')
            <?php echo $buy_bill->supplier->supplier_name . " - فاتورة رقم " . $buy_bill->buy_bill_number;  ?>
        @else
            <?php echo $buy_bill->supplier->supplier_name . " -  bill number " . $buy_bill->buy_bill_number;  ?>
        @endif
    </title>
    <meta charset="utf-8"/>
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <style type="text/css" media="screen">
        @font-face {
            font-family: 'Cairo';
            src: url({{asset('fonts/Cairo.ttf')}});
        }

        body, html {
            font-family: 'Cairo' !important;
        }

        .table-container {
            width: 50%;
            margin: 10px auto;
        }

        .no-print {
            position: fixed;
            bottom: 0;
            right: 10px;
            border-radius: 0;
            z-index: 9999;
            font-size: 12px !important;
        }

        a.no-print {
            bottom: 35px !important;
        }

    </style>
    <style type="text/css" media="print">
        body, html {
            font-family: 'Cairo' !important;
        }


        .no-print, .noprint {
            display: none;
        }
    </style>
</head>
<body style="background: #fff">
<table class="table table-bordered table-container">
    <thead class="header">
    <tr>
        <td>
            <img class="img-footer" src="{{asset($company->basic_settings->header)}}"/>
        </td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="thisTD">
            <center style="margin:20px auto;">
                <span style="font-size:18px;font-weight:bold;border:1px dashed #333; padding: 5px 30px;">
                    @if(App::getLocale() == 'ar')
                        فاتورة ضريبية مشتريات
                    @else
                        tax buy bill
                    @endif
                     </span>
            </center>

            <hr style="border-bottom:1px solid #000;margin:5px auto; width: 90%;"/>
            <div class="row" dir="rtl">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin:10px auto;">

                    <table class="table  table-bordered text-right" dir="rtl" style="font-size:12px;">
                        <tr>
                            <td style="width:40%;">
                                @if(App::getLocale() == 'ar')
                                    تاريخ الفاتورة
                                @else
                                    Bill Date
                                @endif
                            </td>
                            <td>{{$buy_bill->date}}</td>
                            <td style="width:40%;">
                                @if(App::getLocale() == 'ar')
                                    الرقم الضريبى
                                @else
                                    Tax Number
                                @endif
                            </td>
                            <td>{{$company->tax_number}}</td>
                        </tr>
                        <tr>
                            <td style="width:40%;">
                                @if(App::getLocale() == 'ar')
                                    رقم الفاتورة
                                @else
                                    Bill Number
                                @endif
                            </td>
                            <td>{{$buy_bill->buy_bill_number}}</td>
                            <td style="width:40%;">
                                @if(App::getLocale() == 'ar')
                                    السجل التجارى
                                @else
                                    Commercial Registration Number
                                @endif
                            </td>
                            <td>{{$company->commercial_registration_number}}</td>
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                @if(App::getLocale() == 'ar')
                                    اسم المؤسسة
                                @else
                                    Company Name
                                @endif
                            </td>
                            <td style="width:35%;">{{$company->company_name}}</td>
                            <td colspan="2" style="width:15%;text-align: center;">
                                @if(App::getLocale() == 'ar')
                                    عنوان المؤسسة
                                @else
                                    Company Address
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                @if(App::getLocale() == 'ar')
                                    رقم التليفون
                                @else
                                    Phone Number
                                @endif

                            </td>
                            <td style="width:35%;">{{$company->phone_number}}</td>
                            <td colspan="2" style="width:35%;text-align: center;">{{$company->company_address}}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-12">
                    <table class="table table-bordered text-right" dir="rtl" style="font-size:12px;">
                        <tr class="text-center">
                            <td colspan="4">
                                @if(App::getLocale() == 'ar')
                                    بيانات المورد
                                @else
                                    Supplier Details
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                @if(App::getLocale() == 'ar')
                                    اسم المورد
                                @else
                                    Supplier Name
                                @endif
                            </td>
                            <td style="width:35%;">{{$buy_bill->supplier->supplier_name}}</td>
                            <td style="width:15%;">
                                @if(App::getLocale() == 'ar')
                                    فئة التعامل
                                @else
                                    Supplier Category
                                @endif
                            </td>
                            <td style="width:35%;">{{$buy_bill->supplier->supplier_category}}</td>
                        </tr>
                        <tr>
                            <td style="width:15%;">
                                @if(App::getLocale() == 'ar')
                                    رقم التليفون
                                @else
                                    Phone Number
                                @endif
                            </td>
                            <td style="width:35%;direction:ltr;">{{$buy_bill->supplier->supplier_phone}}</td>
                            <td style="width:15%;">
                                @if(App::getLocale() == 'ar')
                                    الرقم الضريبى
                                @else
                                    Tax Number
                                @endif
                            </td>
                            <td style="width:35%;">{{$buy_bill->supplier->tax_number}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        <?php
            $sum = array();
            $elements = $buy_bill->elements;
            $extras = $buy_bill->extras;
            if (!$elements->isEmpty()) {
                echo '<h6 class="alert alert-sm alert-info text-center">
                        <i class="fa fa-info-circle"></i>';
                if (App::getLocale() == "ar") {
                    echo " بيانات عناصر الفاتورة  رقم";
                } else {
                    echo "Buy Bill items  - Number ";
                }
                echo $buy_bill->buy_bill_number . '
                    </h6 > ';
                $i = 0;
                echo "<div class='table - responsive'>";
                echo "<table style='width:100 %;text - align:center' dir='rtl' class='table table - bordered text - right'>";
                echo "<thead dir='rtl' class='text - center bg - primary' style='text - align:center;'>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>#</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "الكود";
                } else {
                    echo "Barcode";
                }
                echo"</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "اسم المنتج";
                } else {
                    echo "Product Name";
                }
                echo"</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "العدد";
                } else {
                    echo "Count";
                }
                echo"</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "سعر الوحدة";
                } else {
                    echo "Unit Price";
                }
                echo"</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "سعر الاجمالى";
                } else {
                    echo "Quantity Price";
                }
                echo"</td>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($elements as $element) {
                    $serials = $element->serials;
                    array_push($sum, $element->quantity_price);
                    echo "<tr>";
                    echo "<td>" . ++$i . "</td>";
                    echo "<td>" . $element->product->code_universal . "</td>";
                    if ($serials->isEmpty()) {
                        echo "<td style='border: 1px solid #aaa'>
                            " . $element->product->product_name . " </td>";
                    } else {
                        echo "<td style='border: 1px solid #aaa'>
                            " . $element->product->product_name;
                        foreach ($serials as $serial) {
                            echo "<br/>" . $serial->serial_number;
                        }
                        echo "
                        </td>";
                    }
                    echo "<td>" . $element->quantity . " " . $element->unit->unit->unit_name . "</td>";
                    echo "<td>" . $element->product_price . "</td>";
                    echo "<td>" . $element->quantity_price . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                $total = array_sum($sum);
                $percentage = ($tax_value_added / 100) * $total;
                $after_total = $total + $percentage;
            }
            echo "<table class='table table-bordered text-right' dir='rtl' style='font-size:12px;'>
                <tr>
                    <td>";
            if (App::getLocale() == "ar") {
                echo "الاجمالى قبل الخصم والضريبة : ";
            } else {
                echo "Total Before Discount and VAT : ";
            }
            echo $total . "  " . trans('main.' . $currency) . "</td>";
            echo "<td>";
            foreach ($extras as $key) {
                if ($key->action == "discount") {
                    if ($key->action_type == "pound") {
                        if (App::getLocale() == "ar") {
                            echo "خصم : ";
                        } else {
                            echo "Discount : ";
                        }
                        echo $key->value . " " . trans('main.' . $currency);
                    } else {
                        if (App::getLocale() == "ar") {
                            echo "خصم : ";
                        } else {
                            echo "Discount : ";
                        }
                        echo $key->value . " % ";
                    }
                } else {
                    echo "<span style='margin-right:30px;'>";
                    if ($key->action_type == "pound") {
                        if (App::getLocale() == "ar") {
                            echo "مصاريف شحن : ";
                        } else {
                            echo "Charging Expenses : ";
                        }
                        echo $key->value . " " . trans('main.' . $currency);
                    } else {
                        if (App::getLocale() == "ar") {
                            echo "مصاريف شحن : ";
                        } else {
                            echo "Charging Expenses : ";
                        }
                        echo $key->value . " % ";
                    }
                    echo "</span>";
                }
            }
            echo "</td></tr>";
            $tax_value = ($tax_value_added / 100) * $total;
            $tax_value_added = $company->tax_value_added;
            $sum = array();
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
            }
            $total = array_sum($sum);
            $previous_extra = \App\Models\BuyBillExtra::where('buy_bill_id', $buy_bill->id)
                ->where('action', 'extra')->first();
            if (!empty($previous_extra)) {
                $previous_extra_type = $previous_extra->action_type;
                $previous_extra_value = $previous_extra->value;
                if ($previous_extra_type == "percent") {
                    $previous_extra_value = $previous_extra_value / 100 * $total;
                }
                $after_discount = $total + $previous_extra_value;
            }
            $previous_discount = \App\Models\BuyBillExtra::where('buy_bill_id', $buy_bill->id)
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
            $tax_value = $tax_value_added / 100 * $after_discount;
            if (isset($after_discount) && $after_discount != 0) {
                $percentage = ($tax_value_added / 100) * $after_discount;
                $after_total_all = $after_discount + $percentage;
            } else {
                $percentage = ($tax_value_added / 100) * $total;
                $after_total_all = $total + $percentage;
            }
            echo "<tr>
                    <td>";
                    if (App::getLocale() == "ar") {
                        echo "ضريبة القيمة المضافة : ";
                    } else {
                        echo "VAT : ";
                    }
                    echo"( " . $tax_value_added . "% ) </td>
                    <td>";
                    if (App::getLocale() == "ar") {
                        echo "قيمة ضريبة القيمة المضافة : ";
                    } else {
                        echo "VAT value : ";
                    }
                    echo $tax_value . " " . trans('main.' . $currency) . " </td>
                </tr>";
                echo "<tr>
                <td>";
                    if (App::getLocale() == "ar") {
                        echo "اجمالى  الفاتورة بعد الخصم والضريبة : ";
                    } else {
                        echo "Bill total after discount and tax : ";
                    }
                echo $after_total_all . " " . trans('main.' . $currency) . "</td>";
            $cash = \App\Models\BuyCash::where('bill_id', $buy_bill->buy_bill_number)
                ->where('company_id', $company_id)
                ->where('supplier_id', $buy_bill->supplier_id)
                ->where('supplier_id', $buy_bill->supplier_id)
                ->first();
            $bank_cash = \App\Models\BankBuyCash::where('bill_id', $buy_bill->buy_bill_number)
                ->where('company_id', $company_id)
                ->where('supplier_id', $buy_bill->supplier_id)
                ->where('supplier_id', $buy_bill->supplier_id)
                ->first();
            if (!empty($cash)) {
                echo "<td>";
                if (App::getLocale() == "ar") {
                        echo "المبلغ المدفوع : ";
                    } else {
                        echo "Paid Amount : ";
                    }
                echo $cash->amount . " " . trans('main.' . $currency) . "</td>";
                $rest = $after_total_all - $cash->amount;
            } elseif (!empty($bank_cash)) {
                echo "<td>";
                if (App::getLocale() == "ar") {
                        echo "المبلغ المدفوع : ";
                    } else {
                        echo "Paid Amount : ";
                    }
                echo $bank_cash->amount . " " . trans('main.' . $currency) . "</td>";
                $rest = $after_total_all - $bank_cash->amount;
            } else {
                echo "<td>";
                if (App::getLocale() == "ar") {
                        echo "المبلغ المدفوع : 0 ";
                    } else {
                        echo "Paid Amount : 0";
                    }
                echo trans('main.' . $currency) . "</td>";
                $rest = $after_total_all;
            }
            echo "</tr>";
            echo "<tr style='text-align:center;'>
                    <td style='text-align:center;' colspan='2'>";
                    if (App::getLocale() == "ar") {
                        echo "المبلغ المتبقى : ";
                    } else {
                        echo "Rest Amount : ";
                    }
                    echo  $rest . " " . trans('main.' . $currency) . " </td>
                </tr>";
            echo "</table>";
            ?>
            <div class="clearfix"></div>
            <div class="visible-print text-center mt-2 mb-2">
                <?php
                use Salla\ZATCA\GenerateQrCode;
                use Salla\ZATCA\Tags\InvoiceDate;
                use Salla\ZATCA\Tags\InvoiceTaxAmount;
                use Salla\ZATCA\Tags\InvoiceTotalAmount;
                use Salla\ZATCA\Tags\Seller;
                use Salla\ZATCA\Tags\TaxNumber;
                $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
                    new Seller($company->company_name), // seller name
                    new TaxNumber($company->tax_number), // seller tax number
                    new InvoiceDate($buy_bill->date . " " . $buy_bill->time), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
                    new InvoiceTotalAmount($after_total_all), // invoice total amount
                    new InvoiceTaxAmount($tax_value) // invoice tax amount
//                     TODO :: Support others tags
                ])->render();
                ?>
                <img src="{{$displayQRCodeAsBase64}}" style="width: 100px; height: 100px;" alt="QR Code"/>

                <img style="width: 100px!important;height: 100px!important;"
                     src="{{asset($company->basic_settings->electronic_stamp)}}"/>
            </div>
        </td>
    </tr>
    </tbody>
    <tfoot class="footer">
    <tr>
        <td>
            <img style="width: 100%; display: inline;float: left;" class="img-footer"
                 src="{{asset($company->basic_settings->footer)}}"/>
        </td>
    </tr>
    </tfoot>
</table>

<button onclick="window.print();" class="no-print btn btn-md btn-success text-white">
    @if(App::getLocale() == 'ar')
        طباعة
    @else
        Print
    @endif
</button>
<a href="{{route('client.buy_bills.create')}}" class="no-print btn btn-md btn-danger text-white">
    @if(App::getLocale() == 'ar')
        العودة الى فاتورة المشتريات
    @else
        Back to buy bills
    @endif
</a>
<button class="show_hide_header noprint text-white btn btn-dark btn-sm"
        style="height: 45px!important;bottom: 50px!important;left: 30px!important;font-size: 12px!important;">
    <i class="fa fa-eye-slash"></i>
    @if(App::getLocale() == 'ar')
        اظهار او اخفاء الهيدر
    @else
        show/hide header
    @endif
</button>
<button class="show_hide_footer noprint text-white btn btn-dark btn-sm"
        style="height: 45px!important;left: 30px!important;font-size: 12px!important;">
    <i class="fa fa-eye-slash"></i>
    @if(App::getLocale() == 'ar')
        اظهار او اخفاء الفوتر
    @else
        show/hide footer
    @endif
</button>
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script type="text/javascript">
    $('.show_hide_header').on('click', function () {
        $('.header').toggle();
    });
    $('.show_hide_footer').on('click', function () {
        $('.footer').toggle();
    });
</script>
</body>
</html>
