<?php

namespace App\Forms\Components;

use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\Model;
use Squire\Models\Country;

class AddressForm extends SpatieMediaLibraryFileUpload
{
    public function getChildComponents(): array
    {
        return [
            // Forms\Components\Grid::make(3)
            //     ->schema([
            //         Forms\Components\TextInput::make('city'),
            //         Forms\Components\TextInput::make('state')
            //             ->label('State / Province'),
            //         Forms\Components\TextInput::make('zip')
            //             ->label('Zip / Postal code'),
            //     ]),
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        // $this->afterStateHydrated(function (AddressForm $component, ?Model $record) {
        //     $address = $record?->getRelationValue($this->getRelationship());

        //     $component->state($address ? $address->toArray() : [
        //         'country' => null,
        //         'street' => null,
        //         'city' => null,
        //         'state' => null,
        //         'zip' => null,
        //     ]);
        // });

        // $this->dehydrated(false);
    }
}
