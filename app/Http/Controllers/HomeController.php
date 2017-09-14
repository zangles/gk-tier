<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateDb;
use App\Pilot;
use App\Raid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{

//    public function __construct()
//    {
//        $this->middleware('auth');
//    }


    public function updateDb()
    {
//        ini_set('max_execution_time', 9999);
//        set_time_limit ( 9999 );
//        Artisan::call('command:migrate:json');

        return redirect()->route('home');
    }

    public function changeStatus()
    {
        if(App::isDownForMaintenance()) {
            Artisan::call('up');
        } else {
            Artisan::call('down');
        }

        return redirect()->route('home');
    }

    public function list()
    {
        $pilots = Pilot::orderBy('name')->get();
        $raids = Raid::all();
        $title = 'Pilots';

        return view('pilot.list', compact('pilots','raids', 'title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        $pilots = Pilot::all();
//        $raids = Raid::all();
//
//        return view('home', compact('pilots','raids'));
//    }

    public function best($id)
    {
        $pilots = Pilot::all();
        $raids = Raid::all();
        $raidId = $id;

        $raid = Raid::findOrFail($raidId);

        $title = 'The best in '.$raid->name;

        return view('pilot.list', compact('pilots','raids','raidId', 'title'));
    }

    public function pilot($id)
    {
        $pilot = Pilot::findOrFail($id);
        $raids = Raid::all();

        $title = trans('gk.'.$pilot->name);

        return view('pilot.view', compact('pilot', 'raids', 'title'));
    }
}
