    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- Navbar -->
        <nav class="topbar-main">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="#" class="logo">
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
                    <a class="nav-link waves-effect waves-light nav-user pr-0" href="#" role="button"
                        aria-expanded="false">
                        <span>Tahun Ajaran :
                            {{ $tahun_ajaran_aktif ? $tahun_ajaran_aktif->semester->nama_semester : 'Belum Diset!' }}</span>
                    </a>
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user pr-0" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('images/profile-picture.jpg') }}" alt="profile-user"
                            class="rounded-circle" />
                        <span class="ml-1 nav-user-name hidden-sm">&commat;{{ Auth()->user()->username }} <i
                                class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @if (Auth()->user()->role == 'admin')
                            <a class="dropdown-item" href="{{ route('profile.admin.index') }}">
                                <i class="dripicons-user text-muted mr-2"></i>
                                Profile
                            </a>
                        @endif
                        @if (Auth()->user()->role == 'dosen')
                            <a class="dropdown-item" href="{{ route('profile.dosen.index') }}">
                                <i class="dripicons-user text-muted mr-2"></i>
                                Profile
                            </a>
                        @endif
                        @if (Auth()->user()->role == 'dospem')
                            <a class="dropdown-item" href="{{ route('profile.dospem.index') }}">
                                <i class="dripicons-user text-muted mr-2"></i>
                                Profile
                            </a>
                        @endif
                        @if (Auth()->user()->role == 'mahasiswa')
                            <a class="dropdown-item" href="{{ route('profile.mahasiswa.index') }}">
                                <i class="dripicons-user text-muted mr-2"></i>
                                Profile
                            </a>
                        @endif
                        @if (Auth()->user()->role == 'kaprodi')
                            <a class="dropdown-item" href="{{ route('profile.kaprodi.index') }}">
                                <i class="dripicons-user text-muted mr-2"></i>
                                Profile
                            </a>
                        @endif
                        @if (Auth()->user()->role == 'koordinator')
                            <a class="dropdown-item" href="{{ route('profile.koordinator.index') }}">
                                <i class="dripicons-user text-muted mr-2"></i>
                                Profile
                            </a>
                        @endif
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
                            @elseif (Auth()->user()->role == 'dosen')
                                <a href="{{ route('dashboard.dosen') }}">
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

                        {{-- Navbar Admin --}}
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
                                        <a href="{{ route('admin.koordinator.index') }}">
                                            Koordinator
                                        </a>
                                        <a href="{{ route('admin.kaprodi.index') }}">
                                            Kaprodi
                                        </a>
                                        <a href="{{ route('admin.dosen.index') }}">
                                            Dosen
                                        </a>
                                        <a href="{{ route('admin.mahasiswa.index') }}">
                                            Mahasiswa
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->

                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-gear"></i>
                                    <span>Setting</span>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{ route('admin.user.index') }}">
                                            User
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.semester.index') }}">
                                            Semester
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.tahun.ajaran.edit') }}">
                                            Tahun Ajaran
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                        @endif

                        {{-- Navbar Koordinator --}}
                        @if (Auth()->user()->role == 'koordinator')
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <span>Mitra</span>
                                </a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="#">Mitra</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('koordinator.mitra.index') }}">Daftar Mitra</a></li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li class="has-submenu">
                                        <a href="#">Mitra Mandiri</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('koordinator.mitra.mandiri.index') }}">Daftar Mitra
                                                    Mandiri</a></li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li class="has-submenu">
                                        <a href="#">Lowongan</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('koordinator.lowongan.index') }}">Daftar
                                                    Lowongan</a>
                                            </li>

                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li class="has-submenu">
                                        <a href="#">Pelamar Magang</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('koordinator.pelamar.magang.index') }}">Daftar
                                                    Pelamar Magang</a></li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li class="has-submenu">
                                        <a href="#">Berkas Persyaratan</a>
                                        <ul class="submenu">
                                            <li><a href="{{ route('koordinator.berkas.index') }}">Daftar Berkas</a>
                                            </li>
                                        </ul>
                                    </li><!--end has-submenu-->
                                    <li>
                                        <a href="{{ route('koordinator.kategori.bidang.index') }}">
                                            Kategori Bidang
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                        @endif

                        {{-- Navbar Kaprodi --}}
                        @if (Auth()->user()->role == 'kaprodi')
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-book"></i>
                                    <span>Akademik</span>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{ route('kaprodi.dospem.index') }}">
                                            Dosen Pembimbing
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('kaprodi.validasi.nilai.index') }}">
                                            Validasi Nilai Magang
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                        @endif

                        {{-- Navbar Dosen --}}
                        @if (Auth()->user()->role == 'dosen')
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-user"></i>
                                    <span>Profil</span>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{ route('profile.dosen.index') }}">
                                            Profil Saya
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                        @endif

                        {{-- Navbar Dosen Pembimbing --}}
                        @if (Auth()->user()->role == 'dospem')
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-book"></i>
                                    <span>Magang</span>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{ route('dospem.mahasiswa.bimbingan.index') }}">
                                            Logbook Kegiatan
                                        </a>
                                        <a href="{{ route('dospem.penilaian.magang.index') }}">
                                            Penilaian Magang
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                        @endif

                        {{-- Navbar Mahasiswa --}}
                        @if (Auth()->user()->role == 'mahasiswa')
                            <li class="has-submenu">
                                <a href="#">
                                    <i class="fa-solid fa-book"></i>
                                    <span>Magang</span>
                                </a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{ route('mahasiswa.daftar.magang.index') }}">
                                            Daftar Magang
                                        </a>
                                        <a href="{{ route('mahasiswa.permohonan.magang.index') }}">
                                            Permohonan Magang
                                        </a>
                                        <a href="{{ route('mahasiswa.mitra.mandiri.index') }}">
                                            Pengajuan Mitra Mandiri
                                        </a>
                                    </li>
                                </ul><!--end submenu-->
                            </li><!--end has-submenu-->
                        @endif
                    </ul><!-- End navigation menu -->
                </div> <!-- end navigation -->
            </div> <!-- end container-fluid -->
        </div> <!-- end navbar-custom -->
    </div>
    <!-- Top Bar End -->
