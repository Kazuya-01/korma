<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\TransaksiKeuangan;
use Illuminate\Support\Carbon;

class RekapKeuangan extends BaseWidget
{
    protected int | string | array $columnSpan = 'full'; // ⬅️ Tambahkan ini

    public function getStats(): array
    {
        $saldo = 0;
        $transaksi = TransaksiKeuangan::orderBy('tanggal')->orderBy('id')->get();

        foreach ($transaksi as $item) {
            $saldo += $item->jenis === 'pemasukan'
                ? $item->jumlah
                : -$item->jumlah;
        }

        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

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
            Stat::make('Saldo Kas', 'Rp ' . number_format($saldo, 0, ',', '.'))->color('success'),
            Stat::make('Pemasukan Bulan Ini', 'Rp ' . number_format($pemasukanBulanIni, 0, ',', '.'))->color('primary'),
            Stat::make('Pengeluaran Bulan Ini', 'Rp ' . number_format($pengeluaranBulanIni, 0, ',', '.'))->color('danger'),
            Stat::make('Jumlah Transaksi', $totalTransaksi)->color('gray'),
        ];
    }
}
