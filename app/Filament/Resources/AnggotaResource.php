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
use Illuminate\Support\Facades\Auth;
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
                    'ketua' => 'Ketua',
                    'wakil' => 'Wakil',
                    'sekretaris' => 'Sekretaris',
                    'bendahara' => 'Bendahara',
                    'anggota' => 'Anggota',
                ])
                ->required(),

            Forms\Components\TextInput::make('nomor_anggota')
                ->label('Nomor Anggota')
                ->required()
                ->unique(ignorable: fn ($record) => $record)
                ->maxLength(50),

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
                    ->label('Jabatan')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'ketua' => 'success',
                        'wakil' => 'info',
                        'sekretaris' => 'warning',
                        'bendahara' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn(string $state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('nomor_anggota')
                    ->label('Nomor Anggota')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kontak')
                    ->label('Kontak'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jabatan')
                    ->label('Filter Jabatan')
                    ->options([
                        'ketua' => 'Ketua',
                        'wakil' => 'Wakil',
                        'sekretaris' => 'Sekretaris',
                        'bendahara' => 'Bendahara',
                        'anggota' => 'Anggota',
                    ]),
            ])
            ->headerActions([
                Tables\Actions\Action::make('export_excel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn() => route('export.anggota.excel'))
                    ->openUrlInNewTab(),

                Tables\Actions\Action::make('export_pdf')
                    ->label('Export PDF')
                    ->icon('heroicon-o-document-text')
                    ->url(fn() => route('export.anggota.pdf'))
                    ->openUrlInNewTab(),
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
        return [];
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();
        return $user && in_array($user->role, ['ketua', 'sekretaris']);
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
