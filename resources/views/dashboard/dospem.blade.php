<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Dosen Pembimbing</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.dospem') }}">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Keluar</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar Menu -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard.dospem') }}">
                                <i class=""></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logbook.dospem') }}">
                                <i class=""></i> Logbook
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('laporan.dospem') }}">
                                <i class=""></i> Laporan Mahasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('cpl.dospem') }}">
                                <i class=""></i> Ketercapaian CPL
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('konversi.dospem') }}">
                                <i class=""></i> Konversi Nilai
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Selamat Datang, {{ Auth::user()->name }}!</h1>
                </div>

                <!-- Dashboard Cards -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4 dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Logbook </h5>
                                <p class="card-text">Melihat kegiatan mahasiswa.</p>
                                <a href="{{ route('logbook.dospem') }}" class="btn btn-primary">Akses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4 dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Laporan Mahasiswa</h5>
                                <p class="card-text">Melihat kelayakan mahasiswa.</p>
                                <a href="{{ route('laporan.dospem') }}" class="btn btn-primary">Akses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4 dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Ketercapaian CPL</h5>
                                <p class="card-text">Melihat CPL mahasiswa.</p>
                                <a href="{{ route('cpl.dospem') }}" class="btn btn-primary">Akses</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
