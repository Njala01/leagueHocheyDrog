<?php

use App\Stat_type;
use Faker\Generator as Faker;

$factory->define(Stat_type::class, function (Faker $faker) {
    //

    $type = [
    	 ['nom' => 'but'],
    	['nom' => 'but'],

    	['nom' => 'but'],
    ];
    return $type;
});
