<?php

namespace App\Filament\Pages\Auth;

use App\Models\Doctor;
use App\Models\Radiolest;
use Filament\Facades\Filament;
use JeffGreco13\FilamentBreezy\Http\Livewire\Auth\Register as FilamentBreezyRegister;
use Filament\Forms;
use Illuminate\Auth\Events\Registered;

class Register extends FilamentBreezyRegister
{


    public $user_type;
    public $phone;
    public $room_number;
    public $specialty;


    protected function getFormSchema(): array
    {
        return  [
            Forms\Components\Select::make('user_type')
                ->label('User Type')
                ->translateLabel()
                ->options([
                    'doctor' => 'Doctor',
                    'radioles' => 'Radiologist',
                ])
                ->required(),
            ...parent::getFormSchema(),
            Forms\Components\TextInput::make('phone')
                ->tel()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('room_number')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('specialty')
                ->required()
                ->maxLength(255),
        ];
    }


    public function register()
    {
        $data = $this->form->getState();


        $preparedData = [
            'name' => $data['name'],
            'email' => $data['email'],
            // 'email_verified_at' => $data['email_verified_at'],
            'password' => $data['password'],
            'room_number' => $data['room_number'],
            'phone' => $data['phone'],
            'specialty' => $data['specialty'],
        ];


        $user = null;

        if ($data['user_type'] === 'doctor') {
            $user = Doctor::create($preparedData);
        } else {
            $user = Radiolest::create($preparedData);
        }

        $user = $user->user;

        event(new Registered($user));
        Filament::auth()->login($user, true);

        return redirect()->to(config('filament-breezy.registration_redirect_url'));
    }
}
