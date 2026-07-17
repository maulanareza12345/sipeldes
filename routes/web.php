<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanPelayananController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegister'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Landing page sebelum login
Route::get('/', function () {
    return view('welcome');
})->name('landing');


// Reset password admin via email
Route::get('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [\App\Http\Controllers\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [\App\Http\Controllers\PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password/{token}', [\App\Http\Controllers\PasswordResetController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth')->group(function () {
    // Abaikan route '/' di dalam group auth agar landing page publik tetap tampil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk.index');
    Route::post('/penduduk', [PendudukController::class, 'store'])->name('penduduk.store');
    Route::get('/penduduk/{penduduk}/edit', [PendudukController::class, 'edit'])->name('penduduk.edit');
    Route::put('/penduduk/{penduduk}', [PendudukController::class, 'update'])->name('penduduk.update');
    Route::delete('/penduduk/{penduduk}', [PendudukController::class, 'destroy'])->name('penduduk.destroy');

    Route::get('/pengajuan-surat', [PengajuanSuratController::class, 'index'])->name('pengajuan-surat.index');
    Route::post('/pengajuan-surat', [PengajuanSuratController::class, 'store'])->name('pengajuan-surat.store');
    Route::get('/pengajuan-surat/penduduk/search', [PengajuanSuratController::class, 'searchPenduduk'])->name('pengajuan-surat.penduduk.search');
    Route::post('/pengajuan-surat/{pengajuanSurat}/approve', [PengajuanSuratController::class, 'approve'])->name('pengajuan-surat.approve');
    Route::post('/pengajuan-surat/{pengajuanSurat}/reject', [PengajuanSuratController::class, 'reject'])->name('pengajuan-surat.reject');
    Route::get('/pengajuan-surat/{pengajuanSurat}/pdf', [PengajuanSuratController::class, 'pdf'])->name('pengajuan-surat.pdf');
    Route::delete('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'destroy'])->name('pengajuan-surat.destroy');

    Route::get('/laporan', [LaporanPelayananController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/generate', [LaporanPelayananController::class, 'generate'])->name('laporan.generate');
    Route::get('/laporan/{laporanPelayanan}/pdf', [LaporanPelayananController::class, 'pdf'])->name('laporan.pdf');

    // Pengaturan TTD Bulanan untuk rekap laporan (PDF)
    Route::get('/laporan/ttd-bulanan', [\App\Http\Controllers\LaporanTtdBulananController::class, 'edit'])->name('laporan.ttd-bulanan.edit');
    Route::post('/laporan/ttd-bulanan', [\App\Http\Controllers\LaporanTtdBulananController::class, 'update'])->name('laporan.ttd-bulanan.update');

    // Hapus rekap laporan
    Route::delete('/laporan/{laporanPelayanan}', [\App\Http\Controllers\LaporanTtdBulananController::class, 'destroy'])->name('laporan.destroy');



});


