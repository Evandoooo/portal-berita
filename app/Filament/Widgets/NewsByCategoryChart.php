<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;
use Filament\Support\RawJs;
use Illuminate\Support\Collection;

class NewsByCategoryChart extends ChartWidget
{
    protected static ?string $heading = 'Komposisi Berita per Kategori';

    protected static ?int $sort = 3; // Urutan widget di dashboard

    protected function getData(): array
    {
        // Mengambil data kategori beserta jumlah berita di dalamnya
        $data = Category::withCount('news')->get();

        // Jika tidak ada data, kembalikan array kosong agar tidak error
        if ($data->isEmpty()) {
            return [
                'datasets' => [],
                'labels' => [],
            ];
        }

        // Memproses data untuk dijadikan label dan nilai untuk chart
        $labels = $data->pluck('name');
        $values = $data->pluck('news_count');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Berita',
                    'data' => $values,
                    // Memberikan warna yang berbeda untuk setiap potongan pie
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
                    'display' => false, // Menyembunyikan sumbu-X (bawah)
                ],
                'y' => [
                    'display' => false, // Menyembunyikan sumbu-Y (pinggir)
                ],
            ],
        ];
    }
}