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
                                تقرير المنتجات الاكثر مبيعا
                            @else
                                best seller products report
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report18.post')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-3 pull-right">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    عدد المنتجات
                                @else
                                    number of products
                                @endif
                            </label>
                            <input type="text" @if(isset($count) && !empty($count)) value="{{$count}}"
                                   @endif class="form-control" name="count" required/>
                        </div>
                        <div class="col-lg-6 pull-right">
                            <button name="submit" value="best_sales" class="btn btn-md btn-danger"
                                    style="font-size: 15px; height: 40px; margin-top: 25px;" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    الاكثر مبيعا
                                @else
                                    best seller
                                @endif
                            </button>
                            <button name="submit" value="best_profits" class="btn btn-md btn-dark"
                                    style="font-size: 15px; height: 40px; margin-top: 25px; margin-right: 20px;"
                                    type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    الاكثر ربحا
                                @else
                                    best profit
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    @if(isset($submit) && !empty($submit) && $submit == "best_sales")
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير المنتجات الاكثر مبيعا
                            @else
                                best seller products report
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            كود المنتج
                                        @else
                                            barcode
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم المنتج
                                        @else
                                            product name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            مجموع المبيعات
                                        @else
                                            sales total
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $products_count = count($products_arr); // 3
                                if ($products_count >= $count) {
                                    $j = 1;
                                    for ($i = 0; $i < $count; $i++) {
                                        $product = \App\Models\Product::FindOrFail($final_sales[$i]['product_id']);
                                        $product_name = $product->product_name;
                                        $product_code = $product->code_universal;
                                        $product_count = $final_sales[$i]['count'];
                                        echo "<tr>";
                                        echo "<td>" . $j . "</td>";
                                        echo "<td>" . $product_code . "</td>";
                                        echo "<td>" . $product_name . "</td>";
                                        echo "<td>" . $product_count . "</td>";
                                        echo "</tr>";
                                        $j++;
                                    }
                                } else {
                                    $j = 1;
                                    for ($i = 0; $i < count($final_sales); $i++) {
                                        $product = \App\Models\Product::FindOrFail($final_sales[$i]['product_id']);
                                        $product_name = $product->product_name;
                                        $product_code = $product->code_universal;
                                        $product_count = $final_sales[$i]['count'];
                                        echo "<tr>";
                                        echo "<td>" . $j . "</td>";
                                        echo "<td>" . $product_code . "</td>";
                                        echo "<td>" . $product_name . "</td>";
                                        echo "<td>" . $product_count . "</td>";
                                        echo "</tr>";
                                        $j++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    @if(isset($submit) && !empty($submit) && $submit == "best_profits")
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير المنتجات الاكثر ربحا
                            @else
                                best profit products report
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            كود المنتج
                                        @else
                                            barcode
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم المنتج
                                        @else
                                            product name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            مجموع الربح
                                        @else
                                            total profits
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $products_count = count($products_arr); // 3
                                if ($products_count >= $count) {
                                    $j = 1;
                                    for ($i = 0; $i < $count; $i++) {
                                        $product = \App\Models\Product::FindOrFail($final_profits[$i]['product_id']);
                                        $product_name = $product->product_name;
                                        $product_code = $product->code_universal;
                                        $product_profit = $final_profits[$i]['profit'];
                                        echo "<tr>";
                                        echo "<td>" . $j . "</td>";
                                        echo "<td>" . $product_code . "</td>";
                                        echo "<td>" . $product_name . "</td>";
                                        echo "<td>" . $product_profit . "</td>";
                                        echo "</tr>";
                                        $j++;
                                    }
                                } else {
                                    $j = 1;
                                    for ($i = 0; $i < count($final_profits); $i++) {
                                        $product = \App\Models\Product::FindOrFail($final_profits[$i]['product_id']);
                                        $product_name = $product->product_name;
                                        $product_code = $product->code_universal;
                                        $product_profit = $final_profits[$i]['profit'];
                                        echo "<tr>";
                                        echo "<td>" . $j . "</td>";
                                        echo "<td>" . $product_code . "</td>";
                                        echo "<td>" . $product_name . "</td>";
                                        echo "<td>" . $product_profit . "</td>";
                                        echo "</tr>";
                                        $j++;
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>
