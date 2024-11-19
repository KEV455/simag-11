<?php

use App\Http\Controllers\AdminProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardDosenController;
use App\Http\Controllers\DashboardDospemController;
use App\Http\Controllers\DashboardKaprodiController;
use App\Http\Controllers\DashboardKoordinatorController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DosenPembimbingController;
use App\Http\Controllers\DosenProfileController;
use App\Http\Controllers\DospemProfileController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\KaprodiProfileController;
use App\Http\Controllers\KategoriBidangController;
use App\Http\Controllers\KoordinatorController;
use App\Http\Controllers\KoordinatorProfileController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MahasiswaProfileController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\UserController;

Route::middleware(['guest'])->group(function () {
    // Route Authentication
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('do.login');

    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
});

Route::middleware(['auth'])->group(function () {
    // Route Authentication
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route for Admin
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('dashboard.admin');
    Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('profile.admin.index');
    Route::put('/admin/profile/{id}/update', [AdminProfileController::class, 'update'])->name('profile.admin.update');

    // Route Manajemen Jurusan
    Route::get('/admin/manajemen-jurusan', [JurusanController::class, 'index'])->name('admin.jurusan.index');
    Route::post('/admin/manajemen-jurusan/create', [JurusanController::class, 'store'])->name('admin.jurusan.create');
    Route::get('/admin/manajemen-jurusan/{id}/delete', [JurusanController::class, 'destroy'])->name('admin.jurusan.destroy');
    Route::put('/admin/manajemen-jurusan/{id}/update', [JurusanController::class, 'update'])->name('admin.jurusan.update');

    // Route Manajemen Prodi
    Route::get('/admin/manajemen-prodi', [ProdiController::class, 'index'])->name('admin.prodi.index');
    Route::post('/admin/manajemen-prodi/create', [ProdiController::class, 'store'])->name('admin.prodi.create');
    Route::get('/admin/manajemen-prodi/{id}/delete', [ProdiController::class, 'destroy'])->name('admin.prodi.destroy');
    Route::put('/admin/manajemen-prodi/{id}/update', [ProdiController::class, 'update'])->name('admin.prodi.update');

    // Route Manajemen Dosen
    Route::get('/admin/manajemen-dosen', [DosenController::class, 'index'])->name('admin.dosen.index');
    Route::get('/admin/manajemen-dosen/create', [DosenController::class, 'create'])->name('admin.dosen.create');
    Route::post('/admin/manajemen-dosen/store', [DosenController::class, 'store'])->name('admin.dosen.store');
    Route::get('/admin/manajemen-dosen/{id}/edit', [DosenController::class, 'edit'])->name('admin.dosen.edit');
    Route::put('/admin/manajemen-dosen/{id}/update', [DosenController::class, 'update'])->name('admin.dosen.update');
    Route::get('/admin/manajemen-dosen/{id}/delete', [DosenController::class, 'destroy'])->name('admin.dosen.destroy');
    Route::post('/admin/manajemen-dosen/import', [DosenController::class, 'import'])->name('admin.dosen.import');

    // Route Manajemen Koordinator
    Route::get('/admin/manajemen-koordinator', [KoordinatorController::class, 'index'])->name('admin.koordinator.index');
    Route::post('/admin/manajemen-koordinator/store', [KoordinatorController::class, 'store'])->name('admin.koordinator.store');
    Route::put('/admin/manajemen-koordinator/{id}/update', [KoordinatorController::class, 'update'])->name('admin.koordinator.update');
    Route::get('/admin/manajemen-koordinator/{id}/delete', [KoordinatorController::class, 'destroy'])->name('admin.koordinator.destroy');

    // Route Manjemen User
    Route::get('/admin/manajemen-user', [UserController::class, 'index'])->name('admin.user.index');
    Route::post('/admin/manajemen-user/store', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/admin/manajemen-user/{id}/delete', [UserController::class, 'destroy'])->name('admin.user.destroy');

    // Route Manajemen Kaprodi
    Route::get('/admin/manajemen-kaprodi', [KaprodiController::class, 'index'])->name('admin.kaprodi.index');
    Route::post('/admin/manajemen-kaprodi/store', [KaprodiController::class, 'store'])->name('admin.kaprodi.store');
    Route::put('/admin/manajemen-kaprodi/{id}/update', [KaprodiController::class, 'update'])->name('admin.kaprodi.update');
    Route::get('/admin/manajemen-kaprodi/{id}/delete', [KaprodiController::class, 'destroy'])->name('admin.kaprodi.destroy');

    // Route Manajemen Mahasiswa
    Route::get('/admin/manajemen-mahasiswa', [MahasiswaController::class, 'index'])->name('admin.mahasiswa.index');
    Route::get('/admin/manajemen-mahasiswa/create', [MahasiswaController::class, 'create'])->name('admin.mahasiswa.create');
    Route::post('/admin/manajemen-mahasiswa/store', [MahasiswaController::class, 'store'])->name('admin.mahasiswa.store');
    Route::get('/admin/manajemen-mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('admin.mahasiswa.edit');
    Route::put('/admin/manajemen-mahasiswa/{id}/update', [MahasiswaController::class, 'update'])->name('admin.mahasiswa.update');
    Route::get('/admin/manajemen-mahasiswa/{id}/delete', [MahasiswaController::class, 'destroy'])->name('admin.mahasiswa.destroy');
    Route::post('/admin/manajemen-mahasiswa/import', [MahasiswaController::class, 'import'])->name('admin.mahasiswa.import');
});

Route::middleware(['auth', 'role:koordinator'])->group(function () {
    Route::get('/koordinator/dashboard', [DashboardKoordinatorController::class, 'index'])->name('dashboard.koordinator');
    Route::get('/koordinator/profile', [KoordinatorProfileController::class, 'index'])->name('profile.koordinator.index');
    Route::put('/koordinator/profile/{id}/update', [KoordinatorProfileController::class, 'update'])->name('profile.koordinator.update');

    // Route Manajemen Kategori Bidang
    Route::get('/koordinator/manajemen-kategori-bidang', [KategoriBidangController::class, 'index'])->name('koordinator.kategori.bidang.index');
    Route::post('/koordinator/manajemen-kategori-bidang/create', [KategoriBidangController::class, 'store'])->name('koordinator.kategori.bidang.create');
    Route::get('/koordinator/manajemen-kategori-bidang/delete/{id}', [KategoriBidangController::class, 'destroy'])->name('koordinator.kategori.bidang.destroy');
    Route::put('/koordinator/manajemen-kategori-bidang/{id}/update', [KategoriBidangController::class, 'update'])->name('koordinator.kategori.bidang.update');

    // Route Manajemen Mitra
    Route::get('/koordinator/manajemen-mitra', [MitraController::class, 'index'])->name('koordinator.mitra.index');
    Route::get('/koordinator/manajemen-mitra/create', [MitraController::class, 'create'])->name('koordinator.mitra.create');
    Route::post('/koordinator/manajemen-mitra/store', [MitraController::class, 'store'])->name('koordinator.mitra.store');
    Route::get('/koordinator/manajemen-mitra/{id}/edit', [MitraController::class, 'edit'])->name('koordinator.mitra.edit');
    Route::put('/koordinator/manajemen-mitra/{id}/update', [MitraController::class, 'update'])->name('koordinator.mitra.update');
    Route::get('/koordinator/manajemen-mitra/delete/{id}', [MitraController::class, 'destroy'])->name('koordinator.mitra.destroy');

    //Route Manaemen Berkas
    Route::get('/koordinator/manajemen-berkas', [BerkasController::class, 'index'])->name('koordinator.berkas.index');
    Route::post('/koordinator/manajemen-berkas/create', [BerkasController::class, 'store'])->name('koordinator.berkas.create');
    Route::get('/koordinator/manajemen-berkas/delete/{id}', [BerkasController::class, 'destroy'])->name('koordinator.berkas.destroy');
    Route::put('/koordinator/manajemen-berkas/{id}/update', [BerkasController::class, 'update'])->name('koordinator.berkas.update');

    // Route Manajemen Lowongan
    Route::get('/koordinator/manajemen-lowongan/index.php', [LowonganController::class, 'index'])->name('koordinator.lowongan.index');
    Route::post('/koordinator/manajemen-lowongan/create', [LowonganController::class, 'store'])->name('koordinator.lowongan.create');
    Route::get('/koordinator/manajemen-lowongan/delete/{id}', [LowonganController::class, 'destroy'])->name('koordinator.lowongan.destroy');
    Route::put('/koordinator/manajemen-lowongan/{id}/update', [LowonganController::class, 'update'])->name('koordinator.lowongan.update');
});

Route::middleware(['auth', 'role:kaprodi'])->group(function () {
    Route::get('/kaprodi/dashboard', [DashboardKaprodiController::class, 'index'])->name('dashboard.kaprodi');
    Route::get('/kaprodi/profile', [KaprodiProfileController::class, 'index'])->name('profile.kaprodi.index');
    Route::put('/kaprodi/profile/{id}/update', [KaprodiProfileController::class, 'update'])->name('profile.kaprodi.update');

    // Route Dosen Pembimbing
    Route::get('/kaprodi/manajemen-dosen-pembimbing', [DosenPembimbingController::class, 'index'])->name('kaprodi.dospem.index');
    Route::post('/kaprodi/manajemen-dosen-pembimbing/store', [DosenPembimbingController::class, 'store'])->name('kaprodi.dospem.store');
    Route::put('/kaprodi/manajemen-dosen-pembimbing/{id}/update', [DosenPembimbingController::class, 'update'])->name('kaprodi.dospem.update');
    Route::get('/kaprodi/manajemen-dosen-pembimbing/{id}/delete', [DosenPembimbingController::class, 'destroy'])->name('kaprodi.dospem.destroy');
});

Route::middleware(['auth', 'role:dospem'])->group(function () {
    Route::get('/dospem/dashboard', [DashboardDospemController::class, 'index'])->name('dashboard.dospem');
    Route::get('/dospem/profile', [DospemProfileController::class, 'index'])->name('profile.dospem.index');
    Route::put('/dospem/profile/{id}/update', [DospemProfileController::class, 'update'])->name('profile.dospem.update');
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', [DashboardDosenController::class, 'index'])->name('dashboard.dosen');
    Route::get('/dosen/profile', [DosenProfileController::class, 'index'])->name('profile.dosen.index');
    Route::put('/dosen/profile/{id}/update', [DosenProfileController::class, 'update'])->name('profile.dosen.update');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', [DashboardMahasiswaController::class, 'index'])->name('dashboard.mahasiswa');
    Route::get('/mahasiswa/profile', [MahasiswaProfileController::class, 'index'])->name('profile.mahasiswa.index');
    Route::put('/mahasiswa/profile/{id}/update', [MahasiswaProfileController::class, 'update'])->name('profile.mahasiswa.update');
});
