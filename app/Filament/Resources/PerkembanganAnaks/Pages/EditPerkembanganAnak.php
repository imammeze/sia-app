<?php

namespace App\Filament\Resources\PerkembanganAnaks\Pages;

use App\Filament\Resources\PerkembanganAnaks\PerkembanganAnakResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPerkembanganAnak extends EditRecord
{
    protected static string $resource = PerkembanganAnakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getBreadcrumbs(): array
    {
        return [];
    }
}
