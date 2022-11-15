@extends('client.layouts.app-main')
<style>
    .count {
        font-size: 16px;
        font-weight: bold;
        line-height: 1.2;
        margin-top: 20px;
    }

    .form-control {
        height: 37px !important;
        padding: 10px !important;
    }

    .count_bottom {
        margin-top: 20px;
    }

    .tile_stats_count {
        border: 1px solid #ccc;
        padding: 10px;
        margin: 10px;
    }

    div.shortcut {
        width: 100%;
        color: #40485b;
        height: auto;
        background: #fff;
        padding: 5px;
        margin-top: 5px;
        border: 1px solid #ccc;
        transition: 0.5s
    }

    a div.shortcut {
        font-size: 12px;
        color: #40485b;
    }

    a div.shortcut i {
        font-size: 40px;
        color: #40485b;
        margin-bottom: 5px
    }

    div.shortcut:hover {
        background: #40485b;
    }

    .count {
        margin-top: 20px;
    }

    a:hover div.shortcut {
        color: #fff !important;
    }

    a:hover div.shortcut i {
        color: #fff !important;
    }

    div.chart_2 div.shortcuts {
        height: auto !important;
    }

    .reports hr {
        margin: 15px
    }

    ul.list-unstyled li {
        margin-top: 25px;
        text-align: center;
        background: #eee;
        padding: 20px
    }

    ul.list-unstyled li a {
        font-size: 13px;
        padding: 5px;
        transition: 0.3s
    }

    ul.list-unstyled li a:hover {
        background: #40485b;
        color: #fff;
    }

    .first_div {
        margin-bottom: 20px;
    }

    .btn-common {
        background-color: #e91e63;
        position: relative;
        color: #fff;
        z-index: 1;
        border-radius: 4px;
        transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -webkit-transition: all .2s ease-in-out;
    }

    ul.points {
        list-style: none !important;
        color: #000 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    ul.points li {
        font-size: 14px !important;
        text-align: right !important;
    }

    ul.points li span {
        font-size: 14px !important;
        text-align: right !important;
    }

    .btn-common:hover {
        color: #fff;
    }
