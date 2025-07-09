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
        $ketua = Anggota::where('jabatan', 'Ketua')->count();
        $sekretaris = Anggota::where('jabatan', 'Sekretaris')->count();
        $umum = Anggota::where('jabatan', 'Umum')->count();

        return [
            Stat::make('Total Anggota', $total)->color('primary'),
            Stat::make('Ketua', $ketua)->color('success'),
            Stat::make('Sekretaris', $sekretaris)->color('info'),
            Stat::make('Umum', $umum)->color('gray'),
        ];
    }
}
