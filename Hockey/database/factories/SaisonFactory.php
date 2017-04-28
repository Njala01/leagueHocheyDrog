<?php

use App\Saison;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Saison::class, function (Faker $faker) {
    //
    return [
    	'name' => str_random(7),
    	'start_date' => Carbon::now(),
    	'end_date' => Carbon::now()->addMonth(4),

    ];
});
