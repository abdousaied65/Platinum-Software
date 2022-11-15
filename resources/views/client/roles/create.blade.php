@extends('client.layouts.app-main')
<style>

</style>
@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Errors :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-left alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اضافة صلاحية جديدة
                            @else
                                Add New Role
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    {!! Form::open(array('route' => 'client.roles.store','method'=>'POST')) !!}
                    <div class="main-content-label mg-b-5">
                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <p>
                                        @if(App::getLocale() == 'ar')
                                            اسم الصلاحية :
                                        @else
                                            Role Name
                                        @endif
                                    </p>
                                    {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row m-3 p-3">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                             aria-orientation="vertical">
                            <a class="nav-link active" id="v-pills-branch-tab" data-toggle="pill" href="#v-pills-branch"
                               role="tab" aria-controls="v-pills-branch" aria-selected="true">
                                @if(App::getLocale() == 'ar')
                                    الفروع والمخازن والخزائن
                                @else
                                    Branches - Stores - Safes
                                @endif
                            </a>
                            <a class="nav-link" id="v-pills-products-tab" data-toggle="pill" href="#v-pills-products"
                               role="tab" aria-controls="v-pills-products" aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    الفئات والمنتجات
                                @else
                                    Categories - Products
                                @endif
                            </a>
                            <a class="nav-link" id="v-pills-suppliers-tab" data-toggle="pill"
                               href="#v-pills-suppliers" role="tab" aria-controls="v-pills-suppliers"
                               aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    العملاء والموردين
                                @else
                                    Clients - Suppliers
                                @endif
                            </a>
                            <a class="nav-link" id="v-pills-banks-tab" data-toggle="pill"
                               href="#v-pills-banks" role="tab" aria-controls="v-pills-banks"
                               aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    البنوك والمصاريف
                                @else
                                    Banks - Expenses
                                @endif
                            </a>
                            <a class="nav-link" id="v-pills-cashs-tab" data-toggle="pill"
                               href="#v-pills-cashs" role="tab" aria-controls="v-pills-cashs"
                               aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    الماليات والصيانة
                                @else
                                    Finance - Maintenance
                                @endif
                            </a>
                            <a class="nav-link" id="v-pills-gifts-tab" data-toggle="pill"
                               href="#v-pills-gifts" role="tab" aria-controls="v-pills-gifts"
                               aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    الهدايا والايميلات
                                @else
                                    Gifts - Emails
                                @endif
                            </a>

                            <a class="nav-link" id="v-pills-quotations-tab" data-toggle="pill"
                               href="#v-pills-quotations" role="tab" aria-controls="v-pills-quotations"
                               aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    عروض الاسعار وفواتير البيع عملاء
                                @else
                                    Quotations - Sale Bills
                                @endif
                            </a>

                            <a class="nav-link" id="v-pills-fast-tab" data-toggle="pill"
                               href="#v-pills-fast" role="tab" aria-controls="v-pills-fast"
                               aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    فواتير المشتريات
                                @else
                                    Buy bills
                                @endif
                            </a>

                            <a class="nav-link" id="v-pills-daily-tab" data-toggle="pill"
                               href="#v-pills-daily" role="tab" aria-controls="v-pills-daily"
                               aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    كشف الحساب ودفتر اليومية
                                @else
                                    Summary - Daily Journal Report
                                @endif
                            </a>

                            <a class="nav-link" id="v-pills-reports-tab" data-toggle="pill"
                               href="#v-pills-reports" role="tab" aria-controls="v-pills-reports"
                               aria-selected="false">
                                @if(App::getLocale() == 'ar')
                                    التقارير والصلاحيات والاعدادات
                                @else
                                    Reports - Roles - Settings
                                @endif
                            </a>
                        </div>
                        <div class="tab-content p-5" id="v-pills-tabContent" style="border-right: 1px solid #ddd;">
                            <div class="tab-pane fade show active" id="v-pills-branch" role="tabpanel"
                                 aria-labelledby="v-pills-branch-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "branch" || $value->key == "store" || $value->key == "safe")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="v-pills-products" role="tabpanel"
                                 aria-labelledby="v-pills-products-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "category" || $value->key == "product")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="v-pills-suppliers" role="tabpanel"
                                 aria-labelledby="v-pills-suppliers-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "outer_client" || $value->key == "supplier")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="v-pills-banks" role="tabpanel"
                                 aria-labelledby="v-pills-banks-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "bank" || $value->key == "expense")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="v-pills-cashs" role="tabpanel"
                                 aria-labelledby="v-pills-cashs-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "cash" || $value->key == "capital" || $value->key == "payments" || $value->key == "maintenance")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="v-pills-gifts" role="tabpanel"
                                 aria-labelledby="v-pills-gifts-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "gifts" || $value->key == "email")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="v-pills-quotations" role="tabpanel"
                                 aria-labelledby="v-pills-quotations-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "quotation" || $value->key == "sale_bill")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>


                            <div class="tab-pane fade" id="v-pills-fast" role="tabpanel"
                                 aria-labelledby="v-pills-fast-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "buy_bill" )
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>


                            <div class="tab-pane fade" id="v-pills-daily" role="tabpanel"
                                 aria-labelledby="v-pills-daily-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "summary" || $value->key == "daily")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>

                            <div class="tab-pane fade" id="v-pills-reports" role="tabpanel"
                                 aria-labelledby="v-pills-reports-tab">
                                @foreach($permission as $value)
                                    @if($value->key == "reports" || $value->key == "privilege" || $value->key == "settings")
                                        <label style="font-size: 16px;">
                                            {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                            @if(App::getLocale() == 'ar')
                                                {{$value->name}}
                                            @else
                                                {{$value->name_en}}
                                            @endif
                                        </label>
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button type="button" id="check_all" class="btn btn-danger"> تحديد الكل</button>
                            <button type="submit" class="btn btn-info">تأكيد</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- main-content closed -->
    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#check_all').click(function () {
            $('input[type=checkbox]').prop('checked', true);
        });
    </script>
@endsection
