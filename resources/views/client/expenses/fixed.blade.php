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
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اضافة مصروف ثابت
                            @else
                                Add Fixed Expense
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.fixed.expenses.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        بيان المصروف الثابت
                                    @else
                                        Fixed Expense Details
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="fixed_expense" type="text">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" type="submit">
                                @if(App::getLocale() == 'ar')
                                    اضافة
                                @else
                                    Add
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix"></div>
                    @if(!$fixed_expenses->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                المصاريف الثابتة
                            @else
                                Fixed Expenses
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
                                            بيان المصروف الثابت
                                        @else
                                            Fixed Expense Details
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
                                @foreach ($fixed_expenses as $key => $fixed_expense)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $fixed_expense->fixed_expense}}</td>
                                        <td>{{ $fixed_expense->client->name }}</td>
                                        <td>
                                            <a href="{{ route('client.fixed.expenses.edit', $fixed_expense->id) }}"
                                               class="btn btn-sm btn-info" data-toggle="tooltip"
                                               data-placement="top">
                                                <i class="fa fa-edit"></i>
                                                @if(App::getLocale() == 'ar')
                                                    تعديل
                                                @else
                                                    Edit
                                                @endif
                                            </a>

                                            <a class="modal-effect btn btn-sm btn-danger delete_fixed_expense"
                                               fixed_expense_id="{{ $fixed_expense->id }}"
                                               fixed_expense="{{ $fixed_expense->fixed_expense}}"
                                               data-toggle="modal"
                                               href="#modaldemo9">
                                                <i class="fa fa-trash"></i>
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
        <div class="modal-dialog modal-dialog-centered" fixed_expense="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header text-center">
                    <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                        @if(App::getLocale() == 'ar')
                            حذف مصروف ثابت
                        @else
                            Delete Fixed Expense
                        @endif
                         </h6>
                    <button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{ route('client.fixed.expenses.destroy', 'test') }}" method="post">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>@if(App::getLocale() == 'ar')
                                هل انت متأكد من الحذف ؟
                            @else
                                Sure To Delete ?
                            @endif</p><br>
                        <input type="hidden" name="fixed_expenseid" id="fixed_expenseid">
                        <input class="form-control" name="fixed_expensename" id="fixed_expensename" type="text"
                               readonly>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">@if(App::getLocale() == 'ar')
                                الغاء
                            @else
                                Cancel
                            @endif</button>
                        <button type="submit" class="btn btn-danger">حذف وتراجع</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('.delete_fixed_expense').on('click', function () {
            var fixed_expense_id = $(this).attr('fixed_expense_id');
            var fixed_expense_name = $(this).attr('fixed_expense');
            $('.modal-body #fixed_expenseid').val(fixed_expense_id);
            $('.modal-body #fixed_expensename').val(fixed_expense_name);
        });
    });
</script>
