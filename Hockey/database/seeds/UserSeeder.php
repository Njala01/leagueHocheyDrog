<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
        ['name' => 'user'],
        ['name' => 'admin'],
        ['name' => 'team_admin'],
        ];
        foreach($type as $type){
            App\Role::create($type);
        }

        factory(App\User::class, 50)->create();
    }
}
