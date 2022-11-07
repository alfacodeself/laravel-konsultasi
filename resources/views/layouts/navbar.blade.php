<div class="navbar-custom">
    <ul class="list-unstyled topnav-menu float-end mb-0">
        <li class="dropdown notification-list topbar-dropdown">
            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                @if (auth('user')->check())
                    <img src="{{ asset(auth('user')->user()->foto) }}" alt="user-image" class="rounded-circle">
                @elseif (auth('admin')->check())
                    <img src="{{ asset(auth('admin')->user()->foto) }}" alt="user-image" class="rounded-circle">
                @endif
                <span class="pro-user-name ms-1">
                    {{ auth('user')->check() ? auth('user')->user()->nama : auth('admin')->user()->nama }} <i class="mdi mdi-chevron-down"></i> 
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                <!-- item-->
                <div class="dropdown-header noti-title">
                    <h6 class="text-overflow m-0">Selamat Datang !</h6>
                </div>

                <!-- item-->
                <a href="#" class="dropdown-item notify-item">
                    <i class="fe-user"></i>
                    <span>Profil</span>
                </a>

                <div class="dropdown-divider"></div>

                <!-- item-->
                
                @if (Auth::guard('admin')->check())
                    <form action="{{ route('admin.logout') }}" method="post">
                @elseif (Auth::guard('user')->check())
                    <form action="{{ route('user.logout') }}" method="post">
                @endif
                    @csrf
                    @method('POST')
                    <button type="submit" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </button>
                </form>

            </div>
        </li>

    </ul>

    <!-- LOGO -->
    <div class="logo-box">
        <a href="#" class="logo logo-light text-center">
            <span class="logo-sm">
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="16">
            </span>
        </a>
        <a href="#" class="logo logo-dark text-center">
            <span class="logo-sm">
                {{-- KApp --}}
                <img src="{{ asset('assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                {{-- Konsultasi App --}}
                <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="16">
            </span>
        </a>
    </div>

    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
        <li>
            <button class="button-menu-mobile disable-btn waves-effect">
                <i class="fe-menu"></i>
            </button>
        </li>

        <li>
            <h4 class="page-title-main">@yield('page')</h4>
        </li>

    </ul>

    <div class="clearfix"></div> 

</div>