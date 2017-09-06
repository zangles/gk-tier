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
        \DB::table('raids')->insert(array (
            'name'        => 'Demon',
        ));
        \DB::table('raids')->insert(array (
            'name'        => 'Dragon',
        ));
        \DB::table('raids')->insert(array (
            'name'        => 'Kraken',
        ));
        \DB::table('raids')->insert(array (
            'name'        => 'Deathmatch',
        ));
        \DB::table('raids')->insert(array (
            'name'        => 'Shootout',
        ));
        \DB::table('raids')->insert(array (
            'name'        => 'Arena',
        ));
    }
}
