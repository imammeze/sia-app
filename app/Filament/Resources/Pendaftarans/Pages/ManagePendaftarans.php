<?php

namespace App\Filament\Resources\Pendaftarans\Pages;

use App\Filament\Resources\Pendaftarans\PendaftaranResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePendaftarans extends ManageRecords
{
    protected static string $resource = PendaftaranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->modalFooterActions(fn () => []), 
        ];
    }
}