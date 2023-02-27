<?php

namespace App\Jobs;

use App\Models\XRayImage;
use App\Models\XRayRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Media $media;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Media $media)
    {
        //
        $this->media = $media;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $media = $this->media;
        $image                      = new XRayImage();
        $image->x_ray_request_id    = $media->model_id;
        $image->diagnosis_id        = XRayRequest::find($media->model_id)->diagnosis_id;

        # send the image in post request to the server
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', 'http://localhost:8000/uploadimage', [
            'multipart' => [
                [
                    'name'     => 'file',
                    'contents' => fopen($media->getPath(), 'r'),
                ],
            ],
        ]);

        $image->result = $response->getBody()->getContents();
        $image->save();

        # move the media to the new model
        $media->model_id = $image->id;
        $media->model_type = XRayImage::class;
        $media->save();
    }
}
