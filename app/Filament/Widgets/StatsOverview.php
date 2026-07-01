<?php

namespace App\Filament\Widgets;

use App\Models\Guru;
use App\Models\PesertaDidik;
use App\Models\Pendaftaran;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Total Guru', Guru::count())
                ->description('Seluruh staf pengajar terdaftar')
                ->descriptionIcon('heroicon-m-users')
                ->color('success'),

            Stat::make('Total Peserta Didik', PesertaDidik::count())
                ->description('Siswa yang aktif belajar')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info'),

            Stat::make('Pendaftar Baru', Pendaftaran::where('status', 'pending')->count())
                ->description('Menunggu proses daftar ulang')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('warning'),

            Stat::make('Tidak Daftar Ulang', Pendaftaran::where('status', 'batal')->count())
                ->description('Pendaftar yang batal')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
        ];
    }
}