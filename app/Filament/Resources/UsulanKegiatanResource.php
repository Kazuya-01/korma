<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsulanKegiatanResource\Pages;
use App\Models\UsulanKegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class UsulanKegiatanResource extends Resource
{
    protected static ?string $model = UsulanKegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Usulan Kegiatan';
    protected static ?string $pluralLabel = 'Usulan Kegiatan';
    protected static ?string $slug = 'usulan-kegiatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kegiatan')
                    ->required()
                    ->label('Nama Kegiatan'),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi'),

                Forms\Components\DatePicker::make('tanggal_usulan')
                    ->label('Tanggal Diusulkan')
                    ->required(),

                Forms\Components\TextInput::make('pengusul')
                    ->label('Nama Pengusul'),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                    ])
                    ->required()
                    ->default('menunggu'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kegiatan')->label('Kegiatan')->searchable(),
                Tables\Columns\TextColumn::make('pengusul')->label('Pengusul')->searchable(),
                Tables\Columns\TextColumn::make('tanggal_usulan')->label('Tanggal')->date(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'menunggu',
                        'success' => 'disetujui',
                        'danger' => 'ditolak',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
                        default => $state,
                    }),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'disetujui' => 'Disetujui',
                        'ditolak' => 'Ditolak',
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsulanKegiatans::route('/'),
            'create' => Pages\CreateUsulanKegiatan::route('/create'),
            'edit' => Pages\EditUsulanKegiatan::route('/{record}/edit'),
        ];
    }
}
