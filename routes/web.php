<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\PenyewaanController;
use App\Http\Controllers\Admin\PembayaranController;
use App\Http\Controllers\Admin\PengembalianController;

Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('home');
Route::get('/katalog', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
Route::get('/barang/{id}', [\App\Http\Controllers\User\BarangController::class, 'show'])->name('user.barang.detail');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



// admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    Route::resource('users', UserController::class);
    Route::resource('barang', BarangController::class);

    // penyewaan
    Route::resource('penyewaan', PenyewaanController::class);

    // pembayaran
    Route::get('pembayaran/create/{id_penyewaan}',
        [PembayaranController::class, 'create']
    )->name('pembayaran.create');

    Route::post('pembayaran',
        [PembayaranController::class, 'store']
    )->name('pembayaran.store');

    Route::get('pembayaran',
        [PembayaranController::class, 'index']
    )->name('pembayaran.index');

    Route::get('pembayaran/{id}',
        [PembayaranController::class, 'show']
    )->name('pembayaran.show');

    // pengembalian
    Route::resource('pengembalian', PengembalianController::class);
    Route::get('pengembalian/{id}/receipt', [PengembalianController::class, 'receipt'])->name('pengembalian.receipt');

    // laporan
    Route::get('laporan', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('laporan.index');
});
