<?php

namespace App\Filament\Resources\PengaturanResource\Pages;

use App\Filament\Resources\PengaturanResource;
use Filament\Resources\Pages\ManageRecords;

class ManagePengaturan extends ManageRecords
{
    protected static string $resource = PengaturanResource::class;

    protected function getHeaderActions(): array
    {
        return []; // Supaya tidak ada tombol "Create"
    }
}
