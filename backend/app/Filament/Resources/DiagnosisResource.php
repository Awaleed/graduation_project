<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DiagnosisResource\Pages;
use App\Filament\Resources\DiagnosisResource\RelationManagers;
use App\Models\Diagnosis;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiagnosisResource extends Resource
{
    protected static ?string $model = Diagnosis::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\BelongsToSelect::make('patient_id')
                    ->relationship('patient', 'name')
                    ->required(),
                Forms\Components\BelongsToSelect::make('doctor_id')
                    ->relationship('doctor', 'name')
                    ->required(),

                Forms\Components\Textarea::make('body')
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(65535),

                    Forms\Components\Textarea::make('x_ray_request_body')
                    ->columnSpanFull()
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('patient.name'),
                Tables\Columns\TextColumn::make('doctor.name'),
                Tables\Columns\TextColumn::make('body'),
                Tables\Columns\IconColumn::make('request_x_ray')
                    ->boolean(),
                Tables\Columns\TextColumn::make('x_ray_request_body'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
            RelationManagers\XRayRequestsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDiagnoses::route('/'),
            'create' => Pages\CreateDiagnosis::route('/create'),
            'edit' => Pages\EditDiagnosis::route('/{record}/edit'),
            'view' => Pages\ViewDiagnosis::route('/{record}'),
        ];
    }
}
