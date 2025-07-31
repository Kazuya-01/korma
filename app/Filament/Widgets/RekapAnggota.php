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
            Stat::make('Total Anggota', $total)
                ->description('Jumlah keseluruhan anggota')
                ->descriptionIcon('heroicon-o-users')
                ->color('primary'),

            Stat::make('Ketua', $ketua)
                ->description('Pemimpin utama')
                ->descriptionIcon('heroicon-o-user-circle')
                ->color('success'),

            Stat::make('Wakil', $wakil)
                ->description('Wakil ketua')
                ->descriptionIcon('heroicon-o-user')
                ->color('emerald'),

            Stat::make('Sekretaris', $sekretaris)
                ->description('Bagian administrasi')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('info'),

            Stat::make('Bendahara', $bendahara)
                ->description('Pengelola keuangan')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('warning'),

            Stat::make('Anggota', $umum)
                ->description('Anggota umum')
                ->descriptionIcon('heroicon-o-user-group')
                ->color('gray'),
        ];
    }
}
