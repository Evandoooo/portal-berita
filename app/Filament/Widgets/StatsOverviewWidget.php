<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\News;  
use App\Models\Category;
use App\Models\User;


class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Berita', News::count()) 
                ->description('Jumlah semua berita yang ada')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success'),

            Stat::make('Berita Hari Ini', News::whereDate('created_at', today())->count())
                ->description('Berita yang dipublikasikan hari ini')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('warning'),

            Stat::make('Total Kategori', Category::count())
                ->description('Jumlah kategori berita')
                ->descriptionIcon('heroicon-m-tag')
                ->color('primary'),

            Stat::make('Total Pengguna', User::count())
                ->description('Jumlah Pengguna Aktif')
                ->descriptionIcon('heroicon-m-user')
                ->color('primary'),    
        ];
    }
}
