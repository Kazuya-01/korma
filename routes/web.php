<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\ExportAnggotaController;


Route::get('/', function () {
    return redirect()->route('filament.admin.auth.login');
});

Route::get('/laporan/keuangan/export', [LaporanKeuanganController::class, 'export'])
    ->name('laporan.keuangan.export'); // pakai titik

Route::get('/laporan/kegiatan/export', [LaporanKegiatanController::class, 'export'])->name('laporan.kegiatan.export');

Route::get('/export/anggota/excel', [ExportAnggotaController::class, 'excel'])->name('export.anggota.excel');
Route::get('/export/anggota/pdf', [ExportAnggotaController::class, 'pdf'])->name('export.anggota.pdf');


