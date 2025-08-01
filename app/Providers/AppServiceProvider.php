<?php

namespace App\Providers;

use App\Models\TransaksiKeuangan;
use Filament\Facades\Filament;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
     View::composer('partials.transparansi-keuangan', function ($view) {
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $totalPemasukan = TransaksiKeuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = TransaksiKeuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $pemasukanBulanIni = TransaksiKeuangan::where('jenis', 'pemasukan')
            ->whereYear('tanggal', $tahunIni)
            ->whereMonth('tanggal', $bulanIni)
            ->sum('jumlah');

        $pengeluaranBulanIni = TransaksiKeuangan::where('jenis', 'pengeluaran')
            ->whereYear('tanggal', $tahunIni)
            ->whereMonth('tanggal', $bulanIni)
            ->sum('jumlah');

        $view->with(compact('saldoKas', 'pemasukanBulanIni', 'pengeluaranBulanIni'));
    });
    Filament::registerRenderHook(
        'scripts.end',
        fn (): string => <<<'HTML'
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                window.addEventListener('swal:success', event => {
                    Swal.fire({
                        icon: 'success',
                        title: event.detail.title || 'Berhasil',
                        text: event.detail.text || 'Data berhasil disimpan!',
                        confirmButtonColor: '#3085d6',
                    });
                });
            </script>
        HTML
    );

        Paginator::useBootstrapFive();
    }
}
