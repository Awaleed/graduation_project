<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Diagnosis extends BaseModel
{

    protected $appends = ['has_x_ray'];



    # belongsTo patient
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    # belongsTo doctor
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function x_ray_requests(): HasMany
    {
        return $this->hasMany(XRayRequest::class);
    }


    # hasMany x_ray_images through x_ray_requests
    public function x_ray_images(): HasMany
    {
        return $this->hasMany(XRayImage::class);
    }

    public function hasXRay(): Attribute
    {
        return new Attribute(
            get: fn () => $this->x_ray_requests()->count() > 0,
        );
    }
}
