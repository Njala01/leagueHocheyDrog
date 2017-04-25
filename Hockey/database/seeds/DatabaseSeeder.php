<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
    	$this->call(UserSeeder::class);
        $this->call(Stat_typeSeeder::class);
        $this->call(LigueSeeder::class);
        $this->call(SaisonSeeder::class);
        
    }
}
