<?php

namespace App\Filament\Resources\TransaksiKeuanganResource\Pages;

use App\Filament\Resources\TransaksiKeuanganResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;

class ListTransaksiKeuangans extends ListRecords
{
    protected static string $resource = TransaksiKeuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Cetak PDF')
                ->label('Cetak PDF')
                ->icon('heroicon-o-printer')
                ->color('primary')
                ->form([
                    Forms\Components\Select::make('periode')
                        ->label('Periode')
                        ->options([
                            'bulanan' => 'Bulanan',
                            'tahunan' => 'Tahunan',
                        ])
                        ->default('bulanan')
                        ->required(),

                    Forms\Components\Select::make('bulan')
                        ->label('Bulan')
                        ->options([
                            '1' => 'Januari',
                            '2' => 'Februari',
                            '3' => 'Maret',
                            '4' => 'April',
                            '5' => 'Mei',
                            '6' => 'Juni',
                            '7' => 'Juli',
                            '8' => 'Agustus',
                            '9' => 'September',
                            '10' => 'Oktober',
                            '11' => 'November',
                            '12' => 'Desember',
                        ])
                        ->default(now()->month)
                        ->visible(fn ($get) => $get('periode') === 'bulanan'),

                    Forms\Components\Select::make('tahun')
                        ->label('Tahun')
                        ->options(collect(range(now()->year, 2020))->mapWithKeys(fn ($y) => [$y => $y])->all())
                        ->default(now()->year)
                        ->required(),
                ])
                ->action(function (array $data) {
                    $params = http_build_query($data);
                    $url = route('laporan.keuangan.export') . '?' . $params;

                    return redirect($url);
                })
                ->openUrlInNewTab(),
        ];
    }
}
