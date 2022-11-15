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
                                سحب وايداع نقدى
                            @else
                                Withdraw & Deposit
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.banks.process.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        نوع العملية
                                    @else
                                        Process Type
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="process_type" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر نوع العملية
                                        @else
                                            Choose Process Type
                                        @endif
                                    </option>
                                    <option value="withdrawal">
                                        @if(App::getLocale() == 'ar')
                                            سحب نقدى
                                        @else
                                            withdrawal
                                        @endif
                                    </option>
                                    <option value="deposit">
                                        @if(App::getLocale() == 'ar')
                                            ايداع نقدى
                                        @else
                                            deposit
                                        @endif
                                    </option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم البنك
                                    @else
                                        Bank Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required class="form-control selectpicker show-tick"
                                        data-style="btn-danger" data-live-search="true" name="bank_id">
                                    @foreach($banks as $bank)
                                        <option value="{{$bank->id}}">{{$bank->bank_name}}</option>
                                    @endforeach
                                </select>
                                <a target="_blank" href="{{route('client.banks.create')}}" role="button"
                                   style="width: 15%;display: inline;"
                                   class="btn btn-sm btn-warning open_popup">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>

                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        المبلغ
                                    @else
                                        Amount
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="ltr" required class="form-control" name="amount" type="text">
                            </div>

                            <div class="col-md-3">
                                <label>
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

                    @if(!$banks_process->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات السحب والايداع على البنوك
                            @else
                                Withdraw & deposit processes
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
                                            نوع العملية
                                        @else
                                            Process Type
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم البنك
                                        @else
                                            Bank Name
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
                                            رصيد ما قبل
                                        @else
                                            Balance Before
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رصيد ما بعد
                                        @else
                                            Balance After
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
                                            control
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($banks_process as $key => $process)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>
                                            @if($process->process_type == "withdrawal")
                                                @if(App::getLocale() == 'ar')
                                                    سحب نقدى
                                                @else
                                                    withdraw
                                                @endif
                                            @elseif($process->process_type == "deposit")
                                                @if(App::getLocale() == 'ar')
                                                    ايداع نقدى
                                                @else
                                                    Deposit
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $process->bank->bank_name }}</td>
                                        <td>
                                            {{floatval($process->amount)}}
                                        </td>
                                        <td>
                                            {{floatval($process->balance_before)}}
                                        </td>
                                        <td>
                                            {{floatval($process->balance_after)}}
                                        </td>
                                        <td>{{ $process->reason }}</td>
                                        <td>{{ $process->client->name }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-danger delete_process"
                                               process_id="{{ $process->id }}"
                                               bank_name="{{ $process->bank->bank_name }}"
                                               amount="{{ $process->amount }}"
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
                            Delete Process
                        @endif
                    </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('client.banks.process.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>
                            @if(App::getLocale() == 'ar')
                                هل انت متأكد من الحذف ؟
                            @else
                                Are You Sure You Want To delete ?
                            @endif
                           </p><br>
                        <input type="hidden" name="processid" id="processid">
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
        $('.delete_process').on('click', function () {
            var process_id = $(this).attr('process_id');
            var bank_name = $(this).attr('bank_name');
            var amount = $(this).attr('amount');
            $('.modal-body #processid').val(process_id);
            $('.modal-body #bankname').val(bank_name + " ( " + amount + " )");
        });
    });
</script>
