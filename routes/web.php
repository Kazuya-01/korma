<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanKeuanganController;
use App\Http\Controllers\LaporanKegiatanController;
use App\Http\Controllers\ExportAnggotaController;
use App\Http\Controllers\Public\PublicController;
use App\Http\Controllers\Public\UsulanKegiatanController;
use App\Models\Kegiatan;
use Filament\Notifications\Notification;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| ROUTE UTAMA
|--------------------------------------------------------------------------
*/

// Akses root diarahkan ke halaman publik
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::post('/usulan', [\App\Http\Controllers\Public\UsulanKegiatanController::class, 'store']);
Route::get('/laporan-keuangan/pdf', [PublicController::class, 'unduh'])
    ->name('laporan.keuangan.pdf');
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


Route::get('/api/kegiatan', function () {
    return Kegiatan::all()->map(function ($kegiatan) {
        return [
            'title' => $kegiatan->nama_kegiatan,
            'start' => $kegiatan->tanggal->format('Y-m-d') . 'T' . $kegiatan->waktu->format('H:i:s'),
            'url' => '#', // bisa diubah untuk lihat detail
        ];
    });
});
