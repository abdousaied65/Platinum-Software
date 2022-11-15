@extends('client.layouts.app-main')
<style>

</style>
@section('content')
    @if (session('success'))
        <div class="alert alert-success fade show">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger fade show">
            {{ session('error') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    <div class="col-12">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">
                            @if(App::getLocale() == 'ar')
                                تحويل بين المخازن
                            @else
                                Transfer Between Stores
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                    <br>

                    <form class="parsley-style-1" id="selectForm2" name="selectForm2"
                          action="{{route('client.stores.transfer.post')}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="company_id" value="{{$company_id}}">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        من مخزن
                                    @else
                                        From Store
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required class="form-control selectpicker show-tick"
                                        data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif

                                        data-style="btn-danger"
                                        name="from_store" id="from_store">
                                    @foreach($stores as $store)
                                        <option value="{{$store->id}}">{{$store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        الى مخزن
                                    @else
                                        To Store
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required class="form-control selectpicker show-tick"
                                        data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif

                                        data-style="btn-info"
                                        name="to_store" id="to_store">
                                    @foreach($stores as $store)
                                        <option value="{{$store->id}}">{{$store->store_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        المنتج
                                    @else
                                        Product
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <select required class="form-control selectpicker show-tick"
                                        data-live-search="true"
                                        @if(App::getLocale() == 'ar')
                                        data-title="ابحث"
                                        @else
                                        data-title="Search"
                                        @endif

                                        data-style="btn-success"
                                        name="product_id" id="product_id">
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        الكمية
                                    @else
                                        Quantity
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" name="quantity" min="1" id="quantity"
                                       required/>
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        التاريخ
                                    @else
                                        Date
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="date" id="date" value="{{date('Y-m-d')}}"
                                       required/>
                            </div>
                            <div class="col-md-3">
                                <label class="d-block">
                                    @if(App::getLocale() == 'ar')
                                        ملاحظات ( السبب )
                                    @else
                                        Notes (Reason)
                                    @endif
                                    <span class="text-danger">*</span></label>
                                <input type="text" dir="rtl" class="form-control" id="notes" name="notes"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <button class="btn btn-warning pd-x-20" type="submit">

                                @if(App::getLocale() == 'ar')
                                    تحويل
                                @else
                                    Transfer
                                @endif
                            </button>
                        </div>
                    </form>
                    <div class="clearfix"></div>

                    @if(!$transfers->isEmpty())
                        <hr>
                        <p class="alert alert-sm alert-success text-center">
                            @if(App::getLocale() == 'ar')
                                عمليات التحويل بين المخازن
                            @else
                                All Transfers Between Stores
                            @endif
                        </p>
                        <div class="table-responsive">
                            <table class="table table-condensed table-striped table-bordered text-center table-hover"
                                   id="example-table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            من مخزن
                                        @else
                                            From Store
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الى مخزن
                                        @else
                                            To Store
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المنتج
                                        @else
                                            Product
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            الكمية
                                        @else
                                            Quantity
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            التاريخ
                                        @else
                                            Date
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            ملاحظات ( السبب )
                                        @else
                                            Notes (Reason)
                                        @endif
                                    </th>
                                    <th class="text-center">
                                        @if(App::getLocale() == 'ar')
                                            المسؤول
                                        @else
                                            User
                                        @endif
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i=0;
                                @endphp
                                @foreach ($transfers as $key => $transfer)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $transfer->fromStore->store_name }}</td>
                                        <td>{{ $transfer->toStore->store_name }}</td>
                                        <td>{{ $transfer->product->product_name }}</td>
                                        <td>{{ $transfer->quantity }}</td>
                                        <td>{{ $transfer->date }}</td>
                                        <td>{{ $transfer->notes }}</td>
                                        <td>{{ $transfer->client->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{asset('app-assets/js/jquery.min.js')}}"></script>
<script>
    $(document).ready(function () {

        $('#from_store').on('change', function () {
            let from_store_id = $(this).val();
            $.post("{{route('get.products.by.store.id')}}", {
                "_token": "{{ csrf_token() }}",
                from_store_id: from_store_id,
            }, function (data) {
                $('#product_id').html(data);
                $('#product_id').selectpicker('refresh');
            });
        });
    });
</script>
