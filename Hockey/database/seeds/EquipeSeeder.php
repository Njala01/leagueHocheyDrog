<?php

use Illuminate\Database\Seeder;

class EquipeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Equipe::class, 10)->create()->each(function ($e){
        	$e->joueur()->saveMany(factory(App\Joueur::class, 10)->make());

        });
    }
}
