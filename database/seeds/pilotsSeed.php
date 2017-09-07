<?php

use App\Pilot;
use App\Raid;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class pilotsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,50) as $index) {
            $pilot = new Pilot();
            $pilot->id = 'c_'. str_pad($faker->numberBetween(0,999), 3, '0', STR_PAD_LEFT);
            $pilot->name = $faker->name('F');
            $pilot->type = $faker->randomElement(['Attack','Defense','Support']);

            $raids = Raid::all();

            foreach ($raids as $raid) {
                $pilot->raid()->attach($raid->id, ['tier' => $faker->randomElement(['S','A','B','C','D','E','F']) ] );
            }

            $pilot->save();
        }
    }
}
