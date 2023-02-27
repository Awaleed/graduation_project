<?php

namespace App\Filament\Resources\XRayRequestResource\Pages;

use App\Filament\Resources\XRayRequestResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditXRayRequest extends EditRecord
{
    protected static string $resource = XRayRequestResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
