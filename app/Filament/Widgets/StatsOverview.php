<?php

namespace App\Filament\Widgets;

use App\Models\Barang;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Jenis Barang', Barang::count())
                ->description('Jumlah jenis barang terdaftar')
                ->descriptionIcon('heroicon-m-archive-box')
                ->color('info'),
            Stat::make('Total Stok Barang', Barang::sum('jumlah'))
                ->description('Total fisik seluruh barang')
                ->descriptionIcon('heroicon-m-cube')
                ->color('primary'),
            Stat::make('Total Barang Baik', Barang::where('kondisi', 'Baik')->count())
                ->description('Kondisi layak pakai')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
            Stat::make('Total Barang Rusak', Barang::where('kondisi', '!=', 'Baik')->count())
                ->description('Rusak / Hilang / Perbaikan')
                ->descriptionIcon('heroicon-m-exclamation-circle')
                ->color('danger'),
        ];
    }
}
