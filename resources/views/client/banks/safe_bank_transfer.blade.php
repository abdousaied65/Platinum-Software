@extends('client.layouts.app-main')
<style>
    .bootstrap-select {
        width: 80% !important;
    }
</style>
@section('content')

    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>الاخطاء :</strong>
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
                                التحويل من خزنة الى بنك
                            @else
                                Transfer From Safe To Bank
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.safe.bank.transfer.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        الخزنة
                                    @else
                                        Safe
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required class="form-control selectpicker show-tick"
                                        data-style="btn-info" data-live-search="true"
                                        name="safe_id">
                                    @foreach($safes as $safe)
                                        <option value="{{$safe->id}}">{{$safe->safe_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.safes.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-info open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        البنك
                                    @else
                                        Bank
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required class="form-control selectpicker show-tick"
                                        data-style="btn-danger" data-live-search="true"
                                        name="bank_id">
                                    @foreach($banks as $bank)
                                        <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.banks.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-danger open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        المبلغ
                                    @else
                                        Amount
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="ltr" required class="form-control" name="amount" type="text">
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        سبب العملية
                                    @else
                                        Process Reason
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="reason" type="text">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" type="submit">
                                @if(App::getLocale() == 'ar')
                                    حفظ
                                @else
                                    Save
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix"></div>

                    @if(!$safe_bank_transfer->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات التحويل من خزنة الى بنك
                            @else
                                Transfers From Safe To Bank
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
                                            الخزنة
                                        @else
                                            Safe
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            البنك
                                        @else
                                            Bank
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
                                            السبب
                                        @else
                                            Reason
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المسؤول
                                        @else
                                            User
                                        @endif
                                    </th>
                                    <th class="text-center">
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
                                @foreach ($safe_bank_transfer as $key => $transfer)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $transfer->safe->safe_name }}</td>
                                        <td>{{ $transfer->bank->bank_name }}</td>
                                        <td>
                                            {{floatval($transfer->amount)}}
                                        </td>
                                        <td>{{ $transfer->reason }}</td>
                                        <td>{{ $transfer->client->name }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-danger delete_transfer"
                                               transfer_id="{{ $transfer->id }}"
                                               amount="{{ $transfer->amount }}"
                                               data-toggle="modal"
                                               href="#modaldemo9"
                                               title="delete"><i
                                                    class="fa fa-trash"></i>
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
                <form action="{{ route('client.safe.bank.transfer.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>
                            @if(App::getLocale() == 'ar')
                                هل انت متأكد من الحذف ؟
                            @else
                                Sure To delete ?
                            @endif
                            </p><br>
                        <input type="hidden" name="transferid" id="transferid">
                        <input class="form-control" name="bankname" id="bankname" type="text" readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            @if(App::getLocale() == 'ar')
                                الغاء
                            @else
                                Cancel
                            @endif
                        </button>
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
            var amount = $(this).attr('amount');
            $('.modal-body #transferid').val(transfer_id);
            $('.modal-body #bankname').val(amount);
        });
    });
</script>
