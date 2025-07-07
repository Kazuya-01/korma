<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnggotaResource\Pages;
use App\Filament\Resources\AnggotaResource\RelationManagers;
use App\Models\Anggota;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnggotaResource extends Resource
{
    protected static ?string $model = Anggota::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama')
                ->required()
                ->label('Nama Lengkap'),

            Forms\Components\Select::make('jabatan')
                ->options([
                    'Ketua' => 'Ketua',
                    'Wakil' => 'Wakil',
                    'Sekretaris' => 'Sekretaris',
                    'Bendahara' => 'Bendahara',
                    'Umum' => 'Umum',
                ])
                ->required(),

            Forms\Components\TextInput::make('kontak')
                ->label('Kontak (HP / Email)')
                ->nullable(),

            Forms\Components\FileUpload::make('foto')
                ->label('Foto Anggota')
                ->directory('foto-anggota')
                ->disk('public')
                ->image()
                ->preserveFilenames()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('foto')
                    ->label('Foto')
                    ->disk('public')
                    ->height(40)
                    ->circular(),

                Tables\Columns\TextColumn::make('nama')->searchable(),

                Tables\Columns\TextColumn::make('jabatan')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'Ketua' => 'success',
                        'Wakil' => 'info',
                        'Sekretaris' => 'warning',
                        'Bendahara' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('kontak')
                    ->label('Kontak'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jabatan')
                    ->options([
                        'Ketua' => 'Ketua',
                        'Wakil' => 'Wakil',
                        'Sekretaris' => 'Sekretaris',
                        'Bendahara' => 'Bendahara',
                        'Umum' => 'Umum',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAnggotas::route('/'),
            'create' => Pages\CreateAnggota::route('/create'),
            'edit' => Pages\EditAnggota::route('/{record}/edit'),
        ];
    }
}
