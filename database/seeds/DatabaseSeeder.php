<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeed::class);
        $this->call(RaidSeed::class);
        //$this->call(pilotsSeed::class);
        // $this->call(UsersTableSeeder::class);
    }
}
