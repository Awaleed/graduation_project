<?php

namespace App\Filament\Resources\DiagnosisResource\RelationManagers;

use App\Forms\Components\AddressForm;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
            ->columns(1)
            ->schema([
                Forms\Components\Hidden::make('radiolest_id')
                    ->default(auth()->user()?->radiolest?->id),
                Forms\Components\SpatieMediaLibraryFileUpload::make('xrays')
                    ->multiple()
                    ->translateLabel(),
                Forms\Components\Textarea::make('body')
                    ->required()
                    ->maxLength(65535),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),
                Tables\Columns\TextColumn::make('body')
                    ->translateLabel(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
