<?php

use Illuminate\Database\Seeder;

class RaidSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //demon
        \DB::table('raids')->insert(array (
            'name'        => '4230011',
        ));
        //dragon
        \DB::table('raids')->insert(array (
            'name'        => '4230012',
        ));
        //kraken
        \DB::table('raids')->insert(array (
            'name'        => '4230013',
        ));
        //deathmatch
        \DB::table('raids')->insert(array (
            'name'        => '1913',
        ));
        //shootout
        \DB::table('raids')->insert(array (
            'name'        => '1919',
        ));
        //arena
        \DB::table('raids')->insert(array (
            'name'        => '1908',
        ));
    }
}
