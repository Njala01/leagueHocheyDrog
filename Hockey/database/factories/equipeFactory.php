<?php

use App\Equipe;
use Faker\Generator as Faker;

$factory->define(Equipe::class, function (Faker $faker) {
    
    return [
    'name' => str_random(7),
    'admin_id' => App\User::all()->random()->id,
    'ligue_id' => 1,
    ];
});
