<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracks', function (Blueprint $table) {
            $table->increments('tra_id');
            $table->integer('tra_habit');
            $table->date('tra_date');
            $table->timestamps();
        });

        Schema::create('track_images', function (Blueprint $table) {
            $table->increments('trai_id');
            $table->integer('trai_track');
            $table->string('trai_path');
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
        Schema::dropIfExists('tracks');

        Schema::dropIfExists('track_images');
    }
}
