<?php

namespace App\Filament\Resources\Absensis\Pages;

use App\Filament\Pages\InputAbsensiHarian;
use App\Filament\Resources\Absensis\AbsensiResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ManageRecords;

class ManageAbsensis extends ManageRecords
{
    protected static string $resource = AbsensiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('input_absensi_kelas')
                ->label('Input Absensi Kelas') 
                ->icon('heroicon-o-plus-circle') 
                ->url(fn (): string => InputAbsensiHarian::getUrl())
                ->visible(fn () => auth()->user()->can('create_absensi')),
        ];
    }
}