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
    @if (session('error'))
        <div class="alert alert-danger text-center">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('error') }}
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
                                    عرض العملاء الحاليين
                                @else
                                    Show All Clients
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
                                        مديونية
                                    @else
                                        Debts
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
                            @foreach ($outer_clients as $key => $outer_client)
                                <tr>
                                    <td>{{ $outer_client->client_name }}</td>
                                    <td>{{ trans('main.'.$outer_client->client_category) }}</td>
                                    <td dir="ltr">
                                        @if(!$outer_client->phones->isEmpty())
                                            {{$outer_client->phones[0]->client_phone}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!$outer_client->addresses->isEmpty())
                                            {{$outer_client->addresses[0]->client_address}}
                                        @endif
                                    </td>
                                    <td>{{$outer_client->tax_number}}</td>
                                    <td>{{$outer_client->shop_name}}</td>
                                    <td>
                                        @if($outer_client->prev_balance > 0 )

                                            @if(App::getLocale() == 'ar')
                                                عليه
                                            @else
                                                Debtor
                                            @endif

                                            {{floatval($outer_client->prev_balance)}}

                                        @elseif($outer_client->prev_balance < 0)
                                            @if(App::getLocale() == 'ar')
                                                له
                                            @else
                                                Creditor
                                            @endif

                                            {{floatval(abs($outer_client->prev_balance))}}
                                        @else
                                            0
                                        @endif
                                    </td>
                                    <td style="width: 20% !important;">
                                        <a href="{{ route('client.outer_clients.show', $outer_client->id) }}"
                                           class="btn btn-sm btn-success" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-eye"></i></a>

                                        <a href="{{ route('client.outer_clients.edit', $outer_client->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger delete_client"
                                           client_id="{{ $outer_client->id }}"
                                           client_name="{{ $outer_client->client_name }}" data-toggle="modal"
                                           href="#modaldemo9"
                                        ><i
                                                class="fa fa-trash"></i></a>
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
                        اجمالى مديونيات العملاء :
                    @else
                        Total Customer debts
                    @endif
                    @if($total_balances > 0 )
                        @if(App::getLocale() == 'ar')
                            عليهم
                        @else
                            Debtor
                        @endif
                        {{floatval($total_balances)}}
                    @elseif($total_balances < 0)
                        @if(App::getLocale() == 'ar')
                            لهم
                        @else
                            Creditor
                        @endif
                        {{floatval(abs($total_balances))}}
                    @else
                        0
                    @endif
                </p>
            </div>
            <div class="col-lg-4 pull-right p-2">
                <a href="{{route('client.outer_clients.print')}}" target="_blank" role="button"
                   class="btn-danger btn btn-md" dir="rtl">
                    <i class="fa fa-print"></i>
                    @if(App::getLocale() == 'ar')
                        طباعة كل العملاء
                    @else
                        Print All Clients
                    @endif
                </a>
            </div>

            <div class="clearfix"></div>
            <hr>
            <form class="d-inline" action="{{ route('outer_clients.import') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6 pull-right p-1" style="border-left: 1px solid #ccc">
                        <a href="javascript:;" class="text-danger open_box">
                            <i class="fa fa-plus"></i>
                            @if(App::getLocale() == 'ar')
                                تعليمات استيراد العملاء :
                            @else
                                Customer Import Instructions:
                            @endif
                        </a>
                        <div class="box mt-2 mb-2" style="display: none;">
                            <ul>
                                @if(App::getLocale() == 'ar')
                                    <li>
                                        ان يكون الملف اكسيل فقط وامتداده .xlsx
                                    </li>
                                    <li>
                                        لا يحتوى على heading row او مايسمى صف عناوين الاعمدة
                                    </li>
                                    <li>
                                        تجنب وجود صفوف فارغة او خالية من البيانات قدر الامكان
                                    </li>
                                    <li>
                                        اول عمود مخصص لاسم العميل
                                    </li>
                                    <li>
                                        ثانى عمود مخصص لمستحقات العميل
                                    </li>
                                @else
                                    <li>
                                        The file should be Excel only and the extension .xlsx
                                    </li>
                                    <li>
                                        Does not contain heading row
                                    </li>
                                    <li>
                                        Avoid having empty rows or empty data as much as possible
                                    </li>
                                    <li>
                                        The first column is dedicated to the name of the customer
                                    </li>
                                    <li>
                                        The second column is dedicated to customer entitlements
                                    </li>

                                @endif

                            </ul>
                            <p>
                                @if(App::getLocale() == 'ar')
                                    مرفق صورة توضيحية لشكل الملف من الداخل
                                @else
                                    Attached is a picture of the inside of the file
                                @endif
                                <br>
                                <br>
                                <img style="width: 100%;border-radius: 5px; padding: 5px;border: 1px solid #000;"
                                     src="{{asset('images/clients.png')}}" alt="">
                            </p>
                        </div>
                        <label class="d-block mt-2" for="">
                            @if(App::getLocale() == 'ar')
                                استيراد البيانات
                            @else
                                Import Data
                            @endif
                        </label>
                        <input accept=".xlsx" required type="file" name="file" class="form-control">
                        <br>
                        <button class="btn btn-success">
                            @if(App::getLocale() == 'ar')
                                اضغط هنا للاستيراد
                            @else
                                Click Here To Import
                            @endif
                        </button>
                    </div>
                    <div class="col-lg-6 pull-left p-1">
                        <label class="d-block" for="">
                            @if(App::getLocale() == 'ar')
                                تصدير البيانات
                            @else
                                Export Data
                            @endif
                        </label>
                        <a class="btn btn-warning" href="{{ route('outer_clients.export') }}">
                            @if(App::getLocale() == 'ar')
                                اضغط هنا للتصدير
                            @else
                                Click To Export
                            @endif
                        </a>
                    </div>
                </div>
            </form>
            <div class="clearfix"></div>
            <hr>

        </div>

        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" client="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                            @if(App::getLocale() == 'ar')
                                حذف عميل
                            @else
                                Delete Client
                            @endif
                        </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('client.outer_clients.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>@if(App::getLocale() == 'ar')
                                    هل انت متأكد من الحذف ؟
                                @else
                                    Sure To Delete ?
                                @endif</p><br>
                            <input type="hidden" name="clientid" id="clientid">
                            <input class="form-control" name="clientname" id="clientname" type="text" readonly>
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
        $('.delete_client').on('click', function () {
            var client_id = $(this).attr('client_id');
            var client_name = $(this).attr('client_name');
            $('.modal-body #clientid').val(client_id);
            $('.modal-body #clientname').val(client_name);
        });

        $('.open_box').on('click', function () {
            $('.box').toggle();
        });
    });
</script>
