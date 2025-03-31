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
        Schema::create('visited_ads', function (Blueprint $table) {
            $table->id();
            //?add foreign key to reports table
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

            //?add foreign key to paid_ads table
            // $table->unsignedBigInteger('paid_ads_id');
            // $table->foreign('paid_ads_id')->references('id')->on('paid_ads');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visited_ads');
    }
};
