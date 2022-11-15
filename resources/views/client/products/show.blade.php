@extends('client.layouts.app-main')
<style>
    .alert-md {
        height: 45px !important;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <h5 class="pull-right alert alert-md alert-info">
                                @if(App::getLocale() == 'ar')
                                    عرض تفاصيل المنتج
                                @else
                                    view product details
                                @endif
                            </h5>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-md" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                المخزن :
                            @else
                                store :
                            @endif
                            {{$product->store->store_name}}
                        </p>
                    </div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-md" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                الفئة الرئيسية :
                            @else
                                main category :
                            @endif
                            {{ $product->category->category_name}}
                            @if(!empty($product->sub_category_id))
                                {{ $product->subcategory->sub_category_name}}
                            @endif
                        </p>
                    </div>
                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-md" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                رقم الباركود :
                            @else
                                barcode number :
                            @endif
                            {{$product->code_universal}}
                        </p>
                    </div>

                    <div class="clearfix"></div>


                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-md" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                اسم المنتج :
                            @else
                                product name :
                            @endif
                            {{$product->product_name}}
                        </p>
                    </div>

                    <div class="col-lg-4 pull-right p-2">
                        <p class="alert alert-secondary alert-md" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                وصف المنتج :
                            @else
                                description
                            @endif
                            {{$product->description}}
                        </p>
                    </div>

                    <div class="col-lg-4 pull-right p-2">
                        <div class="alert alert-secondary alert-md" dir="rtl">
                            @if(App::getLocale() == 'ar')
                                اللون المميز :
                            @else
                                color
                            @endif
                            <div class="d-inline pull-left"
                                 style="background: {{$product->color}}; width: 100px; height: 30px;"></div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div id="result" class="col-lg-12 mt-2" dir="rtl">
                        <p id="result_text"></p>
                        <table id="myTable" style="width: 100%!important;" cellpadding="5" class="text-center">
                            <thead>
                            <th>
                                @if(App::getLocale() == 'ar')
                                    الوحدة
                                @else
                                    unit
                                @endif
                            </th>
                            <th>
                                @if(App::getLocale() == 'ar')
                                    رصيد
                                @else
                                    balance
                                @endif
                            </th>
                            <th>
                                @if(App::getLocale() == 'ar')
                                    التكلفة
                                @else
                                    cost
                                @endif
                            </th>
                            <th>
                                @if(App::getLocale() == 'ar')
                                    الجملة
                                @else
                                    wholesale
                                @endif
                            </th>
                            <th>
                                @if(App::getLocale() == 'ar')
                                    القطاعى
                                @else
                                    sector
                                @endif
                            </th>
                            <th>
                                @if(App::getLocale() == 'ar')
                                    حد أدنى
                                @else
                                    min balanace
                                @endif
                            </th>
                            <th>
                                @if(App::getLocale() == 'ar')
                                    افتراضية
                                @else
                                    default
                                @endif
                            </th>
                            <th>
                                @if(App::getLocale() == 'ar')
                                    السيريالات
                                @else
                                    serials
                                @endif
                            </th>

                            </thead>
                            <tbody id="tbody">
                            @foreach($product->units as $product_unit)
                                <tr>
                                    <td>{{$product_unit->unit->unit_name}}</td>
                                    <td>{{$product_unit->first_balance}}</td>
                                    <td>{{$product_unit->purchasing_price}}</td>
                                    <td>{{$product_unit->wholesale_price}}</td>
                                    <td>{{$product_unit->sector_price}}</td>
                                    <td>{{$product_unit->min_balance}}</td>
                                    <td>{{$product_unit->type}}</td>
                                    <td>
                                        @if(!$product_unit->serials->isEmpty())
                                            @foreach($product_unit->serials as $serial)
                                                {{$serial->serial_number}} <br>
                                            @endforeach
                                        @else
                                            @if(App::getLocale() == 'ar')
                                                لا يوجد سيريالات لهذه الوحدة
                                            @else
                                                no serials for this unit
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="clearfix"></div>

                    <div class="col-lg-12 text-center p-5">
                        <img style="width: 100%;" src="{{asset($product->product_pic)}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
