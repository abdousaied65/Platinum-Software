<script src="{{asset('app-assets/js/vendors.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/bootstrap-select.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/app.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/customizer.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
<script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
<script src="{{ asset('js/form-repeater.js') }}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $(function () {
        $('#example-table').DataTable({});
    });
    $(".alert.alert-success.alert-dismissable").fadeTo(2000, 5000).slideUp(500);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('input').on('keyup', function () {
        var arabic = /[\u0660-\u0669]/;
        var string = $(this).val(); // some Arabic string from Wikipedia
        if (arabic.test(string)) {
            alert("غير مسموح بالارقام العربية");
            $(this).val('');
        }
    });
</script>

