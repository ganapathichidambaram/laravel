<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (            
            0 => 
            array (
                'id' => 1,
                'name' => 'User Read',
                'slug' => 'users.read',
                'description' => 'Read Permission for User',
                'deleted_at' => NULL,
                'created_at' => '2021-06-09 19:18:07',
                'updated_at' => '2021-06-09 19:26:57',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'User Edit',
                'slug' => 'users.edit',
                'description' => 'Editing of User',
                'deleted_at' => NULL,
                'created_at' => '2021-06-09 19:35:43',
                'updated_at' => '2021-06-09 19:35:43',
            ),
        ));
        
        
    }
}