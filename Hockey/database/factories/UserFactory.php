<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'email' => str_random(10).'@gmail.com',
        'password' => bcrypt('secret'),
    ];
});
