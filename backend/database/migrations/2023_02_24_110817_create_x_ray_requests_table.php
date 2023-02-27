<?php

use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\Radiolest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('x_ray_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Diagnosis::class)->constrained();
            // $table->foreignIdFor(Patient::class)->constrained();
            $table->foreignIdFor(Radiolest::class)->constrained();
            $table->text('body')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('x_ray_requests');
    }
};
