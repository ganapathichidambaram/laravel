<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Ganapathi Chidambaram',
                'email' => 'ganapathi.rj@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$J3.nmpw3hkmmekMgRwr1NO/3FK1nplG0aytpmGEspFvIOnWC1O0wO',
                'remember_token' => NULL,
                'created_at' => '2021-06-03 17:19:37',
                'updated_at' => '2021-06-07 19:44:27',
            )
        ));
        
        
    }
}