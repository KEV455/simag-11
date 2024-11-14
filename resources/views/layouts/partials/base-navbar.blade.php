    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- Navbar -->
        <nav class="topbar-main">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="" class="logo">
                    <span>
                        <img src="{{ asset('images/logo-title-poliwangi.png') }}" alt="logo-small" class="logo-sm">
                    </span>
                    <span>
                        <img src="{{ asset('images/logo-poliwangi.png') }}" alt="logo-large" class="logo-lg">
                    </span>
                </a>
            </div><!--topbar-left-->
            <!--end logo-->
            <ul class="list-unstyled topbar-nav float-right mb-0">
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user pr-0" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('images/profile-picture.jpg') }}" alt="profile-user"
                            class="rounded-circle" />
                        <span class="ml-1 nav-user-name hidden-sm">&commat;{{ Auth()->user()->username }} <i
                                class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="dripicons-user text-muted mr-2"></i>
                            Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i
                                class="dripicons-exit text-muted mr-2"></i>
                            Logout</a>
                    </div>
                </li><!--end dropdown-->
            </ul><!--end topbar-nav-->
        </nav>
        <!-- end navbar-->

        <!-- MENU Start -->
        <div class="navbar-custom-menu">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li class="has-submenu">
                            @if (Auth()->user()->role == 'admin')
                                <a href="{{ route('dashboard.admin') }}">
                                    <i class="fa-solid fa-house-chimney"></i>
                                    <span>Dashboard</span>
                                </a>
                            @elseif (Auth()->user()->role == 'mahasiswa')
                                <a href="{{ route('dashboard.mahasiswa') }}">
                                    <i class="fa-solid fa-house-chimney"></i>
                                    <span>Dashboard</span>
                                </a>
                            @elseif (Auth()->user()->role == 'dospem')
                                <a href="{{ route('dashboard.dospem') }}">
                                    <i class="fa-solid fa-house-chimney"></i>
                                    <span>Dashboard</span>
                                </a>
                            @elseif (Auth()->user()->role == 'kaprodi')
                                <a href="{{ route('dashboard.kaprodi') }}">
                                    <i class="fa-solid fa-house-chimney"></i>
                                    <span>Dashboard</span>
                                </a>
                            @elseif (Auth()->user()->role == 'koordinator')
                                <a href="{{ route('dashboard.koordinator') }}">
                                    <i class="fa-solid fa-house-chimney"></i>
                                    <span>Dashboard</span>
                                </a>
                            @endif
                        </li>

                        @if (Auth()->user()->role == 'koordinator')
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span>Magang</span>
                                </a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="#">Mitra</a>
                                        <ul class="submenu">
                                            <li><a href="">Daftar Mitra</a></li>
                                            <li><a href="">Daftar Lowongan</a></li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li class="has-submenu">
                                        <a href="#">Mitra Mandiri</a>
                                        <ul class="submenu">
                                            <li><a href="">Daftar Mitra Mandiri</a></li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li class="has-submenu">
                                        <a href="#">Pelamar Magang</a>
                                        <ul class="submenu">
                                            <li><a href="">Daftar Pelamar Magang</a></li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li class="has-submenu">
                                        <a href="#">Berkas Persyaratan</a>
                                        <ul class="submenu">
                                            <li><a href="#">Daftar Berkas</a></li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li>
                                        <a href="{{ route('admin.kategori.bidang.index') }}">
                                            Kategori Bidang
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                        @endif

                        @if (Auth()->user()->role == 'admin')
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-book"></i>
                                    <span>Akademik</span>
                                </a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="#">Program Studi</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('admin.jurusan.index') }}">Jurusan</a></li>
                                            <li><a href="{{ route('admin.prodi.index') }}">Prodi</a></li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li>
                                        <a href="#">
                                            Dosen
                                        </a>
                                        <a href="#">
                                            Mahasiswa
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                        @endif

                        @if (Auth()->user()->role == 'admin')
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span>Kelola Lowongan</span>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a href="#">
                                            <i></i>Lowongan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.berkas.index') }}">
                                            <i></i>Berkas
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i></i>Berkas Lowongan
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i></i>Prodi Lowongan
                                        </a>
                                    </li>
                                </ul>
                                <!--end submenu-->
                            </li>
                        @endif

                    </ul><!-- End navigation menu -->
                </div> <!-- end navigation -->
            </div> <!-- end container-fluid -->
        </div> <!-- end navbar-custom -->
    </div>
    <!-- Top Bar End -->
