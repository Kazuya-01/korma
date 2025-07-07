<?php

namespace App\Filament\Resources\UsulanKegiatanResource\Pages;

use App\Filament\Resources\UsulanKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUsulanKegiatan extends CreateRecord
{
    protected static string $resource = UsulanKegiatanResource::class;
    protected function getRedirectUrl(): string
    {
        return UsulanKegiatanResource::getUrl();
    }
}
