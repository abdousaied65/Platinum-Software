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
                                تقرير مديونية الموردين
                            @else
                                supplier dues report
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report6.post')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-4 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    اسم المورد
                                @else
                                    supplier name
                                @endif
                            </label>
                            <select required name="supplier_id" id="supplier_id" class="selectpicker"
                                    data-style="btn-info" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                @endif
                            >
                                <option
                                    @if(isset($supplier_id) && $supplier_id == "all")
                                    selected
                                    @endif
                                    value="all">
                                    @if(App::getLocale() == 'ar')
                                        كل الموردين
                                    @else
                                        all suppliers
                                    @endif
                                </option>
                                @foreach($suppliers as $supplier)
                                    <option
                                        @if(isset($supplier_id) && $supplier->id == $supplier_id)
                                        selected
                                        @endif
                                        value="{{$supplier->id}}">{{$supplier->supplier_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 pull-right">
                            <button class="btn btn-md btn-danger"
                                    style="font-size: 15px; height: 40px; margin-top: 25px;" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    عرض التقرير
                                @else
                                    show report
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    @if(isset($Suppliers) && !empty($Suppliers))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير مديونية الموردين
                            @else
                                supplier dues report
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
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
                                            الفئة
                                        @else
                                            category
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            مديونية
                                        @else
                                            dues
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($Suppliers as $key => $supplier)
                                    <tr>
                                        <td>{{ $supplier->supplier_name }}</td>
                                        <td>{{ trans('main.'.$supplier->supplier_category) }}</td>
                                        <td>{{floatval( $supplier->prev_balance  )}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(isset($total_balances) && !empty($total_balances))
                            <div class="col-lg-4 pull-right p-2">
                                <p class="alert alert-info alert-sm" dir="rtl">
                                    @if(App::getLocale() == 'ar')
                                        اجمالى مستحقات الموردين :
                                    @else
                                        suppliers total dues
                                    @endif
                                    {{floatval( $total_balances  )}} {{__('main.'.$currency)}}
                                </p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>

</script>
