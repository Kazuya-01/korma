<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\TransaksiKeuangan;

class RekapKeuangan extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function getStats(): array
    {
        // Hitung saldo keseluruhan
        $pemasukanTotal = TransaksiKeuangan::where('jenis', 'pemasukan')->sum('jumlah');
        $pengeluaranTotal = TransaksiKeuangan::where('jenis', 'pengeluaran')->sum('jumlah');
        $saldo = $pemasukanTotal - $pengeluaranTotal;

        // Hitung data bulan ini
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $pemasukanBulanIni = TransaksiKeuangan::where('jenis', 'pemasukan')
            ->whereYear('tanggal', $tahunIni)
            ->whereMonth('tanggal', $bulanIni)
            ->sum('jumlah');

        $pengeluaranBulanIni = TransaksiKeuangan::where('jenis', 'pengeluaran')
            ->whereYear('tanggal', $tahunIni)
            ->whereMonth('tanggal', $bulanIni)
            ->sum('jumlah');

        $totalTransaksi = TransaksiKeuangan::count();

        return [
            Stat::make('Saldo Kas', 'Rp ' . number_format($saldo, 0, ',', '.'))
                ->description('Total saldo hingga hari ini')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color($saldo >= 0 ? 'success' : 'danger'),

            Stat::make('Pemasukan Bulan Ini', 'Rp ' . number_format($pemasukanBulanIni, 0, ',', '.'))
                ->description('Periode: ' . now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-o-arrow-up-circle')
                ->color('success'),

            Stat::make('Pengeluaran Bulan Ini', 'Rp ' . number_format($pengeluaranBulanIni, 0, ',', '.'))
                ->description('Periode: ' . now()->translatedFormat('F Y'))
                ->descriptionIcon('heroicon-o-arrow-down-circle')
                ->color('danger'),

            Stat::make('Jumlah Transaksi', $totalTransaksi)
                ->description('Total semua transaksi')
                ->descriptionIcon('heroicon-o-receipt-percent')
                ->color('gray'),
        ];
    }
}
