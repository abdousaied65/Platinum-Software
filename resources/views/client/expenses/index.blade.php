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
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <h5 class="pull-right alert alert-sm alert-success">
                                @if(App::getLocale() == 'ar')
                                    عرض كل المصاريف
                                @else
                                    Show All Expenses
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
                                        رقم المصروف
                                    @else
                                        Expense Number
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        تفاصيل المصروف
                                    @else
                                        Expense Details
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        نوع المصروف
                                    @else
                                        Expense Type
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
                                        الموظف
                                    @else
                                        Employee
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        صورة المصروف
                                    @else
                                        Expense Picture
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        خزنة الدفع
                                    @else
                                        Payment Safe
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        بنك الدفع
                                    @else
                                        Payment Bank
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        Notes
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
                            @foreach ($expenses as $key => $expense)
                                <tr>
                                    <td>{{ $expense->expense_number }}</td>
                                    <td>{{ $expense->expense_details }}</td>
                                    <td>{{ $expense->fixed->fixed_expense}}</td>
                                    <td>{{floatval( $expense->amount  )}}</td>
                                    <td>
                                        @if(!empty($expense->employee_id))
                                            {{$expense->employee->name}}
                                        @endif
                                    </td>
                                    <td>
                                        <img data-toggle="modal" href="#modaldemo8"
                                             src="{{asset($expense->expense_pic)}}"
                                             style="width:50px; height: 50px;cursor:pointer;"
                                             alt=""/>
                                    </td>
                                    <td>
                                        @if(!empty($expense->safe_id))
                                            {{ $expense->safe->safe_name }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!empty($expense->bank_id))
                                            {{ $expense->bank->bank_name }}
                                        @endif
                                    </td>
                                    <td>{{ $expense->notes }}</td>
                                    <td>{{ $expense->client->name }}</td>
                                    <td>
                                        <a href="{{ route('client.expenses.edit', $expense->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger delete_expense"
                                           expense_id="{{ $expense->id }}"
                                           expense_details="{{ $expense->expense_details }}" data-toggle="modal"
                                           href="#modaldemo9">
                                            <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal effects -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100"
                            style="font-family: 'Cairo'; ">
                            @if(App::getLocale() == 'ar')
                                عرض صورة المصروف
                            @else
                                Expense Picture Preview
                            @endif
                             </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <img id="image_larger" alt="image" style="width: 100%; "/>
                    </div>
                    <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-sm btn-danger"><i class="fa fa-colse"></i> Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" expense="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                            @if(App::getLocale() == 'ar')
                                حذف مصروف
                            @else
                                Delete Expense
                            @endif
                            </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('client.expenses.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>@if(App::getLocale() == 'ar')
                                    هل انت متأكد من الحذف ؟
                                @else
                                    Sure To Delete ?
                                @endif</p><br>
                            <input type="hidden" name="expenseid" id="expenseid">
                            <input class="form-control" name="expensedetails" id="expensedetails" type="text" readonly>
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
        $('.delete_expense').on('click', function () {
            var expense_id = $(this).attr('expense_id');
            var expense_details = $(this).attr('expense_details');
            $('.modal-body #expenseid').val(expense_id);
            $('.modal-body #expensedetails').val(expense_details);
        });
        $('img').on('click', function () {
            var image_larger = $('#image_larger');
            var path = $(this).attr('src');
            $(image_larger).prop('src', path);
        });
    });
</script>
