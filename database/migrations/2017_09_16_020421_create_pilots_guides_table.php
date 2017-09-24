<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePilotsGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilots_guides', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('guides_id');
            $table->string('pilot_id');
            $table->integer('pilot_level');
            $table->integer('pilot_stars');
            $table->integer('affection_level');
            $table->unsignedInteger('dress_id');
            $table->integer('position');
            $table->integer('wave');
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
        Schema::dropIfExists('pilots_guides');
    }
}
