<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Carbon\Carbon;

class VisitorsChart extends ChartWidget
{
    protected static ?string $heading = 'Grafik Pengunjung Harian (Data Dummy)';

    protected static ?string $description = 'Grafik ini akan menampilkan data asli setelah website di-deploy.';

    // Widget akan mengambil lebar penuh
    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        // --- Inilah bagian data dummy ---
        $data = [];
        $labels = [];

        // Membuat data acak untuk 14 hari terakhir
        for ($i = 13; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            // Menambahkan label tanggal (misal: "03 Jun")
            $labels[] = $date->format('d M');

            srand(crc32($date->toDateString())); 

            // Menambahkan data pengunjung acak antara 100 - 800
            $data[] = rand(100, 800);
        }
        // --- Akhir dari bagian data dummy ---

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