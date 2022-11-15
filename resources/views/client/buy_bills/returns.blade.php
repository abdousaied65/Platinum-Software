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
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <h5 class="pull-right alert alert-sm alert-success">
                                @if(App::getLocale() == 'ar')
                                    عرض كل مرتجعات فواتير المشتريات
                                @else
                                    Show All Buy Return Bills
                                @endif
                            </h5>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered text-center table-hover"
                               id="example-table">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رقم الفاتورة
                                    @else
                                        Bill Number
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        المورد
                                    @else
                                        Supplier
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        المنتج
                                    @else
                                        Product
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الكمية المرتجعة
                                    @else
                                        Return Quantity
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الوقت
                                    @else
                                        Time
                                    @endif
                                    </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        التاريخ
                                    @else
                                        Date
                                    @endif
                                    </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        سعر المنتج
                                    @else
                                        Product Price
                                    @endif
                                    </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        سعر الكمية
                                    @else
                                        Quantity Price
                                    @endif
                                    </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        مستحقات المورد قبل الارتجاع
                                    @else
                                        Supplier Dues Before Return
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        مستحقات المورد بعد الارتجاع
                                    @else
                                        Supplier Dues After Return
                                    @endif
                                    </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رصيد المنتج قبل الارتجاع
                                    @else
                                        Product Balance Before Return
                                    @endif
                                    </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رصيد المنتج بعد الارتجاع
                                    @else
                                        Product Balance After Return
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        Notes
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($buy_bill_returns as $key => $return)
                                <tr>
                                    <td>{{ $return->bill_id }}</td>
                                    <td>{{ $return->supplier->supplier_name }}</td>
                                    <td>{{ $return->product->product_name}}</td>
                                    <td>
                                        {{floatval($return->return_quantity)}}
                                    </td>
                                    <td>{{ $return->date}}</td>
                                    <td>{{ $return->time}}</td>
                                    <td>
                                        {{floatval($return->product_price)}}
                                    </td>
                                    <td>
                                        {{floatval( $return->quantity_price  )}}</td>
                                    <td>{{floatval( $return->balance_before  )}}</td>
                                    <td>{{floatval( $return->balance_after  )}}</td>
                                    <td>{{floatval( $return->before_return  )}}</td>
                                    <td>{{floatval( $return->after_return  )}}</td>
                                    <td>{{$return->notes}}</td>
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
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

    });
</script>
