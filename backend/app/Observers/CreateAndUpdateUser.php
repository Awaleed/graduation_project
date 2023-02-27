<?php

namespace App\Observers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CreateAndUpdateUser
{
    public function created(Model $model)
    {
        $model->password = Hash::make($model->password);

        //
        $user               = User::where('email', $model->email)->first();
        if (!$user) $user   = new User();
        $user->name         = $model->name;
        $user->email        = $model->email;
        $user->password     = $model->password;

        $user->save();

        $model->user_id = $user->id;
        $model->save();

        if (is_a($model, Doctor::class)) {
            $user->assignRole('doctor');
        } else {
            $user->assignRole('radiolests');
        }
    }

    public function updated(Model $model)
    {

        //
        $user               = User::where('email', $model->email)->first();
        if (!$user) $user   = new User();
        $user->name         = $model->name;
        $user->email        = $model->email;

        if ($model->isDirty('password')) {
            $model->password = Hash::make($model->password);
            $user->password  = $model->password;
        }

        $user->save();

        if (is_a($model, Doctor::class)) {
            $user->assignRole('doctor');
        } else {
            $user->assignRole('radiolests');
        }
    }

    public function deleted(Model $model)
    {
        //
    }

    public function restored(Model $model)
    {
        //
    }

    public function forceDeleted(Model $model)
    {
        //
    }
}
