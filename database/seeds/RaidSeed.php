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
        $config = app('config');
        
        //demon
        \DB::table('raids')->insert(array (
            'name'        => $config['constants']['TRANSLATION_RAID_DEMON_ID'],
        ));
        //dragon
        \DB::table('raids')->insert(array (
            'name'        => $config['constants']['TRANSLATION_RAID_DRAGON_ID'],
        ));
        //kraken
        \DB::table('raids')->insert(array (
            'name'        => $config['constants']['TRANSLATION_RAID_KRAKEN_ID'],
        ));
        //deathmatch
        \DB::table('raids')->insert(array (
            'name'        => $config['constants']['TRANSLATION_RAID_DEATHMATCH_ID'],
        ));
        //shootout
        \DB::table('raids')->insert(array (
            'name'        => $config['constants']['TRANSLATION_RAID_SHOOTOUT_ID'],
        ));
        //arena
        \DB::table('raids')->insert(array (
            'name'        => $config['constants']['TRANSLATION_RAID_ARENA_ID'],
        ));
    }
}
