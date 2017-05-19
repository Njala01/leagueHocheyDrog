<?php

use App\Partie;
use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(Partie::class, function (Faker $faker) {
    //
    $win_team = App\Equipe::all()->random()->id;
    $lose_team = App\Equipe::all()->random()->id;
    $winscore = mt_rand(2,5);

    $start_date = '2015-12-31 00:00:00';
    $end_date = '2018-01-01 00:00:00';

    $min = strtotime($start_date);
    $max = strtotime($end_date);

            // Generate random number using above bounds
    $val = rand($min, $max);
    $weeks = rand(1, 52);

            // Convert back to desired date format
    $start = new DateTime(date('Y-m-d H:i:s', $val));

    if($start < Carbon::today()){
    return [
    'local_team' => $win_team,
    'visitor_team' => $lose_team,
    'saison_id' =>rand(1,10),
    'titre' => 'match',
    'lieu' => $faker->city,
    'date' => $start,
    'winning_team' => $win_team,
    'losing_team' => $lose_team,
    'final_score_local' => $winscore,
    'final_score_visitor' => $winscore - 2,

    ];}else{
    return [
    'local_team' => $win_team,
    'visitor_team' => $lose_team,
    'saison_id' =>rand(1,10),
    'titre' => 'match',
    'lieu' => str_random(7),
    'date' => $start,

    ];}
});
