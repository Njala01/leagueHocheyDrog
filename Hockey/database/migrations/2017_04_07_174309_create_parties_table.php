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
            $table->integer('saison_id');
            $table->string('titre', 50);
            $table->string('lieu', 50);
            $table->datetime('date');
            $table->integer('winning_team')->nullable();
            $table->integer('losing_team')->nullable();
            $table->integer('final_score_local')->nullable();
            $table->integer('final_score_visitor')->nullable();
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
