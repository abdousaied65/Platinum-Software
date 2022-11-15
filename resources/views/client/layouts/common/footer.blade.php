<footer id="myFooter" class="footer footer-static footer-dark navbar-border navbar-shadow no-print">
    <p class="clearfix text-center mb-0 px-2 alarm-upgrade justify-content-center text-white w-100">
        @if($user->company->subscription->type->type_name == "تجربة")

            @if(App::getLocale() == 'ar')
                أنت الان فى النسخة التجريبية - الوقت المتبقى
            @else
                You are now in the trial version - time left
            @endif

            <?php
            $subscription_type = $user->company->subscription->type->type_name;
            if ($subscription_type == "تجربة") {
                $now = time(); // or your date as well
                $your_date = strtotime($user->company->subscription->end_date);
                $datediff = $your_date - $now;
                echo round($datediff / (60 * 60 * 24));
            }
            ?>
            @if(App::getLocale() == 'ar')
                يوم لانتهاء التجربة
            @else
                days to finish the experiment
            @endif

            <a role="button" class="ml-2 btn btn-md btn-outline-success" href="{{route('go.to.upgrade')}}">
                @if(App::getLocale() == 'ar')
                    الترقية الان
                @else
                    Upgrade Now
                @endif
            </a>
        @else
            @if(App::getLocale() == 'ar')
                أنت الان فى النسخة المفعلة
            @else
                You are now in the active version
            @endif
            {{$user->company->subscription->type->package->package_name}}
            ( {{$user->company->subscription->type->type_name}} )
            @if(App::getLocale() == 'ar')
                - الوقت المتبقى
            @else
                - the remaining time
            @endif
            <?php
            $subscription_type = $user->company->subscription->type->type_name;
            $now = time(); // or your date as well
            $your_date = strtotime($user->company->subscription->end_date);
            $datediff = $your_date - $now;
            echo round($datediff / (60 * 60 * 24));
            ?>
            @if(App::getLocale() == 'ar')
                يوم لانتهاء النسخة
                <br>
                تاريخ انتهاء النسخة الحالية :
            @else
                copy expiration day
                <br>
                Expiry date for the current version:
            @endif
            ( {{$user->company->subscription->end_date}} )
        @endif
    </p>
</footer>

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
        <span class="float-md-left d-block d-md-inline-blockd-none d-lg-block">
            <a data-toggle="modal" data-target="#modaldemo">
                <i class="fa fa-info-circle pink"></i>
                @if(App::getLocale() == 'ar')
                    سياسة الخصوصية
                @else
                    Privacy Policy
                @endif
            </a>
        </span>
        <span class="float-md-left ml-5">
            <a href="{{url('client/go-to-upgrade')}}">
                <i class="fa fa-money pink"></i>

                @if(App::getLocale() == 'ar')
                    أسعار الخدمات
                @else
                    Packages Prices
                @endif
            </a>
        </span>
    </p>
</footer>
