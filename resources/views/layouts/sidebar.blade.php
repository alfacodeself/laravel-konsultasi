{{-- <div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            @if (auth('user')->check())
                @if (auth('user')->user()->foto == null)
                    <img src="{{ asset('assets/images/default-avatar.png') }}" alt="user-img"
                        title="{{ auth('user')->user()->nama }}" class="rounded-circle img-thumbnail avatar-md">
                @else
                    <img src="{{ url(auth('user')->user()->foto) }}" alt="user-img"
                        title="{{ auth('user')->user()->nama }}" class="rounded-circle img-thumbnail avatar-md">
                @endif
            @elseif (auth('admin')->check())
                @if (auth('admin')->user()->foto == null)
                    <img src="{{ asset('assets/images/default-avatar.png') }}" alt="user-img"
                        title="{{ auth('admin')->user()->nama }}" class="rounded-circle img-thumbnail avatar-md">
                @else
                    <img src="{{ url(auth('admin')->user()->foto) }}" alt="user-img"
                        title="{{ auth('admin')->user()->nama }}" class="rounded-circle img-thumbnail avatar-md">
                @endif
            @endif
            <p href="#" class="user-name text-capitalize h5 mt-2 mb-1 d-block">
                {{ auth('user')->check() ? auth('user')->user()->nama : auth('admin')->user()->nama }}</p>
        </div>
        <div id="sidebar-menu">

            <ul id="side-menu">

                @if (auth()->guard('admin')->check())
                    <li class="menu-title">Main</li>
                    <li>
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Beranda </span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">Data</li>
                    <li>
                        <a href="{{ route('admin.psycholog.index') }}">
                            <i class="mdi mdi-book-edit-outline"></i>
                            <span> Tes Psikologi </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pricing.index') }}">
                            <i class="mdi mdi-cash-multiple"></i>
                            <span> Paket Konseling </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.konsultasi.index') }}">
                            <i class="mdi mdi-calendar-blank-outline"></i>
                            <span> Jadwal Konseling </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pasien.index') }}">
                            <i class="mdi mdi-account-box-multiple-outline"></i>
                            <span> Pasien </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.transaksi.index') }}">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span> Transaksi </span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">Settings</li>
                    <li>
                        <a href="{{ route('admin.pengaturan.profil.index') }}">
                            <i class="mdi mdi-account-edit-outline"></i>
                            <span> Profil </span>
                        </a>
                    </li>
                @elseif (auth()->guard('user')->check())
                    <li class="menu-title">Main</li>
                    <li>
                        <a href="{{ route('user.dashboard') }}">
                            <i class="mdi mdi-view-dashboard-outline"></i>
                            <span> Beranda </span>
                        </a>
                    </li>
                    <li class="menu-title">Feature</li>
                    <li>
                        <a href="{{ route('user.konseling.index') }}">
                            <i class="mdi mdi-forum-outline"></i>
                            <span> Konseling </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('user.psycholog.index') }}">
                            <i class="mdi mdi-book-edit-outline"></i>
                            <span> Hasil Tes Psikologi </span>
                        </a>
                    </li>
                    <li class="menu-title">History</li>
                    <li>
                        <a href="{{ route('user.transaksi.index') }}">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span> Transaksi </span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">Settings</li>
                    <li>
                        <a href="{{ route('user.pengaturan.profil.index') }}">
                            <i class="mdi mdi-account-edit-outline"></i>
                            <span> Profil </span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
        <div class="clearfix"></div>
    </div>
</div> --}}

{{-- ================================================== --}}
<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    @if (auth()->guard('admin')->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('admin.dashboard') }}" id="topnav-dashboard"
                                role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('admin.psycholog.index') }}" id="topnav-test"
                                role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-book-edit-outline me-1"></i> Tes Psikolog
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('admin.pricing.index') }}"
                                id="topnav-pricing" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-cash-multiple me-1"></i> Paket Konseling
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('admin.konsultasi.index') }}"
                                id="topnav-schedule" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-calendar-blank-outline me-1"></i> Jadwal Konseling
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('admin.pasien.index') }}" id="topnav-patient"
                                role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-account-box-multiple-outline me-1"></i> Pasien
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('admin.transaksi.index') }}"
                                id="topnav-transaction" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-file-document-multiple-outline me-1"></i> Transaksi
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('admin.pengaturan.profil.index') }}"
                                id="topnav-transaction" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-account-edit-outline me-1"></i> Profil
                            </a>
                        </li>
                    @elseif (auth()->guard('user')->check())
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('user.dashboard') }}"
                                id="topnav-dashboard" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-view-dashboard me-1"></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('user.konseling.index') }}"
                                id="topnav-chat" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-forum-outline me-1"></i> Konseling
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('user.psycholog.index') }}"
                                id="topnav-result" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-book-edit-outline me-1"></i> Hasil Tes Psikologi
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('user.transaksi.index') }}"
                                id="topnav-transaction" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-file-document-multiple-outline me-1"></i> Transaksi
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link arrow-none" href="{{ route('user.pengaturan.profil.index') }}"
                                id="topnav-transaction" role="button" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-account-edit-outline me-1"></i> Profil
                            </a>
                        </li>
                    @endif

                </ul> <!-- end navbar-->
            </div> <!-- end .collapsed-->
        </nav>
    </div> <!-- end container-fluid -->
</div> <!-- end topnav-->
