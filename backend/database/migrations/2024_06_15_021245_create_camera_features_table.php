<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('camera_features', function (Blueprint $table) {
            $table->id();
            $table->string('Resolution');
            $table->string('Lens_type');
            $table->string('Screen_type');
            $table->string('Zoom');
            $table->string('Year');
            $table->string('Used_time_period');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('camera_features');
    }
};
