<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class VisitorsChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pengunjung Harian (Data Dummy)';

    protected static ?string $description = 'Grafik ini akan menampilkan data asli setelah website di-deploy.';

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $data = [];
        $labels = [];

        for ($i = 13; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            $labels[] = $date->format('d M');

            srand(crc32($date->toDateString())); 

            $data[] = rand(100, 800);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengunjung',
                    'data' => $data,
                    'borderColor' => 'rgb(49, 108, 168)',
                    'tension' => 0.1,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}