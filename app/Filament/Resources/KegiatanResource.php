<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KegiatanResource\Pages;
use App\Filament\Resources\KegiatanResource\RelationManagers;
use App\Models\Kegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kegiatan')
                    ->label('Nama Kegiatan')
                    ->required(),

                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(3),

                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),

                Forms\Components\TimePicker::make('waktu')
                    ->label('Waktu')
                    ->required(),

                Forms\Components\TextInput::make('lokasi')
                    ->label('Lokasi'),

                Forms\Components\Select::make('kategori')
                    ->label('Kategori')
                    ->options([
                        'kajian' => 'Kajian',
                        'rapat' => 'Rapat',
                        'lomba' => 'Lomba',
                        'sosial' => 'Sosial',
                        'lainnya' => 'Lainnya',
                    ])
                    ->required(),

                Forms\Components\FileUpload::make('foto')
                    ->label('Foto Dokumentasi')
                    ->directory('dokumentasi')
                    ->disk('public')
                    ->preserveFilenames()
                    ->image()
                    ->maxSize(2048)
                    ->nullable(),

                Forms\Components\Toggle::make('terlaksana')
                    ->label('Sudah Terlaksana')
                    ->default(false),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_kegiatan')
                    ->label('Kegiatan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('tanggal')
                    ->label('Tanggal')
                    ->date(),

                Tables\Columns\TextColumn::make('waktu')
                    ->label('Waktu')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('kategori')
                    ->badge()
                    ->color(fn(string $state) => match ($state) {
                        'kajian' => 'success',
                        'rapat' => 'info',
                        'lomba' => 'warning',
                        'sosial' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\IconColumn::make('terlaksana')
                    ->label('Status')
                    ->boolean(),

                Tables\Columns\ImageColumn::make('foto')
                    ->label('Dokumentasi')
                    ->disk('public')
                    ->height(40)
                    ->circular()
                    ->default(fn($record) => $record->dokumentasi ? asset('storage/' . $record->dokumentasi) : null)
                    ->placeholder('-')
                    ->toggleable(),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Action::make('Cetak Laporan PDF')
                    ->label('Cetak PDF')
                    ->icon('heroicon-o-printer')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_awal')
                            ->label('Dari Tanggal')
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal_akhir')
                            ->label('Sampai Tanggal')
                            ->required()
                            ->after('tanggal_awal'),
                    ])
                    ->action(function (array $data) {
                        $query = http_build_query([
                            'tanggal_awal'  => $data['tanggal_awal'],
                            'tanggal_akhir' => $data['tanggal_akhir'],
                        ]);
                        return redirect('/laporan/kegiatan/export?' . $query);
                    })
                    ->openUrlInNewTab()
                    ->color('gray'),
            ]);
    }

    public static function canAccess(): bool
    {
        $user = Auth::user();

        return $user && in_array($user->role, ['ketua', 'wakil', 'sekretaris']);
    }
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    public static function getNavigationGroup(): ?string
    {
        return '📅 Manajemen Kegiatan';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKegiatans::route('/'),
            'create' => Pages\CreateKegiatan::route('/create'),
            'edit' => Pages\EditKegiatan::route('/{record}/edit'),
        ];
    }
}
