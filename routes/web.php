<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

use App\Http\Controllers\AuthController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/mahasiswa', fn() => view('dashboard.mahasiswa'))->name('dashboard.mahasiswa');
    Route::get('/dashboard/dospem', fn() => view('dashboard.dospem'))->name('dashboard.dospem');
    Route::get('/dashboard/kaprodi', fn() => view('dashboard.kaprodi'))->name('dashboard.kaprodi');
    Route::get('/dashboard/koordinator', fn() => view('dashboard.koordinator'))->name('dashboard.koordinator');
});

Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile')->middleware('auth');

