<?php

namespace App\Filament\Resources\Rapors\Pages;

use App\Filament\Resources\Rapors\RaporResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageRapors extends ManageRecords
{
    protected static string $resource = RaporResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
