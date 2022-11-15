@extends('client.layouts.app-main')
<style>
    .btn.dropdown-toggle.bs-placeholder {
        height: 40px;
    }

    .bootstrap-select {
        width: 80% !important;
    }

    .form-control {
        height: 45px !important;
        padding: 10px !important;
    }

    .unit {
        border: 1px solid #444;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    #result {
        width: 100% !important;
    }

    label, input {
        color: #333 !important;
    }

    .serials_result {
        font-size: 16px !important;
        text-align: center !important;
        color: #ffffff !important;
        padding: 0.75rem 1rem !important;
        margin-bottom: 1rem !important;
        border: 1px solid #464855 !important;
        border-radius: 0.25rem !important;
        background-color: #464855 !important;
    }

    .serials_result h3 {
        color: #fff !important;
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
                        <h3 class="text-center alert alert-info"
                            style="height: 40px!important;font-size: 15px!important;">
                            @if(App::getLocale() == 'ar')
                                تعديل بيانات منتج
                            @else
                                Edit Product Details
                            @endif
                        </h3>
                    </div>
                    <div class="clearfix"></div>
                    <form method="post"
                          enctype="multipart/form-data"
                          id="laravel-ajax-file-upload" action="javascript:void(0)">
                        <input type="hidden" name="company_id" id="company_id" value="{{$company_id}}">
                        <input type="hidden" value="{{$product->id}}" name="product_id" id="product_id"/>
                        <input type="hidden" name="typo" id="typo" value="old">
                        <hr>
                        <div class="col-lg-6 col-xs-12 pull-right">
                            <div class="form-group  col-lg-6  pull-right" dir="rtl">
                                <label for="store_id">
                                    @if(App::getLocale() == 'ar')
                                        اسم المخزن
                                    @else
                                        Store Name
                                    @endif
                                </label>
                                <select required style="width: 80%; display: inline;" name="store_id" id="store_id"
                                        class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر المخزن
                                        @else
                                            Choose store
                                        @endif
                                    </option>
                                    @foreach($stores as $store)
                                        <option
                                            @if($store->id == $product->store_id)
                                            selected
                                            @endif
                                            value="{{$store->id}}">{{$store->store_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.stores.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="form-group  col-lg-6  pull-right" dir="rtl">
                                <label class="d-block" for="category">
                                    @if(App::getLocale() == 'ar')
                                        اسم الفئة الرئيسية
                                    @else
                                        choose main category
                                    @endif
                                </label>
                                <select required style="display: inline; width: 80%;" name="category_id"
                                        id="category_id"
                                        class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر الفئة الرئيسية
                                        @else
                                            choose main category
                                        @endif
                                    </option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                                @if($category->id == $product->category_id)
                                                selected
                                                @endif
                                                type="{{$category->category_type}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.categories.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group  col-lg-6  pull-right" dir="rtl">
                                <label for="order">
                                    @if(App::getLocale() == 'ar')
                                        اسم المنتج
                                    @else
                                        product name
                                    @endif
                                </label>
                                <input type="text" value="{{$product->product_name}}" name="product_name"
                                       id="product_name" class="form-control" required>
                            </div>
                            <div class="form-group  pull-right col-lg-6" dir="rtl">
                                <label for="description">
                                    @if(App::getLocale() == 'ar')
                                        وصف المنتج
                                    @else
                                        product description
                                    @endif
                                </label>
                                <input type="text" name="description" id="description" class="form-control"
                                       dir="rtl" value="{{$product->description}}"/>
                            </div>
                            <div class="clearfix"></div>
                            <div class="form-group  col-lg-6  pull-right" dir="rtl">
                                <label style="display: block;">
                                    @if(App::getLocale() == 'ar')
                                        رقم الباركود
                                    @else
                                        barcode number
                                    @endif
                                </label>
                                <input type="text" class="form-control" value="{{$product->code_universal}}" dir="ltr"
                                       id="code_universal" name="code_universal"/>
                            </div>
                            <div class="form-group  col-lg-6  pull-right" dir="rtl">
                                <label class="d-block" for="sub_category_id">
                                    @if(App::getLocale() == 'ar')
                                        اسم الفئة الفرعية
                                    @else
                                        sub category name
                                    @endif
                                </label>
                                <select style="display: inline; width: 100%;" name="sub_category_id"
                                        id="sub_category_id"
                                        class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر الفئة الفرعية
                                        @else
                                            choose sub category
                                        @endif
                                    </option>
                                    @foreach($sub_categories as $category)
                                        <option
                                            @if($category->id == $product->sub_category_id)
                                            selected
                                            @endif
                                            value="{{$category->id}}">
                                            {{$category->sub_category_name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="clearfix"></div>
                            <div class="form-group col-lg-6 pull-right" dir="rtl">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        اختر صورة لرفعها
                                    @else
                                        choose picture to upload
                                    @endif
                                </label>
                                <input accept=".jpg,.png,.jpeg" type="file"
                                       oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="product_pic"
                                       name="product_pic" class="form-control">
                                <label for="" class="d-block mt-2">
                                    @if(App::getLocale() == 'ar')
                                        معاينة الصورة
                                    @else
                                        picture preview
                                    @endif
                                </label>
                                <img id="pic" src="{{asset($product->product_pic)}}"
                                     style="width: 100px; height:100px;"/>
                            </div>
                            <div class="form-group  col-lg-6  pull-right" dir="rtl">
                                <label class="d-block" for="color">
                                    @if(App::getLocale() == 'ar')
                                        اختر لون معبر
                                    @else
                                        choose color
                                    @endif
                                </label>
                                <input style="width: 100%!important; height: 45px;" type="color" name="color"
                                       id="color" value="{{$product->color}}"/>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="col-lg-6 col-xs-12 pull-left">
                            <div class="unit">
                                <div class="col-lg-4 pull-right">
                                    <label class="d-block" for="unit_id">
                                        @if(App::getLocale() == 'ar')
                                            وحدة المنتج
                                        @else
                                            product unit
                                        @endif
                                    </label>
                                    <select name="unit_id" id="unit_id" class="form-control">
                                        <option value="">
                                            @if(App::getLocale() == 'ar')
                                                اختر وحدة
                                            @else
                                                choose unit
                                            @endif
                                        </option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->unit_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-4  pull-right" dir="rtl">
                                    <label for="first_balance">
                                        @if(App::getLocale() == 'ar')
                                            رصيد المخازن
                                        @else
                                            stores balance
                                        @endif
                                    </label>
                                    <input value="" type="text" name="first_balance" id="first_balance"
                                           class="form-control text-left">
                                </div>
                                <div class="form-group pull-right col-lg-4" dir="ltr">
                                    <label for="min_balance">
                                        @if(App::getLocale() == 'ar')
                                            رصيد حد أدنى المخازن
                                        @else
                                            min balance
                                        @endif
                                    </label>
                                    <input value="" type="text" name="min_balance" id="min_balance"
                                           class="form-control text-left"
                                           dir="ltr"/>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group  pull-right col-lg-6" dir="rtl">
                                    <label for="wholesale_price">
                                        @if(App::getLocale() == 'ar')
                                            سعر الجملة
                                        @else
                                            wholesale price
                                        @endif
                                    </label>
                                    <input value="" type="text" name="wholesale_price" id="wholesale_price"
                                           class="form-control text-left">
                                </div>
                                <div class="form-group  pull-right col-lg-6" dir="rtl">
                                    <label for="sector_price">
                                        @if(App::getLocale() == 'ar')
                                            سعر القطاعى
                                        @else
                                            sector price
                                        @endif
                                    </label>
                                    <input value="" type="text" name="sector_price" id="sector_price"
                                           class="form-control text-left">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group  pull-right col-lg-6" dir="rtl">
                                    <label for="purchasing_price">
                                        @if(App::getLocale() == 'ar')
                                            سعر التكلفة
                                        @else
                                            cost price (purchasing)
                                        @endif
                                    </label>
                                    <input value="" type="text" name="purchasing_price" id='purchasing_price'
                                           class="form-control text-left">
                                </div>
                                <div class="form-group pull-right col-lg-6" dir="ltr">
                                    <label for="type">
                                        @if(App::getLocale() == 'ar')
                                            وحدة افتراضية فى البيع ؟؟
                                        @else
                                            default unit in sales ?
                                        @endif
                                    </label>
                                    <select name="type" class="form-control">
                                        <option selected value="لا">
                                            @if(App::getLocale() == 'ar')
                                                لا
                                            @else
                                                No
                                            @endif
                                        </option>
                                        <option value="نعم">
                                            @if(App::getLocale() == 'ar')
                                                نعم
                                            @else
                                                Yes
                                            @endif
                                        </option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="form-group text-center col-lg-12 mt-2" dir="rtl">
                                <button type="submit" class="btn btn-md btn-danger add_unit">
                                    <i class="fa fa-plus"></i>

                                    @if(App::getLocale() == 'ar')
                                        اضافة وحدة جديدة تابعة للمنتج
                                    @else
                                        Add New Unit to this product
                                    @endif
                                </button>
                            </div>
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
                                    <th>
                                        @if(App::getLocale() == 'ar')
                                            حذف
                                        @else
                                            Delete
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
                                                <a quantity="{{$product_unit->first_balance}}"
                                                   product_unit_id="{{$product_unit->id}}"
                                                   href="#myFooter" role="button"
                                                   class="btn btn-sm text-white btn-success add_serials">
                                                    <i class="fa fa-barcode"></i>
                                                </a>
                                            </td>

                                            <td>
                                                <button unit_id="{{$product_unit->id}}" type="button"
                                                        class="delete_unit btn btn-sm btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row mt-2">
                            <div class="col-lg-6 pull-left text-center">
                                <a href="{{route('client.products.create')}}" class="btn btn-dark btn-md">
                                    <i class="fa fa-refresh"></i>
                                    @if(App::getLocale() == 'ar')
                                        اضافة منتج جديد
                                    @else
                                        Add New Product
                                    @endif
                                </a>
                            </div>
                            <div class="col-lg-6 pull-right text-center">
                                <a href="{{route('client.products.index')}}" class="btn btn-dark btn-md">
                                    <i class="fa fa-arrow-right"></i>
                                    @if(App::getLocale() == 'ar')
                                        الذهاب الى المنتجات
                                    @else
                                        Go to Products
                                    @endif
                                </a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="serials_result">

                    </div>
                    <div class="serials">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#category').on('change', function () {
            var category_name = $(this).val();
            var category_type = $(this).children("option:selected").attr('type');
            if (category_type == 'خدمية') {
                $('#first_balance').val("").attr('readonly', true);
                $('#order_universal').val("").attr('readonly', true);
                $('#min_balance').attr('readonly', true);
                $('#store').attr('disabled', true);
            } else {
                $('#first_balance').attr('readonly', false);
                $('#order_universal').attr('readonly', false);
                $('#min_balance').attr('readonly', false);
                $('#store').attr('disabled', false);
            }
        });
        $('.delete_unit').on("click", function () {
            let unit_id = $(this).attr('unit_id');
            $.post("{{route('remove.product.unit')}}", {
                unit_id: unit_id,
                "_token": "{{ csrf_token() }}"
            }, function (data) {
                $('#result_text').html(data.msg);
            });
            $(this).parent().parent().fadeOut();
        });
        $('#laravel-ajax-file-upload').submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "{{route('client.products.store')}}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $('#store_id').attr('disabled', true);
                    $('#category_id').attr('disabled', true);
                    $('#sub_category_id').attr('disabled', true);
                    $('#color').attr('disabled', true);
                    $('#product_pic').attr('disabled', true);
                    $('#code_universal').attr('disabled', true);
                    $('#product_name').attr('disabled', true);
                    $('#description').attr('disabled', true);
                    $('#unit_id').val("");
                    $('#first_balance').val("");
                    $('#min_balance').val("");
                    $('#purchasing_price').val("");
                    $('#wholesale_price').val("");
                    $('#sector_price').val("");
                    $('#product_id').val(data.product_id);
                    $('#typo').val("old");
                    $('#result_text').html(data.msg);
                    $('#tbody').append(
                        '<tr>\n' +
                        '<td>' + data.unit_name + '</td>\n' +
                        '<td>' + data.product_unit.first_balance + '</td>\n' +
                        '<td>' + data.product_unit.purchasing_price + '</td>\n' +
                        '<td>' + data.product_unit.wholesale_price + '</td>\n' +
                        '<td>' + data.product_unit.sector_price + '</td>\n' +
                        '<td>' + data.product_unit.min_balance + '</td>\n' +
                        '<td>' + data.product_unit.type + '</td>\n' +
                        '<td><a quantity="' + data.product_unit.first_balance + '" product_unit_id = "' + data.product_unit.id + '" href="#myFooter" role="button" class="btn btn-sm text-white btn-success add_serials"><i class="fa fa-barcode"></i></a></td>\n' +
                        '<td><button unit_id="' + data.product_unit.id + '" type="button" class="delete_unit btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></td>\n' +
                        '</tr>');
                    $('.add_serials').on('click', function () {
                        let product_unit_id = $(this).attr('product_unit_id');
                        let quantity = $(this).attr('quantity');
                        if (quantity <= 0) {
                            @if(App::getLocale() == 'ar')
                            alert('الكمية غير مقبولة');
                            @else
                            alert('quantity is not suitable');
                            @endif
                        } else {
                            $.post('{{route('add.serials')}}', {
                                quantity: quantity,
                                product_unit_id: product_unit_id
                            }, function (data) {
                                $('.serials').html(data);
                            });
                        }
                    });

                },
                error: function (data) {
                    console.log(data.msg);
                }
            });
        });
        $('.add_serials').on('click', function () {
            let product_unit_id = $(this).attr('product_unit_id');
            let quantity = $(this).attr('quantity');
            if (quantity <= 0) {
                @if(App::getLocale() == 'ar')
                alert('الكمية غير مقبولة');
                @else
                alert('quantity is not suitable');
                @endif
            } else {
                $.post('{{route('add.serials')}}', {
                    quantity: quantity,
                    product_unit_id: product_unit_id
                }, function (data) {
                    $('.serials').html(data);
                });
            }
        });
        $('#myForm').on('submit', function () {
            @if(App::getLocale() == 'ar')
            $('.serials_result').html('<h3> تم اضافة السيريالات بنجاح الى هذه الوحدة من المنتج </h3>');
            @else
            $('.serials_result').html('<h3>Serials have been successfully added to this unit of the product</h3>');
            @endif
            $('#myForm').html('');
        });
    </script>
@endsection
