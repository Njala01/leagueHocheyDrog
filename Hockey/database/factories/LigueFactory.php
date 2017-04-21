<?php

use App\Ligue;
use Faker\Generator as Faker;

$factory->define(Ligue::class, function (Faker $faker) {
    //

    return [
    'name' => str_random(5),
    'category' => str_random(1),

    ];
});
