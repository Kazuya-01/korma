<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransaksiKeuanganResource\Pages;
use App\Models\TransaksiKeuangan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Actions\Action;

class TransaksiKeuanganResource extends Resource
{
    protected static ?string $model = TransaksiKeuangan::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'Keuangan';
    protected static ?string $pluralLabel = 'Keuangan';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('jenis')
                ->label('Jenis Transaksi')
                ->options([
                    'pemasukan' => 'Pemasukan',
                    'pengeluaran' => 'Pengeluaran',
                ])
                ->required(),

            Forms\Components\Select::make('kategori')
                ->label('Kategori')
                ->options([
                    'kas' => 'Kas Rutin',
                    'infaq' => 'Infaq',
                    'donasi' => 'Donasi',
                    'operasional' => 'Operasional',
                    'lainnya' => 'Lainnya',
                ])
                ->required(),

            Forms\Components\TextInput::make('jumlah')
                ->label('Jumlah')
                ->numeric()
                ->prefix('Rp')
                ->required(),

            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal')
                ->required(),

            Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->rows(3),

            Forms\Components\FileUpload::make('bukti')
                ->label('Bukti Transaksi')
                ->directory('bukti-keuangan')
                ->disk('public')
                ->preserveFilenames()
                ->nullable(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->defaultSort('tanggal', 'asc')
            ->columns([
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal')->date(),

                Tables\Columns\TextColumn::make('jenis')
                    ->label('Jenis')
                    ->badge()
                    ->color(fn($state) => $state === 'pemasukan' ? 'success' : 'danger'),

                Tables\Columns\TextColumn::make('kategori')->label('Kategori'),

                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->money('IDR', locale: 'id'),

                Tables\Columns\TextColumn::make('deskripsi')->limit(20),

                Tables\Columns\ImageColumn::make('bukti')
                    ->label('Bukti')
                    ->disk('public')
                    ->height(40),
                Tables\Columns\TextColumn::make('saldo')
                    ->label('Saldo Setelah Transaksi')
                    ->state(function ($record) {
                        $saldo = TransaksiKeuangan::where(function ($query) use ($record) {
                            $query->where('tanggal', '<', $record->tanggal)
                                ->orWhere(function ($q) use ($record) {
                                    $q->where('tanggal', $record->tanggal)
                                        ->where('id', '<=', $record->id);
                                });
                        })
                            ->orderBy('tanggal')
                            ->orderBy('id')
                            ->get()
                            ->reduce(function ($carry, $item) {
                                return $carry + ($item->jenis === 'pemasukan' ? $item->jumlah : -$item->jumlah);
                            }, 0);

                        return 'Rp ' . number_format($saldo, 0, ',', '.');
                    }),

            ])
            ->filters([
                Filter::make('tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('Dari'),
                        Forms\Components\DatePicker::make('until')->label('Sampai'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['from'], fn($q) => $q->whereDate('tanggal', '>=', $data['from']))
                            ->when($data['until'], fn($q) => $q->whereDate('tanggal', '<=', $data['until']));
                    }),

                Tables\Filters\SelectFilter::make('jenis')
                    ->options([
                        'pemasukan' => 'Pemasukan',
                        'pengeluaran' => 'Pengeluaran',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->headerActions([
                Tables\Actions\Action::make('tambah_transaksi')
                    ->label('Tambah Transaksi')
                    ->icon('heroicon-o-plus-circle')
                    ->url(static::getUrl('create'))
                    ->color('primary')
                    ->button()
                    ->size('lg')
                    ->extraAttributes([
                        'class' => 'font-semibold tracking-wide',
                    ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransaksiKeuangans::route('/'),
            'create' => Pages\CreateTransaksiKeuangan::route('/create'),
            'edit' => Pages\EditTransaksiKeuangan::route('/{record}/edit'),
        ];
    }
}
