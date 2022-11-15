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
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-danger">
                            @if(App::getLocale() == 'ar')
                                تقرير كمية المنتجات المشتراه
                            @else
                                Quantity report of products purchased
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report8.post')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-3 pull-right no-print">
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
                        <div class="col-lg-3 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    من تاريخ
                                @else
                                    from date
                                @endif
                            </label>
                            <input type="date" @if(isset($from_date) && !empty($from_date)) value="{{$from_date}}"
                                   @endif class="form-control" name="from_date"/>
                        </div>
                        <div class="col-lg-3 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    الى تاريخ
                                @else
                                    to date
                                @endif
                            </label>
                            <input type="date" @if(isset($to_date) && !empty($to_date)) value="{{$to_date}}"
                                   @endif  class="form-control" name="to_date"/>
                        </div>
                        <div class="col-lg-3 pull-right">
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
                    @if(isset($buyBills))
                        @if(!empty($buyBills))
                            <div class="alert alert-sm alert-success text-center mt-1 mb-2">
                                @if(App::getLocale() == 'ar')
                                    تقرير كمية المنتجات المشتراه
                                @else
                                    Quantity report of products purchased
                                @endif
                            </div>
                            <table class='table table-condensed table-striped table-bordered'>
                                <thead class="text-center">
                                <th>#</th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        رقم الفاتورة
                                    @else
                                        bill number
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        اسم المورد
                                    @else
                                        supplier name
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        تاريخ الفاتورة
                                    @else
                                        bill date
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        وقت الفاتورة
                                    @else
                                        bill time
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        كمية المنتجات المشتراه
                                    @else
                                        Products Quantity purchased
                                    @endif
                                </th>
                                <th>
                                    @if(App::getLocale() == 'ar')
                                        عرض
                                    @else
                                        Show
                                    @endif
                                </th>
                                </thead>
                                <tbody>
                                <?php $i = 0; $total = 0;$total_pieces = 0; ?>
                                @foreach($buyBills as $buy_bill)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$buy_bill->buy_bill_number}}</td>
                                        <td>{{$buy_bill->supplier->supplier_name}}</td>
                                        <td>{{$buy_bill->date}}</td>
                                        <td>{{$buy_bill->time}}</td>
                                        <td>
                                            <?php
                                            $pieces = 0;
                                            if (isset($product_id) && $product_id == "all") {
                                                foreach ($buy_bill->elements as $element) {
                                                    $pieces = $pieces + $element->quantity;
                                                }
                                            } else {
                                                foreach ($buy_bill->elements as $element) {
                                                    if ($element->product_id == $product_id) {
                                                        $pieces = $pieces + $element->quantity;
                                                    }
                                                }
                                            }
                                            echo floatval($pieces);
                                            $total_pieces = $total_pieces + $pieces;
                                            ?>
                                        </td>
                                        <td>
                                            <form action="{{route('client.buy_bills.filter.key')}}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="buy_bill_id" value="{{$buy_bill->id}}">
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fa fa-eye"></i>
                                                    @if(App::getLocale() == 'ar')
                                                        عرض
                                                    @else
                                                        Show
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row mt-3">
                                <span class=" col-lg-4 col-sm-12 alert alert-secondary alert-sm mr-5">
                                    @if(App::getLocale() == 'ar')
                                        اجمالى كمية المنتجات المشتراه
                                    @else
                                        Products Quantity purchased
                                    @endif
                                    ( {{floatval( $total_pieces  )}} )
                                </span>
                            </div>
                        @else
                            <div class="alert alert-sm alert-danger text-center mt-3">
                                <i class="fa fa-close"></i>
                                @if(App::getLocale() == 'ar')
                                    لا توجد اى فواتير لهذا المنتج
                                @else
                                    no bills for this product
                                @endif
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>

</script>
