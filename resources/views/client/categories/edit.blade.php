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
                                تحديث بيانات الفئة
                            @else
                                Update Data
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>
                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.categories.update',$category->id)}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('PATCH')
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
                                <input dir="rtl" value="{{$category->category_name}}" required class="form-control"
                                       name="category_name" type="text">
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
                                    <option
                                        @if($category->category_type == "مخزونية")
                                        selected
                                        @endif
                                        value="مخزونية">
                                        @if(App::getLocale() == 'ar')
                                            مخزونية
                                        @else
                                            Stores
                                        @endif
                                    </option>
                                    <option
                                        @if($category->category_type == "توصيل")
                                        selected
                                        @endif
                                        value="توصيل">
                                        @if(App::getLocale() == 'ar')
                                            توصيل
                                        @else
                                            Delivery
                                        @endif
                                    </option>
                                    <option
                                        @if($category->category_type == "مصنعية")
                                        selected
                                        @endif
                                        value="مصنعية">
                                        @if(App::getLocale() == 'ar')
                                            مصنعية
                                        @else
                                            workmanship
                                        @endif
                                    </option>
                                    <option
                                        @if($category->category_type == "مخزون ومصنعية")
                                        selected
                                        @endif
                                        value="مخزون ومصنعية">
                                        @if(App::getLocale() == 'ar')
                                            مخزون ومصنعية
                                        @else
                                            stock and workmanship
                                        @endif
                                    </option>
                                    <option
                                        @if($category->category_type == "قطع غيار الصيانة")
                                        selected
                                        @endif
                                        value="قطع غيار الصيانة">
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
