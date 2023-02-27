<?php

use App\Models\Diagnosis;
use App\Models\XRayRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_ray_images', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(XRayRequest::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Diagnosis::class)->constrained()->onDelete('cascade');
            $table->json('result');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_ray_images');
    }
};
