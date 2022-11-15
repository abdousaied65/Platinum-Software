@extends('client.layouts.app-main')
<style>

</style>
@section('content')
    <!-- main-content closed -->
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Errors :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                اضافة مستخدم جديد
                            @else
                                add new user
                            @endif
                        </h5>
                    </div>
                </div>
                <div class="card-body p-1 m-1">
                    <form action="{{route('client.clients.store')}}" method="post">
                        {{csrf_field()}}
                        <div class="row m-t-3 mb-3">
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم المستخدم
                                    @else
                                        user name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input class="form-control mg-b-20" name="name" required type="text">
                            </div>
                            <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        البريد الالكترونى
                                    @else
                                        Email
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input class="form-control  mg-b-20" style="text-align: left;direction:ltr;"
                                       data-parsley-class-handler="#lnWrapper" name="email" required=""
                                       type="email">
                            </div>
                            <div class="parsley-input col-md-4 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label class="form-label">
                                    @if(App::getLocale() == 'ar')
                                        الحالة
                                    @else
                                        Status
                                    @endif
                                </label>
                                <select name="Status" id="select-beast"
                                        class="form-control">
                                    <option selected value="active">
                                        @if(App::getLocale() == 'ar')
                                            مفعل
                                        @else
                                            Active
                                        @endif
                                    </option>
                                    <option value="blocked">
                                        @if(App::getLocale() == 'ar')
                                            معطل
                                        @else
                                            Blocked
                                        @endif
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row m-t-3 mb-3">
                            <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        كلمة المرور
                                    @else
                                        Password
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input class="form-control  mg-b-20" style="text-align: left;direction:ltr;"
                                       data-parsley-class-handler="#lnWrapper"
                                       name="password" required="" type="password">
                            </div>
                            <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        تأكيد كلمة المرور
                                    @else
                                        Password Confirm
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input class="form-control  mg-b-20" style="text-align: left;direction:ltr;"
                                       data-parsley-class-handler="#lnWrapper"
                                       name="confirm-password" required="" type="password">
                            </div>
                            <div class="parsley-input col-md-3 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label class="form-label">
                                    @if(App::getLocale() == 'ar')
                                        الصلاحية
                                    @else
                                        Role
                                    @endif
                                </label>
                                <select id="role_name" data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif
                                        data-style="btn-info"
                                        class="form-control selectpicker" required name="role_name[]">
                                    @foreach($roles as $role)
                                        <option value="{{$role}}">{{$role}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 mg-t-20 mg-md-t-0 branch" style="display: none;">
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
                                        <option value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
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
