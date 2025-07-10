<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengaturanResource\Pages;
use App\Models\Pengaturan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PengaturanResource extends Resource
{
    protected static ?string $model = Pengaturan::class;
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $pluralLabel = 'Pengaturan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_organisasi')
                ->label('Nama Organisasi')
                ->required()
                ->maxLength(255),

            Forms\Components\FileUpload::make('logo')
                ->label('Logo')
                ->directory('logo-organisasi')
                ->disk('public')
                ->image()
                ->preserveFilenames()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        Tables\Columns\ImageColumn::make('logo')
            ->label('Logo')
            ->disk('public')
            ->height(40)
            ->circular()
            ->default(fn($record) => $record->logo ? asset('storage/' . $record->logo) : null);
        return $table->columns([
            Tables\Columns\TextColumn::make('nama_organisasi')->label('Nama'),
            Tables\Columns\ImageColumn::make('logo')->label('Logo')->disk('public')->height(40),
        ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePengaturan::route('/'),
        ];
    }
}
