<?php

use Illuminate\Database\Seeder;
use App\Stat_type;

class Stat_typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $type = [
    	['nom' => 'but'],
    	['nom' => 'assist'],
    	['nom' => 'penalite'],
    ];
        foreach($type as $type){
    		Stat_type::create($type);
		}
	}
}
