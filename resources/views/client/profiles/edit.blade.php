@extends('client.layouts.app-main')
<!-- Internal Data table css -->
<style>

    [role='combobox'] {
        left: -90px !important;
        width: 220px;
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
            <strong>Errors :</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- row -->
    <div id="form-control-repeater">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-family: 'Cairo';" id="tel-repeater">
                            @if(App::getLocale() == 'ar')
                                البيانات الاساسية
                            @else
                                Basic Data
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="la la-minus"></i></a></li>
                                <li><a data-action="reload"><i class="la la-refresh"></i></a></li>
                                <li><a data-action="expand"><i class="la la-expand"></i></a></li>
                                <li><a data-action="close"><i class="la la-close"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::model($user, ['method' => 'PATCH','class'=> 'row','route' => ['client.profile.update', Auth::user()->id ]]) !!}
                            <div class="form-group col-lg-6 mb-2">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        الاسم
                                    @else
                                        Name
                                    @endif
                                </label>
                                <input type="text" class="form-control" required value="{{ Auth::user()->name }}"
                                       name="name">
                            </div>
                            <div class="form-group col-lg-6 mb-2">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        البريد الالكترونى
                                    @else
                                        Email
                                    @endif
                                </label>
                                <input type="text" class="form-control text-left" dir="ltr" required
                                       value="{{ Auth::user()->email }}" name="email">
                            </div>

                            <div class="form-group col-lg-6 mb-2">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        كلمة المرور
                                    @else
                                        Password
                                    @endif
                                </label>
                                <input type="password" class="form-control" style="text-align: left;" dir="ltr" required
                                       name="password">
                            </div>
                            <div class="form-group col-lg-6 mb-2">
                                <label for="">
                                    @if(App::getLocale() == 'ar')
                                        تاكيد كلمة المرور
                                    @else
                                        Confirm Password
                                    @endif
                                </label>
                                <input type="password" class="form-control" style="text-align: left;" dir="ltr" required
                                       name="confirm-password">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12 text-center">
                                <button type="reset" name="reset" class="btn btn-info btn-sm">
                                    <i class="la la-refresh"></i>
                                    @if(App::getLocale() == 'ar')
                                        اعادة ضبط
                                    @else
                                        Reset
                                    @endif
                                </button>
                                <button type="submit" name="submit" class="btn btn-success btn-sm">
                                    <i class="la la-check"></i>
                                    @if(App::getLocale() == 'ar')
                                        تحديث البيانات
                                    @else
                                        Update
                                    @endif
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-family: 'Cairo';" id="tel-repeater">
                            @if(App::getLocale() == 'ar')
                                البيانات الشخصية
                            @else
                                Personal Data
                            @endif
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="la la-minus"></i></a></li>
                                <li><a data-action="reload"><i class="la la-refresh"></i></a></li>
                                <li><a data-action="expand"><i class="la la-expand"></i></a></li>
                                <li><a data-action="close"><i class="la la-close"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-content collapse show">
                        <div class="card-body">
                            {!! Form::model($user, ['method' => 'PATCH','class'=> 'row','enctype' => 'multipart/form-data','route' => ['client.profile.store', Auth::user()->id ]]) !!}

                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-6 pull-right">
                                    <label>
                                        @if(App::getLocale() == 'ar')
                                            النوع :
                                        @else
                                            Gender :
                                        @endif
                                        <span class="text-danger">*</span></label>
                                    <select required name="gender" id="select-beast" class="form-control">
                                        <option value="">
                                            @if(App::getLocale() == 'ar')
                                                حدد النوع
                                            @else
                                                Choose Gender
                                            @endif
                                        </option>
                                        <option @if($profile->gender == "male")
                                                selected
                                                @endif value="male">
                                            @if(App::getLocale() == 'ar')
                                                ذكر
                                            @else
                                                Male
                                            @endif
                                        </option>
                                        <option @if($profile->gender == "female")
                                                selected
                                                @endif value="female">
                                            @if(App::getLocale() == 'ar')
                                                انثى
                                            @else
                                                Female
                                            @endif
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-6 pull-right">
                                    <label class="form-label d-block">
                                        @if(App::getLocale() == 'ar')
                                            العمر
                                        @else
                                            Age
                                        @endif
                                        <span class="text-danger">*</span></label>
                                    <input value="{{$profile->age}}" type="text" min="1" required max="100" name="age"
                                           class="form-control">
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <div class="col-lg-12 mb-3">
                                <div class="col-lg-6 pull-right">
                                    <label class="form-label d-block">
                                        @if(App::getLocale() == 'ar')
                                            المدينة
                                        @else
                                            City
                                        @endif
                                        <span
                                            class="text-danger">*</span></label>
                                    <input value="{{$profile->city_name}}" type="text" required name="city_name"
                                           class="form-control">
                                </div>
                                <div class="col-lg-6 pull-right">
                                    <label for="">
                                        @if(App::getLocale() == 'ar')
                                            الصورة الشخصية
                                        @else
                                            Profile Picture
                                        @endif
                                    </label>
                                    <input accept=".jpg,.png,.jpeg" type="file"
                                           oninput="pic.src=window.URL.createObjectURL(this.files[0])" id="file"
                                           name="profile_pic" class="form-control">
                                </div>
                            </div>

                            <div class="col-lg-12 text-center mb-2">
                                <label for="" class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        معاينة الصورة
                                    @else
                                        Picture Preview
                                    @endif
                                </label>
                                <img id="pic" src="{{asset($profile->profile_pic)}}"
                                     style="width: 100px; height:100px;"/>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="col-lg-12 text-center">
                                <button type="reset" name="reset" id="reset-btn" class="btn btn-info btn-sm">
                                    <i class="la la-refresh"></i>
                                    @if(App::getLocale() == 'ar')
                                        اعادة ضبط
                                    @else
                                        Reset
                                    @endif
                                </button>
                                <button type="submit" name="submit" class="btn btn-success btn-sm">
                                    <i class="la la-check"></i>
                                    @if(App::getLocale() == 'ar')
                                        تحديث البيانات
                                    @else
                                        Update
                                    @endif
                                </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('app-assets/js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#reset-btn').on('click', function () {
                var $image = $('#pic');
                $image.removeAttr('src').replaceWith($image.clone());
            });
        });
    </script>
@endsection

