<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class XRayRequest extends BaseModel
{

    public function x_ray_images(): HasMany
    {
        return $this->hasMany(XRayImage::class);
    }
}
