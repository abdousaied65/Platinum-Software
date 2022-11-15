@extends('client.layouts.app-main')
@section('content')
    @if (session('success'))

        <div class="alert alert-success alert-dismissable fade show">
            <button class="close" data-dismiss="alert" aria-label="Close">×</button>
            {{ session('success') }}
        </div>
    @endif
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="col-lg-12 margin-tb">
                        <h5 style="min-width: 300px;" class="pull-right alert alert-sm alert-success">

                            @if(App::getLocale() == 'ar')
                                عرض كل المستخدمين
                            @else
                                Show All Users
                            @endif
                        </h5>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="card-body p-1 m-1">
                    <div class="table-responsive hoverable-table">
                        <table class="table table-striped table-bordered zero-configuration" id="example-table"
                               style="text-align: center;">
                            <thead>
                            <tr>
                                <th class="wd-10p border-bottom-0 text-center">#</th>
                                <th class="wd-15p border-bottom-0 text-center">
                                    @if(App::getLocale() == 'ar')
                                        اسم المستخدم
                                    @else
                                        User Name
                                    @endif
                                </th>
                                <th class="wd-20p border-bottom-0 text-center">
                                    @if(App::getLocale() == 'ar')
                                        البريد الالكترونى
                                    @else
                                        Email
                                    @endif
                                </th>
                                <th class="wd-15p border-bottom-0 text-center">
                                    @if(App::getLocale() == 'ar')
                                        الحالة
                                    @else
                                        Status
                                    @endif
                                </th>
                                <th class="wd-15p border-bottom-0 text-center">
                                    @if(App::getLocale() == 'ar')
                                        الفرع
                                    @else
                                        Branch
                                    @endif
                                </th>
                                <th class="wd-15p border-bottom-0 text-center">
                                    @if(App::getLocale() == 'ar')
                                        الصلاحية
                                    @else
                                        Role
                                    @endif
                                </th>
                                <th class="wd-10p border-bottom-0 text-center">@if(App::getLocale() == 'ar')
                                        تحكم
                                    @else
                                        Control
                                    @endif
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $i = 0;
                            @endphp

                            @foreach ($data as $key => $client)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>
                                        @if ($client->Status == 'active')
                                            <span class="badge badge-success">

                                                @if(App::getLocale() == 'ar')
                                                    مفعل
                                                @else
                                                    Active
                                                @endif
                                                </span>
                                        @elseif ($client->Status == 'blocked')
                                            <span class="badge badge-danger">

                                                @if(App::getLocale() == 'ar')
                                                    معطل
                                                @else
                                                    Blocked
                                                @endif
                                                </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($client->branch == "")
                                            @if(App::getLocale() == 'ar')
                                                غير محدد
                                            @else
                                                Not Defined
                                            @endif
                                        @else
                                            {{$client->branch->branch_name}}
                                        @endif
                                    </td>
                                    <td>
                                        @if (!empty($client->getRoleNames()))
                                            @foreach ($client->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('client.clients.edit', $client->id) }}"
                                           class="btn btn-sm btn-info" data-toggle="tooltip"
                                           data-placement="top"><i class="fa fa-edit"></i></a>
                                        @if (!in_array("مدير النظام",$client->role_name ))
                                            <a class="modal-effect btn btn-sm btn-danger delete_client"
                                               client_id="{{ $client->id }}"
                                               email="{{ $client->email }}" data-toggle="modal" href="#modaldemo8"
                                            ><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->

        <!-- Modal effects -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                            @if(App::getLocale() == 'ar')
                                حذف مستخدم
                            @else
                                Delete User
                            @endif
                            </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('client.clients.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p></p><br>
                            <input type="hidden" name="client_id" id="client_id" value="">
                            <input class="form-control" name="email" id="email" type="text" readonly>
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
        $('.delete_client').on('click', function () {
            var client_id = $(this).attr('client_id');
            var email = $(this).attr('email');
            $('.modal-body #client_id').val(client_id);
            $('.modal-body #email').val(email);
        });
    });
</script>
