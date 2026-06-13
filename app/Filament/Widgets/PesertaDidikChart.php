<?php

namespace App\Filament\Widgets;

use App\Models\PesertaDidik;
use Filament\Widgets\ChartWidget;

class PesertaDidikChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Pertumbuhan Peserta Didik (Per Tahun)';
    
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $dataSiswa = [];
        $tahunLabels = [];

        $tahunSekarang = now()->year;
        
        for ($i = $tahunSekarang - 4; $i <= $tahunSekarang; $i++) {
            $tahunLabels[] = (string) $i;
            $dataSiswa[] = PesertaDidik::whereYear('created_at', $i)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total Peserta Didik Baru',
                    'data' => $dataSiswa,
                    'backgroundColor' => '#10b981', 
                    'borderColor' => '#059669',
                ],
            ],
            'labels' => $tahunLabels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; 
    }
}