<?php

use Illuminate\Database\Seeder;

class SourceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('lead_source')->delete();
        
        \DB::table('lead_source')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'Web',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'Chat',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'Phone',
            ),
            3 =>
            array (
                'id' => 4,
                'name' => 'Referal',
            ),
            4 =>
            array (
                'id' => 5,
                'name' => 'Blogs',
            ),
            5 =>
            array (
                'id' => 6,
                'name' => 'Social Media',
            ),
            6 =>
            array (
                'id' => 7,
                'name' => 'Events',
            ),
            7 =>
            array (
                'id' => 8,
                'name' => 'Advertisements',
            ),
            8 =>
            array (
                'id' => 9,
                'name' => 'Manually By Web',
            ),
           
        ));
    }
}
