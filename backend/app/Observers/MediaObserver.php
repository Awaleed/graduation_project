<?php

namespace App\Observers;

use App\Models\XRayImage;
use App\Models\XRayRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaObserver
{
    public function created(Media $media)
    {
        //
        if ($media->model_type == XRayRequest::class) {
            $job = new \App\Jobs\MediaCreated($media);
            dispatch($job);
        }
    }
}
