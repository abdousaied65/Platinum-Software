<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body
    style="box-sizing: border-box; font-family:'Cairo'; position: relative; -webkit-text-size-adjust: none; background-color: #ffffff; color: #718096; height: 100%; line-height: 1.4; margin: 0; padding: 0; width: 100% !important;">
<style>
    @media only screen and (max-width: 600px) {
        .inner-body {
            width: 100% !important;
        }

        .footer {
            width: 100% !important;
        }
    }

    @media only screen and (max-width: 500px) {
        .button {
            width: 100% !important;
        }
    }
</style>

<table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation"
       style="box-sizing: border-box; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; margin: 0; padding: 0; width: 100%;">
    <!-- Email Body -->
    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0"
            style="box-sizing: border-box; font-family: 'Cairo'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; background-color: #edf2f7; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; margin: 0; padding: 0; width: 100%;">
            <table class="inner-body" width="570" cellpadding="0" cellspacing="0"
                   role="presentation"
                   style="box-sizing: border-box; font-family: 'Cairo'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;">
                <!-- Body content -->
                <tr>
                    <td class="content-cell"
                        style="box-sizing: border-box; font-family: 'Cairo'; position: relative; max-width: 100vw; padding: 32px;">
                        <div style="width: 90%; height: 30px; padding: 10px; background: #0d3349; color:#fff; font-family: 'Cairo';
                            font-size: 16px; margin: 10px auto; border-radius: 5px;"> @if(App::getLocale() == 'ar')
                                رسالة من
                            @else
                                Message From
                            @endif
                            @if(App::getLocale() == 'ar')
                                {{$system->name_ar}}
                            @else
                                {{$system->name_en}}
                            @endif
                        </div>
                        <h1 style="box-sizing: border-box; font-family: 'Cairo';
                        position: relative; color: #3d4852; font-size: 18px;
                        font-weight: bold; margin-top: 0; text-align: right;">
                            {{$data['subject']}} </h1>
                        <p style="box-sizing: border-box; font-family: 'Cairo'; position: relative;
                        font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: right;">
                            @if(App::getLocale() == 'ar')
                                من فضلك اقرا محتوى الرسالة جيدا
                            @else
                                Please Read Message Carefully !
                            @endif</p>
                        <table class="action" width="100%" cellpadding="0" cellspacing="0"
                               role="presentation"
                               style="box-sizing: border-box; font-family: 'Cairo'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padding: 0; width: 100%;">
                            <tr>
                                <td
                                    style="box-sizing: border-box; font-family: 'Cairo'; position: relative;">
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0"
                                           role="presentation" align="right" dir="rtl"
                                           style="box-sizing: border-box; font-family: 'Cairo'; position: relative;">
                                        <tr>
                                            <td
                                                style="box-sizing: border-box; font-family: 'Cairo'; position: relative;">
                                                <table border="0" cellpadding="0" cellspacing="0"
                                                       role="presentation"
                                                       style="box-sizing: border-box; font-family: 'Cairo';
                                                       position: relative;">
                                                    <tr>
                                                        <td style="box-sizing: border-box;
                                                        font-family: 'Cairo'; position: relative;">
                                                            <p>{{$data['body']}}</p>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $purchase_order = $data['purchase_order'];
                                                    $elements = $data['elements'];
                                                    $extras = $data['extras'];
                                                    $company = $data['company'];
                                                    $currency = $data['currency'];
                                                    $after_total_all = $data['after_total_all'];
                                                    ?>

                                                    <div class="col-lg-12 mb-3 alert alert-secondary alert-sm">
                                                        <div class="col-4 pull-right">
                                                            @if(App::getLocale() == 'ar')
                                                                اسم المورد :
                                                            @else
                                                                Supplier Name :
                                                            @endif
                                                            {{$purchase_order->supplier->supplier_name}}
                                                        </div>
                                                        <br/>
                                                        <div class="col-4 pull-right">
                                                            @if(App::getLocale() == 'ar')
                                                                تاريخ بدأ امر الشراء :
                                                            @else
                                                                Purchase Order Start Date :
                                                            @endif
                                                            {{$purchase_order->start_date}}
                                                        </div>
                                                        <br/>
                                                        <div class="col-4 pull-right">
                                                            @if(App::getLocale() == 'ar')
                                                                تاريخ انتهاء امر الشراء :
                                                            @else
                                                                Purchase Order End Date :
                                                            @endif
                                                            {{$purchase_order->expiration_date}}
                                                        </div>
                                                        <br/>
                                                        <div class="clearfix"></div>
                                                    </div>

                                                    <?php
                                                    $tax_value_added = $company->tax_value_added;
                                                    $sum = array();
                                                    if (!$elements->isEmpty()) {
                                                        $i = 0;
                                                        echo "<table width='100%' border='1' cellpadding='5' cellspacing='0'
                                                       align='right' dir='rtl'
                                                       style='box-sizing: border-box; font-family: Cairo; position: relative;'>";
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
                                                            echo "quantity";
                                                        }
                                                        echo "</th>";
                                                        echo "<th>";
                                                        if (App::getLocale() == "ar") {
                                                            echo "الاجمالى";
                                                        } else {
                                                            echo "Total";
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
                                                            echo "<td>" . floatval($element->quantity) . " " . $element->unit->unit_name . "</td>";
                                                            echo "<td>" . floatval($element->quantity_price) . "</td>";

                                                            echo "</tr>";
                                                        }
                                                        echo "</tbody>";
                                                        echo "</table>";
                                                        echo "<br/>";
                                                        $total = array_sum($sum);
                                                        $percentage = ($tax_value_added / 100) * $total;
                                                        $after_total = $total + $percentage;
                                                        echo "
                                                        <div class='clearfix'></div>
                                                        <div class='alert alert-dark alert-sm before_totals'>
                                                            <br/>
                                                            <div class='pull-right col-6 '>";
                                                        if (App::getLocale() == "ar") {
                                                            echo "اجمالى امر الشراء";
                                                        } else {
                                                            echo "Total";
                                                        }
                                                        echo floatval($total) . " " . trans('main.' . $currency) . "
                                                            </div>
                                                            <br/>
                                                            <div class='clearfix'></div>
                                                        </div>";
                                                        echo "
                                                        <div class='clearfix'></div>
                                                        <div class='alert alert-dark alert-sm'>";
                                                        foreach ($extras as $key) {
                                                            if ($key->action == "discount") {
                                                                echo "<div class='pull-right col-6 '>";
                                                                if ($key->action_type == "pound") {
                                                                    if (App::getLocale() == "ar") {
                                                                        echo "خصم";
                                                                    } else {
                                                                        echo "discount";
                                                                    }
                                                                    echo $key->value . " " . trans('main.' . $currency);
                                                                } else {
                                                                    if (App::getLocale() == "ar") {
                                                                        echo "خصم";
                                                                    } else {
                                                                        echo "discount";
                                                                    }
                                                                    echo $key->value . " % ";
                                                                }
                                                                echo "</div><br/>";
                                                            } else {
                                                                echo "<div class='pull-right col-6 '>";
                                                                if ($key->action_type == "pound") {
                                                                    if (App::getLocale() == "ar") {
                                                                        echo "مصاريف شحن";
                                                                    } else {
                                                                        echo "charging fees";
                                                                    }
                                                                    echo $key->value . " " . trans('main.' . $currency);
                                                                } else {
                                                                    if (App::getLocale() == "ar") {
                                                                        echo "مصاريف شحن";
                                                                    } else {
                                                                        echo "charging fees";
                                                                    }
                                                                    echo $key->value . " % ";
                                                                }
                                                                echo "</div><br/>";
                                                            }
                                                        }
                                                        echo "<div class='clearfix'></div>";
                                                        echo "</div>";
                                                        echo "
                                                        <div class='clearfix'></div>
                                                        <div class='col-lg-12 col-md-12 col-sm-12 after_totals'>
                                                            <div class='alert alert-secondary alert-sm'>";
                                                        if (App::getLocale() == "ar") {
                                                            echo "اجمالى امر الشراء النهائى بعد الشحن والخصم والقيمة المضافة :";
                                                        } else {
                                                            echo "The total of the final purchase order after shipping, discount and VAT";
                                                        }
                                                        echo floatval($after_total_all) . " " . trans('main.' . $currency) . "
                                                            </div>
                                                            <br/>
                                                        </div>";
                                                    }
                                                    ?>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <p style="box-sizing: border-box; font-family: 'Cairo'; position: relative;
                        font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: right;">
                            @if(App::getLocale() == 'ar')
                                اذا كنت تعتقد انها رسالة وهمية او مزيفة .. قم بتجاهلها
                            @else
                                If you think it's a fake message.. ignore it
                            @endif </p>

                        <p style="box-sizing: border-box; font-family: 'Cairo'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: right;">
                            @if(App::getLocale() == 'ar')
                                مع خالص التحيات,
                            @else
                                with my all best wishes
                            @endif<br>
                            @if(App::getLocale() == 'ar')
                                {{$system->name_ar}}
                            @else
                                {{$system->name_en}}
                            @endif
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
