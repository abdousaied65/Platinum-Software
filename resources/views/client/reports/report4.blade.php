@extends('client.layouts.app-main')
<style>
    .btn.dropdown-toggle.bs-placeholder {
        height: 40px;
    }

    .bootstrap-select {
        width: 100% !important;
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
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="company_details printy" style="display: none;">
                        <div class="text-center">
                            <img class="logo" style="width: 20%;" src="{{asset($company->company_logo)}}" alt="">
                        </div>
                        <div class="text-center">
                            <div class="col-lg-12 text-center justify-content-center">
                                <p class="alert alert-secondary text-center alert-sm"
                                   style="margin: 10px auto; font-size: 17px;line-height: 1.9;" dir="rtl">
                                    {{$company->company_name}} -- {{$company->business_field}} <br>
                                    {{$company->company_owner}} -- {{$company->phone_number}} <br>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 no-print">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-danger">
                            @if(App::getLocale() == 'ar')
                                تقرير مشتريات حسب المنتج
                            @else
                                purchases report by product
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report4.post')}}" class="no-print" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-4 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    اسم المنتج
                                @else
                                    product name
                                @endif
                            </label>
                            <select required name="product_id" id="product_id" class="selectpicker"
                                    data-style="btn-info" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                @endif
                            >
                                <option
                                    @if(isset($product_id) && $product_id == "all")
                                    selected
                                    @endif
                                    value="all">
                                    @if(App::getLocale() == 'ar')
                                        كل المنتجات
                                    @else
                                        all products
                                    @endif
                                </option>
                                @foreach($products as $product)
                                    <option
                                        @if(isset($product_id) && $product->id == $product_id)
                                        selected
                                        @endif
                                        value="{{$product->id}}">{{$product->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <button class="btn btn-md btn-danger"
                                    style="font-size: 15px; height: 40px; margin-top: 25px;" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    عرض التقرير
                                @else
                                    show report
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    @if(isset($buyBills) && !empty($buyBills))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير مشتريات حسب المنتج
                            @else
                                purchases report by product
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class='table table-condensed table-striped table-bordered'>
                                <thead class="text-center">
                                <th>#</th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        رقم الفاتورة
                                    @else
                                        Bill Number
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        اسم المورد
                                    @else
                                        Supplier Name
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        تاريخ الفاتورة
                                    @else
                                        Bill Date
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        وقت الفاتورة
                                    @else
                                        Bill Time
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        الاجمالى النهائى
                                    @else
                                        Final Total
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        عدد العناصر
                                    @else
                                        items count
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        عرض
                                    @else
                                        show
                                    @endif
                                </th>
                                </thead>
                                <tbody>
                                <?php $i = 0; $total = 0; ?>
                                @foreach($buyBills as $buy_bill)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$buy_bill->buy_bill_number}}</td>
                                        <td>{{$buy_bill->supplier->supplier_name}}</td>
                                        <td>{{$buy_bill->date}}</td>
                                        <td>{{$buy_bill->time}}</td>
                                        <td>
                                            <?php $sum = 0; ?>
                                            @foreach($buy_bill->elements as $element)
                                                <?php $sum = $sum + $element->quantity_price; ?>
                                            @endforeach
                                            <?php
                                            $extras = $buy_bill->extras;
                                            foreach ($extras as $key) {
                                                if ($key->action == "discount") {
                                                    if ($key->action_type == "pound") {
                                                        $buy_bill_discount_value = $key->value;
                                                        $buy_bill_discount_type = "pound";
                                                    } else {
                                                        $buy_bill_discount_value = $key->value;
                                                        $buy_bill_discount_type = "percent";
                                                    }
                                                } else {
                                                    if ($key->action_type == "pound") {
                                                        $buy_bill_extra_value = $key->value;
                                                        $buy_bill_extra_type = "pound";
                                                    } else {
                                                        $buy_bill_extra_value = $key->value;
                                                        $buy_bill_extra_type = "percent";
                                                    }
                                                }
                                            }
                                            if ($extras->isEmpty()) {
                                                $buy_bill_discount_value = 0;
                                                $buy_bill_extra_value = 0;
                                                $buy_bill_discount_type = "pound";
                                                $buy_bill_extra_type = "pound";
                                            }
                                            if ($buy_bill_extra_type == "percent") {
                                                $buy_bill_extra_value = $buy_bill_extra_value / 100 * $sum;
                                            }
                                            $after_discount = $sum + $buy_bill_extra_value;

                                            if ($buy_bill_discount_type == "percent") {
                                                $buy_bill_discount_value = $buy_bill_discount_value / 100 * $sum;
                                            }
                                            $after_discount = $sum - $buy_bill_discount_value;
                                            $after_discount = $sum - $buy_bill_discount_value + $buy_bill_extra_value;
                                            $tax_value_added = $company->tax_value_added;
                                            $percentage = ($tax_value_added / 100) * $after_discount;
                                            $after_total = $after_discount + $percentage;
                                            echo floatval($after_total) . " " . trans('main.' . $currency);
                                            ?>
                                            <?php $total = $total + $after_total; ?>
                                        </td>
                                        <td>{{$buy_bill->elements->count()}}</td>
                                        <td class="no-print">
                                            <form target="_blank" action="{{route('client.buy_bills.filter.key')}}"
                                                  method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="buy_bill_id" value="{{$buy_bill->id}}">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fa fa-eye"></i>
                                                    @if(App::getLocale() == 'ar')
                                                        عرض
                                                    @else
                                                        show
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                                <span class=" col-lg-4 col-sm-12 alert alert-secondary alert-sm mr-5">
                                    @if(App::getLocale() == 'ar')
                                        عدد الفواتير
                                    @else
                                        total bills count
                                    @endif
                                    ( {{$i}} )
                                </span>
                            <span class=" col-lg-4 col-sm-12 alert alert-secondary alert-sm">
                                @if(App::getLocale() == 'ar')
                                    اجمالى اسعار كل الفواتير
                                @else
                                    all bills total price
                                @endif
                                    ({{floatval($total)}}) {{__('main.'.$currency)}}
                                </span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="mt-3 no-print">
                            <button type="button" onclick="window.print()" class="btn btn-md btn-info pull-right">
                                <i class="fa fa-print"></i>
                                @if(App::getLocale() == 'ar')
                                    طباعة التقرير
                                @else
                                    print report
                                @endif
                            </button>
                        </div>
                    @elseif(isset($buyBills) && empty($buyBills))
                        <div class="alert alert-sm alert-danger text-center mt-3">
                            <i class="fa fa-close"></i>
                            @if(App::getLocale() == 'ar')
                                لا توجد اى فواتير لهذا المنتج
                            @else
                                no bills for this product
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>

</script>
