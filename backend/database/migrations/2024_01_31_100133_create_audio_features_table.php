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
        Schema::create('audio_features', function (Blueprint $table) {
            $table->id();
            // $table->string('New/Used');
            $table->string('Brand');
            $table->string('Wireless_or_not');
            $table->string('Battery_capercity');
            $table->string('Colour');
            // $table->string('Features');
            // $table->string('Additional Description');
            // $table->string('Location');
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
        Schema::dropIfExists('audio_features');
    }
};
