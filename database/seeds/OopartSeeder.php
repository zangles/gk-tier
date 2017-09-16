<?php

use Illuminate\Database\Seeder;

class OopartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type1 = ['STR', 'DEF', 'ACC', 'LUK'];
        $type2 = ['Strength','Defense','Accuracy','Luck'];
        $letters = ['A','B','C','D','E','F'];
        $config = app('config');

        foreach ($type1 as $k => $t1) {
            foreach ($letters as $letter) {
                \DB::table('ooparts')->insert(array (
                    'name' => $config['constants']['TRANSLATION_OOPARTS_'.$t1.'_'.$letter],
                    'type' => $type2[$k],
                    'letter' => $letter
                ));
            }
        }

    }
}
