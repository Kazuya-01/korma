<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\ExportAnggotaController;
use App\Http\Controllers\Public\UsulanKegiatanController;

/*
|--------------------------------------------------------------------------
| ROUTE UTAMA
|--------------------------------------------------------------------------
*/

// Akses root diarahkan ke halaman publik
Route::get('/', [\App\Http\Controllers\Public\PublicController::class, 'home'])->name('home');
Route::post('/usulan', [\App\Http\Controllers\Public\UsulanKegiatanController::class, 'store']);
/*
|--------------------------------------------------------------------------
| ROUTE ADMIN FILAMENT (Export)
|--------------------------------------------------------------------------
*/

Route::get('/laporan/keuangan/export', [LaporanKeuanganController::class, 'export'])
    ->name('laporan.keuangan.export');

Route::get('/laporan/kegiatan/export', [LaporanKegiatanController::class, 'export'])
    ->name('laporan.kegiatan.export');

Route::get('/export/anggota/excel', [ExportAnggotaController::class, 'excel'])
    ->name('export.anggota.excel');

Route::get('/export/anggota/pdf', [ExportAnggotaController::class, 'pdf'])
    ->name('export.anggota.pdf');



