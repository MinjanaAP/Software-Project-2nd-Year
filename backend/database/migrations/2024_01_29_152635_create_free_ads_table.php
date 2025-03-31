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
        Schema::create('free_ads', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->float('price');
            $table->string('image_1');
            $table->string('image_2');
            $table->string('image_3');
            $table->string('image_4');
            $table->string('image_5');
            $table->string('sub_category');
            $table->string('category');
            $table->unsignedBigInteger('user_id');
            $table->string('condition');
            $table->string('brand');
            $table->text('description');
            $table->string('town');
            $table->string('district');
            $table->string('negotiable');
            $table->integer('view_count')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_ads');
    }
};
