@extends('client.layouts.app-main')
<style>
    .bootstrap-select, select.form-control {
        width: 80% !important;
        /*display: inline !important;*/
    }

    label {
        display: block !important;
    }

    input[type='checkbox'] {
        margin-left: 20px;
        opacity: 1 !important;
        position: relative !important;
        pointer-events: auto !important;
        width: 20px;
        height: 20px;
    }

    img.img-thumb {
        width: 60px;
        height: 60px;
        border: 2px solid #eee;
        padding: 4px;
        margin: 5px auto;
        box-shadow: 1px 1px 5px #000;
    }

    table thead tr {
        background: #337ab7;
        color: #fff;
        font-size: 15px;
    }

    select {
        margin: 0px;
    }

    input[type=text], input[type=number], button, select {
        border-radius: 0 !important;
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
    @if (session('success'))
        <div class="alert alert-danger alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-danger">
                            @if(App::getLocale() == 'ar')
                                ارسال ايميل الى مورد
                            @else
                                Send Email To Supplier
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <br>
                    <form method="POST" action="{{route('client.send.supplier.email')}}" id="myForm" dir="rtl"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="col-lg-6 no-print pull-right">
                            <div class="form-group" dir="rtl">
                                <label for="supplier_name">
                                    @if(App::getLocale() == 'ar')
                                        اسم المورد
                                    @else
                                        Supplier Name
                                    @endif
                                </label>
                                <select data-actions-box="true" multiple required
                                        class="selectpicker form-control show-tick selectpicker" data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif

                                        data-style="btn-warning" name="supplier_id[]"
                                        id="supplier_name">
                                    @foreach($suppliers as $supplier)
                                        <option value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.suppliers.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="form-group" dir="rtl">
                                <label for="body">
                                    @if(App::getLocale() == 'ar')
                                        نص الرسالة
                                    @else
                                        Messgae
                                    @endif
                                </label>
                                <textarea required name="body" class="form-control"
                                          style="width:100%;height:160px; resize:none;"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 no-print  pull-right">
                            <div class="form-group" dir="rtl">
                                <label for="subject">
                                    @if(App::getLocale() == 'ar')
                                        موضوع الرسالة
                                    @else
                                        Subject
                                    @endif
                                </label>
                                <input required type="text" name="subject" style="padding:20px; height:60px;"
                                       class="form-control">
                            </div>
                            <div class="form-group" dir="rtl">
                                <label for="file">
                                    @if(App::getLocale() == 'ar')
                                        ارفق ملفات
                                    @else
                                        Attach Files
                                    @endif
                                </label>
                                <input type="file" class="form-control" name="files[]" multiple/>
                            </div>
                            <div class="form-group" dir="rtl">
                                <label for="images" style="display:block ! important;">
                                    @if(App::getLocale() == 'ar')
                                        اختر صور منتجات موجوده
                                    @else
                                        Choose Products images
                                    @endif
                                </label>
                                <a style="display:block !important;display:inline !important ; float:right !important; width:90%; height:auto !important; min-height: 70px; border:1px solid #dedede;
                                    padding:10px !important; text-align:center; font-size: 14px; font-weight:bold;"
                                   href="#mymoda21"
                                   data-toggle="modal" class="dismiss"><i class="fa fa-plus"></i><br/>
                                    @if(App::getLocale() == 'ar')
                                        اضغط هنا لاختيار المنتجات
                                    @else
                                        Click here to choose products
                                    @endif
                                </a>
                                <div class="clearfix"></div>
                                <div id="showChecked" class=" text-center text-danger"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <button type="submit" name="submit" class="no-print btn btn-danger btn-md pull-right"><i
                                class="fa fa-envelope"></i>
                            @if(App::getLocale() == 'ar')
                                ارسال الرسالة
                            @else
                                Send Message
                            @endif
                        </button>
                        <div id="daily_details"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="mymoda21" class="modal" data-easein="bounceIn" dir="rtl" role="dialog" aria-labelledby="costumModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header w-100">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title text-center w-100">
                        <i class="fa fa-image"></i>
                        @if(App::getLocale() == 'ar')
                            عرض صورة المنتجات
                        @else
                            Products Images
                        @endif
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 images">
                            @if(!$products->isEmpty())
                                <table dir='rtl' class='table table-bordered table-hover table-condensed table-striped'
                                       style='text-align:center !important;'>
                                    <thead class='text-center'>
                                    <th class='text-center' style='width: 20%;'>
                                        <input type='checkbox' name='check_all' class='check_all'/>
                                        @if(App::getLocale() == 'ar')
                                            تحديد الكل
                                        @else
                                            Select All
                                        @endif
                                    </th>
                                    <th class='text-center'>
                                        @if(App::getLocale() == 'ar')
                                            اسم المنتج
                                        @else
                                            Product Name
                                        @endif
                                    </th>
                                    <th class='text-center'>
                                        @if(App::getLocale() == 'ar')
                                            تفاصيل المنتج
                                        @else
                                            Product Details
                                        @endif
                                    </th>
                                    <th class='text-center'>
                                        @if(App::getLocale() == 'ar')
                                            صورة المنتج
                                        @else
                                            Product Image
                                        @endif
                                    </th>
                                    </thead>
                                    @foreach($products as $product)
                                        <tr>
                                            <td><input type='checkbox' form='myForm' name='check[]'
                                                       value='{{asset($product->product_pic)}}' class='check'/></td>
                                            <td>{{$product->product_name}}</td>
                                            <td>{{$product->description}}</td>
                                            <td><img src='{{asset($product->product_pic)}}' class='img-thumb'/></td>
                                        </tr>
                                    @endforeach
                                </table>
                            @endif
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnDismiss" data-dismiss="modal" class="btn btn-md btn-danger"><i
                            class="fa fa-check"></i>
                        @if(App::getLocale() == 'ar')
                            تم وارفاق الصور
                        @else
                            Done .. Images Attached
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $(".check_all").click(function () {
            $('.check').not(this).prop('checked', this.checked);
        });
        $('#btnDismiss').on('click', function () {
            var numberOfChecked = $('input[name="check[]"]:checked').length;
            @if(App::getLocale() == 'ar')
            $('#showChecked').html("<br/>" + " تم اختيار وارفاق عدد ( " + numberOfChecked + " ) صورة منتج");
            @else
            $('#showChecked').html("<br/>" + " you chose and attached ( " + numberOfChecked + " ) product image ");
            @endif
        });
    </script>
@endsection
