@extends('client.layouts.app-main')
<style>
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
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اضافة كوبون خصم جديد
                            @else
                                Add New Coupon
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.coupons.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            كود الكوبون
                                        @else
                                            Coupon Code
                                        @endif
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group" dir="ltr">
                                        <button type="button"
                                                class="input-group-addon btn btn-sm btn-info shuffle_codes"
                                                style="font-size: 18px;font-weight: bold;">
                                            <i class="fa fa-cogs"></i>
                                        </button>
                                        <input required type="text" class="form-control input-spec" id="coupon_code"
                                               name="coupon_code"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            قيمة الخصم
                                        @else
                                            Discount Value
                                        @endif
                                    </label>
                                    <input required type="number" class="form-control" name="coupon_value" dir="ltr"/>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            تاريخ انتهاء الصلاحية
                                        @else
                                            Expiration Date
                                        @endif
                                    </label>
                                    <input required type="date" class="form-control" name="coupon_expired"
                                           value="{{date('Y-m-d',strtotime('+1 year'))}}"/>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="" class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            القسم المخصص له
                                        @else
                                            is specialised for
                                        @endif
                                    </label>
                                    <select required class="form-control" name="dept" id="depts">
                                        <option value="">
                                            @if(App::getLocale() == 'ar')
                                                اختر القسم المخصص له
                                            @else
                                                Choose Department
                                            @endif
                                        </option>
                                        <option value="outer_clients">
                                            @if(App::getLocale() == 'ar')
                                                العملاء
                                            @else
                                                Clients
                                            @endif
                                        </option>
                                        <option value="categories">
                                            @if(App::getLocale() == 'ar')
                                                الفئات
                                            @else
                                                Categories
                                            @endif
                                        </option>
                                        <option value="products">
                                            @if(App::getLocale() == 'ar')
                                                المنتجات
                                            @else
                                                Products
                                            @endif
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-4 outer_clients" style="display: none;">
                                <div class="form-group">
                                    <label for="" class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            اسم العميل
                                        @else
                                            Client Name
                                        @endif
                                    </label>
                                    <select name="outer_client_id" class="selectpicker"
                                            data-style="btn-danger" data-live-search="true"
                                            @if(App::getLocale() == 'ar')
                                            data-title="ابحث"
                                            @else
                                            data-title="Search"
                                        @endif>
                                        @foreach($outer_clients as $outer_client)
                                            <option
                                                value="{{$outer_client->id}}">{{$outer_client->client_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 categories" style="display: none;">
                                <div class="form-group">
                                    <label for="" class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            اسم الفئة
                                        @else
                                            Category Name
                                        @endif
                                         </label>
                                    <select name="category_id" class="selectpicker"
                                            data-style="btn-info" data-live-search="true"
                                            @if(App::getLocale() == 'ar')
                                            data-title="ابحث"
                                            @else
                                            data-title="Search"
                                        @endif>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 products" style="display: none;">
                                <div class="form-group">
                                    <label for="" class="d-block">
                                        @if(App::getLocale() == 'ar')
                                            اسم المنتج
                                        @else
                                            Product Name
                                        @endif
                                    </label>
                                    <select name="product_id" class="selectpicker"
                                            data-style="btn-warning" data-live-search="true"
                                            @if(App::getLocale() == 'ar')
                                            data-title="ابحث"
                                            @else
                                            data-title="Search"
                                        @endif>
                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->product_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" type="submit">
                                @if(App::getLocale() == 'ar')
                                    اضافة
                                @else
                                    Add
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
        $('.shuffle_codes').on('click', function () {
            $.post("{{route('shuffle.coupon.codes')}}", {
                "_token": "{{ csrf_token() }}",
            }, function (data) {
                $('#coupon_code').val(data.coupon_code);
            });
        });
        $('#depts').on('change', function () {
            let depts = $(this).val();
            if (depts == "categories") {
                $('.categories').show();
                $('.products').hide();
                $('.outer_clients').hide();
            } else if (depts == "products") {
                $('.products').show();
                $('.categories').hide();
                $('.outer_clients').hide();
            } else if (depts == "outer_clients") {
                $('.outer_clients').show();
                $('.products').hide();
                $('.categories').hide();
            }
        });
    });
</script>
