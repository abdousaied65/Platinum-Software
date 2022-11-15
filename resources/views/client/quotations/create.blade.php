@extends('client.layouts.app-main')
<style>
    .btn.dropdown-toggle.bs-placeholder, .form-control {
        height: 40px !important;
    }

    a, a:hover {
        text-decoration: none;
        color: #444;
    }

    .bootstrap-select {
        width: 80% !important;
    }

    .bill_details {
        margin-top: 30px !important;
        min-height: 150px !important;
    }
</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show text-center">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="alert alert-success alert-dismissable text-center box_success d-none no-print">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        <span class="msg_success"></span>
    </div>

    <div class="alert alert-danger alert-dismissable text-center box_error d-none no-print">
        <button class="close" data-dismiss="alert" aria-label="Close">×</button>
        <span class="msg_error"></span>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger no-print">
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

    <form target="_blank" action="#" method="POST">
        @csrf
        @method('POST')
        <input type="hidden" value="{{$pre_quotation}}" id="quotation_number"/>
        <h6 class="alert alert-dark alert-sm text-center no-print" dir="rtl">
            <center>
                @if(App::getLocale() == 'ar')
                    اضافة عرض سعر جديد
                @else
                    Add New Quotation
                @endif
                <span>
                    @if(App::getLocale() == 'ar')
                        رقم العملية
                    @else
                        Process Number
                    @endif
                    {{$pre_quotation}}
                </span>
            </center>
        </h6>
        <div class="col-lg-3 pull-right no-print">
            <label for="" class="d-block">
                @if(App::getLocale() == 'ar')
                    اسم العميل
                @else
                    Client Name
                @endif
            </label>
            <select name="outer_client_id" id="outer_client_id" class="selectpicker"
                    data-style="btn-success" data-live-search="true"
                    @if(App::getLocale() == 'ar')
                    data-title="ابحث"
                    @else
                    data-title="Search"
                @endif
            >
                @foreach($outer_clients as $outer_client)
                    <option value="{{$outer_client->id}}">{{$outer_client->client_name}}</option>
                @endforeach
            </select>
            <a target="_blank" href="{{route('client.outer_clients.create')}}" role="button"
               style="width: 15%;display: inline;"
               class="btn btn-sm btn-warning open_popup">
                <i class="fa fa-plus"></i>
            </a>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 pull-right no-print">
            <div class="form-group" dir="rtl">
                <label for="date">
                    @if(App::getLocale() == 'ar')
                        تاريخ بدأ العرض
                    @else
                        Quotation Start Date
                    @endif
                </label>
                <input type="date" name="start_date" value="<?php echo date("Y-m-d"); ?>" id="start_date"
                       class="form-control"/>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 pull-right no-print">
            <div class="form-group" dir="rtl">
                <label for="date">
                    @if(App::getLocale() == 'ar')
                        تاريخ انتهاء العرض
                    @else
                        Quotation End Date
                    @endif
                </label>
                <input type="date" name="expiration" value="<?php echo date("Y-m-d"); ?>" id="expiration_date"
                       class="form-control"/>
            </div>
        </div>
        <div class="col-lg-3 pull-right no-print">
            <label for="">
                @if(App::getLocale() == 'ar')
                    اختر المخزن
                @else
                    Choose store
                @endif
            </label>
            <select name="store_id" id="store_id" class="selectpicker"
                    data-style="btn-warning" data-live-search="true"
                    @if(App::getLocale() == 'ar')
                    data-title="ابحث"
                    @else
                    data-title="Search"
                @endif
            >
                <?php $i = 0; ?>
                @foreach($stores as $store)
                    @if($stores->count() == 1)
                        <option selected value="{{$store->id}}">{{$store->store_name}}</option>
                    @else
                        @if($i ==  0)
                            <option selected value="{{$store->id}}">{{$store->store_name}}</option>
                        @else
                            <option value="{{$store->id}}">{{$store->store_name}}</option>
                        @endif
                    @endif
                    <?php $i++; ?>
                @endforeach
            </select>
            <a target="_blank" href="{{route('client.stores.create')}}" role="button"
               style="width: 15%;display: inline;"
               class="btn btn-sm btn-warning open_popup">
                <i class="fa fa-plus"></i>
            </a>
        </div>

        <div class="clearfix no-print"></div>
        <div class="col-lg-12 no-print">
            <div class="outer_client_details">

            </div>
        </div>
        <hr class="no-print">
        <div class="options no-print">
            <div class="col-lg-3 pull-right">
                <label for="">
                    @if(App::getLocale() == 'ar')
                        كود المنتج او الاسم
                    @else
                        Product Name Or Barcode
                    @endif
                </label>
                <select name="product_id" id="product_id" class="selectpicker form-control"
                        data-style="btn-danger" data-live-search="true"
                        @if(App::getLocale() == 'ar')
                        data-title="ابحث"
                        @else
                        data-title="Search"
                    @endif
                >
                    @foreach($all_products as $product)
                        <option value="{{$product->id}}"
                                data-tokens="{{$product->code_universal}}"
                        >{{$product->product_name}}</option>
                    @endforeach
                </select>
                <a target="_blank" href="{{route('client.products.create')}}" role="button"
                   style="width: 15%;display: inline;"
                   class="btn btn-sm btn-warning open_popup">
                    <i class="fa fa-plus"></i>
                </a>
                <div class="available text-center" style="color: #000; font-size: 14px; margin-top: 10px;"></div>
            </div>
            <div class="col-lg-3 pull-right">
                <label class="d-block" for="">
                    @if(App::getLocale() == 'ar')
                        الكمية
                    @else
                        Quantity
                    @endif
                </label>
                <input style="width: 50%;" type="text" name="quantity" id="quantity"
                       class="form-control d-inline float-left"/>
                <select style="width: 50%;" class="form-control d-inline float-right" name="product_unit_id"
                        id="product_unit_id">

                </select>
            </div>
            <div class="col-lg-3 pull-right">
                <label for="">
                    @if(App::getLocale() == 'ar')
                        سعر المنتج
                    @else
                        Product Price
                    @endif
                </label>
                <input type="text" name="product_price" id="product_price" class="form-control">
            </div>

            <div class="col-lg-3 pull-right">
                <label for="">
                    @if(App::getLocale() == 'ar')
                        الاجمالى
                    @else
                        Total
                    @endif
                </label>
                <input type="text" name="quantity_price" id="quantity_price" class="form-control"/>
                <br>
                <label for="">
                    @if(App::getLocale() == 'ar')
                        ملاحظات
                    @else
                        Notes
                    @endif
                </label>
                <input type="text" name="notes" id="notes" dir="rtl" class="form-control"/>
            </div>

            <div class="clearfix"></div>
            <div class="col-lg-12 text-center">
                <button type="button" id="add" class="btn btn-info btn-md mt-3">
                    <i class="fa fa-plus"></i>
                    @if(App::getLocale() == 'ar')
                        اضافة الى عرض السعر
                    @else
                        Add to quotation
                    @endif
                </button>
                <button type="button" id="edit" style="display: none" class="btn btn-success btn-md mt-3">
                    <i class="fa fa-pencil"></i>

                    @if(App::getLocale() == 'ar')
                        تعديل
                    @else
                        edit
                    @endif
                </button>
            </div>
            <hr>
        </div>
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
        <div class="col-lg-12 col-md-12 col-sm-12 bill_details">
            <h6 class="alert alert-sm alert-danger text-center">
                <i class="fa fa-info-circle"></i>
                @if(App::getLocale() == 'ar')
                    بيانات عناصر عرض السعر رقم
                @else
                    quotation items  - number
                @endif
                {{$pre_quotation}}
            </h6>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 after_totals">

        </div>

        <div class="clearfix no-print"></div>
        <hr class="no-print">
        <div class="row no-print" style="margin: 20px auto;">
            <div class="col-lg-12">
                <div class="col-lg-6 col-md-6 col-xs-6 pull-right">
                    <div class="form-group" dir="rtl">
                        <label for="discount">
                            @if(App::getLocale() == 'ar')
                                خصم على اجمالى عرض السعر
                            @else
                                discount
                            @endif
                        </label> <br>
                        <select name="discount_type" id="discount_type" class="form-control" disabled
                                style="width: 20%;display: inline;float: right; margin-left:5px;">
                            <option value="pound">{{$extra_settings->currency}}</option>
                            <option value="percent">%</option>
                        </select>
                        <input type="text" value="0" name="discount_value"
                               style="width: 50%;display: inline;float: right;"
                               disabled id="discount_value" class="form-control "/>
                        <button type="button" disabled class="btn btn-md btn-success pull-right text-center"
                                style="display: inline !important;width: 20% !important; height: 40px;margin-right: 20px; "
                                id="exec_discount">
                            @if(App::getLocale() == 'ar')
                                تطبيق
                            @else
                                Apply
                            @endif

                        </button>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-xs-6 pull-right">
                    <div class="form-group" dir="rtl">
                        <label for="extra">
                            @if(App::getLocale() == 'ar')
                                مصاريف الشحن
                            @else
                                charging fees
                            @endif
                            </label> <br>
                        <select disabled name="extra_type" id="extra_type" class="form-control"
                                style="width: 20%;display: inline;float: right;margin-left: 5px">
                            <option value="pound">{{$extra_settings->currency}}</option>
                            <option value="percent">%</option>
                        </select>
                        <input value="0" disabled type="text" name="extra_value"
                               style="width: 50%;display: inline;float: right;"
                               id="extra_value" class="form-control"/>
                        <button disabled type="button" class="btn btn-md btn-success pull-right text-center"
                                style="display: inline !important;width: 20% !important; height: 40px;margin-right: 20px; "
                                id="exec_extra">

                            @if(App::getLocale() == 'ar')
                                تطبيق
                            @else
                                apply
                            @endif
                        </button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div> <!--  End Col-lg-12 -->
        </div><!--  End Row -->
    </form>
    <div class="col-lg-12 no-print" style="padding-top: 25px;height: 40px !important;">
        <button type="button" onclick="window.print()" disabled name="print"
                class="btn btn-md btn-info print_btn pull-right"><i
                class="fa fa-print"></i>
            @if(App::getLocale() == 'ar')
                طباعة عرض السعر
            @else
                print quotation
            @endif

        </button>
        <form class="d-inline" action="{{ route('client.quotations.destroy', 'test') }}" method="post">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <input type="hidden" name="quotation_number" value="{{$pre_quotation}}">
            <button disabled type="submit" class="btn btn-md close_btn btn-danger pull-right ml-3">
                <i class="fa fa-close"></i>
                @if(App::getLocale() == 'ar')
                    الغاء وخروج
                @else
                    Cancel & Exit
                @endif
            </button>
        </form>
        <a href="{{route('client.quotations.redirect')}}" role="button"
           class="btn disabled save_btn btn-md btn-success pull-right ml-3"><i
                class="fa fa-check"></i>
            @if(App::getLocale() == 'ar')
                حفظ وخروج
            @else
                save & exit
            @endif
        </a>
    </div>
    <input type="hidden" id="product" placeholder="product" name="product"/>
    <input type="hidden" id="total" name="total"/>
    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#outer_client_id').on('change', function () {
            let outer_client_id = $(this).val();
            if (outer_client_id != "" || outer_client_id != "0") {
                $.post("{{url('/client/quotations/getOuterClientDetails')}}", {
                    outer_client_id: outer_client_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('.outer_client_details').html(data);
                });
            }
        });
        $('#store_id').on('change', function () {
            let store_id = $(this).val();
            if (store_id != "" || store_id != "0") {
                $('.options').fadeIn(200);
                $.post("{{url('/client/quotations/getProducts')}}", {
                    store_id: store_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('select#product_id').html(data);
                    $('select#product_id').selectpicker('refresh');
                });
            } else {
                $('.options').fadeOut(200);
            }
        });
        $('#product_id').on('change', function () {
            let product_id = $(this).val();
            let outer_client_id = $('#outer_client_id').val();
            if (outer_client_id == "") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار العميل أولا");
                @else
                alert("You must choose client first");
                @endif
            } else {
                $.post("{{route('get.product.units')}}", {
                    product_id: product_id,
                    "_token": "{{ csrf_token() }}"
                }, function (proto) {
                    $('#product_unit_id').html(proto);
                });
                $.post("{{url('/client/quotations/get')}}", {
                    product_id: product_id,
                    outer_client_id: outer_client_id,
                    "_token": "{{ csrf_token() }}"
                }, function (data) {
                    $('input#product_price').val(data.order_price);
                    $('input#quantity').val(1).attr('max', data.first_balance);
                    $('input#quantity_price').val(data.order_price);
                    $('.available').html('الكمية المتاحة : ' + data.first_balance);
                });
            }
        });
        $('#product_unit_id').on('change', function () {
            let product_unit_id = $(this).val();
            let quotation_number = $('#quotation_number').val();
            let quantity = $('#quantity').val();
            $.post("{{route('change.product.unit')}}", {
                product_unit_id: product_unit_id,
                quotation_number: quotation_number,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                let quantity_price = data.wholesale_price * quantity;
                $('#wholesale').prop('checked', true);
                $('input#product_price').val(data.wholesale_price);
                $('input#quantity').attr('max', data.first_balance);
                $('input#quantity_price').val(quantity_price);
                @if(App::getLocale() == 'ar')
                $('.available').html('الكمية المتاحة : ' + data.first_balance);
                @else
                $('.available').html('Available Quantity : ' + data.first_balance);
                @endif
            });
        });
        $('#quantity').on('keyup change', function () {
            let product_id = $('#product_id').val();
            let product_price = $('#product_price').val();
            let quantity = $(this).val();
            let quantity_price = quantity * product_price;
            $('#quantity_price').val(quantity_price);
        });
        $('#product_price').on('keyup change', function () {
            let product_id = $('#product_id').val();
            let product_price = $(this).val();
            let quantity = $('#quantity').val();
            let quantity_price = quantity * product_price;
            $('#quantity_price').val(quantity_price);
        });
        $('#add').on('click', function () {
            let outer_client_id = $('#outer_client_id').val();
            let quotation_number = $('#quotation_number').val();
            let product_id = $('#product_id').val();
            let product_price = $('#product_price').val();
            let quantity = $('#quantity').val();
            let product_unit_id = $('#product_unit_id').val();
            let start_date = $('#start_date').val();
            let expiration_date = $('#expiration_date').val();
            let quantity_price = quantity * product_price;
            let notes = $('#notes').val();

            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();

            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();
            let first_balance = parseFloat($('#quantity').attr('max'));
            if (outer_client_id == "") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار العميل أولا");
                @else
                alert("You Must Choose Client First !");
                @endif

            } else {
                if (product_id == "" || product_id <= "0") {
                    @if(App::getLocale() == 'ar')
                    alert("لابد ان تختار المنتج أولا");
                    @else
                    alert("You Must Choose Product First !");
                    @endif
                } else if (product_price == "" || product_price == "0") {
                    @if(App::getLocale() == 'ar')
                    alert("لم يتم اختيار سعر المنتج");
                    @else
                    alert("You Haven't Chosen Product Price Yet !");
                    @endif

                } else if (quantity == "" || quantity <= "0" || quantity > first_balance) {
                    @if(App::getLocale() == 'ar')
                    alert("الكمية غير مناسبة");
                    @else
                    alert("Quantity is not correct");
                    @endif
                } else if (quantity_price == "" || quantity_price == "0") {
                    @if(App::getLocale() == 'ar')
                    alert("الكمية غير مناسبة او الاجمالى غير صحيح");
                    @else
                    alert("Quantity is not correct or total is not correct");
                    @endif
                } else if (product_unit_id == "" || product_unit_id == "0") {
                    @if(App::getLocale() == 'ar')
                    alert("اختر الوحدة");
                    @else
                    alert("Choose Unit First !");
                    @endif
                } else {
                    $.post("{{url('/client/quotations/post')}}", {
                        outer_client_id: outer_client_id,
                        quotation_number: quotation_number,
                        product_id: product_id,
                        product_price: product_price,
                        quantity: quantity,
                        product_unit_id: product_unit_id,
                        quantity_price: quantity_price,
                        start_date: start_date,
                        notes: notes,
                        expiration_date: expiration_date,
                        "_token": "{{ csrf_token() }}"
                    }, function (data) {
                        $('#outer_client_id').attr('disabled', true).addClass('disabled');
                        $('#product_id').val('').trigger('change');
                        $('#discount_type').attr('disabled', false);
                        $('.print_btn').attr('disabled', false);
                        $('.close_btn').attr('disabled', false);
                        $('.save_btn').removeClass('disabled');
                        $('.send_btn').removeClass('disabled');
                        $('#discount_value').attr('disabled', false);
                        $('#exec_discount').attr('disabled', false);
                        $('#extra_type').attr('disabled', false);
                        $('#extra_value').attr('disabled', false);
                        $('#exec_extra').attr('disabled', false);
                        $('#product_price').val('0');
                        $('#quantity').val('');
                        $('#product_unit_id').val('');
                        $('#quantity_price').val('');
                        if (data.status == true) {
                            $('.box_success').removeClass('d-none').fadeIn(200);
                            $('.msg_success').html(data.msg);
                            $('.box_success').delay(3000).fadeOut(300);
                            $.post("{{url('/client/quotations/elements')}}",
                                {"_token": "{{ csrf_token() }}", quotation_number: quotation_number},
                                function (elements) {
                                    $('.bill_details').html(elements);
                                });

                            $.post("{{url('/client/quotations/discount')}}",
                                {
                                    "_token": "{{ csrf_token() }}",
                                    quotation_number: quotation_number,
                                    discount_type: discount_type,
                                    discount_value: discount_value
                                },
                                function (data) {
                                    $('.after_totals').html(data);
                                });

                            $.post("{{url('/client/quotations/extra')}}",
                                {
                                    "_token": "{{ csrf_token() }}",
                                    quotation_number: quotation_number,
                                    extra_type: extra_type,
                                    extra_value: extra_value
                                },
                                function (data) {
                                    $('.after_totals').html(data);
                                });

                        } else {
                            $('.box_error').removeClass('d-none').fadeIn(200);
                            $('.msg_error').html(data.msg);
                            $('.box_error').delay(3000).fadeOut(300);
                            $.post("{{url('/client/quotations/elements')}}",
                                {"_token": "{{ csrf_token() }}", quotation_number: quotation_number},
                                function (elements) {
                                    $('.bill_details').html(elements);
                                });

                            $.post("{{url('/client/quotations/discount')}}",
                                {
                                    "_token": "{{ csrf_token() }}",
                                    quotation_number: quotation_number,
                                    discount_type: discount_type,
                                    discount_value: discount_value
                                },
                                function (data) {
                                    $('.after_totals').html(data);
                                });

                            $.post("{{url('/client/quotations/extra')}}",
                                {
                                    "_token": "{{ csrf_token() }}",
                                    quotation_number: quotation_number,
                                    extra_type: extra_type,
                                    extra_value: extra_value
                                },
                                function (data) {
                                    $('.after_totals').html(data);
                                });
                        }
                    });
                }
            }
        });
        $('#exec_discount').on('click', function () {
            let quotation_number = $('#quotation_number').val();
            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();
            $.post("{{url('/client/quotations/discount')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    quotation_number: quotation_number,
                    discount_type: discount_type,
                    discount_value: discount_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
        });
        $('#exec_extra').on('click', function () {
            let quotation_number = $('#quotation_number').val();
            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();
            $.post("{{url('/client/quotations/extra')}}",
                {
                    "_token": "{{ csrf_token() }}",
                    quotation_number: quotation_number,
                    extra_type: extra_type,
                    extra_value: extra_value
                },
                function (data) {
                    $('.after_totals').html(data);
                });
        });
        $('#edit').on('click', function () {
            let element_id = $(this).attr('element_id');
            let quotation_number = $(this).attr('quotation_number');

            let product_id = $('#product_id').val();
            let product_price = $('#product_price').val();
            let quantity = $('#quantity').val();
            let quantity_price = $('#quantity_price').val();
            let product_unit_id = $('#product_unit_id').val();

            let discount_type = $('#discount_type').val();
            let discount_value = $('#discount_value').val();
            let extra_type = $('#extra_type').val();
            let extra_value = $('#extra_value').val();

            if (product_id == "" || product_id <= "0") {
                @if(App::getLocale() == 'ar')
                alert("لابد ان تختار المنتج أولا");
                @else
                alert("You Must Choose Product First !");
                @endif
            } else if (product_price == "" || product_price == "0") {
                @if(App::getLocale() == 'ar')
                alert("لم يتم اختيار سعر المنتج");
                @else
                alert("You Haven't Chosen Product Price Yet !");
                @endif

            } else if (quantity == "" || quantity <= "0" || quantity > first_balance) {
                @if(App::getLocale() == 'ar')
                alert("الكمية غير مناسبة");
                @else
                alert("Quantity is not correct");
                @endif
            } else if (quantity_price == "" || quantity_price == "0") {
                @if(App::getLocale() == 'ar')
                alert("الكمية غير مناسبة او الاجمالى غير صحيح");
                @else
                alert("Quantity is not correct or total is not correct");
                @endif
            } else if (product_unit_id == "" || product_unit_id == "0") {
                @if(App::getLocale() == 'ar')
                alert("اختر الوحدة");
                @else
                alert("Choose Unit First !");
                @endif
            } else {
                $.post('/client/quotations/element/update',
                    {
                        '_token': "{{ csrf_token() }}",
                        element_id: element_id,
                        product_id: product_id,
                        product_price: product_price,
                        quantity: quantity,
                        quantity_price: quantity_price,
                        product_unit_id: product_unit_id,
                    },
                    function (data) {
                        $.post("{{url('/client/quotations/elements')}}",
                            {"_token": "{{ csrf_token() }}", quotation_number: quotation_number},
                            function (elements) {
                                $('.bill_details').html(elements);
                            });
                        $('#add').show();
                        $('#edit').hide();
                        $('#product_id').val('').trigger('change');
                        $('#product_unit_id').val('');
                        $('.available').html("");
                        $('#product_price').val('0');
                        $('#quantity').val('');
                        $('#quantity_price').val('');
                    });
                $.post("{{url('/client/quotations/discount')}}",
                    {
                        "_token": "{{ csrf_token() }}",
                        quotation_number: quotation_number,
                        discount_type: discount_type,
                        discount_value: discount_value
                    },
                    function (data) {
                        $('.after_totals').html(data);
                    });

                $.post("{{url('/client/quotations/extra')}}",
                    {
                        "_token": "{{ csrf_token() }}",
                        quotation_number: quotation_number,
                        extra_type: extra_type,
                        extra_value: extra_value
                    },
                    function (data) {
                        $('.after_totals').html(data);
                    });
            }
        });

    </script>
@endsection
