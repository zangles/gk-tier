<?php

namespace App\Console\Commands;

use App\Pilot;
use App\pilotsDress;
use Illuminate\Console\Command;
use Waavi\Translation\Models\Language;
use Waavi\Translation\Models\Translation;
use Waavi\Translation\Repositories\LanguageRepository;
use Waavi\Translation\Repositories\TranslationRepository;

class migratejson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:migrate:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    protected $locales = [
        'en' => 'English',
        'es' => 'Español',
    ];

    protected $localePosition = [
        'en' => 2,
        'es' => 4
    ];

    private $units;
    private $dresses;

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
        $this->line('Updating Translation');
        $this->loadTrans();
        $this->line('--------------------------------');
        $this->line('Updating Pilots');
        $this->migratePilots();
        $this->info('FINISH');

    }

    private function migratePilots()
    {
        $pilots = $this->getJsonFile('CommanderDataTable.json');
        $this->units = $this->getJsonFile('UnitDataTable.json');
        $this->dresses = $this->getJsonFile('CommanderCostumeDataTable.json');

        $PilotsBar = $this->output->createProgressBar(count($pilots));
        $totalNew = 0;
        $totalUpdate = 0;
        foreach ($pilots as $pilot) {
            if ($pilot->C_Type == 1){
                if (Pilot::find($pilot->resourceId)->count() == 0) {
                    $this->createPilot($pilot);
                    $totalNew++;
                } else {
                    $this->updatePilot($pilot);
                    $totalUpdate++;
                }

            }

            $PilotsBar->advance();
        }
        $PilotsBar->finish();
        $this->info(PHP_EOL.$totalNew.' new Pilots');
        $this->info($totalUpdate.' updated Pilots');
    }

    private function createPilot($pilot)
    {
        $code = $pilot->resourceId;
        $unitId = $pilot->unitId;
        $transNameId = $pilot->S_Idx;

        $newPilot = new Pilot();
        $newPilot->id = $code;
        $newPilot->name = $transNameId;
        $newPilot->type = $this->getUnitType($unitId);

        $pilotDresses = $this->getPilotDresses($pilot->id);

        foreach ($pilotDresses as $pilotDress) {
            $dress = new pilotsDress();
            $dress->name = $pilotDress->name;
            $newPilot->dress()->save($dress);
        }

        $newPilot->save();
    }

    private function updatePilot($pilot)
    {
        $code = $pilot->resourceId;
        $unitId = $pilot->unitId;
        $transNameId = $pilot->S_Idx;


        $dbPilot = Pilot::findOrFail($code);

        $dbPilot->name = $transNameId;
        $dbPilot->type = $this->getUnitType($unitId);

        $dbPilot->dress()->delete();

        $pilotDresses = $this->getPilotDresses($pilot->id);

        foreach ($pilotDresses as $pilotDress) {
            $dress = new pilotsDress();
            $dress->name = $pilotDress->name;
            $dbPilot->dress()->save($dress);
        }

        $dbPilot->save();
    }

    private function getPilotDresses($id)
    {
        $dresses = [];
        foreach ($this->dresses as $dress) {
            if ($dress->cid == $id) {
                $dresses[] = $dress;
            }
        }

        return $dresses;
    }

    private function getUnitType($unitId)
    {
        foreach ($this->units as $unit) {
            if($unit->key == $unitId ){
                switch ($unit->job) {
                    case 1:
                        return 'Attack';
                        break;
                    case 2:
                        return 'Defense';
                        break;
                    case 3;
                        return 'Support';
                        break;
                }
            }
        }

        return false;
    }

    private function loadTrans()
    {
        $locale = new Language();
        $this->line('Creating Languages');

        $newsLangs = 0;
        $LocaleBar = $this->output->createProgressBar(count($this->locales));

        foreach ($this->locales as $localeCode=>$localeName) {
            if(Language::where('locale' ,'=',$localeCode)->get()->count() == 0){
                $locale->create(['locale' => $localeCode, 'name' => $localeName]);
                $newsLangs++;
            }
            $LocaleBar->advance();
        }
        $LocaleBar->finish();
        $this->info(PHP_EOL.$newsLangs.' new Locales created');

        $this->line('Updating Translations');
        $trans = $this->getTxtFile('Localization.txt');
        $totalTrans = (count($trans)-1)*count($this->locales);
        $transBar = $this->output->createProgressBar($totalTrans);
        $totalNewTrans = 0;
        $totalUpdateTrans = 0;
        foreach ($trans as $k => $tran) {
            if ($k > 0) {
                foreach ($this->locales as $localeCode=>$localeName) {

                    $text = $tran[$this->localePosition[$localeCode]];
                    $dbTrans = Translation::where('locale' ,'=',$localeCode)
                        ->where('item', $tran[0])
                        ->get();

                    if($dbTrans->count() == 0)
                    {
                        $aux = new Translation();

                        $aux->create([
                            'locale' => $localeCode,
                            'namespace' => '*',
                            'group' => 'gk',
                            'item' => $tran[0],
                            'text' => $text
                        ]);
                        $totalNewTrans++;
                    } else {
                        $dbTrans[0]->text = $text;
                        $dbTrans[0]->save();
                        $totalUpdateTrans++;
                    }
                    $transBar->advance();
                }
            }
        }
        $transBar->finish();
        $this->info(PHP_EOL.$totalNewTrans.' new Translations');
        $this->info($totalUpdateTrans.' updated Translations');

    }

    private function getJsonFile($name)
    {
        return json_decode($this->getFile($name));
    }

    private function getTxtFile($name)
    {
        $content = [];
        $file = fopen($file = realpath(base_path('gkdata/Regulation/'.$name)), 'r');
        while (($line = fgetcsv($file,0,'|')) !== FALSE) {
            //$line is an array of the csv elements

            $content[] = $line;
        }
        fclose($file);

        return $content;
    }

    private function getFile($name)
    {
        $file = realpath(base_path('gkdata/Regulation/'.$name));
        return file_get_contents($file);
    }
}
