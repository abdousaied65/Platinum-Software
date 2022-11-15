@extends('client.layouts.app-main')
<style>
</style>
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">

            @if (count($errors) > 0)
                <div class="alert alert-danger">
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

            <div class="card">
                <div class="card-body">
                    <div class="col-lg-12 margin-tb">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                تعديل بيانات المستخدم
                            @else
                                Edit User Details
                            @endif
                        </h5>
                        <div class="clearfix"></div>
                    </div>
                    <br>
                    {!! Form::model($client, ['method' => 'PATCH','route' => ['client.clients.update', $client->id]]) !!}
                    <div class="row mb-3 mt-3">
                        <div class="parsley-input col-md-4" id="fnWrapper">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    اسم المستخدم
                                @else
                                    User Name
                                @endif
                                <span class="tx-danger">*</span></label>
                            {!! Form::text('name', null, array('class' => 'form-control','required')) !!}
                        </div>

                        <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    البريد الالكترونى
                                @else
                                    Email
                                @endif
                                <span class="tx-danger">*</span></label>
                            {!! Form::text('email', null, array('class' => 'form-control text-left','dir'=>'ltr','required')) !!}
                        </div>
                        <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label class="form-label">
                                @if(App::getLocale() == 'ar')
                                    الحالة
                                @else
                                    Status
                                @endif
                                 </label>
                            <select name="Status" id="select-beast" class="form-control">
                                <option value="active"
                                        @if ($client->Status == 'active')
                                        selected
                                    @endif
                                >
                                    @if(App::getLocale() == 'ar')
                                        مفعل
                                    @else
                                        Active
                                    @endif
                                </option>
                                <option value="blocked"
                                        @if ($client->Status == 'blocked')
                                        selected
                                    @endif
                                >
                                    @if(App::getLocale() == 'ar')
                                        معطل
                                    @else
                                        Blocked
                                    @endif
                                </option>

                            </select>
                        </div>
                    </div>

                    <div class="row  mb-3 mt-3">
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    كلمة المرور
                                @else
                                    Password
                                @endif
                                <span class="tx-danger">*</span></label>
                            {!! Form::password('password', array('class' => 'form-control','required')) !!}
                        </div>

                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    تأكيد كلمة المرور
                                @else
                                    Password Confirm
                                @endif
                                <span class="tx-danger">*</span></label>
                            {!! Form::password('confirm-password', array('class' => 'form-control','required')) !!}
                        </div>
                        <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>
                                @if(App::getLocale() == 'ar')
                                    الصلاحية
                                @else
                                    Role
                                @endif
                                 </label>
                            {!! Form::select('role_name[]', $roles,$clientRole,
                                        array('required','id'=>'role_name','class' => 'selectpicker form-control','data-live-search' => 'true','data-style'=>'btn-info'
                                        ,'title' => 'Choose Privileges',)
                                    )
                                    !!}
                        </div>

                        <div class="col-md-3 mg-t-20 mg-md-t-0 branch"
                             @if(in_array('مديرالنظام',$client->role_name))
                             style="display: none"
                            @endif
                        >
                            <label class="form-label">
                                @if(App::getLocale() == 'ar')
                                    اختر الفرع
                                @else
                                    Choose Branch
                                @endif
                            </label>
                            <select id="branch_id" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                    @endif

                                    data-style="btn-danger"
                                    class="form-control selectpicker show-tick" name="branch_id">
                                @foreach($branches as $branch)
                                    <option
                                        @if($branch->id == $client->branch_id)
                                        selected
                                        @endif
                                        value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="col-lg-12 text-center mt-3 mb-3">
                        <button class="btn btn-info btn-md pd-x-20" type="submit">
                            @if(App::getLocale() == 'ar')
                                تحديث
                            @else
                                Update
                            @endif
                            </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- main-content closed -->
@endsection

<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $('#role_name').on('change', function () {
            var role_name = $(this).val();
            $('#branch_id').val("");
            $('#branch_id').selectpicker('refresh');
            if (role_name != "مدير النظام") {
                $('.branch').show();
            } else {
                $('.branch').hide();
            }
        });
    });
</script>

