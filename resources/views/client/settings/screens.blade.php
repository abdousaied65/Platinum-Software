@extends('client.layouts.app-main')
<style>
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <p class="alert alert-info alert-sm text-center">
                @if(App::getLocale() == 'ar')
                    اعدادات ظهور الشاشات
                @else
                    Screens Display Settings
                @endif
            </p>
        </div>
    </div>
    <div class="row mt-2 mb-2">
        <div class="col-lg-12 text-center">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered text-center table-hover"
                               id="example-table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        اسم الفرع
                                    @else
                                        Branch Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الشاشات
                                    @else
                                        Screens
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        تعديل
                                    @else
                                        Edit
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($screens as $screen)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $screen->branch->branch_name }}</td>
                                    <td>
                                        @if($screen->products == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة المنتجات
                                            @else
                                                Products
                                            @endif
                                            <br/>
                                        @endif
                                        @if($screen->debt == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة الديون
                                            @else
                                                Debts (Clients - Suppliers)
                                            @endif
                                            <br/>
                                        @endif

                                        @if($screen->banks_safes == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة البنوك والخزن
                                            @else
                                                Banks - Safes
                                            @endif
                                            <br/>
                                        @endif
                                        @if($screen->sales == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة المبيعات
                                            @else
                                                Sales
                                            @endif
                                            <br/>
                                        @endif
                                        @if($screen->purchases == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة المشتريات
                                            @else
                                                Purchases
                                            @endif
                                            <br/>
                                        @endif
                                        @if($screen->finance == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة الماليات
                                            @else
                                                Finance
                                            @endif
                                            <br/>
                                        @endif
                                        @if($screen->marketing == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة التسويق
                                            @else
                                                Marketing
                                            @endif
                                            <br/>
                                        @endif
                                        @if($screen->accounting == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة دفتر اليومية
                                            @else
                                                Daily Journal Report
                                            @endif
                                            <br/>
                                        @endif
                                        @if($screen->reports == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة التقارير
                                            @else
                                                Reports
                                            @endif
                                            <br/>
                                        @endif
                                        @if($screen->settings == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة الضبط والاعدادات
                                            @else
                                                Settings
                                            @endif
                                            <br/>
                                        @endif

                                        @if($screen->maintenance == "1")
                                            <i class="fa fa-check"></i>
                                            @if(App::getLocale() == 'ar')
                                                شاشة الصيانة
                                            @else
                                                Maintenance
                                            @endif
                                            <br/>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('screens.settings.edit', $screen->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
