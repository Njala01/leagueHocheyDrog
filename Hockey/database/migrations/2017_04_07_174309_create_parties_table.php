<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('local_team');
            $table->integer('visitor_team');
            $table->integer('id_saison');
            $table->string('titre');
            $table->string('lieu');
            $table->dateTime('date');
            $table->integer('winning_team');
            $table->integer('losing_team');
            $table->integer('final_score_local');
            $table->integer('final_score_visitor');
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
        Schema::dropIfExists('parties');
    }
}
