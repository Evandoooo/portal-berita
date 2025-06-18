<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;
use Filament\Support\RawJs;
use Illuminate\Support\Collection;

class NewsByCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Komposisi Berita per Kategori';

    protected static ?int $sort = 3; 
    protected function getData(): array
    {
        $data = Category::withCount('news')->get();

        if ($data->isEmpty()) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        $labels = $data->pluck('name');
        $values = $data->pluck('news_count');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Berita',
                    'data' => $values,
                    'backgroundColor' => [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C9CBCF'
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'x' => [
                    'display' => false, 
                ],
                'y' => [
                    'display' => false, 
                ],
            ],
        ];
    }
}