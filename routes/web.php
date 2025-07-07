<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanKeuanganController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/laporan-keuangan/export', [LaporanKeuanganController::class, 'export'])->name('laporan-keuangan.export');
