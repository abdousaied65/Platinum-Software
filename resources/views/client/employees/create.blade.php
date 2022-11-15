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
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اضافة موظف جديد
                            @else
                                Add New Employee
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.employees.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم الموظف
                                    @else
                                        Employee Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="name" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        تاريخ الميلاد
                                    @else
                                        Date of Birth
                                    @endif
                                </label>
                                <input class="form-control" dir="ltr" name="birth_date" type="date">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        الوظيفة
                                    @else
                                        Job
                                    @endif
                                </label>
                                <input dir="rtl" class="form-control" name="job" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        السجل المدنى
                                    @else
                                        Civil Record
                                    @endif
                                </label>
                                <input dir="ltr" class="form-control" name="civil_registry" type="text">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        العنوان
                                    @else
                                        Address
                                    @endif
                                </label>
                                <input dir="rtl" class="form-control" name="address" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        الهاتف
                                    @else
                                        Phone
                                    @endif
                                </label>
                                <input class="form-control" dir="ltr" name="phone_number" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        البريد الالكترونى
                                    @else
                                        Email
                                    @endif
                                </label>
                                <input dir="ltr" class="form-control" name="email" type="email">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        المرتب
                                    @else
                                        Salary
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input required dir="ltr" class="form-control" name="salary" type="text">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        الدفع بالساعة
                                    @else
                                        Hourly Paying
                                    @endif
                                </label>
                                <input type="checkbox" name="works_by_the_hour"/>
                                @if(App::getLocale() == 'ar')
                                    يعمل بالساعة
                                @else
                                    per hour
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        عدد الساعات فى اليوم
                                    @else
                                        number of hours per day
                                    @endif
                                </label>
                                <input class="form-control" dir="ltr" name="number_of_hours_per_day" type="text">
                            </div>
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        ثمن الساعة
                                    @else
                                        Hour Price
                                    @endif
                                </label>
                                <input dir="ltr" class="form-control" name="hourly_price" type="text">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        يوم بداية العمل
                                    @else
                                        Start Day
                                    @endif
                                </label>
                                <select name="work_start_date" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر يوم
                                        @else
                                            Choose Day
                                        @endif
                                    </option>
                                    <option value="Saturday">
                                        @if(App::getLocale() == 'ar')
                                            السبت
                                        @else
                                            Saturday
                                        @endif
                                    </option>
                                    <option value="Sunday">
                                        @if(App::getLocale() == 'ar')
                                            الاحد
                                        @else
                                            Sunday
                                        @endif
                                    </option>
                                    <option value="Monday">
                                        @if(App::getLocale() == 'ar')
                                            الاثنين
                                        @else
                                            Monday
                                        @endif
                                    </option>
                                    <option value="Tuesday">
                                        @if(App::getLocale() == 'ar')
                                            الثلاثاء
                                        @else
                                            Tuesday
                                        @endif
                                    </option>
                                    <option value="Wednesday">
                                        @if(App::getLocale() == 'ar')
                                            الاربعاء
                                        @else
                                            Wednesday
                                        @endif
                                    </option>
                                    <option value="Thursday">
                                        @if(App::getLocale() == 'ar')
                                            الخميس
                                        @else
                                            Thursday
                                        @endif
                                    </option>
                                    <option value="Friday">
                                        @if(App::getLocale() == 'ar')
                                            الجمعة
                                        @else
                                            Friday
                                        @endif
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        يوم نهاية العمل
                                    @else
                                        End Day
                                    @endif
                                </label>
                                <select name="work_end_date" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر يوم
                                        @else
                                            Choose Day
                                        @endif
                                    </option>
                                    <option value="Saturday">
                                        @if(App::getLocale() == 'ar')
                                            السبت
                                        @else
                                            Saturday
                                        @endif
                                    </option>
                                    <option value="Sunday">
                                        @if(App::getLocale() == 'ar')
                                            الاحد
                                        @else
                                            Sunday
                                        @endif
                                    </option>
                                    <option value="Monday">
                                        @if(App::getLocale() == 'ar')
                                            الاثنين
                                        @else
                                            Monday
                                        @endif
                                    </option>
                                    <option value="Tuesday">
                                        @if(App::getLocale() == 'ar')
                                            الثلاثاء
                                        @else
                                            Tuesday
                                        @endif
                                    </option>
                                    <option value="Wednesday">
                                        @if(App::getLocale() == 'ar')
                                            الاربعاء
                                        @else
                                            Wednesday
                                        @endif
                                    </option>
                                    <option value="Thursday">
                                        @if(App::getLocale() == 'ar')
                                            الخميس
                                        @else
                                            Thursday
                                        @endif
                                    </option>
                                    <option value="Friday">
                                        @if(App::getLocale() == 'ar')
                                            الجمعة
                                        @else
                                            Friday
                                        @endif
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        حالة العمل
                                    @else
                                        Work Status
                                    @endif
                                     <span class="text-danger">*</span></label>
                                <input type="radio" checked name="work_status" value="working"/>
                                @if(App::getLocale() == 'ar')
                                    يعمل
                                @else
                                    Working
                                @endif
                                <br>
                                <input type="radio" name="work_status" value="quit"/>
                                @if(App::getLocale() == 'ar')
                                    قدم استقالته
                                @else
                                    Quit - Retired
                                @endif
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
                </div>
            </div>
        </div>
    </div>
@endsection
