<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePilotGuideTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pilots_guides', function (Blueprint $table) {
            $table->integer('pilot_level')->nullable()->change();
            $table->integer('pilot_stars')->nullable()->change();
            $table->integer('affection_level')->nullable()->change();
            $table->unsignedInteger('dress_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
