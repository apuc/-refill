<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUser = User::where('email', 'test@test.test')->first();
        if(!$testUser){
            User::firstOrCreate([
                'name' => 'test',
                'email' => 'test@test.test',
                'password' => bcrypt('test123'),
            ]);
        }
//        factory('App\User', 20)->create();
    }
}
