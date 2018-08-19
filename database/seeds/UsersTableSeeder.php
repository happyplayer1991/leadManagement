<?php

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
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('admin123'),
                'address' => '',
                'work_number' => 0,
                'personal_number' => 0,
                'image_path' => '',
                'remember_token' => null,
                'company_name'=>'admin',
                'company_id'=> '1515483847',
                'random_unique_number' =>'1515483850',
                'created_at' => '2016-06-04 13:42:19',
                'updated_at' => '2016-06-04 13:42:19',
                'date_expired' => '2025-12-30'
            ),
        ));
    }
}
