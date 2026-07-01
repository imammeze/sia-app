<?php

namespace App\Filament\Resources\PerkembanganAnaks\Pages;

use App\Filament\Resources\PerkembanganAnaks\PerkembanganAnakResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePerkembanganAnak extends CreateRecord
{
    protected static string $resource = PerkembanganAnakResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
