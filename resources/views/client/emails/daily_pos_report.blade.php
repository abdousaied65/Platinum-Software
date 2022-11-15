<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
<style>
    @font-face {
        font-family: 'Cairo';
        src: url("{{asset('fonts/Cairo.ttf')}}");
    }

    * {
        font-family: 'Cairo' !important;
    }

    table {
        font-family: 'Cairo' !important;
        color: #000 !important;
    }
</style>

<table border="1" cellpadding="5"
       style="width: 100%!important; margin: 10px auto;"
       class="text-center">
    <tbody>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                الشركة
            @else
                company
            @endif
        </td>
        <td>{{$shift->company->company_name}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                الفرع
            @else
                Branch
            @endif
        </td>
        <td>{{$shift->branch->branch_name}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                المستخدم
            @else
                User
            @endif
        </td>
        <td>{{$shift->client->name}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                رصيد افتتاحى درج الكاشير
            @else
                cashier drawer balance
            @endif
        </td>
        <td>{{$shift->cashier_drawer_balance}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                الرصيد المرحل من الوردية السابقة
            @else
                previous shift balance
            @endif
        </td>
        <td>{{$shift->previous_shift_balance}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                فرق الرصيد الافتتاحى
            @else
                difference balance
            @endif
        </td>
        <td>{{$shift->difference_balance}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                المبلغ الفعلى المدخل الموجود كاش
            @else
                actual cash
            @endif
        </td>
        <td>{{$shift->actual_cash}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                المبلغ الفعلى المدخل الموجود دفع بنكى
            @else
                actual bank
            @endif
        </td>
        <td>{{$shift->actual_bank}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                الخزنة المرحل اليها
            @else
                The Safe which the amount is converted to
            @endif
        </td>
        <td>{{$shift->safe->safe_name}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                المبلغ المرحل الى الخزنة
            @else
                The Amount is converted
            @endif
        </td>
        <td>{{$shift->transfer_safe_amount}}</td>
    </tr>

    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                المبلغ المرحل الى الوردية التالية
            @else
                The Amount which is converted to next shift
            @endif
        </td>
        <td>{{$shift->next_shift_balance}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                بداية الشيفت
            @else
                Shift Start Date Time
            @endif
        </td>
        <td>{{$shift->start_date_time}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                نهاية الشيفت
            @else
                Shift End Date Time
            @endif
        </td>
        <td>{{$shift->end_date_time}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                ملاحظات
            @else
                Notes
            @endif
        </td>
        <td>{{$shift->notes}}</td>
    </tr>
    </tbody>
</table>
<table border="1" cellpadding="5"
       style="width: 100%!important; margin: 10px auto;"
       class="text-center">
    <tbody>

    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                اجمالى الارباح
            @else
                Profits
            @endif
        </td>
        <td>{{$data['profits']}}</td>
    </tr>

    <tr class="text-center">
        <td>

            @if(App::getLocale() == 'ar')
                المبلغ الاجمالى لتقفيل اليومية
                ( حسب النظام )
            @else
                The total amount of the daily closing
                ( Depending on the system )
            @endif

        </td>
        <td>{{$shift_report->system_total}}</td>
    </tr>
    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                المبلغ الاجمالى الفعلى المدخل لتقفيل اليومية
            @else
                Actual total amount entered for daily closing
            @endif
        </td>
        <td>{{$shift_report->actual_total}}</td>
    </tr>

    <tr class="text-center">
        <td>
            @if(App::getLocale() == 'ar')
                مبلغ العجز (الفرق بين المبلغين السابقين )
            @else
                The amount of the deficit (the difference between the two previous amounts)
            @endif
        </td>
        <td>
            @if($shift_report->difference_amount == "0")
                {{$shift_report->difference_amount}}
            @elseif($shift_report->difference_amount > 0)
                {{$shift_report->difference_amount}}
                <br>

                @if(App::getLocale() == 'ar')
                    زائد
                @else
                    Plus
                @endif
            @elseif($shift_report->difference_amount < 0)
                {{abs($shift_report->difference_amount)}}
                <br>

                @if(App::getLocale() == 'ar')
                    ناقص
                @else
                    Minus
                @endif
            @endif
        </td>
    </tr>

    </tbody>
</table>

</body>
</html>
