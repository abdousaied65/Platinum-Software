@extends('client.layouts.app-main')
<style>
    .btn.dropdown-toggle.bs-placeholder {
        height: 40px;
    }

    .bootstrap-select {
        width: 100% !important;
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
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-danger">
                            @if(App::getLocale() == 'ar')
                                تقرير مديونية العملاء
                            @else
                                client debts report
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <form action="{{route('client.report5.post')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="col-lg-4 pull-right no-print">
                            <label for="" class="d-block">
                                @if(App::getLocale() == 'ar')
                                    اسم العميل
                                @else
                                    client name
                                @endif
                            </label>
                            <select required name="outer_client_id" id="outer_client_id" class="selectpicker"
                                    data-style="btn-info" data-live-search="true"
                                    @if(App::getLocale() == 'ar')
                                    data-title="ابحث"
                                    @else
                                    data-title="Search"
                                @endif
                            >
                                <option
                                    @if(isset($outer_client_id) && $outer_client_id == "all")
                                    selected
                                    @endif
                                    value="all">
                                    @if(App::getLocale() == 'ar')
                                        كل العملاء
                                    @else
                                        all clients
                                    @endif
                                </option>
                                @foreach($outer_clients as $outer_client)
                                    <option
                                        @if(isset($outer_client_id) && $outer_client->id == $outer_client_id)
                                        selected
                                        @endif
                                        value="{{$outer_client->id}}">{{$outer_client->client_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-4 pull-right">
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
                    @if(isset($outerClients) && !empty($outerClients))
                        <p class="alert alert-sm alert-danger mt-2 mb-2 text-center">
                            @if(App::getLocale() == 'ar')
                                تقرير مديونية العملاء
                            @else
                                clients debts report
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover">
                                <thead>
                                <tr>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الاسم
                                        @else
                                            name
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الفئة
                                        @else
                                            category
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            مديونية
                                        @else
                                            previous debts
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($outerClients as $key => $outer_client)
                                    <tr>
                                        <td>{{ $outer_client->client_name }}</td>
                                        <td>{{ trans('main.'.$outer_client->client_category) }}</td>
                                        <td>
                                            @if($outer_client->prev_balance > 0 )

                                                @if(App::getLocale() == 'ar')
                                                    عليه
                                                @else
                                                    debtor
                                                @endif
                                                {{floatval( $outer_client->prev_balance  )}}
                                            @elseif($outer_client->prev_balance < 0)

                                                @if(App::getLocale() == 'ar')
                                                    له
                                                @else
                                                    creditor
                                                @endif
                                                {{floatval( abs($outer_client->prev_balance)  )}}
                                            @else
                                                0
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(isset($total_balances) && !empty($total_balances))
                            <div class="col-lg-6 pull-right p-2">
                                <p class="alert alert-info alert-sm" dir="rtl">
                                    @if(App::getLocale() == 'ar')
                                        اجمالى مديونيات العملاء :
                                    @else
                                        clients total debts :
                                    @endif
                                    @if($total_balances > 0 )

                                        @if(App::getLocale() == 'ar')
                                            عليهم
                                        @else
                                            debtor
                                        @endif
                                        {{floatval( $total_balances  )}}
                                    @elseif($total_balances < 0)

                                        @if(App::getLocale() == 'ar')
                                            لهم
                                        @else
                                            creditor
                                        @endif
                                        {{floatval( abs($total_balances)  )}}
                                    @else
                                        0
                                    @endif
                                    {{__('main.'.$currency)}}
                                </p>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>

</script>
