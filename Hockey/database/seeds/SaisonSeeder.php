<?php

use Illuminate\Database\Seeder;

class SaisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Saison::class, 100)->create()->each(function($s){
            
            $s->partie()->saveMany(factory(App\Partie::class, 5)->create()->each(function ($e){

                $e->stats()->saveMany(factory(App\Stats::class, 2)->make());

            }));
        });
    }
}
