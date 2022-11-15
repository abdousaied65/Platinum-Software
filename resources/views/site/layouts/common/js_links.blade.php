<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/heandline.js')}}"></script>
<script src="{{asset('assets/js/magnific-popup.min.js')}}"></script>
<script src="{{asset('assets/js/wow.min.js')}}"></script>
<script src="{{asset('assets/js/nice-select.js')}}"></script>
<script src="{{asset('assets/js/main.js')}}"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
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
