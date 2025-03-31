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
        Schema::table('users', function (Blueprint $table) {

            //?add foreign key to user_roles table
            // $table->unsignedBigInteger('user_role_id');
            // $table->foreign('user_role_id')->references('id')->on('user_roles');

            // // //?add foreign key to paid_ads table
            // $table->unsignedBigInteger('free_ads_id');
            // $table->foreign('free_ads_id')->references('id')->on('free_ads');

            // // //?add foreign key to paid_ads table
            // $table->unsignedBigInteger('paid_ads_id');
            // $table->foreign('paid_ads_id')->references('id')->on('paid_ads');

         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->dropForeign(['user_role_id']);
            // $table->dropColumn('user_role_id');

            // $table->dropForeign(['free_ads_id']);
            // $table->dropColumn('free_ads_id');

            // $table->dropForeign(['paid_ads_id']);
            // $table->dropColumn('paid_ads_id');
        });
    }
};
