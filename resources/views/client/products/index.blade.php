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
                                    عرض المنتجات
                                @else
                                    show all products
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
                                        الاسم
                                    @else
                                        name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رقم الباركود
                                    @else
                                        barcode number
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        المخزن
                                    @else
                                        store
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الفئة
                                    @else
                                        category
                                    @endif
                                </th>
                                <th class="text-center" style="width: 20% !important;">
                                    @if(App::getLocale() == 'ar')
                                        تحكم
                                    @else
                                        Control
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($products as $key => $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->code_universal }}</td>
                                    <td>{{ $product->store->store_name }}</td>
                                    <td>
                                        {{ $product->category->category_name}}
                                        @if(!empty($product->sub_category_id))
                                            {{ $product->subcategory->sub_category_name}}
                                        @endif
                                    </td>
                                    <td style="width: 20% !important;">
                                        <a href="{{ route('client.products.show', $product->id) }}"
                                           class="btn btn-sm btn-success" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('client.products.edit', $product->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger delete_product"
                                           product_id="{{ $product->id }}"
                                           product_name="{{ $product->product_name }}" data-toggle="modal"
                                           href="#modaldemo9"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pull-right p-2">
                <p class="alert alert-success alert-sm" dir="rtl">
                    @if(App::getLocale() == 'ar')
                        اجمالى اسعار المنتجات :
                    @else
                        products total prices
                    @endif
                    {{floatval( $total_purchase_prices  )}}
                </p>
            </div>
            <div class="col-lg-4 pull-right p-2">
                <p class="alert alert-info alert-sm" dir="rtl">
                    @if(App::getLocale() == 'ar')
                        اجمالى عدد القطع فى كل المخازن :
                    @else
                        pieces count total in all stores
                    @endif
                    {{floatval( $total_balances  )}}
                </p>
            </div>
            <div class="col-lg-4 pull-right p-2">
                <a href="{{route('client.products.print')}}" target="_blank" role="button" class="btn-danger btn btn-md"
                   dir="rtl">
                    <i class="fa fa-print"></i>
                    @if(App::getLocale() == 'ar')
                        طباعة كل المنتجات
                    @else
                        print all products
                    @endif
                </a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" product="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                            @if(App::getLocale() == 'ar')
                                حذف منتج
                            @else
                                delete product
                            @endif
                        </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('client.products.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>
                                @if(App::getLocale() == 'ar')
                                    هل انت متأكد من الحذف ؟
                                @else
                                    Sure To Delete ?
                                @endif
                            </p><br>
                            <input type="hidden" name="productid" id="productid">
                            <input class="form-control" name="productname" id="productname" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">
                                @if(App::getLocale() == 'ar')
                                    الغاء
                                @else
                                    Cancel
                                @endif</button>
                            <button type="submit" class="btn btn-danger">
                                @if(App::getLocale() == 'ar')
                                    حذف
                                @else
                                    Delete
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.delete_product').on('click', function () {
            var product_id = $(this).attr('product_id');
            var product_name = $(this).attr('product_name');
            $('.modal-body #productid').val(product_id);
            $('.modal-body #productname').val(product_name);
        });
    });
</script>
