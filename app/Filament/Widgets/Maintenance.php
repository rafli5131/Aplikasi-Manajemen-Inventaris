<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class Maintenance extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected static ? int $sort = 8;
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Barang::query()->where('tanggal_maintenance', '=>', now()->addDays(7))
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->label('Nama Barang'),
                Tables\Columns\TextColumn::make('kode')
                    ->searchable()
                    ->label('Kode Barang'),
                Tables\Columns\TextColumn::make('ruangan.nama')
                    ->searchable()
                    ->label('Ruangan'),
                Tables\Columns\TextColumn::make('tanggal_maintenance')
                    ->searchable()
                    ->label('Tanggal Maintenance'),
            ]);
    }
}
