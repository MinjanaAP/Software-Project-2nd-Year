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
        Schema::create('tv_features', function (Blueprint $table) {
            $table->id();
            // $table->string('New/Used');
            $table->string('Brand');
            $table->string('Screen_size');
            $table->string('Screen_type');
            // $table->string('Features');
            // $table->string('Additional Description');
            $table->string('Year');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_features');
    }
};
