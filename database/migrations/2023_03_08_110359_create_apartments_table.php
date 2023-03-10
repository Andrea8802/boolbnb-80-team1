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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();

            $table->string('title', 64);
            $table->string('description')->nullable();
            $table->decimal('price', 10, 2)->unsigned();
            $table->smallInteger('rooms_num')->unsigned();
            $table->smallInteger('beds_num')->unsigned();
            $table->smallInteger('baths_num')->unsigned();
            $table->integer('size')->unsigned();
            $table->string('address');
            $table->decimal('lat', 10, 8);
            $table->decimal('long', 11, 8);
            $table->string('image')->nullable();
            $table->boolean('visibility');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apartments');
    }
};