<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->uuid('gol_id')->default(DB::raw('(UUID())'));
            $table->string('gol_name', 255);
            $table->string('gol_photo', 255)->nullable();
            $table->integer('gol_user');
            $table->integer('gol_days')->default(0);
            $table->text('gol_description')->nullable();
            $table->date('gol_date_from')->nullable();
            $table->date('gol_date_to')->nullable();
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
        Schema::dropIfExists('goals');
    }
}
