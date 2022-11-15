@extends('client.layouts.app-main')
<style>

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
                    <div class="col-12 no-print">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-dark">
                            @if(App::getLocale() == 'ar')
                                كشف حساب الموظف
                            @else
                                Employee Summary
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix no-print"></div>
                    <hr class="no-print">
                    <form class="parsley-style-1 no-print" id="selectForm2" name="selectForm2"
                          action="{{route('employees.summary.post')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        اختر الموظف
                                    @else
                                        Choose Employee
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="employee_id" id="employee_id" class="selectpicker"
                                        data-style="btn-success" data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                    @endif
                                >
                                    <option
                                        @if(isset($employee_id) && $employee_id == "all")
                                        selected
                                        @endif
                                        value="all">
                                        @if(App::getLocale() == 'ar')
                                            كل الموظفين
                                        @else
                                            All Employees
                                        @endif
                                    </option>
                                    @foreach($employees as $employee)
                                        <option
                                            @if(isset($employee_id) && $employee_id == $employee->id)
                                            selected
                                            @endif
                                            value="{{$employee->id}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        من تاريخ
                                    @else
                                        From Date
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required type="date"
                                       @if(isset($from_date) && !empty($from_date))
                                       value="{{$from_date}}"
                                       @else
                                       value="{{date('Y-m-01')}}"
                                       @endif
                                       class="form-control" name="from_date"/>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        الى تاريخ
                                    @else
                                        To Date
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required
                                       @if(isset($to_date) && !empty($to_date))
                                       value="{{$to_date}}"
                                       @else
                                       value="{{date("Y-m-t", strtotime(date('Y-m-d')))}}"
                                       @endif
                                       type="date" class="form-control" name="to_date"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" name="submit" value="all" type="submit">
                                <i class="fa fa-check"></i>
                                @if(App::getLocale() == 'ar')
                                    عرض كشف الحساب
                                @else
                                    Show Summary
                                @endif
                            </button>
                            <button onclick="window.print()" type="button" class="btn btn-md btn-success">
                                <i class="fa fa-print"></i>
                                @if(App::getLocale() == 'ar')
                                    طباعة تقرير كشف الحساب
                                @else
                                    Print Employee Summary Report
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix no-print"></div>
                    <hr class="no-print"/>
                    @if(isset($employee_k))
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اسم الموظف
                                        @else
                                            Employee Name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اجمالى الرواتب
                                        @else
                                            total salary
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اجمالى الدفعات
                                        @else
                                            Total Paid
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اجمالى المتبقى
                                        @else
                                            Total Rest
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $employee_k->name }}</td>
                                    <td>
                                        <?php
                                        $date1 = $from_date;
                                        $date = new DateTime($to_date);
                                        $date->modify('+1 day');
                                        $date2 = $date->format('Y-m-d');
                                        $ts1 = strtotime($date1);
                                        $ts2 = strtotime($date2);
                                        $year1 = date('Y', $ts1);
                                        $year2 = date('Y', $ts2);
                                        $month1 = date('m', $ts1);
                                        $month2 = date('m', $ts2);
                                        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                                        $salary = $employee_k->salary;
                                        $total_salary = $salary * $diff;
                                        echo floatval($total_salary) . " " . trans('main.' . $currency);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $employees_cashs = \App\Models\EmployeeCash::where('employee_id', $employee_k->id)
                                            ->whereBetween('date', [$from_date, $to_date])
                                            ->get();
                                        $sum = 0;
                                        foreach ($employees_cashs as $cash) {
                                            $sum = $sum + $cash->amount;
                                        }
                                        echo $sum . " " . trans('main.' . $currency);
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $rest = $total_salary - $sum;
                                        if ($rest > 0) {
                                            if (App::getLocale() == 'ar') {
                                                echo " له " . $rest . " " . trans('main.' . $currency);
                                            } else {
                                                echo " creditor :  " . $rest . " " . trans('main.' . $currency);
                                            }
                                        } elseif ($rest < 0) {
                                            if (App::getLocale() == 'ar') {
                                                echo " عليه " . abs($rest) . " " . trans('main.' . $currency);
                                            } else {
                                                echo " debtor " . abs($rest) . " " . trans('main.' . $currency);
                                            }
                                        } else {
                                            echo "0";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    @if(isset($employees_k))
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
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
                                            اجمالى الرواتب
                                        @else
                                            Total Salary
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اجمالى الدفعات
                                        @else
                                            Total Paid
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            اجمالى المتبقى
                                        @else
                                            Total Rest
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($employees_k as $employee_k)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{ $employee_k->name }}</td>
                                        <td>
                                            <?php
                                            $date1 = $from_date;
                                            $date = new DateTime($to_date);
                                            $date->modify('+1 day');
                                            $date2 = $date->format('Y-m-d');
                                            $ts1 = strtotime($date1);
                                            $ts2 = strtotime($date2);
                                            $year1 = date('Y', $ts1);
                                            $year2 = date('Y', $ts2);
                                            $month1 = date('m', $ts1);
                                            $month2 = date('m', $ts2);
                                            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                                            $salary = $employee_k->salary;
                                            $total_salary = $salary * $diff;
                                            echo floatval($total_salary) . " " . $currency;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $employees_cashs = \App\Models\EmployeeCash::where('employee_id', $employee_k->id)
                                                ->whereBetween('date', [$from_date, $to_date])
                                                ->get();
                                            $sum = 0;
                                            foreach ($employees_cashs as $cash) {
                                                $sum = $sum + $cash->amount;
                                            }
                                            echo $sum . " " . $currency;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $rest = $total_salary - $sum;
                                            if ($rest > 0) {
                                                if (App::getLocale() == 'ar') {
                                                    echo " له " . $rest . " " . trans('main.' . $currency);
                                                } else {
                                                    echo " creditor :  " . $rest . " " . trans('main.' . $currency);
                                                }
                                            } elseif ($rest < 0) {
                                                if (App::getLocale() == 'ar') {
                                                    echo " عليه " . abs($rest) . " " . trans('main.' . $currency);
                                                } else {
                                                    echo " debtor " . abs($rest) . " " . trans('main.' . $currency);
                                                }
                                            } else {
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
