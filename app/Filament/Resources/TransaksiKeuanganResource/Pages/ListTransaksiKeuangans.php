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
                    Forms\Components\DatePicker::make('tanggal_awal')
                        ->label('Dari Tanggal')
                        ->required(),

                    Forms\Components\DatePicker::make('tanggal_akhir')
                        ->label('Sampai Tanggal')
                        ->required()
                        ->after('tanggal_awal'),

                    Forms\Components\Select::make('jenis')
                        ->label('Jenis Transaksi')
                        ->options([
                            'semua' => 'Semua',
                            'pemasukan' => 'Pemasukan',
                            'pengeluaran' => 'Pengeluaran',
                        ])
                        ->default('semua')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $params = http_build_query($data);

                    $fileName = 'laporan-keuangan-'
                        . $data['tanggal_awal'] . '-sd-'
                        . $data['tanggal_akhir'];

                    if ($data['jenis'] !== 'semua') {
                        $fileName .= '-' . $data['jenis'];
                    }

                    $fileName .= '.pdf';

                    $url = route('laporan.keuangan.export')
                        . '?' . $params
                        . '&file=' . $fileName;

                    return redirect($url);
                })
                ->openUrlInNewTab(),
        ];
    }
}
