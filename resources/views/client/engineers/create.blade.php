@extends('client.layouts.app-main')
<style>
    .form-control {
        height: 45px !important;
    }

    .input-group-addon {
        border-radius: 0px 5px 5px 0px;
        border: 1px solid #444;
        border-left: 0;
        font-size: 17px !important;
    }
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
                                اضافة مهندس صيانة
                            @else
                                Add New Engineer
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.engineers.store','test')}}" enctype="multipart/form-data"
                          method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        اسم مهندس الصيانة
                                    @else
                                        Engineer name
                                    @endif
                                     <span class="text-danger">*</span></label>
                                <input dir="rtl" required class="form-control" name="name" type="text">
                            </div>
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
                                <input dir="rtl" class="form-control" name="phone" type="text">
                            </div>
                            <div class="col-md-3">
                                <label>
                                    @if(App::getLocale() == 'ar')
                                        نسبةالعمولة
                                    @else
                                        commission Rate
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-addon" style="font-size: 18px;font-weight: bold;">%</span>
                                    <input required min="1" type="number" class="form-control" name="commission_rate"/>
                                </div>
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

    });
</script>
