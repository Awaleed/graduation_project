<?php

namespace App\Filament\Resources\DiagnosisResource\Pages;

use App\Filament\Resources\DiagnosisResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDiagnosis extends EditRecord
{
    protected static string $resource = DiagnosisResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
