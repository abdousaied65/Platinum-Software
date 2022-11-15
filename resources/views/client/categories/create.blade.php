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
                                اضافة فئة جديد
                            @else
                                Add New Category
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.categories.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم الفئة
                                    @else
                                        Category Name
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="category_name" type="text">
                            </div>

                            <div class="col-md-4">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        نوع الفئة
                                    @else
                                        Category Type
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required name="category_type" class="form-control">
                                    <option value="">
                                        @if(App::getLocale() == 'ar')
                                            اختر نوع الفئة
                                        @else
                                            Choose Category Type
                                        @endif
                                        </option>
                                    <option selected value="مخزونية">
                                        @if(App::getLocale() == 'ar')
                                            مخزونية
                                        @else
                                            Stores
                                        @endif
                                    </option>
                                    <option value="توصيل">
                                        @if(App::getLocale() == 'ar')
                                            توصيل
                                        @else
                                            Delivery
                                        @endif
                                    </option>
                                    <option value="مصنعية">
                                        @if(App::getLocale() == 'ar')
                                            مصنعية
                                        @else
                                            workmanship
                                        @endif
                                    </option>
                                    <option value="مخزون ومصنعية">
                                        @if(App::getLocale() == 'ar')
                                            مخزون ومصنعية
                                        @else
                                            stock and workmanship
                                        @endif
                                    </option>
                                    <option value="قطع غيار الصيانة">
                                        @if(App::getLocale() == 'ar')
                                            قطع غيار الصيانة
                                        @else
                                            Maintenance spare parts
                                        @endif
                                    </option>
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
