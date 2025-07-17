<?php

namespace App\Filament\Widgets;

use App\Models\Anggota;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class RekapAnggota extends BaseWidget
{
    protected function getStats(): array
    {
        $total = Anggota::count();
        $ketua = Anggota::where('jabatan', 'ketua')->count();
        $wakil = Anggota::where('jabatan', 'wakil')->count();
        $sekretaris = Anggota::where('jabatan', 'sekretaris')->count();
        $bendahara = Anggota::where('jabatan', 'bendahara')->count();
        $umum = Anggota::where('jabatan', 'anggota')->count();

        return [
            Stat::make('Total Anggota', $total)->color('primary'),
            Stat::make('Ketua', $ketua)->color('success'),
            Stat::make('Wakil', $wakil)->color('success'),
            Stat::make('Sekretaris', $sekretaris)->color('info'),
            Stat::make('Bendahara', $bendahara)->color('warning'),
            Stat::make('Anggota', $umum)->color('gray'),
        ];
    }
}
