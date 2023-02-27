<?php

namespace App\Filament\Resources\PatientResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DiagnosesRelationManager extends RelationManager
{
    protected static string $relationship = 'diagnoses';

    protected static ?string $recordTitleAttribute = 'id';

    protected function getViewFormSchema(): array
    {
        return [
            Forms\Components\Textarea::make('body')
                ->required()
                ->maxLength(65535),
            Forms\Components\Toggle::make('request_x_ray')
                ->required(),
            Forms\Components\Textarea::make('x_ray_request_body')
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
            ->columns(1)
            ->schema([
                Forms\Components\Hidden::make('doctor_id')->default(auth()->user()?->doctor?->id),
                Forms\Components\Textarea::make('body')
                    ->required()
                    ->maxLength(65535),
                Forms\Components\Toggle::make('request_x_ray')
                    ->required(),
                Forms\Components\Textarea::make('x_ray_request_body')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('body'),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
                Tables\Columns\IconColumn::make('request_x_ray')
                    ->translateLabel()
                    ->boolean(),
                Tables\Columns\IconColumn::make('has_x_ray')
                    ->translateLabel()
                    ->boolean(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
