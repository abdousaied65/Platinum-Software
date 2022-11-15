@extends('client.layouts.app-main')
<style>

</style>
@section('content')
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
                                تحديث بيانات الفرع
                            @else
                                Update Branch Details
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.branches.update',$branch->id)}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم الفرع
                                    @else
                                        Branch Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input value="{{$branch->branch_name}}" dir="rtl" required class="form-control"
                                       name="branch_name" type="text">
                            </div>

                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        تليفون الفرع
                                    @else
                                        Branch phone
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input value="{{$branch->branch_phone}}" required class="form-control" dir="ltr"
                                       name="branch_phone" type="text">
                            </div>

                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        عنوان الفرع
                                    @else
                                        Branch Address
                                    @endif

                                    <span class="text-danger">*</span></label>
                                <input value="{{$branch->branch_address}}" required dir="rtl" class="form-control"
                                       name="branch_address" type="text">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-info pd-x-20" type="submit">
                                @if(App::getLocale() == 'ar')
                                    تحديث
                                @else
                                    Update
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
