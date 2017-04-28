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
    	factory(App\Saison::class)->create()->each(function($s){
            
            $s->partie()->saveMany(factory(App\Partie::class, 10)->create()->each(function ($p){

                $p->stats()->saveMany(factory(App\Stats::class, 10)->make());

            }));
        });

    }
}
