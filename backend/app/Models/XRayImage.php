<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class XRayImage extends BaseModel
{
    public function x_ray_request(): BelongsTo
    {
        return $this->belongsTo(XRayRequest::class);
    }

    public function result(): Attribute
    {
        return new Attribute(
            get: function ($value) {
                $json  = json_decode($value, true);

                $necroticTumor  = number_format(doubleval($json['Necrotic-Tumor'])  * 100, 2, '.', '');
                $nonTumor       = number_format(doubleval($json['Non-Tumor'])       * 100, 2, '.', '');
                $viable         = number_format(doubleval($json['Viable'])          * 100, 2, '.', '');

                return '
<pre> Prediction:       ' .  $json['prediction'] . '</pre>
<pre> Necrotic-Tumor:   ' .  $necroticTumor . ' %</pre>
<pre> Non-Tumor:        ' .  $nonTumor . ' %</pre>
<pre> Viable:           ' .  $viable . ' %</pre>
';
            },
        );
    }
}
