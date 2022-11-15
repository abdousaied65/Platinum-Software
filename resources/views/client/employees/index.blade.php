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
                                    عرض كل الموظفين
                                @else
                                    Show All Employees
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
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        اسم الموظف
                                    @else
                                        Employee Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الهاتف
                                    @else
                                        Phone
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        المرتب
                                    @else
                                        Salary
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        حالة العمل
                                    @else
                                        Work Status
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
                            @foreach ($employees as $key => $employee)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $employee->name}}</td>
                                    <td>{{ $employee->phone_number}}</td>
                                    <td>{{ $employee->salary}}</td>
                                    <td>
                                        @if($employee->work_status == "working")
                                            <span class="badge badge-success">
                                                @if(App::getLocale() == 'ar')
                                                    يعمل
                                                @else
                                                    Working
                                                @endif
                                            </span>
                                        @elseif($employee->work_status == "quit")
                                            <span class="badge badge-danger">
                                            @if(App::getLocale() == 'ar')
                                                قدم استقالته
                                            @else
                                                Quit - Retired
                                            @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('client.employees.edit', $employee->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger delete_employee"
                                           employee_id="{{ $employee->id }}"
                                           employee_name="{{ $employee->name }}" data-toggle="modal" href="#modaldemo9"
                                        ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" employee="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                            @if(App::getLocale() == 'ar')
                                حذف موظف
                            @else
                                Delete Employee
                            @endif
                        </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('client.employees.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>
                                @if(App::getLocale() == 'ar')
                                    هل انت متأكد من الحذف ؟
                                @else
                                    Sure To Delete ?
                                @endif
                            </p><br>
                            <input type="hidden" name="employeeid" id="employeeid">
                            <input class="form-control" name="employeename" id="employeename" type="text" readonly>
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
        $('.delete_employee').on('click', function () {
            var employee_id = $(this).attr('employee_id');
            var employee_name = $(this).attr('employee_name');
            $('.modal-body #employeeid').val(employee_id);
            $('.modal-body #employeename').val(employee_name);
        });
    });
</script>
