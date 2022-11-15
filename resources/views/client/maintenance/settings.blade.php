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
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12">
                        <h2 style="min-width: 300px;font-size: 14px!important;"
                            class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                خيارات قسم الصيانة
                            @else
                                Maintenance Department Options
                            @endif
                        </h2>
                    </div>
                    <div class="col-6 pull-right">
                        <p class="alert alert-sm alert-danger text-center w-100">
                            @if(App::getLocale() == 'ar')
                                انواع الاجهزة
                            @else
                                Devices Types
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <form action="{{route('maintenance.device.post')}}" method="POST">
                            @csrf
                            <input type="hidden" name="company_id" value="{{$company_id}}"/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">
                                            @if(App::getLocale() == 'ar')
                                                نوع الجهاز
                                            @else
                                                Device Type
                                            @endif
                                        </label>
                                        <input style="width:100%" required type="text" class="form-control"
                                               dir="rtl"
                                               name="device_type"
                                               id="device_type"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 pull-right">
                                <div class="form-group">
                                    <button class="btn btn-md btn-success"><i class="fa fa-check"></i>
                                        @if(App::getLocale() == 'ar')
                                            حفظ
                                        @else
                                            Save
                                        @endif

                                    </button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <hr>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead class="bg-cyan">
                            <tr>
                                <th style="color: #fff!important;">#</th>
                                <th style="color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        نوع الجهاز
                                    @else
                                        Device Type
                                    @endif
                                </th>
                                <th style="color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        Delete
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($devices_types as $device_type)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$device_type->device_type}}</td>
                                    <td>
                                        <form class="d-inline" action="{{route('maintenance.device.delete')}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{$device_type->id}}" name="device_type_id"/>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 pull-right">
                        <p class="alert alert-sm alert-info text-center w-100">
                            @if(App::getLocale() == 'ar')
                                مشاكل الاجهزة
                            @else
                                Devices Issues
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <form action="{{route('maintenance.issue.post')}}" method="POST">
                            @csrf
                            <input type="hidden" name="company_id" value="{{$company_id}}"/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">
                                            @if(App::getLocale() == 'ar')
                                                مشكلة الجهاز
                                            @else
                                                Device issue
                                            @endif
                                        </label>
                                        <input style="width:100%" required type="text" class="form-control"
                                               dir="rtl"
                                               name="issue"
                                               id="issue"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 pull-right">
                                <div class="form-group">
                                    <button class="btn btn-md btn-success"><i class="fa fa-check"></i>
                                        @if(App::getLocale() == 'ar')
                                            حفظ
                                        @else
                                            Save
                                        @endif
                                    </button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <hr>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead class="bg-cyan">
                            <tr>
                                <th style="color: #fff!important;">#</th>
                                <th style="color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        مشكلة الجهاز
                                    @else
                                        Device issue
                                    @endif
                                </th>
                                <th style="color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        Delete
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($devices_issues as $issue)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$issue->issue}}</td>
                                    <td>
                                        <form class="d-inline" action="{{route('maintenance.issue.delete')}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{$issue->id}}" name="issue_id"/>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="col-6 pull-right">
                        <p class="alert alert-sm alert-primary text-center w-100">
                            @if(App::getLocale() == 'ar')
                                اماكن الصيانة
                            @else
                                Maintenance Places
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <form action="{{route('maintenance.place.post')}}" method="POST">
                            @csrf
                            <input type="hidden" name="company_id" value="{{$company_id}}"/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">
                                            @if(App::getLocale() == 'ar')
                                                مكان الصيانة
                                            @else
                                                Maintenance Place
                                            @endif
                                        </label>
                                        <input style="width:100%" required type="text" class="form-control"
                                               dir="rtl"
                                               name="place_name"
                                               id="place_name"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 pull-right">
                                <div class="form-group">
                                    <button class="btn btn-md btn-success"><i class="fa fa-check"></i>
                                        @if(App::getLocale() == 'ar')
                                            حفظ
                                        @else
                                            Save
                                        @endif
                                    </button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <hr>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead class="bg-cyan">
                            <tr>
                                <th style="color: #fff!important;">#</th>
                                <th style="color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        مكان الصيانة
                                    @else
                                        Maintenance Place
                                    @endif
                                </th>
                                <th style="color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        Delete
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($maintenance_places as $maintenance_place)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$maintenance_place->place_name}}</td>
                                    <td>
                                        <form class="d-inline" action="{{route('maintenance.place.delete')}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{$maintenance_place->id}}" name="place_id"/>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6 pull-right">
                        <p class="alert alert-sm alert-dark text-center w-100">
                            @if(App::getLocale() == 'ar')
                                مناديب الصيانة والتوصيل
                            @else
                                Maintenance and delivery delegates
                            @endif
                        </p>
                        <div class="clearfix"></div>
                        <form action="{{route('maintenance.delegate.post')}}" method="POST">
                            @csrf
                            <input type="hidden" name="company_id" value="{{$company_id}}"/>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="">
                                            @if(App::getLocale() == 'ar')
                                                اسم المندوب
                                            @else
                                                Delegate Name
                                            @endif
                                        </label>
                                        <input style="width:100%" required type="text" class="form-control"
                                               dir="rtl"
                                               name="delegate_name"
                                               id="delegate_name"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12 pull-right">
                                <div class="form-group">
                                    <button class="btn btn-md btn-success"><i class="fa fa-check"></i>
                                        @if(App::getLocale() == 'ar')
                                            حفظ
                                        @else
                                            Save
                                        @endif
                                    </button>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <hr>
                        <table class="table table-bordered table-condensed table-hover table-striped">
                            <thead class="bg-cyan">
                            <tr>
                                <th style="color: #fff!important;">#</th>
                                <th style="color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        اسم المندوب
                                    @else
                                        Delegate Name
                                    @endif
                                </th>
                                <th style="color: #fff!important;">
                                    @if(App::getLocale() == 'ar')
                                        حذف
                                    @else
                                        Delete
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($delegates as $delegate)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$delegate->delegate_name}}</td>
                                    <td>
                                        <form class="d-inline" action="{{route('maintenance.delegate.delete')}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" value="{{$delegate->id}}" name="delegate_id"/>
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>

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
