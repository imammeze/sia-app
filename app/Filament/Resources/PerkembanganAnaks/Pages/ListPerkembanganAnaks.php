<?php

namespace App\Filament\Resources\PerkembanganAnaks\Pages;

use App\Filament\Resources\PerkembanganAnaks\PerkembanganAnakResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPerkembanganAnaks extends ListRecords
{
    protected static string $resource = PerkembanganAnakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
