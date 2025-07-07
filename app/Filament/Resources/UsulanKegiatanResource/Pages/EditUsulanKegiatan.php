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
            // Cek apakah sudah pernah ditambahkan ke tabel kegiatan
            $exists = Kegiatan::where('nama_kegiatan', $this->record->nama_kegiatan)
                ->where('tanggal', $this->record->tanggal_usulan)
                ->exists();

            if (! $exists) {
                Kegiatan::create([
                    'nama_kegiatan' => $this->record->nama_kegiatan,
                    'deskripsi'     => $this->record->deskripsi,
                    'tanggal'       => $this->record->tanggal_usulan,
                    'waktu'         => '00:00:00', // default
                    'lokasi'        => null,
                    'kategori'      => 'lainnya',
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
