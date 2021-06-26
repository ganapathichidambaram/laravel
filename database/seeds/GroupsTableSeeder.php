<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('groups')->delete();
        
        \DB::table('groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'SuperAdmin',
                'slug' => 'super-admin',
                'description' => 'Super Admin Group',
                'deleted_at' => NULL,
                'created_at' => '2021-06-09 18:21:18',
                'updated_at' => '2021-06-09 18:21:18',
            ),       
            
        ));
        
        
    }
}