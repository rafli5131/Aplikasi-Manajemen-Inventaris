<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Barang;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BarangResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\BarangResource\RelationManagers;
use AlperenErsoy\FilamentExport\Actions\FilamentExportBulkAction;
use AlperenErsoy\FilamentExport\Actions\FilamentExportHeaderAction;

class BarangResource extends Resource
{
    public static function getPluralLabel(): ?string
    {
        return 'Barang';
    }
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationGroup = 'Barang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kode')
                ->label('Nomor Barang')
                ->required()
                ->maxLength(255),
                Forms\Components\TextInput::make('nama')
                ->required()
                ->maxLength(255),
                Forms\Components\Select::make('kategori_id')
                    ->label('Kategori')
                    ->required()
                    ->relationship('kategori', 'nama'),
                Forms\Components\Select::make('ruangan_id')
                    ->label('Ruangan')
                    ->required()
                    ->relationship('ruangan', 'nama'),
                Forms\Components\Select::make('satuan_id')
                    ->label('Satuan')
                    ->required()
                    ->relationship('satuan', 'nama'),
                Forms\Components\Select::make('supplier_id')
                    ->label('Supplier')
                    ->relationship('supplier', 'nama'),
                Forms\Components\TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('harga_persatuan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('penyusutan')
                    ->numeric()
                    ->default(0),
                Forms\Components\Select::make('kondisi')
                    ->required()
                    ->options([
                        'Baik' => 'Baik',
                        'Rusak' => 'Rusak',
                        'Hilang' => 'Hilang',
                        'Perbaikan' => 'Perbaikan',
                    ]),
                Forms\Components\Textarea::make('deskripsi')
                    ->columnSpan(2)
                    ->maxLength(255),
                Forms\Components\DatePicker::make('tanggal_pembelian')
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_maintenance'),
                Forms\Components\FileUpload::make('gambar'),
                Forms\Components\FileUpload::make('bukti_pembelian'),
                Forms\Components\ViewField::make('Maintenance')
                    ->view('filament.custom-table', ['barang_id' => request('record')])
                    ->columnSpan(2)
                    ->visibleOn('view'),
            ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('gambar')
                ->searchable(),
                Tables\Columns\TextColumn::make('kode')
                    ->label('Nomor Barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ruangan.nama')
                    ->sortable(),
                Tables\Columns\TextColumn::make('supplier.nama')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('jumlah')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pembelian')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('kondisi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Hilang' => 'gray',
                        'Perbaikan' => 'warning',
                        'Baik' => 'success',
                        'Rusak' => 'danger',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('kategori_id')
                    ->options(fn () => \App\Models\Kategori::pluck('nama', 'id')->toArray())
                    ->label('Kategori'),
                SelectFilter::make('ruangan_id')
                    ->options(fn () => \App\Models\Ruangan::pluck('nama', 'id')->toArray())
                    ->label('Ruangan'),
                SelectFilter::make("supplier_id")
                    ->options(fn () => \App\Models\Supplier::pluck('nama', 'id')->toArray())
                    ->label('Supplier'),
                SelectFilter::make("konidisi")
                    ->options([
                        'Baik' => 'Baik',
                        'Rusak' => 'Rusak',
                        'Hilang' => 'Hilang',
                    ])
                    ->label('Kondisi'),

            ])
            ->headerActions([
                FilamentExportHeaderAction::make('export')
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    FilamentExportBulkAction::make('export'),
                    Tables\Actions\BulkAction::make('printLabel')
                        ->label('Print Label')
                        ->icon('heroicon-o-printer')
                        ->action(function ( $records) {
                            // Implement the logic to print labels for the selected items
                            $pdf = Pdf::loadView('pdf', compact(['records']))->setPaper('a6', 'landscape');
                            return response()->streamDownload(function () use ($pdf) {
                                echo $pdf->stream();
                            }, 'label-barang.pdf');
                        }),
                ]),
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
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'view' => Pages\ViewBarang::route('/{record}'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
