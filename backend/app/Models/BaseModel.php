<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Manipulations;

class BaseModel extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    // use SoftDeletes;

    protected $guarded = [];

    protected $appends = ['photo', 'preview'];
    protected $casts = ['id' => 'integer'];
    protected $hidden = ['media'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->useFallbackUrl('' . url('') . '/images/default.png')
            ->useFallbackPath(public_path('/images/default.png'));
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CONTAIN, 100, 200)
            ->nonQueued();
    }

    public function getPhotoAttribute()
    {
        return $this->getFirstMediaUrl('default');
    }

    public function getPreviewAttribute()
    {
        return $this->getFirstMediaUrl('default', 'preview');
    }
}
