<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            @if (auth('user')->check())
                <img src="{{ url(auth('user')->user()->foto) }}" alt="user-img" title="{{ auth('user')->user()->nama }}"
                    class="rounded-circle img-thumbnail avatar-md">
            @elseif (auth('admin')->check())
                <img src="{{ url(auth('admin')->user()->foto) }}" alt="user-img" title="{{ auth('admin')->user()->nama }}"
                    class="rounded-circle img-thumbnail avatar-md">
            @endif
            <p href="#" class="user-name h5 mt-2 mb-1 d-block">
                {{ auth('user')->check() ? auth('user')->user()->nama : auth('admin')->user()->nama }}</p>
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
                            <span> Konseling </span>
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
                        <a href="#">
                            <i class="mdi mdi-account-box-multiple-outline"></i>
                            <span> Data Pasien </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span> Data Transaksi </span>
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
                        <a href="#">
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
                        <a href="#">
                            <i class="mdi mdi-file-document-multiple-outline"></i>
                            <span> Riwayat Transaksi </span>
                        </a>
                    </li>
                    <li class="menu-title mt-2">Settings</li>
                    <li>
                        <a href="#">
                            <i class="mdi mdi-account-edit-outline"></i>
                            <span> Profil </span>
                        </a>
                    </li>
                @endif
            </ul>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
