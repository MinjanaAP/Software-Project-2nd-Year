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
        Schema::create('mobile_phone_features', function (Blueprint $table) {
            $table->id();
            // $table->string('New/Used');
            $table->string('Brand');
            $table->string('Series');
            $table->string('Display_size');
            $table->string('Display_type');
            $table->string('Battery_capercity');
            $table->string('RAM');
            $table->string('Storage');
            $table->string('Colour');
            // $table->string('Features');
            // $table->string('Additional Description');
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
        Schema::dropIfExists('mobile_phone_features');
    }
};
