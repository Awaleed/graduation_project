<?php

namespace App\Filament\Resources\RadiolestResource\Pages;

use App\Filament\Resources\RadiolestResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRadiolest extends EditRecord
{
    protected static string $resource = RadiolestResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
