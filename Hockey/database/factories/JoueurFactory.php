<?php

use App\Joueur;
use Faker\Generator as Faker;

$factory->define(Joueur::class, function (Faker $faker) {
    //
	$array = array('AttDroite', "AttGauche", 'Centre', 'defenseDroite', 'defenseGauche', 'Gardien');
	$int = mt_rand(0,5);
	$but = rand(1,50);
	$assist = rand(1,50);
	$userID = null;
	if(rand(0,20) > 10){
		$userID = DB::table('users')->get()->random()->id;
	}
	

    return [
    	'name' => $faker->name,
    	'position' => $array[$int],
    	'user_id' => $userID,
    	'partieJouer' => rand(1, 50),
    	'but' => $but,
    	'assist' => $assist,
    	'points' => $but + $assist,
    ];
});
