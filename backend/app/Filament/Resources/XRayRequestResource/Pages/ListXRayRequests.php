<?php

namespace App\Filament\Resources\XRayRequestResource\Pages;

use App\Filament\Resources\XRayRequestResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListXRayRequests extends ListRecords
{
    protected static string $resource = XRayRequestResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
