<?php

namespace App\Console\Commands;

use App\Pilot;
use App\pilotsDress;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
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
    
    private $totals = [];

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
        $time_start = microtime(true);

        ini_set('max_execution_time', 9999);
        set_time_limit ( 9999 );

        Artisan::call('down');
        exec('git clone https://github.com/questforboobs/gkdata');

        $this->loadTrans();
        $this->migratePilots();
        $this->showResult();
        Artisan::call('up');

        exec('rm -rf '.realpath(base_path('gkdata')));

        $totalTime = 'Total execution time in seconds: ' . (microtime(true) - $time_start);
        $this->line($totalTime);
    }

    private function showResult()
    {
        $this->line('------------------------------------');
        foreach ($this->totals as $title=>$total) {
            $this->info($total . ' ' . $title);
        }
        $this->line('------------------------------------');
    }

    private function migratePilots()
    {
        $pilots = $this->getJsonFile('CommanderDataTable.json');
        $this->units = $this->getJsonFile('UnitDataTable.json');
        $this->dresses = $this->getJsonFile('CommanderCostumeDataTable.json');

        $PilotsBar = $this->output->createProgressBar(count($pilots));
        $PilotsBar->setMessage('Updating Pilots');
        $PilotsBar->setFormatDefinition('custom', ' %current%/%max% [%bar%] -- %message% %pilotname%');
        $PilotsBar->setFormat('custom');

        $totalNew = 0;
        $totalUpdate = 0;
        foreach ($pilots as $pilot) {
            if ($pilot->C_Type == 1){
                $PilotsBar->setMessage( trans('gk.'.$pilot->S_Idx), 'pilotname');

                $auxPilot = Pilot::find($pilot->resourceId);
                if (is_null($auxPilot)) {
                    $this->createPilot($pilot);
                    $totalNew++;
                } else {
                    $this->updatePilot($pilot);
                    $totalUpdate++;
                }

            }

            $PilotsBar->advance();
        }
        $PilotsBar->setMessage( '', 'pilotname');
        $PilotsBar->setMessage('Updating Pilots - Complete');
        $PilotsBar->finish();
        $this->line(PHP_EOL);
        $this->totals = array_merge($this->totals,[
            'new Pilots' => $totalNew,
            'updated Pilots' => $totalUpdate
        ]);

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

        $newsLangs = 0;
        $LocaleBar = $this->output->createProgressBar(count($this->locales));
        $LocaleBar->setMessage('Updating Locales');
        $LocaleBar->setFormatDefinition('custom', ' %current%/%max% [%bar%] -- %message%');
        $LocaleBar->setFormat('custom');

        foreach ($this->locales as $localeCode=>$localeName) {
            if(Language::where('locale' ,'=',$localeCode)->get()->count() == 0){
                $locale->create(['locale' => $localeCode, 'name' => $localeName]);
                $newsLangs++;
            }
            $LocaleBar->advance();
        }
        $LocaleBar->setMessage('Updating Locales - Complete');
        $LocaleBar->finish();
        $this->line(PHP_EOL);

        $this->totals = array_merge($this->totals,['new Locales' => $newsLangs]);

        $trans = $this->getTxtFile('Localization.txt');
        $totalTrans = (count($trans)-1)*count($this->locales);

        $transBar = $this->output->createProgressBar($totalTrans);
        $transBar->setMessage('Updating Translations');
        $transBar->setFormatDefinition('custom', ' %current%/%max% [%bar%] -- %message%');
        $transBar->setFormat('custom');

        $totalNewTrans = 0;
        $totalUpdateTrans = 0;
        $countTrans = count($trans);
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
        $transBar->setMessage('Updating Translations - Complete');
        $transBar->finish();
        $this->line(PHP_EOL);

        $this->totals = array_merge($this->totals,[
            'new Translations' => $totalNewTrans,
            'updated Translations' => $totalUpdateTrans
        ]);
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
