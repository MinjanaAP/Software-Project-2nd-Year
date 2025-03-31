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
        Schema::table('free_ads', function (Blueprint $table) {

            // //?add foreign key to reports table
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

            // //?add foreign key to sub_categories table
            // $table->unsignedBigInteger('sub_category_id');
            // $table->foreign('sub_category_id')->references('id')->on('sub_categories');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('free_ads', function (Blueprint $table) {
            // $table->dropForeign(['user_id']);
            // $table->dropColumn('user_id');

            // $table->dropForeign(['sub_category_id']);
            // $table->dropColumn('sub_category_id');
        });
    }
};
