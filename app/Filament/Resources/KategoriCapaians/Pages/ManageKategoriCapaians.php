<?php

namespace App\Filament\Resources\KategoriCapaians\Pages;

use App\Filament\Resources\KategoriCapaians\KategoriCapaianResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageKategoriCapaians extends ManageRecords
{
    protected static string $resource = KategoriCapaianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
