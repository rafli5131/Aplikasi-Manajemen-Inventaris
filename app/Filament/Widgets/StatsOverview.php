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
            Stat::make('Total Jumlah Barang', Barang::count())
                ->color('info'),
            Stat::make('Total Barang Baik', Barang::select()->where('kondisi', 'Baik')->count())
                ->color('success'),
            Stat::make('Total Barang Rusak', Barang::select()->where('kondisi', 'Rusak')->count())
                ->color('danger'),

        ];
    }
}
