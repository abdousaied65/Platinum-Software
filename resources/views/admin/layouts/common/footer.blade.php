<footer class="footer footer-static footer-light navbar-border navbar-shadow no-print">
    <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">
            <i class="fa fa-heart pink"></i>
            @if(App::getLocale() == 'ar')
                {{$system->name_ar}}
            @else
                {{$system->name_en}}
            @endif
        </span>
    </p>
</footer>
