<?php

namespace App\Filament\Resources\DiagnosisResource\Pages;

use App\Filament\Resources\DiagnosisResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDiagnoses extends ListRecords
{
    protected static string $resource = DiagnosisResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
