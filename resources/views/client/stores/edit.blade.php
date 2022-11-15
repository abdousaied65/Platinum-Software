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
                                تحديث بيانات المخزن
                            @else
                                Edit Store
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.stores.update',$store->id)}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم المخزن
                                    @else
                                        Store Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input value="{{$store->store_name}}" dir="rtl" required class="form-control"
                                       name="store_name" type="text">
                            </div>

                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        يوجد بداخل فرع
                                    @else
                                        is in branch
                                    @endif
                                        <span class="text-danger">*</span></label>
                                <select required name="branch_id" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر فرع
                                        @else
                                            choose branch
                                        @endif
                                    </option>
                                    @foreach($branches as $branch)
                                        <option
                                            @if($branch->id == $store->branch_id)
                                            selected
                                            @endif
                                            value="{{$branch->id}}">{{$branch->branch_name}}</option>
                                    @endforeach
                                </select>
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
