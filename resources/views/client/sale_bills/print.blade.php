<?php
$company = \App\Models\Company::FindOrFail($sale_bill->company_id);
$company_id = $company->id;
$extra_settings = \App\Models\ExtraSettings::where('company_id', $company->id)->first();
$currency = $extra_settings->currency;
$tax_value_added = $company->tax_value_added;
?>
    <!DOCTYPE html>
<html>
<head>
    <title>
        @if (!empty($sale_bill->outer_client_id))
            @if(App::getLocale() == 'ar')
                <?php echo $sale_bill->OuterClient->client_name . " - فاتورة رقم " . $sale_bill->sale_bill_number;  ?>
            @else
                <?php echo $sale_bill->OuterClient->client_name . " - bill number " . $sale_bill->sale_bill_number;  ?>
            @endif
        @else
            @if(App::getLocale() == 'ar')
                <?php echo "فاتورة بيع نقدى" . " - فاتورة رقم " . $sale_bill->sale_bill_number;  ?>
            @else
                <?php echo "Cash Sale Bill" . " - Bill number " . $sale_bill->sale_bill_number;  ?>
            @endif
        @endif
    </title>
    <meta charset="utf-8"/>
    <link href="{{asset('/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <style type="text/css" media="screen">
        @font-face {
            font-family: 'Cairo';
            src: url({{asset('fonts/Cairo.ttf')}});
        }

        * {
            color: #000 !important;
            font-size: 15px !important;
            font-weight: bold !important;
        }

        .img-footer {
            width: 100% !important;
            height: 100px !important;
            max-height: 100px !important;
        }

        body, html {
            font-family: 'Cairo' !important;
        }

        .table-container {
            width: 70%;
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

        * {
            font-size: 15px !important;
            color: #000 !important;
            font-weight: bold !important;
        }

        .img-footer {
            width: 100% !important;
            height: 100px !important;
            max-height: 100px !important;
        }

        .no-print {
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
                @if (!empty($sale_bill->outer_client_id))
                    <span style="font-size:18px;font-weight:bold;border:1px dashed #333; padding: 5px 30px;">
                    @if(App::getLocale() == 'ar')
                            فاتورة ضريبية مبيعات عملاء
                        @else
                            Customer sales tax invoice
                        @endif
                    </span>
                @else
                    <span style="font-size:18px;font-weight:bold;border:1px dashed #333; padding: 5px 30px;">
                        @if(App::getLocale() == 'ar')
                            فاتورة ضريبية مبيعات نقدية
                        @else
                            cash sales tax invoice
                        @endif
                    </span>
                @endif
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
                            <td>{{$sale_bill->date}}</td>
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
                            <td>{{$sale_bill->sale_bill_number}}</td>
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
                            <td style="width:15%;text-align: center;">
                                @if(App::getLocale() == 'ar')
                                    عنوان المؤسسة
                                @else
                                    Company Address
                                @endif
                            </td>
                            <td style="width:35%;text-align: center;">{{$company->company_address}}</td>

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
                            <td style="width:15%;">
                                @if(App::getLocale() == 'ar')
                                    اسم البائع
                                @else
                                    Seller Name
                                @endif
                            </td>
                            <td style="width:35%;">{{$sale_bill->client->name}}</td>

                        </tr>
                    </table>
                </div>
                @if (!empty($sale_bill->outer_client_id))
                    <div class="col-lg-12">
                        <table class="table table-bordered text-right" dir="rtl" style="font-size:12px;">
                            <tr class="text-center">
                                <td colspan="4">
                                    @if(App::getLocale() == 'ar')
                                        بيانات العميل
                                    @else
                                        Client details
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%;">
                                    @if(App::getLocale() == 'ar')
                                        اسم العميل
                                    @else
                                        Client Name
                                    @endif
                                </td>
                                <td style="width:35%;">{{$sale_bill->OuterClient->client_name}}</td>
                                <td style="width:15%;">
                                    @if(App::getLocale() == 'ar')
                                        فئة التعامل
                                    @else
                                        Client Category
                                    @endif
                                </td>
                                <td style="width:35%;">{{trans('main.'.$sale_bill->OuterClient->client_category)}}</td>
                            </tr>
                            <tr>
                                <td style="width:15%;">
                                    @if(App::getLocale() == 'ar')
                                        رقم التليفون
                                    @else
                                        Phone Number
                                    @endif
                                </td>
                                <td style="width:35%;direction:ltr;">{{$sale_bill->OuterClient->supplier_phone}}</td>
                                <td style="width:15%;">
                                    @if(App::getLocale() == 'ar')
                                        الرقم الضريبى
                                    @else
                                        Tax Number
                                    @endif
                                </td>
                                <td style="width:35%;">{{$sale_bill->OuterClient->tax_number}}</td>
                            </tr>
                        </table>
                    </div>
                @endif
            </div>
            <?php
            $sum = array();
            $elements = $sale_bill->elements;
            $extras = $sale_bill->extras;
            if (!$elements->isEmpty()) {
                echo '<h6 class="alert alert-sm alert-info text-center">
                        <i class="fa fa-info-circle"></i>';
                if (App::getLocale() == "ar") {
                    echo " بيانات عناصر الفاتورة  رقم";
                } else {
                    echo "Buy Bill items  - Number ";
                }
                echo $sale_bill->sale_bill_number . '
                </h6>';
                $i = 0;
                echo "<div class='table-responsive'>";
                echo "<table style='width:100%;text-align:center' dir='rtl' class='table table-bordered text-right'>";
                echo "<thead dir='rtl' class='text-center bg-primary' style='text-align:center;'>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>#</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "الكود";
                } else {
                    echo "Barcode";
                }
                echo "</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "اسم المنتج";
                } else {
                    echo "Product Name";
                }
                echo "</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "العدد";
                } else {
                    echo "Count";
                }
                echo "</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "سعر الوحدة";
                } else {
                    echo "Unit Price";
                }
                echo "</td>";
                echo "<td style='border:1px solid #ddd;font-family:Cairo !important;'>";
                if (App::getLocale() == "ar") {
                    echo "سعر الاجمالى";
                } else {
                    echo "Quantity Price";
                }
                echo "</td>";
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
            echo $total . "  " . $currency . "</td>";
            echo "<td>";
            foreach ($extras as $key) {
                if ($key->action == "discount") {
                    if ($key->action_type == "pound") {
                        if (App::getLocale() == "ar") {
                            echo "خصم : ";
                        } else {
                            echo "Discount : ";
                        }
                        echo $key->value . " " . $currency;
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
                        echo $key->value . " " . $currency;
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
            $tax_value_added = $company->tax_value_added;
            $sum = array();
            foreach ($elements as $element) {
                array_push($sum, $element->quantity_price);
            }
            $total = array_sum($sum);
            $previous_extra = \App\Models\SaleBillExtra::where('sale_bill_id', $sale_bill->id)
                ->where('action', 'extra')->first();
            if (!empty($previous_extra)) {
                $previous_extra_type = $previous_extra->action_type;
                $previous_extra_value = $previous_extra->value;
                if ($previous_extra_type == "percent") {
                    $previous_extra_value = $previous_extra_value / 100 * $total;
                }
                $after_discount = $total + $previous_extra_value;
            }
            $previous_discount = \App\Models\SaleBillExtra::where('sale_bill_id', $sale_bill->id)
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
            echo "( " . $tax_value_added . "% ) </td>
                    <td>";
            if (App::getLocale() == "ar") {
                echo "قيمة ضريبة القيمة المضافة : ";
            } else {
                echo "VAT value : ";
            }
            echo $tax_value . " " . $currency . " </td>
                </tr>";
            echo "<tr>
                <td>";
            if (App::getLocale() == "ar") {
                echo "اجمالى  الفاتورة بعد الخصم والضريبة : ";
            } else {
                echo "Bill total after discount and tax : ";
            }
            echo $after_total_all . " " . $currency . "</td>";
            $cash = \App\Models\Cash::where('bill_id', $sale_bill->sale_bill_number)
                ->where('company_id', $company_id)
                ->where('outer_client_id', $sale_bill->outer_client_id)
                ->where('outer_client_id', $sale_bill->outer_client_id)
                ->first();
            $bank_cash = \App\Models\BankCash::where('bill_id', $sale_bill->sale_bill_number)
                ->where('company_id', $company_id)
                ->where('outer_client_id', $sale_bill->outer_client_id)
                ->where('outer_client_id', $sale_bill->outer_client_id)
                ->first();
            if (!empty($cash)) {
                echo "<td>";
                if (App::getLocale() == "ar") {
                    echo "المبلغ المدفوع : ";
                } else {
                    echo "Paid Amount : ";
                }
                echo $cash->amount . " " . $currency . "</td>";
                $rest = $after_total_all - $cash->amount;
            } elseif (!empty($bank_cash)) {
                echo "<td>";
                if (App::getLocale() == "ar") {
                    echo "المبلغ المدفوع : ";
                } else {
                    echo "Paid Amount : ";
                }
                echo $bank_cash->amount . " " . $currency . "</td>";
                $rest = $after_total_all - $bank_cash->amount;
            } else {
                echo "<td>";
                if (App::getLocale() == "ar") {
                    echo "المبلغ المدفوع : 0 ";
                } else {
                    echo "Paid Amount : 0";
                }
                echo $currency . "</td>";
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
            echo $rest . " " . $currency . " </td>
                </tr>";
            echo "</table>";
            ?>

            <div class="clearfix"></div>
            <div class="text-center mt-2 mb-2">
            <!--{!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->generate(Request::url()); !!}-->
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
                    new InvoiceDate($sale_bill->date . " " . $sale_bill->time), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
                    new InvoiceTotalAmount($after_total_all), // invoice total amount
                    new InvoiceTaxAmount($tax_value) // invoice tax amount
                    // TODO :: Support others tags
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
<a href="{{route('client.sale_bills.create')}}" class="no-print btn btn-md btn-danger text-white">
    @if(App::getLocale() == 'ar')
        العودة الى فاتورة المبيعات
    @else
        Back to sale bills
    @endif
</a>


<button class="show_hide_header no-print text-white btn btn-dark btn-sm"
        style="height: 45px!important;bottom: 50px!important;left: 30px!important;font-size: 12px!important;">
    <i class="fa fa-eye-slash"></i>
    @if(App::getLocale() == 'ar')
        اظهار او اخفاء الهيدر
    @else
        show/hide header
    @endif
</button>
<button class="show_hide_footer no-print text-white btn btn-dark btn-sm"
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