</style>
@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissable text-center fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger text-center">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    <?php $uncompleted = 0; ?>
    @if($company->company_name == "" || $company->company_owner == "" || $company->business_field == "" || $company->phone_number == ""
    || $company->company_logo == "" || $company->company_address == "" || $company->tax_number == "" || $company->commercial_registration_number == ""
    || $company->tax_value_added == "" || $company->taxes->isEmpty())
        <div class="row profile">
            <div class="col-lg-12">
                <div class="card mg-b-20">
                    <div class="card-body">
                        <div class="col-lg-6 pull-right text-right p-0 m-0">
                            <ul class="points">
                                <li>
                                    <a href="{{route('client.basic.settings.edit')}}">
                                        <?php
                                        if ($company->company_name == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل اسم الشركة";
                                            } else {
                                                echo "Company name registration";
                                            }
                                            echo "
                                          </span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل اسم الشركة";
                                            } else {
                                                echo "Company name registration";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.basic.settings.edit')}}">
                                        <?php
                                        if ($company->company_owner == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل اسم مدير الشركة";
                                            } else {
                                                echo "Register the name of the company manager";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل اسم مدير الشركة";
                                            } else {
                                                echo "Register the name of the company manager";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.basic.settings.edit')}}">
                                        <?php
                                        if ($company->business_field == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل مجال او نشاط الشركة";
                                            } else {
                                                echo "Registering the company's domain or activity";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل مجال او نشاط الشركة";
                                            } else {
                                                echo "Registering the company's domain or activity";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.basic.settings.edit')}}">
                                        <?php
                                        if ($company->phone_number == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل هاتف الشركة";
                                            } else {
                                                echo "Company phone registration";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل هاتف الشركة";
                                            } else {
                                                echo "Company phone registration";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.basic.settings.edit')}}">
                                        <?php
                                        if ($company->company_logo == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل شعار الشركة";
                                            } else {
                                                echo "Company logo registration";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل شعار الشركة";
                                            } else {
                                                echo "Company logo registration";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.basic.settings.edit')}}">
                                        <?php
                                        if ($company->company_address == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل عنوان الشركة";
                                            } else {
                                                echo "Company address registration";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل عنوان الشركة";
                                            } else {
                                                echo "Company address registration";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.billing.settings.edit')}}">
                                        <?php
                                        if ($company->tax_number == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل الرقم الضريبى للشركة";
                                            } else {
                                                echo "Registration of the company's tax number";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل الرقم الضريبى للشركة";
                                            } else {
                                                echo "Registration of the company's tax number";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.billing.settings.edit')}}">
                                        <?php
                                        if ($company->commercial_registration_number == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل السجل التجارى للشركة";
                                            } else {
                                                echo "Registration of the commercial register of the company";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل السجل التجارى للشركة";
                                            } else {
                                                echo "Registration of the commercial register of the company";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.billing.settings.edit')}}">
                                        <?php
                                        if ($company->tax_value_added == "") {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل ضريبة القيمة المضافة";
                                            } else {
                                                echo "VAT registration";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل ضريبة القيمة المضافة";
                                            } else {
                                                echo "VAT registration";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{route('client.billing.settings.edit')}}">
                                        <?php
                                        if ($company->taxes->isEmpty()) {
                                            $uncompleted++;
                                            echo "<span class='text-danger'>
                                              <i class='fa fa-close'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل النسب الضريبية المستخدمة فى الفواتير";
                                            } else {
                                                echo "Registering the tax rates used in invoices";
                                            }
                                            echo "</span>";
                                        } else {
                                            echo "<span class='text-success'>
                                              <i class='fa fa-check'></i>";
                                            if (App::getLocale() == 'ar') {
                                                echo "تسجيل النسب الضريبية المستخدمة فى الفواتير";
                                            } else {
                                                echo "Registering the tax rates used in invoices";
                                            }
                                            echo "</span>";
                                        }
                                        ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6 pull-left text-center justify-content-center">
                            <h3 style="font-size: 17px!important;color: #fff!important;"
                                class="alert alert-md btn-common text-center">
                                @if(App::getLocale() == 'ar')
                                    معدل اكتمال بروفايل الشركة
                                @else
                                    Company profile completion rate
                                @endif
                            </h3>
                            <?php
                            $completed = 10 - $uncompleted;
                            $percentage = ($completed / 10) * 100;
                            ?>
                            <div class="progress-pie-chart" data-percent="{{$percentage}}">
                                <div class="ppc-progress">
                                    <div class="ppc-progress-fill"></div>
                                </div>
                                <div class="ppc-percents">
                                    <div class="pcc-percents-wrapper">
                                        <span>%</span>
                                    </div>
                                </div>
                            </div>
                            @if($percentage != 100)
                                <a href="{{route('client.basic.settings.edit')}}"
                                   class="btn btn-md btn-common mt-2">
                                    <i class="fa fa-plus"></i>
                                    @if(App::getLocale() == 'ar')
                                        استكمل معلومات الشركة
                                    @else
                                        Complete the company information
                                    @endif
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row mb-1">
        <div class="col-lg-12">
            @if(empty($package) || $package->products == "1")
                @if($all_products->isEmpty())
                    @can('اضافة منتج جديد')
                        <div class="col-lg-3 pull-right">
                            <a href="{{route('client.products.create')}}"
                               class="btn btn-md btn-common btn-block">
                                <i class="fa fa-plus"></i>
                                @if(App::getLocale() == 'ar')
                                    اضافة اول منتج
                                @else
                                    Add The First Product
                                @endif
                            </a>
                        </div>
                    @endcan
                @endif
            @endif
            @if(empty($package) || $package->debt == "1")
                @if($all_outer_clients->isEmpty())
                    @can('اضافة عميل جديد')
                        <div class="col-lg-3 pull-right">
                            <a href="{{route('client.outer_clients.create')}}"
                               class="btn btn-md btn-common btn-block">
                                <i class="fa fa-plus"></i>
                                @if(App::getLocale() == 'ar')
                                    اضافة اول عميل
                                @else
                                    Add The First Client
                                @endif
                            </a>
                        </div>
                    @endcan
                @endif
            @endif
            @if(empty($package) || $package->debt == "1")
                @if($all_suppliers->isEmpty())
                    @can('اضافة مورد جديد')
                        <div class="col-lg-3 pull-right">
                            <a href="{{route('client.suppliers.create')}}"
                               class="btn btn-md btn-common btn-block">
                                <i class="fa fa-plus"></i>
                                @if(App::getLocale() == 'ar')
                                    اضافة اول مورد
                                @else
                                    Add The First Supplier
                                @endif
                            </a>
                        </div>
                    @endcan
                @endif
            @endif

        </div>
    </div>
    <div class="row mt-1 mb-2">
        @if(empty($package) || $package->debt == "1")
            @can('قائمة العملاء الحاليين')
                <div class="col-lg-3 pull-right">
                    <form class="d-inline float-left" action="{{route('client.outer_clients.filter.name')}}"
                          method="POST">
                        @csrf
                        @method('POST')
                        <input required type="text"
                               placeholder="@if(App::getLocale() == 'ar') البحث عن عميل @else Search For Client @endif"
                               style="border-radius: 0;"
                               class="d-inline float-left w-75 form-control" name="client_name"/>
                        <button class="btn btn-md btn-info d-inline float-left"
                                style="border-radius: 0; height: 37px;"
                                type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            @endcan
        @endif
        @if(empty($package) || $package->sales == "1")
            @can('فواتير البيع السابقة')
                <div class="col-lg-3 pull-right">
                    <form class="d-inline float-left w-100" action="{{route('client.sale_bills.filter.key')}}"
                          method="POST">
                        @csrf
                        @method('POST')
                        <input required type="text"
                               placeholder="@if(App::getLocale() == 'ar') البحث عن فاتورة مبيعات@else Search For Sales Invoice @endif"
                               style="border-radius: 0;"
                               class="d-inline float-left w-75 form-control" name="sale_bill_number"/>
                        <button class="btn btn-md btn-info d-inline float-left"
                                style="border-radius: 0; height: 37px;"
                                type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            @endcan
        @endif
        @if(empty($package) || $package->debt == "1")
            @can('اضافة عميل جديد')
                <div class="col-lg-3 pull-right">
                    <a style="border-radius: 0;" href="{{route('client.outer_clients.create')}}"
                       class="btn btn-md btn-block btn-success float-left d-inline">
                        <i class="fa fa-plus"></i>
                        @if(App::getLocale() == 'ar')
                            اضافة عميل جديد
                        @else
                            Add New Client
                        @endif
                    </a>
                </div>
            @endcan
        @endif
        @if(empty($package) || $package->sales == "1")
            @can('اضافة فاتورة بيع جديدة')
                <div class="col-lg-3 pull-right">
                    <a style="border-radius: 0;" href="{{route('client.sale_bills.create')}}"
                       class="btn btn-md btn-block btn-success float-left d-inline">
                        <i class="fa fa-plus"></i>
                        @if(App::getLocale() == 'ar')
                            انشاء فاتورة مبيعات
                        @else
                            Add New Sales Invoice
                        @endif
                    </a>
                </div>
            @endcan
        @endif

    </div>
    <div class="row tile_count text-center">
        @if(empty($package) || $package->debt == "1")
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="tile_stats_count">
                    <span class="count_top" style="font-size:16px;background: darkred; color:#fff; padding: 10px;">
                    <i class="fa fa-2x fa-money"></i>
                        @if(App::getLocale() == 'ar')
                            اجمالى مديونيات العملاء
                        @else
                            customers total debts
                        @endif

                </span>
                    <div class="count">
                        @if (in_array("مدير النظام",Auth::user()->role_name))
                            <small style="font-size: 13px;">
                                @if(App::getLocale() == 'ar')
                                    دائن
                                @else
                                    Creditor
                                @endif
                            </small>
                            {{floatval($total_clients_balances_plus)}} <br>
                            <small style="font-size: 13px;">
                                @if(App::getLocale() == 'ar')
                                    مدين
                                @else
                                    Debtor
                                @endif
                            </small>
                            {{floatval($total_clients_balances_minus)}}
                        @else
                            ***********
                        @endcan
                    </div>
                    <span class="count_bottom" style="font-size:16px"> {{__('main.'.$currency)}} </span>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="tile_stats_count">
                    <span class="count_top" style="font-size:16px;background: darkgreen; color:#fff; padding: 10px;">
                        <i class="fa fa-2x fa-money"></i>
                        @if(App::getLocale() == 'ar')
                            اجمالى مستحقات الموردين
                        @else
                            Total dues to suppliers
                        @endif
                    </span>
                    <div class="count">
                        @if (in_array("مدير النظام",Auth::user()->role_name))
                            <small style="font-size: 13px;">
                                @if(App::getLocale() == 'ar')
                                    دائن
                                @else
                                    Creditor
                                @endif
                            </small>
                            {{floatval($total_suppliers_balances_minus)}}
                            <br>
                            <small style="font-size: 13px;">
                                @if(App::getLocale() == 'ar')
                                    مدين
                                @else
                                    Debtor
                                @endif
                            </small>
                            {{floatval($total_suppliers_balances_plus)}}
                        @else
                            ***********
                        @endif
                    </div>
                    <span class="count_bottom" style="font-size:16px">
                        {{__('main.'.$currency)}}
                    </span>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="tile_stats_count">
                    <span class="count_top" style="font-size:16px;background: #40485b; color:#fff; padding: 10px;">
                        <i class="fa fa-2x fa-money"></i>
                        @if(App::getLocale() == 'ar')
                            صافى الرصيد الخارجى
                        @else
                            net external balance
                        @endif
                    </span>
                    <div class="count">
                        @if (in_array("مدير النظام",Auth::user()->role_name))
                            <?php
                            $total_plus = $total_clients_balances_plus + $total_suppliers_balances_minus;
                            $total_minus = $total_clients_balances_minus + $total_suppliers_balances_plus;
                            ?>
                            <small style="font-size: 13px;">
                                @if(App::getLocale() == 'ar')
                                    دائن
                                @else
                                    Creditor
                                @endif
                            </small>
                            {{floatval($total_plus)}} <br>
                            <small style="font-size: 13px;">
                                @if(App::getLocale() == 'ar')
                                    مدين
                                @else
                                    Debtor
                                @endif
                            </small>
                            {{floatval($total_minus)}}
                        @else
                            ***********
                        @endif
                    </div>
                    <span class="count_bottom" style="font-size:16px">
                        {{__('main.'.$currency)}}
                    </span>
                </div>
            </div>
        @endif
    </div>
    <hr>
    <div class="clearfix"></div>

    <div class="row tile_count text-center">
        @if(empty($package) || $package->banks_safes == "1")
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="tile_stats_count">
                    <span class="count_top" style="font-size:16px;background: darkorange; color:#fff; padding: 10px;">
                    <i class="fa fa-2x fa-money"></i>
                        @if(App::getLocale() == 'ar')
                            اجمالى ارصدة الخزن
                        @else
                            Total Safes Balances
                        @endif
                </span>
                    <div class="count">
                        @if (in_array("مدير النظام",Auth::user()->role_name))
                            {{floatval($safes_balances)}}
                        @else
                            ***********
                        @endif
                    </div>
                    <span class="count_bottom" style="font-size:16px"> {{__('main.'.$currency)}} </span>
                </div>
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="tile_stats_count">
                    <span class="count_top" style="font-size:16px;background: darkcyan; color:#fff; padding: 10px;">
                        <i class="fa fa-2x fa-money"></i>
                        @if(App::getLocale() == 'ar')
                            اجمالى ارصدة البنوك
                        @else
                            Total Banks Balances
                        @endif
                    </span>
                    <div class="count">
                        @if (in_array("مدير النظام",Auth::user()->role_name))
                            {{floatval($banks_balances)}}
                        @else
                            ***********
                        @endif
                    </div>
                    <span class="count_bottom" style="font-size:16px">
                        {{__('main.'.$currency)}}
                    </span>
                </div>
            </div>
        @endif
        @if(empty($package) || $package->products == "1")
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="tile_stats_count">
                    <span class="count_top" style="font-size:12px;background: darkmagenta; color:#fff; padding: 10px;">
                        <i class="fa fa-2x fa-money"></i>
                        @if(App::getLocale() == 'ar')
                            اجمالي قيمة البضاعة التى في المخازن
                        @else
                            Total value of products in Stores
                        @endif
                    </span>
                    <div class="count">
                        @if (in_array("مدير النظام",Auth::user()->role_name))
                            {{floatval($total_purchase_prices)}}
                        @else
                            ***********
                        @endif
                    </div>
                    <span class="count_bottom" style="font-size:16px">
                        {{__('main.'.$currency)}}
                    </span>
                </div>
            </div>
        @endif
    </div>
    <hr>
    <div class="clearfix"></div>
    <div class="row first_div">
        <div class="col-md-12 col-sm-12 ">
            <div class="chart_2" style="padding: 0 !important;">
                <div class="shortcuts">
                    <div class="col-lg-12 col-xs-12 pull-right" style="padding: 0;">
                        <div class="alert alert-sm alert-success text-center mt-2 mb-2"
                             style="border-radius: 0; background: darkcyan !important; border-color: darkcyan !important;">
                            <h3 style="color: #fff !important;">
                                <i class="fa fa-plane"></i>
                                @if(App::getLocale() == 'ar')
                                    اختصارات هامة
                                @else
                                    Important Shortcuts
                                @endif
                            </h3>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-4 pull-right">
                            <p class="alert alert-secondary alert-sm text-center">
                                <i class="fa fa-plus"></i>
                                @if(App::getLocale() == 'ar')
                                    اضافة
                                @else
                                    Add
                                @endif
                            </p>
                            @if(empty($package) || $package->products == "1")
                                @can('اضافة فئة جديد')
                                    <a href="{{route('client.categories.create')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-plus"></i>
                                            <br/>
                                            @if(App::getLocale() == 'ar')
                                                اضافة فئة
                                            @else
                                                Add New Main Category
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                                @can('اضافة منتج جديد')
                                    <a href="{{route('client.products.create')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-plus"></i>
                                            <br/>
                                            @if(App::getLocale() == 'ar')
                                                اضافة منتج جديد
                                            @else
                                                Add New Product
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                            @endif
                            @if(empty($package) || $package->debt == "1")
                                @can('اضافة عميل جديد')
                                    <a href="{{route('client.outer_clients.create')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-plus"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                اضافة عميل
                                            @else
                                                Add New Client
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                                @can('اضافة مورد جديد')
                                    <a href="{{route('client.suppliers.create')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-plus"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                اضافة مورد
                                            @else
                                                Add New Supplier
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                            @endif
                            @if(empty($package) || $package->settings == "1")
                                @can('صلاحيات المستخدمين')
                                    <a href="{{route('client.employees.create')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-plus"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                اضافة موظف
                                            @else
                                                Add New Employee
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                            @endif
                        </div>
                        <div class="col-lg-4 pull-right">
                            <p class="alert alert-secondary alert-sm text-center">
                                <i class="fa fa-money"></i>
                                @if(App::getLocale() == 'ar')
                                    دفع نقدى
                                @else
                                    Add Cash Payment
                                @endif
                            </p>
                            @if(empty($package) || $package->finance == "1")
                                @can('دفع نقدى الى مورد')
                                    <a href="{{route('client.add.cash.suppliers')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-money"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                دفع نقدى لمورد
                                            @else
                                                Give Cash Payment to Supplier
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                                @can('استلام نقدية من عميل')
                                    <a href="{{route('client.give.cash.clients')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-money"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                دفع نقدية لعميل
                                            @else
                                                Give Cash Payment From Client
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                            @endif
                            @if(empty($package) || $package->settings == "1")
                                @can('صلاحيات المستخدمين')
                                    <a href="{{route('employees.get.cash')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-money"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                دفع نقدية لموظف
                                            @else
                                                Give Cash Payment To Employee
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                            @endif

                        </div>

                        <div class="col-lg-4 pull-right">
                            <p class="alert alert-secondary alert-sm text-center">
                                <i class="fa fa-pencil"></i>
                                @if(App::getLocale() == 'ar')
                                    تسجيل
                                @else
                                    Registering
                                @endif
                            </p>
                            @if(empty($package) || $package->finance == "1")

                                @can('استلام نقدية من عميل')
                                    <a href="{{route('client.add.cash.clients')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-pencil"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                تسجيل دفعة من عميل
                                            @else
                                                Take Cash From Client
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                                @can('دفع نقدى الى مورد')
                                    <a href="{{route('client.give.cash.suppliers')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-pencil"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                تسجيل دفعة من مورد
                                            @else
                                                Give Cash To Supplier
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                                @can('تسجيل مصاريف جديدة')
                                    <a href="{{route('client.expenses.create')}}">
                                        <div class="shortcut text-center pull-right"><i
                                                class="fa fa-2x fa-pencil"></i>
                                            <br>
                                            @if(App::getLocale() == 'ar')
                                                تسجيل مصروف
                                            @else
                                                Add New Expense
                                            @endif
                                        </div>
                                    </a>
                                @endcan
                            @endif
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
