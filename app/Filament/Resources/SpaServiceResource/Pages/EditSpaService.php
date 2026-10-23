<?php

namespace App\Filament\Resources\SpaServiceResource\Pages;

use App\Filament\Resources\SpaServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSpaService extends EditRecord
{
    protected static string $resource = SpaServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
