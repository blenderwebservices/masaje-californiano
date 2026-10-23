<?php

namespace App\Filament\Resources\SpaServiceResource\Pages;

use App\Filament\Resources\SpaServiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSpaServices extends ListRecords
{
    protected static string $resource = SpaServiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
