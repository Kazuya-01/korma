<?php

namespace App\Filament\Resources\UsulanKegiatanResource\Pages;

use App\Filament\Resources\UsulanKegiatanResource;
use App\Models\Kegiatan;
use Filament\Resources\Pages\EditRecord;

class EditUsulanKegiatan extends EditRecord
{
    protected static string $resource = UsulanKegiatanResource::class;

    protected function afterSave(): void
    {
        if ($this->record->status === 'disetujui') {
            $exists = Kegiatan::where('nama_kegiatan', $this->record->nama_kegiatan)
                ->whereDate('tanggal', $this->record->tanggal)
                ->exists();

            if (! $exists) {
                Kegiatan::create([
                    'nama_kegiatan' => $this->record->nama_kegiatan,
                    'deskripsi'     => $this->record->deskripsi,
                    'tanggal'       => $this->record->tanggal,
                    'waktu'         => '00:00:00', // default
                    'lokasi'        => $this->record->lokasi,
                    'kategori'      => $this->record->kategori ?? 'lainnya',
                    'terlaksana'    => false,
                ]);
            }
        }
    }

    protected function getRedirectUrl(): string
    {
        return UsulanKegiatanResource::getUrl();
    }
}
