<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Patient extends BaseModel
{
    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }


    public function x_ray_requests(): HasManyThrough
    {
        return $this->hasManyThrough(XRayRequest::class, Diagnosis::class);
    }
}
