<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow no-print">
    <div class="navbar-wrapper navbar-dark">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto">
                    <a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#">
                        <i class="fa fa-bars fa-2x"></i>
                    </a>
                </li>
                <li class="nav-item mr-auto  text-center"
                    style="margin-top: -10px!important; margin-right: 20px !important;">
                    <a class="navbar-brand text-center" href="{{route('client.home')}}">
                        <h6 class="brand-text  text-center" style="font-size: 14px!important;line-height: 2;top: 10px;"
                            dir="rtl">
                            {{Auth::user()->company->company_name}}
                        </h6>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block float-right">
                    <a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse">
                        <i class="fa fa-toggle-on fa2-x" style="color: #ddd;font-size: 22px !important;"
                           data-ticon="fa fa-toggle-right"></i>
                    </a></li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <p class="mr-auto float-left">
                </p>
                <ul class="nav navbar-nav float-left">
                    @if(App::getLocale() == 'ar')
                        <li class="nav-item">
                            <a class="nav-link pt-2"
                               href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">
                                <img style="width:30px; height: 20px;" src="{{asset('images/lang/en.png')}}" alt="">
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link pt-2"
                               href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">
                                <img style="width:30px; height: 20px;" src="{{asset('images/lang/ar.png')}}" alt="">
                            </a>
                        </li>
                    @endif
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <span class="mr-1">
                                  <span class="user-name text-bold-700"
                                        style="color: #ddd;">{{Auth::user()->name}}</span>
                                </span>
                            <span class="avatar avatar-online">
                                    @if (isset(Auth::user()->profile->profile_pic) && !empty(Auth::user()->profile->profile_pic) )
                                    <img src="{{asset(Auth::user()->profile->profile_pic)}}" alt="avatar"><i></i>
                                @else
                                    <img src="{{asset('app-assets/images/user.png')}}" alt="avatar"><i></i>
                                @endif
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="{{ route('client.profile.edit',Auth::user()->id) }}">
                                <i class="fa fa-user"></i>
                                @if(App::getLocale() == 'ar')
                                    تعديل البيانات
                                @else
                                    Edit Profile Data
                                @endif
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('client.logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i>
                                @if(App::getLocale() == 'ar')
                                    تسجيل الخروج
                                @else
                                    Logout
                                @endif
                            </a>
                            <form id="logout-form" action="{{ route('client.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
