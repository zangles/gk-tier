<?php

namespace App\Console\Commands;

use App\Pilot;
use App\Raid;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Waavi\Translation\Models\Translation;

class updateTiers extends Command
{

    protected $sheetUrl = 'https://docs.google.com/spreadsheets/d/1VdCDI_C1TSb7ELXy5tUKbCWaWdOkVN9bBYJ4-YWsqQg/export?gid=819772222&format=csv';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pilots:update:tiers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update pilot tiers from Astral excel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $csv = file_get_contents($this->sheetUrl);
        $nameColumn = 0;
        $raidsColumns['4230011'] = 1; //demon
        $raidsColumns['4230012'] = 2; //dragon
        $raidsColumns['4230013'] = 3; //kraken
        $raidsColumns['1913'] = 4; //deathmatch
        $raidsColumns['1919'] = 5; //shootout
        $raidsColumns['1908'] = 6; //arena

        $rows = array_map('str_getcsv', explode("\n", $csv));

        foreach ($rows as $pilotTier) {
            if ($pilotTier[$nameColumn] != '') {
                $translates = Translation::where('text','like', $pilotTier[$nameColumn].'%')
                    ->where('locale','=','en')
                    ->orderBy('id','asc')
                    ->get();

                foreach ($translates as $translate) {
                    $codeName = $translate->item;

                    $pilot = Pilot::where('name',$codeName)->get();

                    if (count($pilot) > 0) {
                        $raids = Raid::all();

                        DB::table('pilot_raid')
                            ->where('pilot_id', $pilot[0]->id)
                            ->delete();

                        foreach ($raids as $raid) {
                            $pilot[0]->raid()->attach($raid->id, ['tier' => $pilotTier[$raidsColumns[$raid->name]] ] );
                        }

                        $pilot[0]->save();
                    }
                }

            }
        }


    }
}
