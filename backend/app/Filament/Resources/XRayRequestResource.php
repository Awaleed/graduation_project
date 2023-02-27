<?php

namespace App\Filament\Resources;

use App\Filament\Resources\XRayRequestResource\Pages;
use App\Filament\Resources\XRayRequestResource\RelationManagers;
use App\Models\XRayRequest;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class XRayRequestResource extends Resource
{
    protected static ?string $model = XRayRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('diagnosis_id')
                    ->required(),
                Forms\Components\TextInput::make('radiolest_id')
                    ->required(),
                Forms\Components\Textarea::make('body')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('diagnosis_id'),
                Tables\Columns\TextColumn::make('radiolest_id'),
                Tables\Columns\TextColumn::make('body'),
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
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListXRayRequests::route('/'),
            'create' => Pages\CreateXRayRequest::route('/create'),
            'edit' => Pages\EditXRayRequest::route('/{record}/edit'),
        ];
    }    
}
