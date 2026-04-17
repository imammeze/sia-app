<?php

namespace App\Filament\Resources\PesertaDidiks\Pages;

use App\Filament\Resources\PesertaDidiks\PesertaDidikResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManagePesertaDidiks extends ManageRecords
{
    protected static string $resource = PesertaDidikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
