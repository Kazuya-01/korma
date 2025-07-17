<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UsulanKegiatanResource\Pages;
use App\Models\UsulanKegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;

class UsulanKegiatanResource extends Resource
{
    protected static ?string $model = UsulanKegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox';
    protected static ?string $navigationLabel = 'Usulan Kegiatan';
    protected static ?string $pluralLabel = 'Usulan Kegiatan';
    protected static ?string $slug = 'usulan-kegiatan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('nama_kegiatan')
                ->label('Nama Kegiatan')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->rows(4)
                ->nullable(),

            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal Usulan')
                ->required(),

            Forms\Components\TextInput::make('lokasi')
                ->label('Lokasi')
                ->required()
                ->maxLength(255),

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
                Forms\Components\TimePicker::make('waktu')
    ->label('Waktu')
    ->required(),

            Forms\Components\TextInput::make('pengusul')
                ->label('Nama Pengusul')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('nomor_anggota')
                ->label('Nomor Anggota')
                ->required()
                ->maxLength(50),

            Forms\Components\Select::make('status')
                ->label('Status Usulan')
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
                Tables\Columns\TextColumn::make('nama_kegiatan')
                    ->label('Nama Kegiatan')
                    ->searchable()
                    ->limit(30)
                    ->action(fn($record) => $record),
                Tables\Columns\TextColumn::make('pengusul')
                    ->label('Pengusul')
                    ->limit(20)
                    ->action(fn($record) => $record),
                Tables\Columns\TextColumn::make('nomor_anggota')
                ->label('Nomor Anggota')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal')->date(),
                Tables\Columns\TextColumn::make('waktu')->label('Waktu'),
                Tables\Columns\TextColumn::make('kategori')->label('Kategori')->badge()->color('gray'),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'menunggu',
                        'success' => 'disetujui',
                        'danger' => 'ditolak',
                    ])
                    ->formatStateUsing(fn($state) => ucfirst($state)),
            ])
            ->actions([
                Action::make('ubah_status')
                    ->label('Ubah Status')
                    ->icon('heroicon-o-pencil-square')
                    ->modalHeading('Ubah Status Usulan')
                    ->modalSubmitActionLabel('Simpan')
                    ->mountUsing(fn($form, UsulanKegiatan $record) => $form->fill([
                        'status' => $record->status,
                    ]))
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'menunggu' => 'Menunggu',
                                'disetujui' => 'Disetujui',
                                'ditolak' => 'Ditolak',
                            ])
                            ->required(),
                    ])
                    ->action(function (array $data, UsulanKegiatan $record): void {
                        $record->update(['status' => $data['status']]);

                        if ($data['status'] === 'disetujui') {
                            // Cek apakah sudah pernah dimigrasi ke kegiatan
                            $sudahAda = \App\Models\Kegiatan::where('nama_kegiatan', $record->nama_kegiatan)
                                ->where('tanggal', $record->tanggal)
                                ->first();

                            if (!$sudahAda) {
                                \App\Models\Kegiatan::create([
                                    'nama_kegiatan' => $record->nama_kegiatan,
                                    'deskripsi'     => $record->deskripsi,
                                    'tanggal'       => $record->tanggal,
                                    'lokasi'        => $record->lokasi,
                                    'kategori'      => $record->kategori,
                                   'waktu' => $record->waktu && $record->waktu !== '' ? $record->waktu : '00:00',
                                    'terlaksana'    => false,
                                ]);
                            }
                        }
                    })
                    ->visible(fn() => Auth::user() && in_array(Auth::user()->role, ['ketua', 'wakil', 'sekretaris'])),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function canAccess(): bool
    {
        return Auth::check() && in_array(Auth::user()->role, ['ketua', 'wakil', 'sekretaris']);
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
