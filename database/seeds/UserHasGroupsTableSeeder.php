<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserHasGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_has_groups')->delete();
        
        \DB::table('user_has_groups')->insert(array (
            0 => 
            array (
                'user_id' => 1,
                'group_id' => 1,
            ),
        ));
        
        
    }
}