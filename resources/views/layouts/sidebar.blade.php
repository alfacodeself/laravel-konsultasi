<div class="left-side-menu">

    <div class="h-100" data-simplebar>

         <!-- User box -->
        <div class="user-box text-center">

            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md">
            <p href="#" class="user-name h5 mt-2 mb-1 d-block">Alfa Code</p>
            <p class="text-muted left-user-info">Administrator</p>
        </div>

        <!--- Sidemenu -->
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

                <li class="menu-title mt-2">Features</li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Konsultasi </span>
                    </a>
                </li>
                <li class="menu-title mt-2">Data</li>
                <li>
                    <a href="{{ route('admin.psycholog.index') }}">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Tes Psikologi </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Data Pasien </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Data Transaksi </span>
                    </a>
                </li>
                <li class="menu-title mt-2">Settings</li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Pengaturan Akun </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Pengaturan Profil </span>
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
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Konseling </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('user.psycholog.index') }}">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Hasil Tes Psikologi </span>
                    </a>
                </li>
                <li class="menu-title">History</li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Riwayat Transaksi </span>
                    </a>
                </li>
                <li class="menu-title mt-2">Settings</li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Pengaturan Akun </span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="mdi mdi-forum-outline"></i>
                        <span> Pengaturan Profil </span>
                    </a>
                </li>
                @endif
            </ul>

        </div>
        <div class="clearfix"></div>
    </div>
</div>