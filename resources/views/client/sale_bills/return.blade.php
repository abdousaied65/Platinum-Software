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
        width: 100% !important;
    }

    .bill_details {
        margin-top: 30px !important;
        min-height: 150px !important;
    }
</style>
@section('content')

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
    <div class="col-lg-12 text-center mt-1 mb-1">
        <p class="alert alert-sm alert-info">
            @if(App::getLocale() == 'ar')
                اضافة مرتجع فاتورة مبيعات
            @else
                Add Sale Return Bill
            @endif
        </p>
    </div>
    <form action="{{route('client.sale_bills.post.return')}}" method="post">
        @csrf
        @method('POST')
        <input type="hidden" value="{{$sale_bill->id}}" name="bill_id"/>
        <input type="hidden" value="{{$element->id}}" name="element_id"/>
        <div class="row mt-2 mb-2">
            <div class="col-lg-3 pull-right no-print">
                <label for="" class="d-block">
                    @if(App::getLocale() == 'ar')
                        اسم العميل
                    @else
                        Client Name
                    @endif
                </label>
                <input type="hidden"
                       @if(empty($sale_bill->outer_client_id))
                       value=""
                       @else
                       value="{{$sale_bill->OuterClient->id}}"
                       @endif
                       required name="outer_client_id"
                       id="outer_client_id"/>
                <input type="text" class="form-control" readonly
                       @if(empty($sale_bill->outer_client_id))
                       @if(App::getLocale() == 'ar')
                       value="عميل مبيعات نقدية"
                       @else
                       value="walk in customer"
                       @endif
                       @else
                       value="{{$sale_bill->OuterClient->client_name}}"
                    @endif />
            </div>
            <div class="col-lg-3 pull-right no-print">
                <label for="" class="d-block">
                    @if(App::getLocale() == 'ar')
                        تاريخ الارتجاع
                    @else
                        Return Date
                    @endif
                </label>
                <input type="date" value="{{date('Y-m-d')}}" class="form-control" required name="date"/>
            </div>
            <div class="col-lg-3 pull-right no-print">
                <label for="" class="d-block">
                    @if(App::getLocale() == 'ar')
                        وقت الارتجاع
                    @else
                        Return Time
                    @endif
                </label>
                <input type="time" value="{{date('H:i:s')}}" class="form-control" required name="time"/>
            </div>
            <div class="col-lg-3 pull-right no-print">
                <label for="" class="d-block">
                    @if(App::getLocale() == 'ar')
                        اسم المنتج
                    @else
                        Product Name
                    @endif
                </label>
                <input type="hidden" value="{{$element->product_id}}" required name="product_id" id="product_id"/>
                <input type="text" class="form-control" readonly value="{{$element->product->product_name}}"/>
            </div>
        </div>
        <div class="row mt-1 mb-1">
            <div class="col-lg-3 pull-right">
                <div class="form-group" dir="rtl">
                    <label for="return_quantity">
                        @if(App::getLocale() == 'ar')
                            الكمية المرتجعة
                        @else
                            Return Quantity
                        @endif
                    </label>
                    <input type="text" name="return_quantity" min="1" max="{{$element->quantity}}"
                           id="return_quantity" class="form-control" required>
                </div>
            </div>

            <div class="col-lg-3 pull-right">
                <div class="form-group" dir="rtl">
                    <label for="before_return">
                        @if(App::getLocale() == 'ar')
                            الموجود بالمخزن قبل الارتجاع
                        @else
                            Store Balance Before Return
                        @endif
                    </label>
                    <input type="text" name="before_return" id="before_return"
                           value="{{$element->product->first_balance}}" readonly class="form-control" required>
                </div>
            </div>

            <div class="col-lg-3 pull-right">
                <div class="form-group" dir="rtl">
                    <label for="after_return">
                        @if(App::getLocale() == 'ar')
                            الموجود بالمخزن بعد الارتجاع
                        @else
                            Store Balance After Return
                        @endif
                    </label>
                    <input type="text" name="after_return" id="after_return" readonly class="form-control"
                           required>
                </div>
            </div>
            <div class="col-lg-3 pull-right">
                <div class="form-group" dir="rtl">
                    <label for="notes">
                        @if(App::getLocale() == 'ar')
                            ملاحظات
                        @else
                            Notes
                        @endif
                    </label>
                    <input type="text" dir="rtl" name="notes" id="notes" class="form-control"/>
                </div>
            </div>
        </div>
        <div class="row mt-1 mb-1">
            <div class="col-lg-3 pull-right">
                <div class="form-group" dir="rtl">
                    <label for="product_price">
                        @if(App::getLocale() == 'ar')
                            سعر المنتج
                        @else
                            Product Price
                        @endif
                    </label>
                    <input type="text" readonly value="{{$element->product_price}}" name="product_price"
                           id="product_price"
                           class="form-control" required>
                </div>
            </div>

            <div class="col-lg-3 pull-right">
                <div class="form-group" dir="rtl">
                    <label for="quantity_price">
                        @if(App::getLocale() == 'ar')
                            سعر الكمية
                        @else
                            Quantity Price
                        @endif
                    </label>
                    <input type="text" name="quantity_price" id="quantity_price" readonly class="form-control"
                           required>
                </div>
            </div>

            <div class="col-lg-3 pull-right">
                <div class="form-group" dir="rtl">
                    <label for="balance_before">
                        @if(App::getLocale() == 'ar')
                            مديونية سابقة
                        @else
                            Previous Debts
                        @endif
                    </label>
                    <input type="text" name="balance_before" id="balance_before"
                           @if(empty($sale_bill->outer_client_id))
                           value="0"
                           @else
                           value="{{$sale_bill->OuterClient->prev_balance}}"
                           @endif
                           class="form-control" readonly required>
                </div>
            </div>

            <div class="col-lg-3 pull-right">
                <div class="form-group" dir="rtl">
                    <label for="balance_after">
                        @if(App::getLocale() == 'ar')
                            مديونية حالية
                        @else
                            Current Debts
                        @endif
                    </label>
                    <input type="text" name="balance_after"
                           @if(empty($sale_bill->outer_client_id))
                           value="0"
                           @endif
                           id="balance_after" readonly class="form-control"
                           required>
                </div>
            </div>
        </div>
        <div class="col-lg-12 mt-1 mb-1 text-center">
            <button type="submit" class="btn btn-md btn-success">
                <i class="fa fa-edit"></i>
                @if(App::getLocale() == 'ar')
                    ارتجاع الكمية
                @else
                    Return Quantity
                @endif
            </button>
        </div>
    </form>

    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $('#return_quantity').on('keyup', function () {
            let outer_client_id = $('#outer_client_id').val();
            let return_quantity = $(this).val();
            let before_return = $('#before_return').val();
            let product_price = $('#product_price').val();
            let balance_before = $('#balance_before').val();
            let after_return = parseFloat(before_return) + parseFloat(return_quantity);
            $('#after_return').val(after_return);
            let quantity_price = parseFloat(product_price) * parseFloat(return_quantity);
            $('#quantity_price').val(quantity_price);
            if (outer_client_id != "") {
                let balance_after = parseFloat(balance_before) - parseFloat(quantity_price);
                $('#balance_after').val(balance_after);
            }
        })
    </script>
@endsection
