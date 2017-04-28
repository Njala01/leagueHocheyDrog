<?php

use Illuminate\Database\Seeder;

class LigueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        factory(App\Ligue::class, 10)->create()->each(function($l){
            
            $l->equipe()->saveMany(factory(App\Equipe::class, 5)->create()->each(function ($e){

                $e->joueur()->saveMany(factory(App\Joueur::class, 10)->make());

            }));
        });
    }
}
