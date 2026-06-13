<?php

namespace App\Filament\Widgets;

use App\Models\Pendaftaran;
use Filament\Widgets\ChartWidget;

class PendaftaranChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Pendaftaran (Per Tahun)';
    
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $dataPendaftar = [];
        $tahunLabels = [];

        $tahunSekarang = now()->year;
        
        for ($i = $tahunSekarang - 4; $i <= $tahunSekarang; $i++) {
            $tahunLabels[] = (string) $i;
            $dataPendaftar[] = Pendaftaran::whereYear('created_at', $i)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Pendaftar',
                    'data' => $dataPendaftar,
                    'backgroundColor' => '#3b82f6', 
                    'borderColor' => '#2563eb',
                ],
            ],
            'labels' => $tahunLabels,
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Grafik batang
    }
}