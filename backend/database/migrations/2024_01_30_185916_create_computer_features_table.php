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
        Schema::create('computer_features', function (Blueprint $table) {
            $table->id();
            // $table->string('New/Used');
            $table->string('RAM');
            $table->string('Hard');
            $table->string('SSD');
            $table->string('Graphics');
            $table->string('Windows');
            $table->string('Version');
            $table->string('Processor_size');
            $table->string('Screen_size');
            $table->string('Screen_type');
            $table->string('Colour');
            /*$table->string('Features');
            $table->string('Additional Description');*/
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
        Schema::dropIfExists('computer_features');
    }
};
