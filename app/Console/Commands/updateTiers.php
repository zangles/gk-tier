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
        $this->line('recover Csv');
        $csv = file_get_contents($this->sheetUrl);
        $nameColumn = 0;
        $raidsColumns['4230011'] = 1; //demon
        $raidsColumns['4230012'] = 2; //dragon
        $raidsColumns['4230013'] = 3; //kraken
        $raidsColumns['1913'] = 4; //deathmatch
        $raidsColumns['1919'] = 5; //shootout
        $raidsColumns['1908'] = 6; //arena

        $rows = array_map('str_getcsv', explode("\n", $csv));

        $pilotsBar = $this->output->createProgressBar(count($rows));
        $pilotsBar->setMessage('Updating Tiers');
        $pilotsBar->setFormatDefinition('custom', ' %current%/%max% [%bar%] -- %message%');
        $pilotsBar->setFormat('custom');

        $totalPilots = Pilot::all()->count();
        $updated = 0;
        foreach ($rows as $pilotTier) {
            if ($pilotTier[$nameColumn] != '') {
                $pilotName = $this->specialNames($pilotTier[$nameColumn]);



                $translates = Translation::where('text','like', $pilotName.'%')
                    ->where('locale','=','en')
                    ->orderBy('id','asc')
                    ->get();

                foreach ($translates as $translate) {
                    $codeName = $translate->item;

                    $pilot = Pilot::where('name',$codeName)->get();

                    if (count($pilot) > 0) {
                        $pilotsBar->setMessage('Updating tiers - ' . $pilotName);

                        $raids = Raid::all();

                        DB::table('pilot_raid')
                            ->where('pilot_id', $pilot[0]->id)
                            ->delete();

                        foreach ($raids as $raid) {
                            $pilot[0]->raid()->attach($raid->id, ['tier' => $this->getClearTier($pilotTier[$raidsColumns[$raid->name]]) ] );
                        }

                        $updated++;
                        $pilot[0]->save();
                    }
                }
            }
            $pilotsBar->advance();
        }
        $pilotsBar->finish();

        $this->line(PHP_EOL);
        $this->info('pilots tiers updated '.$updated.'/'.$totalPilots);

    }

    private function getClearTier($tier)
    {
        return str_replace('*','' ,trim($tier));
    }

    private function specialNames($name)
    {
        $rtrn = $name;
        // excel name => translation name
        $maps = [
            'Ryu Bing Bing' => 'Ryu BingBing',
            'Betty Abagail' => 'Betty Abigail',
        ];

        if (isset($maps[$name])) {
            $rtrn = $maps[$name];
        }

        return $rtrn;
    }
}
