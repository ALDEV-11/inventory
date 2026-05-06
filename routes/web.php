<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Redirect root ke login
Route::get('/', function () {
    return redirect('/login');
});

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin'])->name('doLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::middleware('auth')->get('/dashboard', [DashboardController::class, 'index']);
// Barang CRUD
Route::middleware('auth')->resource('barang', \App\Http\Controllers\BarangController::class);

// Purchase Order (Barang Masuk)
Route::middleware('auth')->group(function() {
    Route::resource('barang-masuk', \App\Http\Controllers\BarangMasukController::class);
    Route::post('barang-masuk/{id}/approve', [\App\Http\Controllers\BarangMasukController::class, 'approve'])->name('barang-masuk.approve');
    Route::post('barang-masuk/{id}/receive', [\App\Http\Controllers\BarangMasukController::class, 'receive'])->name('barang-masuk.receive');
});

// Barang Keluar (Outgoing Goods) - API and Resource
Route::middleware('auth')->group(function() {
    Route::get('/api/barang/{id}/stok', [\App\Http\Controllers\BarangKeluarController::class, 'checkStock'])->name('api.barang.stok');
    Route::resource('barang-keluar', \App\Http\Controllers\BarangKeluarController::class)->except(['edit', 'update', 'destroy']);
    Route::resource('retur-barang', \App\Http\Controllers\ReturBarangController::class)->except(['edit', 'update', 'destroy']);

    // Notifikasi Stok
    Route::get('/notifikasi', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifikasi.index');
    Route::post('/notifikasi/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifikasi.markAsRead');
    Route::post('/notifikasi/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifikasi.markAllAsRead');
});

// Master Data CRUD (Admin Only)
Route::middleware(['auth'])->group(function() {
    Route::resource('kategori-barang', \App\Http\Controllers\KategoriBarangController::class);
    Route::resource('supplier', \App\Http\Controllers\SupplierController::class);
    Route::resource('lokasi', \App\Http\Controllers\LokasiController::class);
});

// Laporan (Admin & Kepala)
Route::middleware(['auth', 'can:lihat-laporan'])->prefix('laporan')->name('laporan.')->group(function() {
    // Halaman utama
    Route::get('/', [\App\Http\Controllers\LaporanController::class, 'index'])->name('index');

    // Mutasi
    Route::get('/mutasi', [\App\Http\Controllers\LaporanController::class, 'mutasi'])->name('mutasi');
    Route::get('/mutasi/preview', [\App\Http\Controllers\LaporanController::class, 'mutasiPreview'])->name('mutasi.preview');
    Route::get('/mutasi/pdf', [\App\Http\Controllers\LaporanController::class, 'mutasiPdf'])->name('mutasi.pdf');
    Route::get('/mutasi/excel', [\App\Http\Controllers\LaporanController::class, 'mutasiExcel'])->name('mutasi.excel');

    // Opname
    Route::get('/opname', [\App\Http\Controllers\LaporanController::class, 'opname'])->name('opname');
    Route::get('/opname/preview', [\App\Http\Controllers\LaporanController::class, 'opnamePreview'])->name('opname.preview');
    Route::get('/opname/pdf', [\App\Http\Controllers\LaporanController::class, 'opnamePdf'])->name('opname.pdf');
    Route::get('/opname/excel', [\App\Http\Controllers\LaporanController::class, 'opnameExcel'])->name('opname.excel');

    // Kartu Stok
    Route::get('/kartu', [\App\Http\Controllers\LaporanController::class, 'kartu'])->name('kartu');
    Route::get('/kartu/preview', [\App\Http\Controllers\LaporanController::class, 'kartuPreview'])->name('kartu.preview');
    Route::get('/kartu/pdf', [\App\Http\Controllers\LaporanController::class, 'kartuPdf'])->name('kartu.pdf');
    Route::get('/kartu/excel', [\App\Http\Controllers\LaporanController::class, 'kartuExcel'])->name('kartu.excel');
});

