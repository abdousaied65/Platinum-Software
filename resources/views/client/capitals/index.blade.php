@extends('client.layouts.app-main')
<style>

</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
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
                                    عرض كل عمليات اضافة راس المال
                                @else
                                    View all capital additions
                                @endif
                            </h5>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped table-bordered text-center table-hover"
                               id="example-table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        المبلغ
                                    @else
                                        Amount
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        الخزنة
                                    @else
                                        Safe
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رصيد ما قبل
                                    @else
                                        Balance Before
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        رصيد ما بعد
                                    @else
                                        Balance After
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        تاريخ - وقت
                                    @else
                                        Date - Time
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات
                                    @else
                                        Notes
                                    @endif
                                </th>
                                <th class="text-center">@if(App::getLocale() == 'ar')
                                        تحكم
                                    @else
                                        Control
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i=0;
                            @endphp
                            @foreach ($capitals as $key => $capital)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{floatval( $capital->amount  )}}</td>
                                    <td>{{ $capital->safe->safe_name }}</td>
                                    <td>{{floatval( $capital->balance_before  )}}</td>
                                    <td>{{floatval( $capital->balance_after  )}}</td>
                                    <td>{{ $capital->created_at }}</td>
                                    <td>{{$capital->notes}}</td>
                                    <td>
                                        <a href="{{ route('client.capitals.edit', $capital->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>

                                        <a class="modal-effect btn btn-sm btn-danger delete_capital"
                                           capital_id="{{ $capital->id }}"
                                           capital_name="{{ $capital->amount }} - {{$capital->safe->safe_name}}"
                                           data-toggle="modal" href="#modaldemo9"
                                        ><i
                                                class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" capital="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">@if(App::getLocale() == 'ar')
                                حذف عملية
                            @else
                                Process Delete
                            @endif</h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('client.capitals.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>@if(App::getLocale() == 'ar')
                                    هل انت متأكد من الحذف ؟
                                @else
                                    Sure To Delete ?
                                @endif</p><br>
                            <input type="hidden" name="capitalid" id="capitalid">
                            <input class="form-control" name="capitalname" id="capitalname" type="text" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">@if(App::getLocale() == 'ar')
                                    الغاء
                                @else
                                    Cancel
                                @endif</button>
                            <button type="submit" class="btn btn-danger">
                                @if(App::getLocale() == 'ar')
                                    حذف
                                @else
                                    Delete
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
        $('.delete_capital').on('click', function () {
            var capital_id = $(this).attr('capital_id');
            var capital_name = $(this).attr('capital_name');
            $('.modal-body #capitalid').val(capital_id);
            $('.modal-body #capitalname').val(capital_name);
        });
    });
</script>
