<?php

use App\Partie;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Partie::class, function (Faker $faker) {
    //
    $win_team = App\Equipe::all()->random()->id;
    $lose_team = App\Equipe::all()->random()->id;
    $winscore = mt_rand(1,5);
    return [
    'local_team' => $win_team,
    'visitor_team' => $lose_team,
    'saison_id' =>1,
    'titre' => 'match',
    'lieu' => 'ville X',
    'date' => Carbon::now(),
    'winning_team' => $win_team,
    'losing_team' => $lose_team,
    'final_score_local' => $winscore,
    'final_score_visitor' => $winscore - 2,

    ];
});
