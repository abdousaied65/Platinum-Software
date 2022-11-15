@extends('client.layouts.app-main')
<style>
    .bootstrap-select {
        width: 75% !important;
        display: inline !important;
        float: right !important;
    }

    .button_search {
        height: 40px !important;
    }
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
                            <h5 class="pull-right alert alert-sm alert-info">
                                @if(App::getLocale() == 'ar')
                                    فلترة الموردين ( بحث متقدم )
                                @else
                                    Suppliers Filter (Advanced Search)
                                @endif
                            </h5>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body p-3">
                    <h4 class="alert alert-sm alert-dark text-center  no-print">
                        @if(App::getLocale() == 'ar')
                            فلترة الموردين ( بحث متقدم )
                        @else
                            Suppliers Filter (Advanced Search)
                        @endif
                    </h4>
                    <div class="col-lg-3 pull-right  no-print">
                        <form action="{{route('client.suppliers.filter.key')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label style="display:block;" for="national">
                                    @if(App::getLocale() == 'ar')
                                        بحث بالجنسية
                                    @else
                                        Search By Nationality
                                    @endif
                                </label>
                                <select required class="selectpicker" data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif
                                        data-style="btn-info"
                                        name="national" id="national">
                                    @if(!empty($nationals[0]->supplier_national))
                                        <?php
                                        if ($nationals->count() > 0) {
                                            $i = 1;
                                            foreach ($nationals as $national) {
                                                $supplier_national = $national->supplier_national;
                                                echo '
                                                <option value="' . $supplier_national . '">' . $i . ' - ' . $supplier_national . '</option>
                                            ';
                                                $i++;
                                            }
                                        }
                                        ?>
                                    @endif
                                </select>
                                <button type="submit" class="button_search btn btn-md btn-info"
                                        style="display: inline !important;width: 20% !important; float: left !important;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-3 pull-right  no-print">
                        <form action="{{route('client.suppliers.filter.key')}}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label style="display:block;" for="category">
                                    @if(App::getLocale() == 'ar')
                                        بحث بالفئة
                                    @else
                                        Search By Category
                                    @endif
                                </label>
                                <select required
                                        style="width: 75% !important; display: inline !important; float: right !important;"
                                        class="form-control" name="category">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر الفئة
                                        @else
                                            choose Category
                                        @endif
                                    </option>
                                    <option value="جملة">
                                        @if(App::getLocale() == 'ar')
                                            جملة
                                        @else
                                            wholesale
                                        @endif
                                    </option>
                                    <option value="قطاعى">
                                        @if(App::getLocale() == 'ar')
                                            قطاعى
                                        @else
                                            sector
                                        @endif
                                    </option>
                                </select>
                                <button type="submit" class="button_search btn btn-md btn-warning"
                                        style="display: inline !important;width: 20% !important; float: left !important;">
                                    <i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div id="bill_details">
                @if(isset($suppliers) && !$suppliers->isEmpty())
                    <p class="alert alert-sm alert-success text-center">
                        @if(App::getLocale() == 'ar')
                            عرض نتائج البحث
                        @else
                            Search Results
                        @endif
                    </p>
                    <table class="table table-condensed table-striped table-bordered text-center table-hover"
                           id="example-table">
                        <thead>
                        <tr>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    الاسم
                                @else
                                    Name
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    الفئة
                                @else
                                    Category
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    تليفون
                                @else
                                    Phone
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    عنوان
                                @else
                                    Address
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    رقم ضريبى
                                @else
                                    Tax Number
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    المحل
                                @else
                                    Shop Name
                                @endif
                            </th>
                            <th class="text-center">
                                @if(App::getLocale() == 'ar')
                                    مستحقات
                                @else
                                    Dues
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
                        @foreach ($suppliers as $key => $supplier)
                            <tr>
                                <td>{{ $supplier->supplier_name }}</td>
                                <td>{{trans('main.'.$supplier->supplier_category)}}</td>
                                <td dir="ltr">
                                    @if(!$supplier->phones->isEmpty())
                                        {{$supplier->phones[0]->supplier_phone}}
                                    @endif
                                </td>
                                <td>
                                    @if(!$supplier->addresses->isEmpty())
                                        {{$supplier->addresses[0]->supplier_address}}
                                    @endif
                                </td>
                                <td>{{$supplier->tax_number}}</td>
                                <td>{{$supplier->shop_name}}</td>
                                <td>
                                    @if($supplier->prev_balance > 0 )
                                        @if(App::getLocale() == 'ar')
                                            له
                                        @else
                                            Creditor

                                        @endif
                                        {{floatval($supplier->prev_balance)}}

                                    @elseif($supplier->prev_balance < 0)
                                        @if(App::getLocale() == 'ar')
                                            عليه
                                        @else
                                            Debtor
                                        @endif

                                        {{floatval(abs($supplier->prev_balance))}}

                                    @else
                                        0
                                    @endif
                                </td>
                                <td style="width: 20% !important;">
                                    <a href="{{ route('client.suppliers.show', $supplier->id) }}"
                                       class="btn btn-sm btn-success" data-toggle="tooltip"
                                       data-placement="top"><i class="fa fa-eye"></i></a>

                                    <a href="{{ route('client.suppliers.edit', $supplier->id) }}"
                                       class="btn btn-sm btn-info" data-toggle="tooltip"
                                       data-placement="top"><i class="fa fa-edit"></i></a>

                                    <a class="modal-effect btn btn-sm btn-danger delete_supplier"
                                       supplier_id="{{ $supplier->id }}"
                                       supplier_name="{{ $supplier->supplier_name }}" data-toggle="modal"
                                       href="#modaldemo9"
                                    ><i
                                            class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" supplier="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            حذف مورد
                        @else
                            Delete Supplier
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('client.suppliers.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>@if(App::getLocale() == 'ar')
                                هل انت متأكد من الحذف ؟
                            @else
                                Sure To Delete ?
                            @endif</p><br>
                        <input type="hidden" name="supplierid" id="supplierid">
                        <input class="form-control" name="suppliername" id="suppliername" type="text" readonly>
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

    <script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.delete_supplier').on('click', function () {
                var supplier_id = $(this).attr('supplier_id');
                var supplier_name = $(this).attr('supplier_name');
                $('.modal-body #supplierid').val(supplier_id);
                $('.modal-body #suppliername').val(supplier_name);
            });
        });
    </script>
@endsection


