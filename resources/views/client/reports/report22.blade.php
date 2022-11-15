@extends('client.layouts.app-main')
<style>
    .bootstrap-select {
        width: 100% !important;
    }

</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('error') }}
        </div>
    @endif
    <!-- row -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="col-lg-12 margin-tb">
                            <h5 class="pull-right alert alert-sm alert-success">
                                @if(App::getLocale() == 'ar')
                                    تقرير العجز فى نقاط البيع
                                @else
                                    Deficit report at points of sale
                                @endif
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="company_details printy" style="display: none;">
                        <div class="text-center">
                            <img class="logo" style="width: 20%;" src="{{asset($company->company_logo)}}" alt="">
                        </div>
                        <div class="text-center">
                            <div class="col-lg-12 text-center justify-content-center">
                                <p class="alert alert-secondary text-center alert-sm"
                                   style="margin: 10px auto; font-size: 17px;line-height: 1.9;" dir="rtl">
                                    {{$company->company_name}} -- {{$company->business_field}} <br>
                                    {{$company->company_owner}} -- {{$company->phone_number}} <br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <form action="{{route('client.report22.post')}}" class="no-print" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-4 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    اسم المستخدم
                                @else
                                    user name
                                @endif
                            </label>
                            <select required name="client_id" id="client_id" class="selectpicker"
                                    data-style="btn-warning" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                @endif
                            >
                                @foreach($clients as $client)
                                    <option
                                        @if(isset($client_id) && $client->id == $client_id)
                                        selected
                                        @endif
                                        value="{{$client->id}}">{{$client->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    من تاريخ
                                @else
                                    from date
                                @endif
                            </label>
                            <input type="date" @if(isset($from_date) && !empty($from_date)) value="{{$from_date}}"
                                   @endif class="form-control" name="from_date"/>
                        </div>
                        <div class="col-lg-4 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    الى تاريخ
                                @else
                                    to date
                                @endif
                            </label>
                            <input type="date" @if(isset($to_date) && !empty($to_date)) value="{{$to_date}}"
                                   @endif class="form-control" name="to_date"/>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-lg-12 text-center pull-right">
                            <button class="btn btn-md btn-danger"
                                    style="font-size: 15px; height: 40px; margin-top: 25px;" type="submit">
                                <i class="fa fa-check"></i>

                                @if(App::getLocale() == 'ar')
                                    عرض التقرير
                                @else
                                    show report
                                @endif

                            </button>
                        </div>
                    </form>

                    <div class="clearfix"></div>
                    @if(isset($reports) && !$reports->isEmpty())
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير العجز فى نقاط البيع للمستخدم
                            @else
                                Deficit report at points of sale for
                            @endif
                        ( {{$client->name}} )
                        </p>
                        <div class="table-responsive">
                            <table id="example-table"
                                   class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المستخدم
                                        @else
                                            user
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الفرع
                                        @else
                                            branch
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            رقم الشيفت
                                        @else
                                            shift number
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المبلغ الاجمالى لتقفيل اليومية ( حسب النظام )
                                    </th>
                                    @else
                                        The total amount of daily closing (according to the system)
                                    @endif
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المبلغ الاجمالى الفعلى المدخل لتقفيل اليومية
                                        @else
                                            Actual total amount entered daily closing
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            مبلغ العجز (الفرق بين المبلغين السابقين )
                                        @else
                                            The amount of the deficit (the difference between the two previous amounts)
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            تاريخ - وقت
                                        @else
                                            date - time
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $sum = 0; ?>
                                @foreach($reports as $report)
                                    <?php $sum = $sum + $report->difference_amount; ?>
                                    <tr>
                                        <td>{{$report->client->name}}</td>
                                        <td>{{$report->branch->branch_name}}</td>
                                        <td>{{$report->shift_id}}</td>
                                        <td>{{$report->system_total}}</td>
                                        <td>{{$report->actual_total}}</td>
                                        <td>
                                            @if($report->difference_amount == "0")
                                                {{$report->difference_amount}}
                                            @elseif($report->difference_amount > 0)
                                                {{$report->difference_amount}}
                                                <br>

                                                @if(App::getLocale() == 'ar')
                                                    زائد
                                                @else
                                                    plus
                                                @endif
                                            @elseif($report->difference_amount < 0)
                                                {{abs($report->difference_amount)}}
                                                <br>

                                                @if(App::getLocale() == 'ar')
                                                    ناقص
                                                @else
                                                    minus
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{$report->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row mt-3">
                            <span class="col-lg-4 col-sm-12 alert alert-secondary alert-sm mr-5">
                                @if(App::getLocale() == 'ar')
                                    اجمالى العجز
                                @else
                                    total deficit
                                @endif
                                @if($sum == "0")
                                    {{$sum}}
                                @elseif($sum > 0)
                                    {{$sum}}
                                    @if(App::getLocale() == 'ar')
                                        زائد
                                    @else
                                        plus
                                    @endif
                                @elseif($sum < 0)
                                    {{abs($sum)}}

                                    @if(App::getLocale() == 'ar')
                                        ناقص
                                    @else
                                        minus
                                    @endif
                                @endif
                            </span>
                        </div>
                    @endif
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
