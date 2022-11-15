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
                                    عرض كل الفئات
                                @else
                                    Show All Categories
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
                                        اسم الفئة
                                    @else
                                        Category Name
                                    @endif
                                </th>
                                <th class="text-center">
                                    @if(App::getLocale() == 'ar')
                                        نوع الفئة
                                    @else
                                        Category Type
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
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_type}}</td>
                                    <td>
                                        @if($category->category_type != "قطع غيار الصيانة")
                                            <a href="{{ route('client.categories.edit', $category->id) }}"
                                               class="btn btn-sm btn-info" data-toggle="tooltip"
                                               data-placement="top"><i class="fa fa-edit"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger delete_category"
                                               category_id="{{ $category->id }}"
                                               category_name="{{ $category->category_name }}" data-toggle="modal"
                                               href="#modaldemo9"
                                            ><i
                                                    class="fa fa-trash"></i></a>
                                        @else
                                            @if(App::getLocale() == 'ar')
                                                غير مسموح
                                            @else
                                                Not Allowed
                                            @endif
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

        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" category="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header text-center">
                        <h6 class="modal-title w-100" style="font-family: 'Cairo'; ">
                            @if(App::getLocale() == 'ar')
                                حذف فئة
                            @else
                                Delete Category
                            @endif
                        </h6>
                        <button aria-label="Close" class="close"
                                data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ route('client.categories.destroy', 'test') }}" method="post">
                        {{ method_field('delete') }}
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <p>
                                @if(App::getLocale() == 'ar')
                                    هل انت متأكد من الحذف ؟
                                @else
                                    Sure To Delete ?
                                @endif
                            </p><br>
                            <input type="hidden" name="categoryid" id="categoryid">
                            <input class="form-control" name="categoryname" id="categoryname" type="text" readonly>
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
        $('.delete_category').on('click', function () {
            var category_id = $(this).attr('category_id');
            var category_name = $(this).attr('category_name');
            $('.modal-body #categoryid').val(category_id);
            $('.modal-body #categoryname').val(category_name);
        });
    });
</script>
