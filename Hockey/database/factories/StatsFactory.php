<?php

use App\Stats;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Stats::class, function (Faker $faker) {
    //
    return [
    	'stat_type_id' => mt_rand(1,3),
    	/*'match_id' => App\Partie::all()->random->id(),*/
    	'player_id' => App\Joueur::all()->random()->id,
    	'periode' => mt_rand(1,3),
    	'time' => 12,

    ];
});
