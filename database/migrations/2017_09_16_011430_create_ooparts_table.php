<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOopartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ooparts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->enum('type',['Strength','Defense','Accuracy','Luck']);
            $table->enum('letter',['A','B','C','D','E','F']);
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
        Schema::dropIfExists('ooparts');
    }
}
