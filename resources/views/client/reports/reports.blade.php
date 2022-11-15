@extends('client.layouts.app-main')
<style>
    li.custom {
        list-style: none;
        margin-top: 20px;
        font-size: 15px;
        color: #000;
        height: 40px;
        width: 100%;
        padding: 5px;
        background: #fff;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 1px 1px 5px #aaa;
    }

    li.custom a {
        width: 80%;
        margin: 5px auto;
        color: #000;
    }

    div.box {
        height: auto;
        background: #fff;
        border: 1px solid #aaa;
        border-radius: 5px;
        box-shadow: 1px 1px 5px #aaa;
    }

    .box .box-header {
        width: 100%;
        height: 30px;
        padding: 0;
        text-align: center;
        font-size: 18px;
        border-bottom: 1px solid #aaa;
    }

    .box .box-body {
        width: 100%;
        height: auto;
        padding: 0;
        text-align: center;
        font-size: 15px;
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
                    <li class="custom">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <h4 class="alert alert-sm alert-secondary text-center">
                        @if(App::getLocale() == 'ar')
                            تقارير عامة
                        @else
                            General Reports
                        @endif
                    </h4>
                    <div class="col-lg-4 pull-right">
                        <div class="box m-1 p-1">
                            <div class="box-header">
                                @if(App::getLocale() == 'ar')
                                    تقارير المنتجات
                                @else
                                    Products Reports
                                @endif
                            </div>
                            <div class="box-body">
                                <li class="custom">
                                    <a href="{{ url('/client/report2/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            مبيعات حسب المنتج
                                        @else
                                            Sales report by product
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report4/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            مشتريات حسب المنتج
                                        @else
                                            purchases report by product
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report18/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير المنتجات الاكثر مبيعا
                                        @else
                                            best seller products report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report21/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير حركة فرع
                                        @else
                                            branch movement report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report19/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير حركة منتج
                                        @else
                                            product movement report
                                        @endif
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="box m-1 p-1">
                            <div class="box-header">
                                @if(App::getLocale() == 'ar')
                                    تقارير الديون
                                @else
                                    debts report (clients - suppliers)
                                @endif
                            </div>
                            <div class="box-body">
                                <li class="custom">
                                    <a href="{{ url('/client/report5/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            مديونية العملاء
                                        @else
                                            clients debts report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report6/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            مديونية الموردين
                                        @else
                                            supplier dues report
                                        @endif
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="box m-1 p-1">
                            <div class="box-header">
                                @if(App::getLocale() == 'ar')
                                    تقارير البنوك والخزن
                                @else
                                    banks & safes report
                                @endif
                            </div>
                            <div class="box-body">
                                <li class="custom">
                                    <a href="{{ url('/client/report15/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير حركة بنك
                                        @else
                                            bank movement report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report20/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير حركة خزنة
                                        @else
                                            safe movement report
                                        @endif
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-lg-4 pull-right">
                        <div class="box m-1 p-1">
                            <div class="box-header">
                                @if(App::getLocale() == 'ar')
                                    تقارير كشف الحساب
                                @else
                                    summary reports
                                @endif
                            </div>
                            <div class="box-body">
                                <li class="custom">
                                    <a href="{{ url('/client/clients-summary-get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            كشف حساب عميل
                                        @else
                                            client summary report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/suppliers-summary-get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            كشف حساب مورد
                                        @else
                                            supplier summary report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/employees-summary-get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            كشف حساب موظف
                                        @else
                                            employee summary report
                                        @endif
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 pull-right">
                        <div class="box m-1 p-1">
                            <div class="box-header">
                                @if(App::getLocale() == 'ar')
                                    تقارير المبيعات
                                @else
                                    sales report
                                @endif
                            </div>
                            <div class="box-body">
                                <li class="custom">
                                    <a href="{{ url('/client/report1/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            مبيعات حسب العميل
                                        @else
                                            sales report by client
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report10/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير كمية المنتجات المباعة
                                        @else
                                            Quantity report of products sold
                                        @endif
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="box m-1 p-1">
                            <div class="box-header">
                                @if(App::getLocale() == 'ar')
                                    تقارير المشتريات
                                @else
                                    purchases report
                                @endif
                            </div>
                            <div class="box-body">
                                <li class="custom">
                                    <a href="{{ url('/client/report3/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            مشتريات حسب المورد
                                        @else
                                            purchases report by supplier
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report8/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير كمية المنتجات المشتراه
                                        @else
                                            Quantity report of products purchased
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report9/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير تكلفة الشراء المنتجات
                                        @else
                                            Products purchase cost report
                                        @endif
                                    </a>

                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 pull-right">
                        <div class="box m-1 p-1">
                            <div class="box-header">
                                @if(App::getLocale() == 'ar')
                                    تقارير المالية
                                @else
                                    financial reports
                                @endif
                            </div>
                            <div class="box-body">
                                <li class="custom">
                                    <a href="{{ url('/client/report7/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير راس المال
                                        @else
                                            capital report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report11/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير ما تم تحصيله من العملاء
                                        @else
                                            Report what has been collected from customers
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report12/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير ما تم دفعه الى الموردين
                                        @else
                                            Report what has been paid to suppliers
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report13/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير الارباح
                                        @else
                                            profits report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report14/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير المصاريف
                                        @else
                                            expenses report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report17/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير المالية
                                        @else
                                            finance report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report16/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير العمل الشامل
                                        @else
                                            Comprehensive work report
                                        @endif
                                    </a>
                                </li>
                                <li class="custom">
                                    <a href="{{ url('/client/report22/get') }}"><i
                                            class="fa fa-plus text-success tx-20"></i>
                                        @if(App::getLocale() == 'ar')
                                            تقرير العجز فى نقاط البيع
                                        @else
                                            Deficit report at points of sale
                                        @endif
                                    </a>
                                </li>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>

</script>
