<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class XRayRequestsRelationManager extends RelationManager
{
    protected static string $relationship = 'x_ray_requests';

    protected static ?string $recordTitleAttribute = 'id';

    protected function getViewFormSchema(): array
    {
        return [
            Forms\Components\Textarea::make('body')
                ->required()
                ->maxLength(65535),
            Forms\Components\Repeater::make('x_ray_images')
                ->relationship()
                ->disableLabel()
                ->columns(2)
                ->schema([
                    # display the image
                    Forms\Components\SpatieMediaLibraryFileUpload::make('photo')
                        ->enableOpen()
                        ->translateLabel(),
                    Forms\Components\RichEditor::make('result')
                        ->translateLabel(),
                ]),
        ];
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('body')
                    ->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->headerActions([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
    }
}
