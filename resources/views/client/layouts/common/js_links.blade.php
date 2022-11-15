<script src="{{asset('app-assets/js/vendors.min.js')}}" type="text/javascript"></script>
@if(App::getLocale() == 'ar')
    <script src="{{asset('app-assets/js-rtl/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js-rtl/datatables.min.js')}}" type="text/javascript"></script>
@else
    <script src="{{asset('app-assets/js/bootstrap-select.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/datatables.min.js')}}" type="text/javascript"></script>
@endif

<script src="{{asset('app-assets/js/app-menu.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/app.js')}}" type="text/javascript"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    $(function () {
        $('#example-table').DataTable({
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': ['nosort']
            }]
        });
    });
    $(".alert.alert-success.alert-dismissable").fadeTo(2000, 5000).slideUp(500);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.progress-pie-chart').each(function () {
        var $ppc = $(this),
            percent = parseInt($ppc.data('percent')),
            deg = 360 * percent / 100;
        if (percent > 50) {
            $ppc.addClass('gt-50');
        }
        if (percent <= 25) {
            $ppc.addClass('red');
        } else if (percent >= 25 && percent <= 90) {
            $ppc.addClass('orange');
        } else if (percent >= 90) {
            $ppc.addClass('green');
        }
        $ppc.find('.ppc-progress-fill').css('transform', 'rotate(' + deg + 'deg)');
        $ppc.find('.ppc-percents span').html('<cite>' + percent + '</cite>' + '%');
    });
    $('input').on('keyup paste blur', function () {
        var arabic = /[\u0660-\u0669]/;
        var string = $(this).val(); // some Arabic string from Wikipedia
        if (arabic.test(string)) {
            alert("غير مسموح بالارقام العربية");
            $(this).val('');
        }
    });
</script>
