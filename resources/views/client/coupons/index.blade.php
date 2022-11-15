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
                                    عرض كل كوبونات الخصم
                                @else
                                    Show All coupon codes
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
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        كود الكوبون
                                    @else
                                        Coupon Code
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        قيمة الخصم
                                    @else
                                        Discount Value
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        القسم المخصص له
                                    @else
                                        is specialised for
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        تاريخ انتهاء الصلاحية
                                    @else
                                        Expiration Date
                                    @endif
                                </th>
                                <th class="text-center"> الحالة</th>
                                <th class="text-center">@if(App::getLocale() == 'ar')
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
                            @foreach ($coupons as $key => $coupon)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $coupon->coupon_code}}</td>
                                    <td>{{ $coupon->coupon_value}}</td>
                                    <td>
                                        @if(!empty($coupon->outer_client_id))
                                            @if(App::getLocale() == 'ar')
                                                العملاء
                                            @else
                                                Clients
                                            @endif

                                            ( {{ $coupon->outerClient->client_name }} )
                                        @endif

                                        @if(!empty($coupon->category_id))
                                            @if(App::getLocale() == 'ar')
                                                الفئات
                                            @else
                                                Categories
                                            @endif

                                            ( {{ $coupon->category->category_name }} )
                                        @endif

                                        @if(!empty($coupon->product_id))
                                            @if(App::getLocale() == 'ar')
                                                المنتجات
                                            @else
                                                Products
                                            @endif

                                            ( {{ $coupon->product->product_name }} )
                                        @endif
                                    </td>
                                    <td>{{ $coupon->coupon_expired}}</td>
                                    <td>
                                        @if($coupon->status == "new")
                                            <span class="badge badge-success">
                                                @if(App::getLocale() == 'ar')
                                                    جديد
                                                @else
                                                    New
                                                @endif
                                            </span>
                                        @elseif($coupon->status == "user")
                                            <span class="badge badge-danger">
                                                @if(App::getLocale() == 'ar')
                                                    مستخدم
                                                @else
                                                    Used
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('client.coupons.edit', $coupon->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger delete_coupon"
                                           coupon_id="{{ $coupon->id }}"
                                           coupon_name="{{ $coupon->coupon_code }}" data-toggle="modal"
                                           href="#modaldemo9"
                                        ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" coupon="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                            @if(App::getLocale() == 'ar')
                                حذف كوبون خصم
                            @else
                                Delete Coupon Code
                            @endif
                            </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('client.coupons.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>@if(App::getLocale() == 'ar')
                                    هل انت متأكد من الحذف ؟
                                @else
                                    Sure To Delete ?
                                @endif</p><br>
                            <input type="hidden" name="couponid" id="couponid">
                            <input class="form-control" name="couponname" id="couponname" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">@if(App::getLocale() == 'ar')
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
        $('.delete_coupon').on('click', function () {
            var coupon_id = $(this).attr('coupon_id');
            var coupon_name = $(this).attr('coupon_name');
            $('.modal-body #couponid').val(coupon_id);
            $('.modal-body #couponname').val(coupon_name);
        });
    });
</script>
