<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apartment_sponsor', function (Blueprint $table) {
            $table->foreignId("apartment_id")
                ->constrained();
            $table->foreignId("sponsor_id")
                ->constrained();
        });
        Schema::table('apartment_service', function (Blueprint $table) {
            $table->foreignId('apartment_id')
                ->constrained();
            $table->foreignId('service_id')
                ->constrained();
        });

        Schema::table('messages', function (Blueprint $table) {

            $table->foreignId('apartment_id')
                ->constrained();

        });
        Schema::table('statistics', function (Blueprint $table) {

            $table->foreignId('apartment_id')
                ->constrained();

        });
        Schema::table('apartments', function (Blueprint $table) {

            $table->foreignId('user_id')
                ->constrained();

        });
        Schema::table('added_images', function (Blueprint $table) {

            $table->foreignId('apartment_id')
                ->constrained();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apartment_service', function (Blueprint $table) {
            $table->dropForeign('apartment_service_apartment_id_foreign');
            $table->dropForeign('apartment_service_service_id_foreign');
        });
        Schema::table('apartment_sponsor', function (Blueprint $table) {
            $table->dropForeign("apartment_sponsor_apartment_id_foreign");
            $table->dropForeign("apartment_sponsor_sponsor_id_foreign");
        });


        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign("messages_apartment_id_foreign");

        });
        Schema::table('statistics', function (Blueprint $table) {
            $table->dropForeign("statistics_apartment_id_foreign");

        });
        Schema::table('apartments', function (Blueprint $table) {
            $table->dropForeign("apartments_user_id_foreign");

        });
        Schema::table('added_images', function (Blueprint $table) {
            $table->dropForeign("added_images_apartment_id_foreign");

        });


    }
};