<!DOCTYPE html>
<html>
<head>
    <title>
        @if(App::getLocale() == 'ar')
            <?php echo " فاتورة مبيعات رقم " . $pos->id;  ?>
        @else
            <?php echo "Sale Bill Number " . $pos->id;  ?>
        @endif
    </title>
    <meta charset="utf-8"/>
    <link href="{{asset('/app-assets/css-rtl/bootstrap.min.css')}}" rel="stylesheet"/>
    <style type="text/css" media="screen">
        @font-face {
            font-family: 'Cairo';
            src: url("{{asset('fonts/Cairo.ttf')}}");
        }

        * {
            color: #000 !important;
        }

        body, html {
            color: #000;
            font-family: 'Cairo' !important;
            font-size: 12px;
            margin: 0;
            padding: 10px;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        .no-print {
            position: fixed;
            bottom: 0;
            color: #fff !important;
            left: 30px;
            height: 40px !important;
            border-radius: 0;
            padding-top: 10px;
            z-index: 9999;
        }

        table thead tr, table tbody tr {
            border-bottom: 1px solid #aaa;
        }

        table {
            text-align: right;
            width: 20% !important;
            margin-top: 10px !important;
        }
    </style>
    <style type="text/css" media="print">
        table {
            text-align: right;
            width: 100% !important;
            margin-top: 10px !important;
        }

        table thead tr, table tbody tr {
            border-bottom: 1px solid #aaa;
        }

        * {
            color: #000 !important;
        }

        body, html {
            color: #000;
            padding: 0px;
            margin: 0;
            font-family: 'Cairo' !important;
            font-size: 10px !important;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        .pos_details {
            width: 100% !important;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        .no-print {
            display: none;
        }
    </style>
</head>
<body dir="rtl" style="background: #fff;
            page-break-before: avoid;
            page-break-after: avoid;
            page-break-inside: avoid;" class="text-right">
<div class="pos_details">
    <div class="text-right">
        <img class="logo" style="width: 100px;height: 100px;margin-top: 5px; margin-right: 20px;"
             src="{{asset($pos->company->company_logo)}}"
             alt="">
    </div>
    <div class="text-right mt-3">
        <div class="text-right">
            @if(App::getLocale() == 'ar')
                اسم التاجر :
            @else
                Merchant name:
            @endif
            {{$pos->company->company_name}} <br>
            @if(App::getLocale() == 'ar')
                عنوان التاجر :
            @else
                Merchant Address :
            @endif
            {{$pos->company->company_address}} <br>
            @if(App::getLocale() == 'ar')
                هاتف التاجر :
            @else
                Merchant Phone :
            @endif
            {{$pos->company->phone_number}} <br>
            @if(App::getLocale() == 'ar')
                الرقم الضريبى :
            @else
                Tax Number :
            @endif
            {{$pos->company->tax_number}}
        </div>
    </div>
    <div class="text-right mt-3">
        <div class="text-right">
            @if(App::getLocale() == 'ar')
                نوع الفاتورة : فاتورة مبيعات
            @else
                Bill Type : Sale Bill
            @endif
            <br>
            @if(App::getLocale() == 'ar')
                رقم الفاتورة :
            @else
                Bill Number :
            @endif
            {{$pos->id}}
            <br>
            @if(App::getLocale() == 'ar')
                اسم الموظف :
            @else
                Employee Name :
            @endif
            {{$pos->client->name}}
        </div>
    </div>
    <div class="text-right mt-3">
        <div class="text-right">
            @if(App::getLocale() == 'ar')
                تاريخ - وقت :
            @else
                Date - time
            @endif
            {{$pos->created_at}}
            <br>
            @if(App::getLocale() == 'ar')
                اسم المشترى :
            @else
                Buyer Name :
            @endif
            @if(isset($pos->outerClient->client_name))
                {{$pos->outerClient->client_name}}
            @else
                @if(App::getLocale() == 'ar')
                    زبون
                @else
                    Walk in Customer
                @endif
            @endif
        </div>
    </div>
    <div class="text-right mt-3">
        <table dir="rtl" height="40">

            <thead>
            <tr style="border: 1px solid #aaa">
                <td style='border: 1px solid #aaa'>
                    @if(App::getLocale() == 'ar')
                        الصنف
                    @else
                        Product
                    @endif
                </td>
                <td style='border: 1px solid #aaa'>
                    @if(App::getLocale() == 'ar')
                        الكمية
                    @else
                        Quantity
                    @endif
                </td>
                <td style='border: 1px solid #aaa'>
                    @if(App::getLocale() == 'ar')
                        السعر
                    @else
                        Price
                    @endif
                </td>
                <td style='border: 1px solid #aaa'>
                    @if(App::getLocale() == 'ar')
                        الاجمالى
                    @else
                        Total
                    @endif
                </td>
            </tr>
            </thead>
            <tbody>
            <?php $pos_elements = $pos->elements; ?>
            @if(isset($pos) && isset($pos_elements) && !$pos_elements->isEmpty())
                <?php
                foreach ($pos_elements as $element) {
                    $serials = $element->serials;
                    echo "<tr style='border: 1px solid #aaa'>";
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
                    echo "<td style='border: 1px solid #aaa' dir='rtl'><span>" . $element->quantity . " " . $element->unit->unit->unit_name . " </span></span></td>";
                    echo "<td style='border: 1px solid #aaa' dir='rtl'><span>" . $element->product_price . "</></td>";
                    echo "<td style='border: 1px solid #aaa'>" . $element->quantity_price . "</td>";
                    echo "</tr>";
                }
                ?>
            @endif
            </tbody>
        </table>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="clearfix"></div>
        <table dir="rtl">
            <tr>
                <td>
                    @if(App::getLocale() == 'ar')
                        عدد الأصناف
                    @else
                        items count
                    @endif
                </td>
                <td class="text-left">
                    <span class="text-left">
                        @if(isset($pos) && !$pos_elements->isEmpty())
                            {{$pos_elements->count()}}
                            <?php
                            $sum = 0;
                            foreach ($pos_elements as $pos_element) {
                                $sum = $sum + $pos_element->quantity;
                            }
                            ?>
                        @else
                            0
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    @if(App::getLocale() == 'ar')
                        اجمالى الفاتورة
                    @else
                        Bill Total
                    @endif
                </td>
                <td class="text-left">
                    <span class="text-left">
                        @if(isset($pos) && !$pos_elements->isEmpty())
                            <?php
                            $sum = 0;
                            foreach ($pos_elements as $pos_element) {
                                $sum = $sum + $pos_element->quantity_price;
                            }
                            ?>
                            {{$sum}}
                        @else
                            0
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    @if(App::getLocale() == 'ar')
                        قيمة الضريبة
                    @else
                        Tax Value
                    @endif
                </td>
                <td class="text-left">
                    <span class="text-left">
                        <?php
                        $pos_tax = $pos->tax;
                        $pos_discount = $pos->discount;
                        ?>
                        @if(isset($pos) && isset($pos_tax) && !empty($pos_tax))
                            <?php
                            $tax_value = $pos_tax->tax_value;
                            $sum = 0;
                            foreach ($pos_elements as $pos_element) {
                                $sum = $sum + $pos_element->quantity_price;
                            }
                            if (isset($pos) && isset($pos_discount) && !empty($pos_discount)) {
                                $discount_value = $pos_discount->discount_value;
                                $discount_type = $pos_discount->discount_type;
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
                        @else
                            <?php $percent = 0; ?>
                            0
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    @if(App::getLocale() == 'ar')
                        قيمة الخصم
                    @else
                        Discount Value
                    @endif
                </td>
                <td class="text-left">
                    <span class="text-left">
                        @if(isset($pos) && !empty($pos_discount))
                            <?php
                            $discount_value = $pos_discount->discount_value;
                            $discount_type = $pos_discount->discount_type;
                            $sum = 0;
                            foreach ($pos_elements as $pos_element) {
                                $sum = $sum + $pos_element->quantity_price;
                            }
                            if ($discount_type == "pound") {
                                echo $discount_value;
                            } else {
                                $discount_value = ($discount_value / 100) * $sum;
                                echo $discount_value;
                            }
                            ?>
                        @else
                            0
                        @endif
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    @if(App::getLocale() == 'ar')
                        الاجمالى النهائى
                    @else
                        Final Total
                    @endif
                </td>
                <td class="text-left">
                    <span class="text-left">
                       @if(isset($pos))
                            <?php
                            $sum = 0;
                            foreach ($pos_elements as $pos_element) {
                                $sum = $sum + $pos_element->quantity_price;
                            }
                            if (isset($pos) && isset($pos_tax) && empty($pos_discount)) {
                                $tax_value = $pos_tax->tax_value;
                                $percent = $tax_value / 100 * $sum;
                                $sum = $sum + $percent;
                            } elseif (isset($pos) && isset($pos_discount) && empty($pos_tax)) {
                                $discount_value = $pos_discount->discount_value;
                                $discount_type = $pos_discount->discount_type;
                                if ($discount_type == "pound") {
                                    $sum = $sum - $discount_value;
                                } else {
                                    $discount_value = ($discount_value / 100) * $sum;
                                    $sum = $sum - $discount_value;
                                }
                            } elseif (isset($pos) && !empty($pos_discount) && !empty($pos_tax)) {
                                $tax_value = $pos_tax->tax_value;

                                $discount_value = $pos_discount->discount_value;
                                $discount_type = $pos_discount->discount_type;
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
            <tr>
                <td>
                    @if(App::getLocale() == 'ar')
                        المبلغ المدفوع
                    @else
                        Paid Amount
                    @endif
                </td>
                <td class="text-left">
                    <?php
                    $cash_id = "pos_" . $pos->id;
                    $cash = \App\Models\Cash::where('bill_id', $cash_id)->get();
                    if (!$cash->isEmpty()) {
                        $cash_amount = 0;
                        foreach ($cash as $item) {
                            $cash_amount = $cash_amount + $item->amount;
                        }
                    } else {
                        $cash_amount = 0;
                    }
                    $bank_cash = \App\Models\BankCash::where('bill_id', $cash_id)->get();
                    if (!$bank_cash->isEmpty()) {
                        $cash_bank_amount = 0;
                        foreach ($bank_cash as $item) {
                            $cash_bank_amount = $cash_bank_amount + $item->amount;
                        }
                    } else {
                        $cash_bank_amount = 0;
                    }

                    $coupon_cash = \App\Models\CouponCash::where('bill_id', $cash_id)->get();
                    if (!$coupon_cash->isEmpty()) {
                        $cash_coupon_amount = 0;
                        foreach ($coupon_cash as $item) {
                            $cash_coupon_amount = $cash_coupon_amount + $item->amount;
                        }
                    } else {
                        $cash_coupon_amount = 0;
                    }

                    $total_amount = $cash_amount + $cash_bank_amount + $cash_coupon_amount;
                    $rest = $sum - $total_amount;
                    echo $total_amount;
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    @if(App::getLocale() == 'ar')
                        المبلغ المتبقى
                    @else
                        Rest Amount
                    @endif
                </td>
                <td class="text-left">
                    <?php
                    echo $rest;
                    ?>
                </td>
            </tr>
        </table>
        <div class="clearfix"></div>
        <div class="visible-print text-right mt-2 mr-2">
            <p>
                @if(App::getLocale() == 'ar')
                    نشكركم علي الزيارة وتشرفنا بخدمتكم
                @else
                    Thank you for visiting and we are happy to serve you
                @endif
            </p>
            <?php
            use Salla\ZATCA\GenerateQrCode;
            use Salla\ZATCA\Tags\InvoiceDate;
            use Salla\ZATCA\Tags\InvoiceTaxAmount;
            use Salla\ZATCA\Tags\InvoiceTotalAmount;
            use Salla\ZATCA\Tags\Seller;
            use Salla\ZATCA\Tags\TaxNumber;
            $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
                new Seller($pos->company->company_name), // seller name
                new TaxNumber($pos->company->tax_number), // seller tax number
                new InvoiceDate($pos->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
                new InvoiceTotalAmount($sum), // invoice total amount
                new InvoiceTaxAmount($percent) // invoice tax amount
                // TODO :: Support others tags
            ])->render();
            ?>
            <img src="{{$displayQRCodeAsBase64}}" style="width: 100px; height: 100px;margin-right: 50px;"
                 alt="QR Code"/>
        </div>
    </div>
</div>
<button onclick="window.print();" class="no-print btn btn-md btn-success">
    @if(App::getLocale() == 'ar')
        اضغط للطباعة
    @else
        Print
    @endif
</button>
<a href="{{route('client.pos.create')}}" class="no-print btn btn-md btn-danger" style="left:150px!important;">
    @if(App::getLocale() == 'ar')
        العودة الى نقطة البيع
    @else
        Back To POS
    @endif
</a>
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script type="text/javascript">

</script>
</body>
</html>
