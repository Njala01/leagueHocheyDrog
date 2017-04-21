<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class JoueurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         foreach(App\Equipe::all() as $e){
            for($i = 0; $i <= 10; i++){
                return [
                    'name' => $faker->name,
                    'position' => 'attaque',
                ];
            }
        }
    }
}
