@extends('client.layouts.app-main')
<style>

</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success fade show">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger fade show">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                تحويل بين الخزن
                            @else
                                Transfer Between Safes
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.safes.transfer.post')}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        من خزنة
                                    @else
                                        From Safe
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required class="form-control selectpicker show-tick"
                                        data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif

                                        data-style="btn-danger"
                                        name="from_safe" id="">
                                    @foreach($safes as $safe)
                                        <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        الى خزنة
                                    @else
                                        To Safe
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required class="form-control selectpicker show-tick"
                                        data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif

                                        data-style="btn-info"
                                        name="to_safe" id="">
                                    @foreach($safes as $safe)
                                        <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        المبلغ
                                    @else
                                        Amount
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="amount" min="1" required/>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات ( السبب )
                                    @else
                                        Notes (Reason)
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input type="text" dir="rtl" class="form-control" name="reason"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" type="submit">
                                @if(App::getLocale() == 'ar')
                                    تحويل
                                @else
                                    Transfer
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix"></div>

                    @if(!$transfers->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات التحويل بين الخزن
                            @else
                                Transfers Between Safes
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover"
                                   id="example-table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            من خزنة
                                        @else
                                            From Safe
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الى خزنة
                                        @else
                                            To Safe
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المبلغ
                                        @else
                                            Amount
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            ملاحظات ( السبب )
                                        @else
                                            Notes (Reason)
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المسؤول
                                        @else
                                            User
                                        @endif
                                    </th>
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
                                @foreach ($transfers as $key => $transfer)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $transfer->fromSafe->safe_name }}</td>
                                        <td>{{ $transfer->toSafe->safe_name }}</td>
                                        <td>
                                            {{floatval($transfer->amount)}}
                                        </td>
                                        <td>{{ $transfer->reason }}</td>
                                        <td>{{ $transfer->client->name }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-danger delete_transfer"
                                               transfer_id="{{ $transfer->id }}"
                                               from_safe="{{ $transfer->fromSafe->safe_name }}"
                                               to_safe="{{ $transfer->toSafe->safe_name }}"
                                               amount="{{ $transfer->amount }}"
                                               data-toggle="modal"
                                               href="#modaldemo9"
                                            ><i class="fa fa-trash"></i>
                                                @if(App::getLocale() == 'ar')
                                                    حذف وتراجع
                                                @else
                                                    Delete & Undo
                                                @endif
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="modaldemo9">
        <div class="modal-dialog modal-dialog-centered" bank="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            حذف عملية
                        @else
                            Process Delete
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('client.safes.transfer.destroy') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>@if(App::getLocale() == 'ar')
                                هل انت متأكد من الحذف ؟
                            @else
                                Sure To Delete ?
                            @endif</p><br>
                        <input type="hidden" name="transferid" id="transferid">
                        <input class="form-control" name="amount" id="amount" type="text" readonly>
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
                                حذف وتراجع
                            @else
                                Delete & Undo
                            @endif
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.delete_transfer').on('click', function () {
            var transfer_id = $(this).attr('transfer_id');
            var from_safe = $(this).attr('from_safe');
            var to_safe = $(this).attr('to_safe');
            var amount = $(this).attr('amount');
            $('.modal-body #transferid').val(transfer_id);
            @if(App::getLocale() == 'ar')
            $('.modal-body #amount').val("من " + from_safe + " الى " + to_safe + " ( " + amount + " )");
            @else
            $('.modal-body #amount').val("from " + from_safe + " to " + to_safe + " ( " + amount + " )");
            @endif
        });
    });
</script>
