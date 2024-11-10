<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Koordinator Magang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Sistem Informasi Magang</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle"></i> {{ $user->username }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="profilkordinator.html">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Keluar</button>
                                </form>
                            </li>
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
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard.koordinator') }}">
                                <i class=""></i> Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kelolamahasiswa.html">
                                <i class=""></i> Kelola Mahasiswa
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="penetapandosenpembimbing.html">
                                <i class=""></i> Penetapan Dosen Pembimbing
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="kelolamitrakordinator.html">
                                <i class=""></i> Kelola Mitra
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="laporanmagangkordinator.html">
                                <i class=""></i> Laporan Magang
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard Koordinator Magang</h1>
                    <p class="text-muted">Selamat datang, {{ $user->name }}</p>
                </div>

                <!-- Dashboard Cards -->
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4 dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Kelola Mahasiswa</h5>
                                <p class="card-text">Melihat dan mengelola data mahasiswa yang mengikuti magang.</p>
                                <a href="kelolamahasiswa.html" class="btn btn-primary">Akses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4 dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Penetapan Dosen Pembimbing</h5>
                                <p class="card-text">Mengatur penetapan dosen pembimbing magang untuk mahasiswa.</p>
                                <a href="penetapandosenpembimbing.html" class="btn btn-primary">Akses</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4 dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Kelola Mitra</h5>
                                <p class="card-text">Menambah, mengelola, dan mengecek status mitra magang.</p>
                                <a href="kelolamitrakordinator.html" class="btn btn-primary">Akses</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-4 dashboard-card">
                            <div class="card-body">
                                <h5 class="card-title">Laporan Magang</h5>
                                <p class="card-text">Melihat laporan magang mahasiswa dan status penilaian.</p>
                                <a href="laporanmagangkordinator.html" class="btn btn-primary">Akses</a>
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
