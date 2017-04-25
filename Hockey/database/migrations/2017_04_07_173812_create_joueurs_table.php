<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJoueursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joueurs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('position');
            $table->integer('user_id')->nullable(true);
            $table->integer('partieJouer');
            $table->integer('but');
            $table->integer('assist');
            $table->integer('points');
            $table->timestamps();
        });

        Schema::create('equipe_joueur', function (Blueprint $table) {
            $table->integer('joueur_id');
            $table->integer('equipe_id');
            $table->primary(['joueur_id', 'equipe_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joueurs');
        Schema::dropIfExists('equipe_joueur');
    }
}
