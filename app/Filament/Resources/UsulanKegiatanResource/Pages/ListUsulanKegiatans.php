<?php

namespace App\Filament\Resources\UsulanKegiatanResource\Pages;

use App\Filament\Resources\UsulanKegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsulanKegiatans extends ListRecords
{
    protected static string $resource = UsulanKegiatanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
