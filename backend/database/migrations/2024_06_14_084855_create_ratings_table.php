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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('ad_id')->nullable();
            $table->integer('stars')->nullable();
            $table->timestamps();

            // Foreign key constraints if needed
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('ad_id')->references('id')->on('free_ads')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
