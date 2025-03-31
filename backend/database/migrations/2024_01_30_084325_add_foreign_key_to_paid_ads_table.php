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
        Schema::table('paid_ads', function (Blueprint $table) {

            // //?add foreign key to paid_ad_types table
            // $table->unsignedBigInteger('paid_ad_type_id');
            // $table->foreign('paid_ad_type_id')->references('id')->on('paid_ad_types');

            //?add foreign key to reports table
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paid_ads', function (Blueprint $table) {

            // $table->dropForeign(['paid_ad_type_id']);
            // $table->dropColumn('paid_ad_type_id');

            // $table->dropForeign(['user_id']);
            // $table->dropColumn('user_id');
        });
    }
};
